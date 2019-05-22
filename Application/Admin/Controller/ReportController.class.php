<?php
namespace Admin\Controller;
use Think\Controller;
class ReportController extends Controller{
    public function report(){
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('report_query')->limit("{$offset},{$pagesize}")->select();
        $count = D("report_query")->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    public function addReport(){
        $id = I('id','0');
        $one = D('report_query')->where("id = {$id}")->find();
        $data = array(
            'id'=>$id,
            'one'=>$one
        );
        $this->assign($data);
        $this->display();
    }
    public function saveReport(){
        $id = I('id','0');
        $unit = I('unit');
        $code = I('code');
        $content = $_POST["content"];
        $status = I('status');
        if(empty($unit)||empty($code)||empty($content)){
            $ret = array(
                'mag'=>'fail',
                'info'=>"信息填写不全"
            );
            $this->ajaxReturn($ret);
        }
        if($id == 0){
            $data = array(
                'unit'=>$unit,
                'code'=>$code,
                'content'=>$content,
                'status'=>$status,
                'save_time'=>date("Y-m-d H:i:s"),
            );
            $save = D('report_query')->add($data);
            if($save){
                $ret = array(
                    'msg'=>'succ'
                );
                $this->ajaxReturn($ret);
            }else{
                $ret = array(
                    'msg'=>'fail',
                    'info'=>'保存失败'
                );
                $this->ajaxReturn($ret);
            }
        }else{
            $data = array(
                'id'=>$id,
                'unit'=>$unit,
                'code'=>$code,
                'content'=>$content,
                'status'=>$status,
                'save_time'=>date("Y-m-d H:i:s"),
            );
            $save = D('report_query')->save($data);
            if($save){
                $ret = array(
                    'msg'=>'succ'
                );
                $this->ajaxReturn($ret);
            }else{
                $ret = array(
                    'msg'=>'fail',
                    'info'=>'保存失败'
                );
                $this->ajaxReturn($ret);
            }
        }
    }
    public function doRepDelete(){
        $id =I("id",0,'intval');
        $rs = array("msg"=>"fail");
        if(D("report_query")->where("id=".$id)->delete()){
            $rs['msg'] = 'succ';
        }
        $this->ajaxReturn($rs);
    }
}