<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $image=D("home_image")->where("id not in (select max(id) from home_image)")->order('id desc')->select();
        $picture=D("home_image")->where("id in (select max(id) from home_image)")->find();
        $num=D("home_image")->count();
        $rs=D('contact')->find();
       // $information_picture=D('information')->where("id = (select max(id) from information where type = 1 )")->find();
        //先检查是否有设置特殊展板
        $check = D("information")->where("if_special = 1")->find();
        if($check){
            $edit = $check['id'];
            $news_box1=D('information')->where("id = ".$edit)->find();
        }else{
            $news_box1=D('information')->where("id = (select max(id) from information where type = 1 and information_images_path != '')")->find();
        }
        $news_box2=D('information')->where('type = 1 and information_images_path != "" ')->limit("0,9")->order("id desc")->select();
       // $news_box1['content'] =htmlspecialchars($news_box1['content']);
        $news_box1['content'] = strip_tags($news_box1['content']);
       // dump($information_picture);
        $body=array(
            "image"=>$image,
            "num"=>$num,
           // 'picture1'=>$information_picture,
            'picture'=>$picture,
            'rs'=>$rs,
            'news_box1'=>$news_box1,
            'list'=>$news_box2,
        );
        $this->assign($body);
        $this->display();
    }
}