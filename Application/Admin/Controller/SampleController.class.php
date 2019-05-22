<?php
namespace Admin\Controller;
use Think\Controller;
class SampleController extends Controller{
    //初始化方法
    public function _initialize(){
        load('@.functions');
        D("account")->checkLogin();
        $this->assign('menu_active',strtolower(CONTROLLER_NAME));
        $this->assign('menu_secoud_active',strtolower(ACTION_NAME));
    }
    //控制台显示参数
    function console_log($data)
    {
        if (is_array($data) || is_object($data))
        {
            echo("<script>console.log('".json_encode($data)."');</script>");
        }
        else
        {
            echo("<script>console.log('".$data."');</script>");
        }
    }
    //地方添加申请单
    public function input(){
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['username'];
        $data = array(
            'collector'=>$collector,
            'auth_id'=>$auth_id,
        );
        $this->assign($data);
        $this->display();
    }
    // 地方保存申请单
    public function doAddSample(){
        $id = I('id');
        $auth_id = I("auth_id");//申请人id
        $authname = I('authname');//申请人姓名
        $clientname = str_replace(' ','',I("clientname"));//委托单位
        $productunit = str_replace(' ','',I("productunit"));//生产单位
        $samplename = I("samplename");//样品名称
        $samplecode = I("samplecode");//样品编号
        $grade = I("grade");//等级
        $specification = I("specification");//规格型号
        $trademark = I("trademark");//商标
        $productiondate = I("productiondate");//生产日期
        $samplequantity = I("samplequantity");//样品数量
        $samplestatus = I("samplestatus");//样品状态
        $ration = I("ration");//粉（料）水比
        $testcriteria = I("testcriteria");//检测依据
        $testitem = I("testitem");//检测项目
        $testcategory = I("testcategory");//检验类别
        $ifonline = I("ifonline",0);//是否可查
        $postmethod = I("postmethod");//提交方式
        $ifsubpackage = I("ifsubpackage");//是否分包
        $clientsign = I("clientsign");//委托人签字
        $telephone = I("telephone");//电话
        $tax = I("tax");//传真
        $postcode = I("postcode");//邮政编码
        $email = I("email");//邮件
        $address = I("address");//地址
        $remark = I("remark");//备注
        $samplestaquan = I("samplestaquan");//样本品状态及数量
        $collector = I("collector");//收样人
        $centreno = I("centreno");//中心编号
        $testcost = I("testcost",0,'intval');//检验费用
        $collectdate = I("collectdate");//收样日期
        $reportdate = I("reportdate");//报告日期
//        $ifHighquantity = I("ifHighquantity");
        $package_remark = I("package_remark");//分包备注

        //验证手机号
        if(!empty($telephone)){
            $isMob="/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/";  //手机
            $isTel="/^([0-9]|[-])+$/"; //电话
            //if(!(funcmtel($telephone) || funcphone($telephone))){
            if(!(preg_match($isTel,$telephone) || preg_match($isMob,$telephone))){
                $rs['msg'] = '请输入正确的联系方式';
                $this->ajaxReturn($rs);
            }
        }

        //验证传真
        if(!empty($tax)){
            $isPostcode="/^([0-9]|[-])+$/";
            if(!(preg_match($isPostcode,$tax))){
                $rs['msg'] = '请输入正确的传真';
                $this->ajaxReturn($rs);
            }
        }

        //验证邮政编码
        if(!empty($postcode)){
            $isPostcode="/^\d{6}$/";
            if(!(preg_match($isPostcode,$postcode))){
                $rs['msg'] = '请输入正确的邮政编码';
                $this->ajaxReturn($rs);
            }
        }

        //验证邮箱
        if(!empty($email)){
            $isEmail="/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
            if(!(preg_match($isEmail,$email))){
                $rs['msg'] = '请输入正确的邮箱';
                $this->ajaxReturn($rs);
            }
        }

        if(empty($clientname)) {
            $rs['msg'] = '委托单位不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($productunit)) {
            $rs['msg'] = '生产单位不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($samplename)) {
            $rs['msg'] = '样品名称不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($testcriteria)) {
            $rs['msg'] = '检验依据不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($testitem)) {
            $rs['msg'] = '检验项目不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($samplequantity)) {
            $rs['msg'] = '样品数量不能为空!';
            $this->ajaxReturn($rs);
        }
        if(empty($samplestatus)) {
            $rs['msg'] = '样品状态不能为空!';
            $this->ajaxReturn($rs);
        }
//        if(empty($sampleStaQuan)) {
//            $rs['msg'] = '样品状态及数量不能为空!';
//            $this->ajaxReturn($rs);
//        }
//        if(empty($collector)) {
//            $rs['msg'] = '收样人不能为空!';
//            $this->ajaxReturn($rs);
//        }
//        if(empty($testCost)) {
//            $rs['msg'] = '检验费用不能为空!';
//            $this->ajaxReturn($rs);
//        }
//        if(empty($collectDate)) {
//            $rs['msg'] = '收样日期不能为空!';
//            $this->ajaxReturn($rs);
//        }
//        if(empty($reportDate)) {
//            $rs['msg'] = '报告日期不能为空!';
//            $this->ajaxReturn($rs);
//        }

        if(empty($productiondate)){
            $productionDate=null;
        }
        if(empty($id)){
            $data_sample = array(
                'auth_id'=>$auth_id,
                'authname'=>$authname,
                'clientname'=>$clientname,
                'productunit'=>$productunit,
                'samplename'=>$samplename,
                'samplecode'=>$samplecode,
                'grade'=>$grade,
                'specification'=>$specification,
                'trademark'=>$trademark,
                'productiondate'=>$productiondate,
                'samplequantity'=>$samplequantity,
                'samplestatus'=>$samplestatus,
                'ration'=>$ration,
                'testcriteria'=>$testcriteria,
                'testitem'=>$testitem,
                'testcategory'=>$testcategory,
                'ifonline'=>$ifonline,
                'postmethod'=>$postmethod,
                'ifsubpackage'=>$ifsubpackage,
                'clientsign'=>$clientsign,
                'telephone'=>$telephone,
                'tax'=>$tax,
                'postcode'=>$postcode,
                'email'=>$email,
                'address'=>$address,
                'remark'=>$remark,
                'samplestaquan'=>$samplestaquan,
                'collector'=>$collector,
                'centreno'=>$centreno,
                'testcost'=>$testcost,
                'collectdate'=>$collectdate,
                'reportdate'=>$reportdate,
                'package_remark'=>$package_remark,
                'status'=> 1,
                'lastedit'=>date("Y-m-d H:i:s"),
                'inputdate'=>date("Y-m-d"),
            );
            $save = D("sampling_form")->data($data_sample)->add();
            if($save){
                $rs['msg'] = 'succ';
                $this->ajaxReturn($rs);
            }else{
                $rs['msg'] = '保存失败';
                $this->ajaxReturn($rs);
            }
        }else{
            $data_sample = array(
                'id'=>$id,
                'auth_id'=>$auth_id,
                'authname'=>$authname,
                'clientname'=>$clientname,
                'productunit'=>$productunit,
                'samplename'=>$samplename,
                'samplecode'=>$samplecode,
                'grade'=>$grade,
                'specification'=>$specification,
                'trademark'=>$trademark,
                'productiondate'=>$productiondate,
                'samplequantity'=>$samplequantity,
                'samplestatus'=>$samplestatus,
                'ration'=>$ration,
                'testcriteria'=>$testcriteria,
                'testitem'=>$testitem,
                'testcategory'=>$testcategory,
                'ifonline'=>$ifonline,
                'postmethod'=>$postmethod,
                'ifsubpackage'=>$ifsubpackage,
                'clientsign'=>$clientsign,
                'telephone'=>$telephone,
                'tax'=>$tax,
                'postcode'=>$postcode,
                'email'=>$email,
                'address'=>$address,
                'remark'=>$remark,
                'samplestaquan'=>$samplestaquan,
                'collector'=>$collector,
                'centreno'=>$centreno,
                'testcost'=>$testcost,
                'collectdate'=>$collectdate,
                'reportdate'=>$reportdate,
                'package_remark'=>$package_remark,
                'status'=> 1,
                'ifedit'=>1,
                'lastedit'=>date("Y-m-d H:i:s"),
                'inputdate'=>date("Y-m-d"),
            );
            $save = D("sampling_form")->data($data_sample)->save();
            if($save){
                $rs['msg'] = 'succ';
                $this->ajaxReturn($rs);
            }else{
                $rs['msg'] = '保存失败';
                $this->ajaxReturn($rs);
            }
        }
    }
    //地方已提交的新申请
    public function allInput(){
        $de = I('de','A');
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($de == 'A'){
            if($if_super == 0){
                $where = "auth_id = {$auth_id} and status = 1";
            }elseif ($if_super == 1){
                $where = " status = 1";
            }
        }if($de == 'B'){
            if($if_super == 0){
                $where = "auth_id = {$auth_id} and status = 8";
            }elseif ($if_super == 1){
                $where = "status = 8";
            }
        }
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'de'=>$de,
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //删除申请单
    public function doSamDelete(){
        $id = I('id');
        $del = D('sampling_form')->where("id = {$id}")->delete();
        if($del){
            $ret = array(
              'msg'=>'succ',
            );
            $this->ajaxReturn($ret);
        }else{
            $ret = array(
                'msg'=>'删除失败',
            );
            $this->ajaxReturn($ret);
        }
    }
    //地方编辑申请单
    public function edit(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();
//        var_dump($one);
        $admin_auth = session("admin_auth");

//        var_dump($admin_auth);
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['username'];
//        var_dump($collector);
        $data = array(
            'id'=>$id,
            'status'=>1,
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'one'=>$one,
            'inputdate'=>date("Y-m-d"),
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();
    }
    //中央待确认金额
    public function zyNew(){
        $de = I('de','A');
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($de == 'A'){
            $where = "status = 1 ";
        }elseif ($de == 'B'){
            if($if_super == 0){
                $where = "status = 2 and collectorid = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 2";
            }
        }elseif ($de == 'C'){
            if($if_super == 0){
                $where = "status = 8 and collectorid = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 8";
            }
        }
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'de'=>$de,
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //中央输入金额
    public function zyCost(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();
        $admin_auth = session("admin_auth");

        $collector = $admin_auth['username'];
        $collectorid = $admin_auth['id'];

        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'one'=>$one,
            'collectorid'=>$collectorid,
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();

    }
    //中央确认金额
    public function doCost(){
        $id = I('id');
        $collector = I('collector');
        $collectorid = I('collectorid');
        $cost = I('cost');
        if($cost == 0){
            $ret = array(
                'msg'=>'金额不能为空'
            );
            $this->ajaxReturn($ret);
        }
        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'collectorid'=>$collectorid,
            'testcost'=>$cost,
            'status'=> 2,
            'lastedit'=>date("Y-m-d H:i:s"),
        );
        $save = D('sampling_form')->save($data);
        if(!$save){
            $ret = array(
                'msg'=>'提交失败'
            );
            $this->ajaxReturn($ret);
        }elseif ($save){
            $ret = array(
                'msg'=>'succ'
            );
            $this->ajaxReturn($ret);
        }
    }
    //不可编辑的查看
    public function view(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();

//        var_dump($collector);
        $data = array(
            'id'=>$id,
            'one'=>$one,
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();
    }
    //中央退回
    public function doSamBack(){
        $id = I('id');
        $admin_auth = session("admin_auth");
        $collector = $admin_auth['username'];
        $collectorid = $admin_auth['id'];
        $data = array(
            'id'=>$id,
            'status'=>8,
            'ifback'=>1,
            'lastedit'=>date("Y-m-d H:i:s"),
            'collectorid'=>$collectorid,
            'collector'=>$collector,
        );
        $save = D('sampling_form')->save($data);
        if($save){
            $ret = array(
                'msg'=>'succ',
            );
            $this->ajaxReturn($ret);
        }else{
            $ret = array(
                'msg'=>'退回失败',
            );
            $this->ajaxReturn($ret);
        }
    }
    //地方待收到样品
    public function getSample(){
        $de = I('de','A');
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($de == 'A'){
            if($if_super == 0){
                $where = "status = 2 and auth_id = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 2";
            }
        }elseif ($de == 'B'){
            if($if_super == 0){
                $where = "status = 3 and auth_id = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 3";
            }
        }elseif ($de == 'C'){
            if($if_super == 0){
                $where = "status = 4 and auth_id = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 4";
            }
        }
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'de'=>$de,
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //地方确认收到样品
    public function doSamGet(){
        $id = I('id');
        $data = array(
            'id'=>$id,
            'status'=>3,
            'lastedit'=>date("Y-m-d H:i:s"),
        );
        $save = D('sampling_form')->save($data);
        if($save){
            $ret = array(
                'msg'=>'succ',
            );
            $this->ajaxReturn($ret);
        }else{
            $ret = array(
                'msg'=>'确认失败',
            );
            $this->ajaxReturn($ret);
        }
    }
    //中央待确认中心编号
    public function zyGetCode(){
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($if_super == 0){
            $where = "status = 3 and collectorid = {$auth_id}";
        }elseif ($if_super == 1){
            $where = " status = 3";
        }
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //中央编辑中心编号
    public function zyGetSample(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();
        $admin_auth = session("admin_auth");

        $collector = $admin_auth['username'];
        $collectorid = $admin_auth['id'];

        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'one'=>$one,
            'collectorid'=>$collectorid,
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();
    }
    //中央保存中心编号
    public function doCode(){
        $id = I('id');
        $collector = I('collector');
        $collectorid = I('collectorid');
        $centreno = I('centreno');
        $samplestaquan = I('samplestaquan');
        $collectdate = I('collectdate');

        if(empty($centreno)){
            $ret = array(
                'msg'=>'中心编号不能为空'
            );
            $this->ajaxReturn($ret);
        }
        if(empty($samplestaquan)){
            $ret = array(
                'msg'=>'样品数量及状态不能为空'
            );
            $this->ajaxReturn($ret);
        }
        if(empty($collectdate)){
            $ret = array(
                'msg'=>'收样日期不能为空'
            );
            $this->ajaxReturn($ret);
        }
        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'collectorid'=>$collectorid,
            'collectdate'=>$collectdate,
            'samplestaquan'=>$samplestaquan,
            'centreno'=>$centreno,
            'status'=> 4,
            'lastedit'=>date("Y-m-d H:i:s"),
        );
        $save = D('sampling_form')->save($data);
        if(!$save){
            $ret = array(
                'msg'=>'提交失败'
            );
            $this->ajaxReturn($ret);
        }elseif ($save){
            $ret = array(
                'msg'=>'succ'
            );
            $this->ajaxReturn($ret);
        }
    }
    //中央待发出报告
    public function zyGetSend(){
        $de = I('de','A');
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($de == 'A'){
            if($if_super == 0){
                $where = "status = 4 and collectorid = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 4";
            }
        }elseif ($de == 'B'){
            if($if_super == 0){
                $where = "status = 5 and collectorid = {$auth_id}";
            }elseif ($if_super == 1){
                $where = " status = 5";
            }
        }

        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'de'=>$de,
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //中央确认发出报告
    public function getSend(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();
        $admin_auth = session("admin_auth");
        $collector = $admin_auth['username'];
        $collectorid = $admin_auth['id'];

        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'one'=>$one,
            'collectorid'=>$collectorid,
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();
    }
    //进行确认操作
    public function doSend(){
        $id = I('id');
        $collector = I('collector');
        $collectorid = I('collectorid');
        $reportdate = I('reportdate');
        if(empty($reportdate)){
            $reportdate = date("Y-m-d");
        }

        $data = array(
            'id'=>$id,
            'collector'=>$collector,
            'collectorid'=>$collectorid,
            'reportdate'=>$reportdate,
            'status'=> 5,
            'lastedit'=>date("Y-m-d H:i:s"),
        );
        $save = D('sampling_form')->save($data);
        if(!$save){
            $ret = array(
                'msg'=>'提交失败'
            );
            $this->ajaxReturn($ret);
        }elseif ($save){
            $ret = array(
                'msg'=>'succ'
            );
            $this->ajaxReturn($ret);
        }
    }

    //地方待确认收到样品
    public function getReport(){
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($if_super == 0){
            $where = "status = 5 and auth_id = {$auth_id}";
        }elseif ($if_super == 1){
            $where = " status = 5";
        }

        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }
    //地方查看report
    public function viewReport(){
        $id = I('id');
        $one = D('sampling_form')->where("id = {$id}")->find();

//        var_dump($collector);
        $data = array(
            'id'=>$id,
            'one'=>$one,
        );
//        var_dump($data);
        $this->assign($data);
        $this->display();
    }

    //地方确认收到报告
    public function doGetReport(){
        $id = I('id');

        $data = array(
            'id'=>$id,
            'status'=> 6,
            'lastedit'=>date("Y-m-d H:i:s"),
            'getdate'=>date("Y-m-d"),
        );
        $save = D('sampling_form')->save($data);
        if(!$save){
            $ret = array(
                'msg'=>'确认失败'
            );
            $this->ajaxReturn($ret);
        }elseif ($save){
            $ret = array(
                'msg'=>'succ'
            );
            $this->ajaxReturn($ret);
        }
    }

    //地方已完成
    public function done(){
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];
        $if_super = $admin_auth['super_admin'];
        if($if_super == 0){
            $where = "status = 6 and auth_id = {$auth_id}";
        }elseif ($if_super == 1){
            $where = " status = 6";
        }

        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }

    //中央已完成
    public function zyDone(){
        $admin_auth = session("admin_auth");
//        var_dump($admin_auth);die;
        $auth_id = $admin_auth['id'];
        $collector = $admin_auth['name'];

        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result= D('common_system_user')->where('gid = 6')->limit("{$offset},{$pagesize}")->select();
        $count =  D('common_system_user')->where('gid = 6')->count();//!!!!!!!!!!!!!!
        $Page       = new \Think\Page($count,$pagesize);
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $pagination       = $Page->show();// 分页显示输出*
        $data = array(
            'collector'=>$collector,
            'auth_id'=>$auth_id,
            'list'=>$result,
            'pagination'=>$pagination,
        );
        $this->assign($data);
        $this->display();
    }

    public function zyDoneDetail(){
        $authname = I('username');
//        var_dump($admin_auth);die;

        $where = " status = 6 and authname = '{$authname}'";
        $page = I("p",'int');
        $pagesize = 10;
        if($page<=0) $page = 1;
        $offset = ( $page-1 ) * $pagesize;
        $result=D('sampling_form')->where($where)->limit("{$offset},{$pagesize}")->select();
        $count = D('sampling_form')->where($where)->count();//!!!!!!!!!!!!!!
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

    //中央导出报告
    public function export(){
        $admin_auth = session("admin_auth");
        $de = I('de',0);
        $begindate = I('begindate');
        $enddate = I('enddate');
        if($de == 0){
            $this->display();
        }elseif ($de == 1){

        }
    }
    //将数据导出
    public function doExport(){
        $begindate = I('begindate');
        $enddate = I('enddate');
//        $begindate = strtotime($begindate);
//        $enddate = strtotime($enddate);
//        $this->console_log($begindate);
//        $this->console_log($enddate);
        $title  = "报告统计";
//        $where = "reportdate between {$begindate} and {$enddate}";

        $map['reportdate']  = array(array('EGT',"{$begindate},"),array('ELT',"{$enddate},"),'and');
        $th  = array(
            array('centreno','中心编号'),
            array('clientname','项目委托单位'),
            array('productunit','生产单位'),
            array('samplename','样品名称'),
            array('testcriteria','检验依据'),
            array('testitem','检验项目'),
            array('testcost','检验费用'),
            array('inputdate','第一次申请单填写时间'),
            array('collectdate','编号确定时间'),
            array('reportdate','报告发出时间'),
            array('getdate','地方收到报告时间'),
            array('authname','地方收样处'),
        );
        $user = D('common_system_user')->where('gid = 6')->select();
        $data  = M('sampling_form')->where($map)->Field('centreno,clientname,productunit,samplename,testcriteria,testitem,testcost,inputdate,collectdate,reportdate,getdate,authname')->select();
        export_excel($title,$th,$data,$user);
    }

    public function mysql(){
        $data = D('lee_article')->where("category = 22 or category = 28" )->field('id,createtime')->select();
        foreach($data as $v){
            $t['save_time'] = date("Y-m-d H:i:s",$v['createtime']);
            $t['id'] = $v['id'];
            var_dump($t);
            $save = D('news')->save($t);
            if(!$save){
                echo 'shibai';
            }
        }

        echo 'chenggong';




    }

}