<?php
namespace Yan\Controller;
use Think\Controller;
class InformationController extends Controller {
    //动态资讯
    public function information(){
        $rs=D('di_contact')->find();
        $page = I("p",'int');
        $pagesize = 9;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $data = D('di_information')->where('type = 1')->limit("{$offset},{$pagesize}")->order("id desc")->select();
        $count = D("di_information")->where('type = 1')->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出
        $body=array(
            'rs'=>$rs,
            'list'=>$data,
            'pagination'=>$pagination,
        );
        $this->assign($body);
        $this->display();
    }
    //招贤纳士
    public function recruitment(){
        $rs=D('di_contact')->find();
        //招贤纳士
        $recruitment = D('di_recruitment')->find();

        $body=array(
            'recruitment'=>$recruitment,

            'rs'=>$rs
        );
        $this->assign($body);
        $this->display();
    }
    //产品及解决方案
    public function production(){
        $rs=D('di_contact')->find();
        //技术服务
        $data1 =D('di_production')->where('type = "B"')->order("id desc")->select();
        $body=array(
            'rs'=>$rs,
            'data1'=>$data1,
        );
        $this->assign($body);
        $this->display();
    }
    //aboutus
    public function aboutUs(){
        $rs=D('di_contact')->find();
        //关于我们
        $aboutus = D('di_aboutus')->where("id = 1")->find();
        //专家团队
        $experts = D('di_aboutus')->where("type = 3")->select();
        $image = D('di_aboutus')->where('type =2 and sortby = 1')->select();
        $image1 = D('di_aboutus')->where('type =2 and sortby = 2')->select();
        $body=array(
            'rs'=>$rs,
            "aboutus"=>$aboutus,
            "experts"=>$experts,
            'list'=>$image,
            'list1'=>$image1
        );
        $this->assign($body);
        $this->display();
    }
    public function pictureDetail(){
        $type = I("type",1);
        $data = D('di_yuangong_picture')->where("type =".$type)->select();
        $rs=D('di_contact')->find();
        $body=array(
            'rs'=>$rs,
            'list'=>$data,
            'type'=>$type
        );
        $this->assign($body);
        $this->display();
    }
    public function informationDetail(){
        $type = I("type",'1');
        $id = I('id');
        $data = D('di_information')->where("id =".$id)->find();
        $front = D('di_information')->where("id > $id and type =$type")->order('id desc')->limit('0,1')->find();
        $after = D('di_information')->where("id < $id and type =$type")->order('id desc')->limit('0,1')->find();
        $other = D('di_information')->where("id != $id and type =$type")->order('id desc')->limit('0,3')->select();
        //$data['content'] =htmlspecialchars($data['content']);
        $rs=D('di_contact')->find();
        $body=array(
            'one'=>$other,
            'front'=>$front,
            'after'=>$after,
            'rs'=>$rs,
            'list'=>$data,
            'type'=>$type
        );
        $this->assign($body);
        $this->display();
    }
}