<?php
namespace Home\Controller;
use Think\Controller;
class ContactController extends Controller {
    public function contact(){
        $rs=D('contact')->find();
        $body = array(
            'rs'=>$rs,
        );
        $this->assign($body);
        $this->display();
    }
}