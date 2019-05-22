<?php
namespace Admin\Controller;
use Think\Controller;
class MainController extends Controller {
    //初始化方法
    public function _initialize(){
        load('@.functions');
        D("account")->checkLogin();
        $this->assign('menu_active',strtolower(CONTROLLER_NAME));
        $this->assign('menu_secoud_active',strtolower(ACTION_NAME));
    }
    public function index(){
       $this->display();
    }

    //主页修改
    public function home(){
        $this->display();
    }
    //轮播图片修改
    public function lunbo(){
        $admin_auth = session("admin_auth");//获取当前登录用户信息
        $if_admin = $admin_auth['super_admin'];//是否是超级管理员
        $user=$admin_auth['gid'];//判断是哪个角色
        $de=I('de','A');

        if($de =='A'){
            $page = I("p",'int');
            $pagesize = 10;
            if($page<=0) $page = 1;
            $offset = ( $page-1 ) * $pagesize;
            $result=D('home_image')->limit("{$offset},{$pagesize}")->select();
            $count = D("home_image")->count();//!!!!!!!!!!!!!!
            $Page       = new \Think\Page($count,$pagesize);
            $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
            $pagination       = $Page->show();// 分页显示输出*
        }elseif ($de =='B'){
            $page2 = I("p2",'int');
            $pagesize2 = 10;
            if($page2<=0) $page2 = 1;
            $offset2 = ( $page2-1 ) * $pagesize2;
            $result=D('lab_image')->limit("{$offset2},{$pagesize2}")->select();
            $count = D("lab_image")->count();//!!!!!!!!!!!!!!
            $Page       = new \Think\Page($count,$pagesize2);
            $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
            $pagination       = $Page->show();// 分页显示输出$Page
        }

        $body=array(
            'lists'=>$result,
            'pagination'=>$pagination,
            'count'=>$count,
            'de'=>$de,
        );
        $this->assign($body);
        $this->display();
    }
}