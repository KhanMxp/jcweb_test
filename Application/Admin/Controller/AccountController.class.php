<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends Controller {
	public $user = null;
	public function _initialize(){
		load('@.functions');
		//D("account")->checkLogin();
	}
	/**
	 * [login 用户登录界面]
	 * @return [type] [description]
	 */
	public function login(){
		if(D("account")->isLogin()){
			$loginUrl = U('/admin/index');
        	@header("Location:{$loginUrl}");
        	exit();
		}
		$this->assign($body);
		$this->display();
	}
	/**
	 * [doLogin 处理管理登录]
	 * @return [type] [description]
	 */
	public function doLogin(){
		$username = I("username");
		$password = I("password");
		$yzm = I("yzm");
		$rs = array('msg'=>'fail');
		if(empty($username) || empty($password) || empty($yzm)){
			$rs['msg'] = "信息填写不完整!";
			$this->ajaxReturn($rs);
		}
		$password = SHA256Hex($password);
		$where = array(
			'username'=>$username,
			'passwd'=>$password,
			'status'=>1,
		);

		$verify = new \Think\Verify();
    	$checkYzm = $verify->check($yzm);
    	if($checkYzm != true){
    		$rs['msg'] = "验证码不正确！";
    		$this->ajaxReturn($rs);
    	}
		$admin = D("common_system_user")->where($where)->find();
		if($admin && D("common_system_user")->where("id=".$admin['id'])->save(array("login_time"=>date("Y-m-d H:i:s")))){
			!$admin['super_admin'] && $role = D("common_role")->where("id=".$admin['gid'])->find();//当&&前的值为真时，后半部分将不会执行，if语句的写法
			if($role && !$role['status']){
				$rs['msg'] = "该账号已禁用！";
				$this->ajaxReturn($rs);
			}
			$power = $role['power'] ? unserialize($role['power']):array();//? 和 ：是if语句的简写用法
            //如果$power不为空，按照power中的权限标号，对权限表进行筛选
			$power && $menus = D("common_admin_nav")->where("status=1 AND id in(".implode(',', $power).")")->field("id,url,path")->select();

			if($menus){
				foreach ($menus as $v) {
					if(strpos($v['url'],'/')>-1){   //  $v['url']的形式为“controller/function”
						$v['url'] = str_replace( strrchr($v['url'].'/') , '' , $v['url']);//将"controller/function"中的"/function"去掉
						$urlaction = explode('/', $v['url']);//将所有的url以“/”为界拆分为数组
						$v['menu_active'] = strtolower($urlaction[count($urlaction)-2]);//数组的末尾倒二位，为menu_active
						$v['menu_secoud_active'] = strtolower($urlaction[count($urlaction)-1]);//数组的末位，为menu_second_active
						$admin['perm'][$v['menu_active']][] = $v['menu_secoud_active'];
					}

				}

			}
			session('admin_auth', $admin);
			$rs['msg'] = 'succ';
		}else{
			$rs['msg'] = "账号或密码错误！";
		}
		$this->ajaxReturn($rs);
	}
	public function yzmCode(){
		$config =    array(
		    'length'      =>    4,
		   	'imageW'	=> 110,
		    'imageH'	=> 32,
		    'fontSize'	=> 16,
		    'codeSet'	=>'0123456789',
		);
		$Verify = new \Think\Verify($config);
		$code = $Verify->entry();
	}
	public function logout(){
		session('admin_auth',null); // 删除name
		D("account")->checkLogin();
	}
}
//file end