<?php
namespace Yan\Controller;
use Think\Controller;
class ContactController extends Controller {
    public function contact(){
        $rs=D('di_contact')->find();
        $body = array(
            'rs'=>$rs,
        );
        $this->assign($body);
        $this->display();
    }
}