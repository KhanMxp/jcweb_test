<?php
namespace Sheng\Controller;
use Think\Controller;
class ContactController extends Controller {
    public function contact(){
        $rs=D('sheng_contact')->find();
        $body = array(
            'rs'=>$rs,
        );
        $this->assign($body);
        $this->display();
    }
}