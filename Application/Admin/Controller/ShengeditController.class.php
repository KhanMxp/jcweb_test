<?php
namespace Admin\Controller;
use Think\Controller;
class shengeditController extends Controller {
    public $user = array();
    //初始化方法
    public function _initialize(){
        load('@.functions');
        $this->user = D("account")->checkLogin();
        $this->assign('menu_active',strtolower(CONTROLLER_NAME));
        $this->assign('menu_secoud_active',strtolower(ACTION_NAME));
    }
    //首页轮播图
    public function lunbo(){
        $admin_auth = session("admin_auth");//获取当前登录用户信息
        $if_admin = $admin_auth['super_admin'];//是否是超级管理员
        $user=$admin_auth['gid'];//判断是哪个角色
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sheng_home_image')->limit("{$offset},{$pagesize}")->select();
        $count = D("sheng_home_image")->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出
        $body=array(
            'lists'=>$result,
            'pagination'=>$pagination,
            'count'=>$count
        );
        $this->assign($body);
        $this->display();
    }
    //首页轮播图片保存
    public function saveImage(){
        $imgurl = I("imgurl");
        //原图地址

        $result = array("msg"=>"fail");
        if(empty($imgurl)){
            $result['msg'] = "无效的提交！";
            $this->ajaxReturn($result);
        }

        $data = array(
            'picture'=>$imgurl
        );
        M()->startTrans();
        if(D('sheng_home_image')->add($data)){
            $result['msg'] = 'succ';
            M()->commit();
        }else{
            M()->rollback();
        }
        $this->ajaxReturn($result);
    }
//首页轮播图片删除
    public function doDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("sheng_home_image")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
    //动态资讯内容
    public function information(){
        $de=I('de','A');
        if($de == 'A'){
            $type = 1;
        }
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $where="type = $type";
        $data = D("sheng_information")->where($where)->limit("{$offset},{$pagesize}")->order('id desc')->select();
        $count = D("sheng_information")->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出
        $body=array(
            'de'=>$de,
            'list'=>$data,
            'pagination'=>$pagination,
        );
        $this->assign($body);
        $this->display();
    }
    //设置特殊展板
    public function doSpecial(){
        $id = I('id');
        $rs['msg'] = 'fail!';
        if (empty($id)) {
            $rs['msg'] = 'fail!';
            $this->ajaxReturn($rs);
        }
        $data = array(
            "if_special" => 0,
        );
        $data1 = array(
            "if_special" => 1,
        );
        //检查之前是否有设置展板
        $check = D('sheng_information')->where('if_special =1')->find();
        if ($check) {//如果有，先把它清空
            $old = $check['id'];
            M()->startTrans();
            if (D('sheng_information')->where('id =' . $old)->save($data) and D('sheng_information')->where('id =' . $id)->save($data1)) {
                $rs['msg'] = 'succ';
                M()->commit();
            } else {
                M()->rollback();
            }
        }
        else{
            M()->startTrans();
            if (D('sheng_information')->where('id =' . $id)->save($data1)) {
                $rs['msg'] = 'succ';
                M()->commit();
            } else {
                M()->rollback();
            }
        }
        $this->ajaxReturn($rs);
    }
    //新闻添加缩略展示图
    public function informationPicture(){
        $id = I('id',0,'intval');
        $type = I("type");

        //type是为区分资讯和产品及解决方案，I是资讯P代表产品
        if($type == 'I'){
            $image = D('sheng_information')->where("id = ".$id)->find();
        }
        elseif($type == 'P'){
            $image = D('sheng_production')->where("id = ".$id)->find();
        }
        $body = array(
            'id'=>$id,
            'image'=>$image,
            'type'=>$type,
        );
        $this->assign($body);
        $this->display();
    }
    public function saveInfoImage(){
        $id = I("id",0,'intval');
        $type = I('type');
        if(empty($type)){
            $result['msg'] = 'fail!';
            $this->ajaxReturn($result);
        }
        $imgurl = I("imgurl");
        //原图地址
        $picture =str_replace("_thumb",'',$imgurl);
        $result = array("msg"=>"fail");
        if(empty($imgurl)){
            $result['msg'] = "无效的提交！";
            $this->ajaxReturn($result);
        }
        if($type == 'I'){
            $data = array(
                'information_images_path'=>$imgurl,
                'picture_path'=>$picture
            );
            M()->startTrans();
            if(D('sheng_information')->where("id = ".$id)->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }elseif($type == 'P'){
            $data = array(
                'thumb_path'=>$imgurl,
                'picture_path'=>$picture
            );
            M()->startTrans();
            if(D('sheng_production')->where("id = ".$id)->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }

        $this->ajaxReturn($result);
    }
    //动态资讯新增
    public function addInformation(){
        $type = I('de');
        $id = I('id');
        if($id){
            $check = D('sheng_information')->where('id ='.$id)->find();
            $check['content'] =htmlspecialchars($check['content']);
            $body = array(
                'one'=>$check,
                'de'=>$type
            );
        }else{
            $body = array(
                'de'=>$type
            );
        }
        $this->assign($body);
        $this->display();
    }
    //保存信息
    public function saveInfo(){
        $de = I('type');
        $id = I('id');
        if($de == 'A'){
            $type = 1;
        }
        elseif($de == 'B'){
            $type = 2;
        }
        $title =$_POST["title"];
        $content = $_POST["content"];
        $result = array("msg"=>"fail");
        if($id){
            $data = array(
                'title' => $title,
                'content' => $content,
                'save_time'=>date("Y-m-d H:i:s"),
            );
            M()->startTrans();
            if(D('sheng_information')->where("id =".$id)->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }
        else{
            $data = array(
                'type'=>$type,
                'title' => $title,
                'content' => $content,
                'save_time'=>date("Y-m-d H:i:s"),
            );
            M()->startTrans();
            if(D('sheng_information')->add($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }
        $this->ajaxReturn($result);
    }
    public function saveInformationImage(){
        $imgurl = I("imgurl");
        //原图地址
        $picture =str_replace("_thumb",'',$imgurl);
        $result = array("msg"=>"fail");
        if(empty($imgurl)){
            $result['msg'] = "无效的提交！";
            $this->ajaxReturn($result);
        }

        $data = array(
            'picture_name'=>$imgurl,
            'picture'=>$picture
        );
        M()->startTrans();
        if(D('sheng_home_image')->add($data)){
            $result['msg'] = 'succ';
            M()->commit();
        }else{
            M()->rollback();
        }
        $this->ajaxReturn($result);
    }
    //删除
    public function doInfoDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("sheng_information")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
//联系我们信息修改
    public function contactus() {
        $rs=D('sheng_contact')->find();
        $this->assign($rs);
        $this->display();
    }

    public function saveContactInformation(){
        $words1=I("words1");
        $words2=I("words2");
        $company_name=I("company_name");
        $address=I('address');
        $email=I("email");
        $telephone=I('telephone');
        $result = array("msg"=>"fail");
        $data =array(
            'words1'=>$words1,
            'words2'=>$words2,
            'company_name'=>$company_name,
            'address'=>$address,
            'telephone'=>$telephone,
            'email'=>$email,
        );
        $check = D('sheng_contact')->select();

        if($check){
            M()->startTrans();
            if(D('sheng_contact')->where('id=1')->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }
        else{
            M()->startTrans();
            if(D('sheng_contact')->add($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }

        $this->ajaxReturn($result);

    }
    //招贤纳士
    public function recruitment (){
        $de=I('de','A');
        $data=D('sheng_recruitment')->find();
        $body=array(
            'de'=>$de,
            'one'=>$data
        );
        $this->assign($body);
        $this->display();
    }
    public function saveRecruitmentInformation(){
        $content=$_POST['content'];
        $result = array("msg"=>"fail");
        $data =array(
            'content'=>$content,
            'save_time'=>date("Y-m-d H:i:s"),
        );
        $a=D('sheng_recruitment')->find();
        if($a){
            M()->startTrans();
            if(D('sheng_recruitment')->where('id=1')->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
            $this->ajaxReturn($result);
        }
        else{
            M()->startTrans();
            if(D('sheng_recruitment')->add($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
            $this->ajaxReturn($result);
        }
    }
//员工图片
    public function yuangongPicture(){
        $type=I('type');
        $admin_auth = session("admin_auth");//获取当前登录用户信息
        $if_admin = $admin_auth['super_admin'];//是否是超级管理员
        $user=$admin_auth['gid'];//判断是哪个角色
        $page = I("p",'int');
        $pagesize = 10;
        $where="type = $type";
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sheng_yuangong_picture')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D("sheng_yuangong_picture")->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出
        $body=array(
            'lists'=>$result,
            'pagination'=>$pagination,
            'count'=>$count,
            'type'=>$type,
        );
        $this->assign($body);
        $this->display();
    }
    public function saveyuangongImage(){
        $imgurl = I("imgurl");
        $type = I('type');
        //原图地址
        $picture =str_replace("_thumb",'',$imgurl);
        $result = array("msg"=>"fail");
        if(empty($imgurl)){
            $result['msg'] = "无效的提交！";
            $this->ajaxReturn($result);
        }
        $data = array(
            'thumb_path'=>$imgurl,
            'picture_path'=>$picture,
            'type'=>$type,
            'save_time'=>date("Y-m-d H:i:s"),
        );
        M()->startTrans();
        if(D('sheng_yuangong_picture')->add($data)){
            $result['msg'] = 'succ';
            M()->commit();
        }else{
            M()->rollback();
        }
        $this->ajaxReturn($result);
    }
    public function doyuangongDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("sheng_yuangong_picture")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
    //产品及解决方案
    public function production(){
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $de=I('de','A');
        if($de =='A'){
            $where="type = 'A'";
            $data=D('sheng_production')->where($where)->limit("{$offset},{$pagesize}")->order('id desc')->select();
        }
        elseif($de =='B'){
            $where="type = 'B'";
            $data=D('sheng_production')->where($where)->limit("{$offset},{$pagesize}")->order('id desc')->select();
        }
        if($de == 'C'){
            $pingtai=D('service')->find();
        }
        $count = D("sheng_production")->where($where)->count();
        $Page= new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination= $Page->show();// 分页显示输出
        $body=array(
            'de'=>$de,
            'data'=>$pingtai,
            'lists'=>$data,
            'pagination'=>$pagination,
        );
        $this->assign($body);
        $this->display();
    }
    //新增加编辑
    public function addProduction(){
        $type=I('de');
        $id=I('id');
        $data="";
        if ($id){
            $data=D('sheng_production')->where('id='.$id)->find();
        }
        $body = array(
            'one'=>$data,
            'type'=>$type
        );
        $this->assign($body);
        $this->display();
    }
    public function saveProductionInformation(){
        $id = I('id');
        $type = I('type');
        $name = I('title');
        $content = $_POST["content"];
        $result = array("msg"=>"fail");
        $data = array(
            'type'=>$type,
            'name'=>$name,
            'content'=>$content,
            'save_time'=>date("Y-m-d H:i:s"),
        );
        if(empty($id)){
            M()->startTrans();
            if(D('sheng_production')->add($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }

        }else{
            M()->startTrans();
            if(D('sheng_production')->where("id=".$id)->save($data)){
                $result['msg'] = 'succ';
                M()->commit();
            }else{
                M()->rollback();
            }
        }
        $this->ajaxReturn($result);


    }
    public function doProductionDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("sheng_production")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
    //关于我们
    public function aboutus(){
        $this->display();
    }
    //关于我们信息保存
    public function saveIntroduction(){
        $result = array("msg"=>"fail");
        $content = $_POST["content"];
        $data = array(
            'content'=>$content,
            'type'=>1,
            'save_time'=>date("Y-m-d H:i:s"),
        );
        $check = D('sheng_aboutus')->where("type = 1")->find();
        if($check){
            if(D('sheng_aboutus')->where("type = 1")->save($data)){
                $result['msg'] = 'succ';
            }
        }
        else{
            if(D('sheng_aboutus')->add($data)){
                $result['msg'] = 'succ';
            }
        }
        $this->ajaxReturn($result);
    }
    public function introduction(){
        $data = D('sheng_aboutus')->where("type = 1")->find();
        $body = array(
            'one'=>$data,
        );
        $this->assign($body);
        $this->display();
    }
    public function show(){
        $type = I('type');
        $imgurl = D('sheng_aboutus')->where("type = 1")->find();
        $list = D('sheng_aboutus')->where("type = 2")->select();
        if($type == 1){
            $body = array(
                'data'=>$imgurl,
                'lists'=>$list,
                'type'=>$type,
            );
        }else{
            $body = array(
                'lists'=>$list,
                'type'=>$type,
            );
        }

        $this->assign($body);
        $this->display();
    }
    public function showSave(){
        $rs = array("msg"=>"fail");
        $type = I('type');
        $sortby = I('sortby');
        $img = I("imgurl");
        if(empty($img)){
            $rs['msg'] = "无效的提交！";
            $this->ajaxReturn($rs);
        }
        $picture =str_replace("_thumb",'',$img);
        $data = array(
            'type'=>$type,
            'thumb_path'=>$img,
            'pic_path'=>$picture,
            'sortby'=>$sortby,
            'save_time'=>date("Y-m-d H:i:s"),
        );
        $type = I('type');
        if($type == 1){
            if(D('sheng_aboutus')->where("type = 1")->save($data)){
                $rs['msg'] = 'succ';
            }
        }else{
            if(D('sheng_aboutus')->add($data)){
                $rs['msg'] = 'succ';
            }
        }
        $this->ajaxReturn($rs);
    }
    //照片删除
    public function showDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("sheng_aboutus")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
}