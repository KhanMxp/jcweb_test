<?php
namespace Sheng\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $image=D("sheng_home_image")->where("id not in (select max(id) from sheng_home_image)")->order('id desc')->select();
        $picture=D("sheng_home_image")->where("id in (select max(id) from sheng_home_image)")->find();
        $num=D("sheng_home_image")->count();
        $rs=D('sheng_contact')->find();
        $aboutus = D('sheng_aboutus')->where("id = 1")->find();
       // $information_picture=D('information')->where("id = (select max(id) from information where type = 1 )")->find();
        //先检查是否有设置特殊展板
        $check = D("sheng_information")->where("if_special = 1")->find();
        if($check){
            $edit = $check['id'];
            $news_box1=D('sheng_information')->where("id = ".$edit)->find();
        }else{
            $news_box1=D('sheng_information')->where("id = (select max(id) from sheng_information where type = 1 and information_images_path != '')")->find();
        }
        $news_box2=D('sheng_information')->where('type = 1 ')->limit("0,2")->order("id desc")->select();
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
            'aboutus'=>$aboutus
        );

        $this->assign($body);
        $this->display();
    }
}