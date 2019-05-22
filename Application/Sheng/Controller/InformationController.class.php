<?php
namespace Sheng\Controller;
use Think\Controller;
class InformationController extends Controller {
    //动态资讯
    public function information(){
        $rs=D('sheng_contact')->find();
        $page = I("p",'int');
        $pagesize = 9;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $data = D('sheng_information')->where('type = 1')->limit("{$offset},{$pagesize}")->order("id desc")->select();
        $count = D("sheng_information")->where('type = 1')->count();//!!!!!!!!!!!!!!
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
        $rs=D('sheng_contact')->find();
        $data=D('sheng_recruitment')->find();
        $image = D('sheng_yuangong_picture')->select();
        $body=array(
            'one'=>$data,
            'bopic'=>$image,
            'rs'=>$rs
        );
        $this->assign($body);
        $this->display();
    }
    //产品及解决方案
    public function production(){
        $rs=D('sheng_contact')->find();
        $page = I("p",'int');
        $np = I("np",'int');
        $pagesize = 12;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        if($np<=0) $np = 1;
        $offset1 = ( $np-1 ) * $pagesize;
        $data = D('sheng_production')->where('type = "A"')->limit("{$offset},{$pagesize}")->order("id desc")->select();
        $count = D("sheng_production")->where('type = "A"')->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出
        $data1 =D('sheng_production')->where('type = "B"')->limit("{$offset1},{$pagesize}")->order("id")->select();
        $count1 = D("sheng_production")->where('type = "B"')->count();//!!!!!!!!!!!!!!
        $Page1       = new \Think\nPage($count1,$pagesize);
        $Page1->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination1       = $Page1->show();// 分页显示输出
        $body=array(
            'rs'=>$rs,
            'list'=>$data,
            'one'=>$data1,
            'pagination'=>$pagination,
            'page'=>$pagination1,
        );
        $this->assign($body);
        $this->display();
    }
    //aboutus
    public function aboutUs(){
        $rs=D('sheng_contact')->find();
        $data = D('sheng_aboutus')->where('type =1')->find();
        $image = D('sheng_aboutus')->where('type =2 and sortby = 1')->select();
        $image1 = D('sheng_aboutus')->where('type =2 and sortby = 2')->select();
        $body=array(
            'rs'=>$rs,
            'one'=>$data,
            'list'=>$image,
            'list1'=>$image1
        );
        $this->assign($body);
        $this->display();
    }
    public function pictureDetail(){
        $type = I("type",1);
        $data = D('yuangong_picture')->where("type =".$type)->select();
        $rs=D('contact')->find();
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
        $data = D('sheng_information')->where("id =".$id)->find();
        $front = D('sheng_information')->where("id > $id and type =$type")->order('id desc')->limit('0,1')->find();
        $after = D('sheng_information')->where("id < $id and type =$type")->order('id desc')->limit('0,1')->find();
        $other = D('sheng_information')->where("id != $id and type =$type")->order('id desc')->limit('0,3')->select();
        //$data['content'] =htmlspecialchars($data['content']);
        $rs=D('sheng_contact')->find();
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
    public function productionDetail(){
        $type = I("type",'A');
        $id = I('id');
        $data = D('sheng_production')->where("id =".$id)->find();
        //$data['content'] =htmlspecialchars($data['content']);
        $rs=D('sheng_contact')->find();
        $body=array(
            'rs'=>$rs,
            'list'=>$data,
            'type'=>$type
        );
        $this->assign($body);
        $this->display();
    }
}