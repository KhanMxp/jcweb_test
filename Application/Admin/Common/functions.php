<?php
namespace Admin\Controller;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
/**
 * 检查当前用户是否登录
 */
if( !function_exists("checkLogin") ){
	function checkLogin(){
		if(session("accessUser")){
			return true;
		}
		return false;
	}
}
/**
 * 获取当前访问的域名
 */
if(!function_exists("getCurrentHost")){
    function getCurrentHost(){
        $httpProtocol = "";
        if($_SERVER["REQUEST_SCHEME"]){
            $httpProtocol = $_SERVER["REQUEST_SCHEME"];
        }else{
            if(stripos($_SERVER['SERVER_PROTOCOL'], 'http')>-1){
                $httpProtocol = "http";
            }elseif(stripos($_SERVER['SERVER_PROTOCOL'], 'https')>-1){
                $httpProtocol = "http";
            }
        }
        $host = $httpProtocol.'://'.$_SERVER["SERVER_NAME"];
        return $host;
    }
}

/**
 * 获取当前访问的url
 */
if(!function_exists("getCurrentUrl")){
	function getCurrentUrl(){
        $httpProtocol = "";
        if($_SERVER["REQUEST_SCHEME"]){
            $httpProtocol = $_SERVER["REQUEST_SCHEME"];
        }else{
            if(stripos($_SERVER['SERVER_PROTOCOL'], 'http')>-1){
                $httpProtocol = "http";
            }elseif(stripos($_SERVER['SERVER_PROTOCOL'], 'https')>-1){
                $httpProtocol = "http";
            }
        }
		$url = $httpProtocol.'://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		return $url;
	}
}
/** 
 * 打印
 */
if(!function_exists("pr")){
	function pr($string){
		@header("Content-type:text/html;charset=utf-8");
		echo '<pre>';
		print_r($string);
		echo '</pre>';
	}
}
/**
 * 获取用户的邀请码
 */
if(!function_exists("encInviteCode")){
	function encInviteCode($user){
		@import("Home.Lib.Crypt");
        $crypt = new \Crypt();
        $inviteCode = $crypt->enc(C("enckey").$user['id']);
        return $inviteCode;
	}
}
/**
 * 邀请码解密
 */
if(!function_exists("decInviteCode")){
	function decInviteCode($code){
		@import("Home.Lib.Crypt");
        $crypt = new \Crypt();
        $inviteCode = $crypt->dec($code);
        $inviteUid = str_replace(C("enckey"),'',$inviteCode);
        return $inviteUid;
	}
}
if(!function_exists("getColumn")){
	function getColumn($a=array(), $column='id', $null=true, $column2=null){
        $ret = array();
        @list($column, $anc) = preg_split('/[\s\-]/',$column,2,PREG_SPLIT_NO_EMPTY);
        foreach( $a AS $one )
        {
            if ( $null || @$one[ $column ] )
                $one[ $column ] && $ret[] = @$one[ $column ].($anc?'-'.@$one[$anc]:'');
        }
        return $ret;
	}
}
if(!function_exists("assColumn")){
	function assColumn($a=array(), $column='id'){
        $two_level = func_num_args() > 2 ? true : false;
        if ( $two_level ) $scolumn = func_get_arg(2);

        $ret = array(); settype($a, 'array');
        if ( false == $two_level )
        {
            foreach( $a AS $one )
            {
                if ( is_array($one) )
                    $ret[ @$one[$column] ] = $one;
                else
                    $ret[ @$one->$column ] = $one;
            }
        }
        else
        {
            foreach( $a AS $one )
            {
                if (is_array($one)) {
                    if ( false==isset( $ret[ @$one[$column] ] ) ) {
                        $ret[ @$one[$column] ] = array();
                    }
                    $ret[ @$one[$column] ][ @$one[$scolumn] ] = $one;
                } else {
                    if ( false==isset( $ret[ @$one->$column ] ) )
                        $ret[ @$one->$column ] = array();

                    $ret[ @$one->$column ][ @$one->$scolumn ] = $one;
                }
            }
        }
        return $ret;
	}
}
if(!function_exists("error")){
    function error($string){
        die($string);
    }
}
//获取客户端的IP地址
if( ! function_exists("get_client_ip")){
    function get_client_ip(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
            $ip = getenv("HTTP_CLIENT_IP");
        }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        #log_message("LOG",var_export($_SERVER,true),'log');
        if($ip!='unknown'){
            $ipArr = explode(',',$ip);
            $ip = $ipArr[count($ipArr)-1];
        }
        return($ip);
    }
}
/**
     * $operation 加密ENCODE或解密DECODE
     * $key 密钥
     * $expiry 密钥有效期 ， 默认是一直有效
*/
if(!function_exists("auth_code")){
    function auth_code($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    /*
        动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
        加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        当此值为 0 时，则不产生随机密钥
    */
    $ckey_length = 4;
    $key = md5($key != '' ? $key : "fdsfdf43535svxfsdfdsfs"); // 此处的key可以自己进行定义，写到配置文件也可以
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}
}
if(!function_exists("isEmail")){
    function isEmail($email){
        return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-]+(\.\w+)+$/",$email);
    }
}
if(!function_exists("isMobile")){
    function isMobile($str){
        return preg_match("/^1[3|5|7|8]\d{9}$/", $str);
    }
}
if(!function_exists("isName")){
    function isName($str){
        $pattern_url = "/^((?!@).)*$/is"; 
        $go = mb_strlen($str,'UTF8');
        //如果输入的在2-8个字符之间 就进行判断
        if($go<=12 && $go>=2){
            // 如果里面没有含有@就返回真
            if (preg_match($pattern_url, $str)){ 
                return true;
            }else{ 
                return false;
            }
        }else{
            return false;
        }
    }
}
if(!function_exists("isQq")){
    function isQq($qq){
        $pattern_url = "/^[1-9]\d{4,12}$/is"; 
        if (preg_match($pattern_url, $qq)){ 
            return true;
        }
        return false;
    }
}
if(!function_exists("humanTime")){

    function humanTime($time=null, $forceDate=false){
        $now = time();
        $time = is_numeric($time) ? $time : strtotime($time);
        $interval = $now - $time;
        if ( $forceDate || $interval > 3*86400 ){
            //return strftime("%Y-%m-%d 周%a %H:%M",$time);
            //return date("Y-m-d 周D H:M",$time);
            $w = array('Sun'=>'日','一','Tue'=>'二','Wed'=>'三','Thu'=>'四','Fri'=>'五','Sat'=>'六');
            ///return  date("Y-m-d ",$time).'周'.$w[ date('D',$time)].date(" H:i",$time);
            return  date("Y-m-d ",$time).date(" H:i",$time);
        }else if ( $interval > 86400 ){
            $number = intval($interval/86400);
            return "${number}天前";
        }else if ( $interval > 3600 ){ // > 1 hour
            $number = intval($interval/3600);
            return "${number}小时前";
        }else if ( $interval >= 60 ){ // > 1 min
            $number = intval($interval/60);
            return "${number}分钟前";
        }else if ( 5 >= $interval){// < 5 second
            return "就在刚才";
        }else{ // < 1 min
            return "${interval}秒前";
        }
    }
}
/**
     * 密码加密
     */
if(!function_exists("SHA256Hex")) {
    function SHA256Hex($str)
    {
        $re = hash('sha256', $str, true);
        return md5(bin2hex($re));
    }
}

//    /**
//     * Export Excel | 2017.12.06
//     * Author:武当山道士 <912900700@qq.com>
//     * PHPExcel Version: 1.8
//    +----------------------------------------------------------
//     * @param {string} $expTitle     导出后的文件名前缀
//     * @param {string} $expCellName  标题栏
//     * @param {array}  $expTableData 内容数组
//     */
//    if(!function_exists("humanTime")) {
//    function export_excel($expTitle,$expCellName,$expTableData){
//        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
//        $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
//        $cellNum = count($expCellName);
//        $dataNum = count($expTableData);
//        import("Org.Util.PHPExcel");
//        import("Org.Util.PHPExcel.IOFactory");
//        import("Org.Util.PHPExcel.Cell");
//        $objPHPExcel = new PHPExcel();
//        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
//
//        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
//        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
//        for($i=0;$i<$cellNum;$i++){
//            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
//        }
//        // Miscellaneous glyphs, UTF-8
//        for($i=0;$i<$dataNum;$i++){
//            for($j=0;$j<$cellNum;$j++){
//                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
//            }
//        }
//
//        ob_end_clean();//清除缓存,避免中文乱码 *************** 这一行非常重要 ******************************
//
//        header('pragma:public');
//        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
//        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//        $objWriter->save('php://output');
//        exit;
//    }
    if(!function_exists("humanTime")) {
        function export_excel($expTitle,$expCellName,$expTableData,$user){
            $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
            $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.IOFactory");
            import("Org.Util.PHPExcel.Cell");
            $objPHPExcel = new PHPExcel();
            $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
            $sheet = 0;
            foreach($user as $one){
                if($sheet !=0){
                    $objPHPExcel->createSheet(); //sheet=0时不需要新建sheet，直接使用默认sheet即可
                }

                $userdata = array();//当前地方收样员的数据先清零
                $authname = $one['username'];
                foreach($expTableData as $v){
                    if($v['authname'] == $authname){
                        $userdata[] = $v;
                    }//查询当前地方收样员的数据
                }
                $cellNum = count($expCellName);
                $dataNum = count($userdata);
                $objPHPExcel->setActiveSheetIndex($sheet);
                $objPHPExcel->getActiveSheet()->setTitle("{$authname}")->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
                for($i=0;$i<$cellNum;$i++){
                    $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
                }
                // Miscellaneous glyphs, UTF-8
                for($i=0;$i<$dataNum;$i++){
                    for($j=0;$j<$cellNum;$j++){
                        $objPHPExcel->getActiveSheet($sheet)->setCellValue($cellName[$j].($i+3), $userdata[$i][$expCellName[$j][0]]);
                    }
                }
                $sheet ++;
            }


            ob_end_clean();//清除缓存,避免中文乱码 *************** 这一行非常重要 ******************************

            header('pragma:public');
            header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
            header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
//
//    /**
//     * Import Excel | 2017.12.06
//     * Author:武当山道士 <912900700@qq.com>
//     * PHPExcel Version: 1.8
//    +----------------------------------------------------------
//     * @param  {file}   $file  文件流
//    +----------------------------------------------------------
//     * @return {array}  $array 返回数组
//    +----------------------------------------------------------
//     */
//    function import_excel($file){
//        if(!file_exists($file)){
//            return array("error"=>0,'message'=>'file not found!');
//        }
//        Vendor("PHPExcel.PHPExcel.IOFactory");
//        $objReader = PHPExcel_IOFactory::createReader('Excel5');
//        try{
//            $PHPReader = $objReader->load($file);
//        }catch(Exception $e){}
//        if(!isset($PHPReader)) return array("error"=>0,'PHPReader'=>$PHPReader,'message'=>'read error!');
//        $allWorksheets = $PHPReader->getAllSheets();
//        $i = 0;
//        foreach($allWorksheets as $objWorksheet){
//            $sheetname=$objWorksheet->getTitle();
//            $allRow = $objWorksheet->getHighestRow();//how many rows
//            $highestColumn = $objWorksheet->getHighestColumn();//how many columns
//            $allColumn = PHPExcel_Cell::columnIndexFromString($highestColumn);
//            $array[$i]["Title"] = $sheetname;
//            $array[$i]["Cols"] = $allColumn;
//            $array[$i]["Rows"] = $allRow;
//            $arr = array();
//            $isMergeCell = array();
//            foreach ($objWorksheet->getMergeCells() as $cells) {//merge cells
//                foreach (PHPExcel_Cell::extractAllCellReferencesInRange($cells) as $cellReference) {
//                    $isMergeCell[$cellReference] = true;
//                }
//            }
//            for($currentRow = 1 ;$currentRow<=$allRow;$currentRow++){
//                $row = array();
//                for($currentColumn=0;$currentColumn<$allColumn;$currentColumn++){;
//                    $cell =$objWorksheet->getCellByColumnAndRow($currentColumn, $currentRow);
//                    $afCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn+1);
//                    $bfCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn-1);
//                    $col = PHPExcel_Cell::stringFromColumnIndex($currentColumn);
//                    $address = $col.$currentRow;
//                    $value = $objWorksheet->getCell($address)->getValue();
//                    if(substr($value,0,1)=='='){
//                        return array("error"=>0,'message'=>'can not use the formula!');
//                        exit;
//                    }
//                    if($cell->getDataType()==PHPExcel_Cell_DataType::TYPE_NUMERIC){
//                        $cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
//                        $formatcode=$cellstyleformat->getFormatCode();
//                        if (preg_match('/^([$[A-Z]*-[0-9A-F]*])*[hmsdy]/i', $formatcode)) {
//                            $value=gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
//                        }else{
//                            $value=PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
//                        }
//                    }
//                    if($isMergeCell[$col.$currentRow]&&$isMergeCell[$afCol.$currentRow]&&!empty($value)){
//                        $temp = $value;
//                    }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$col.($currentRow-1)]&&empty($value)){
//                        $value=$arr[$currentRow-1][$currentColumn];
//                    }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$bfCol.$currentRow]&&empty($value)){
//                        $value=$temp;
//                    }
//                    $row[$currentColumn] = $value;
//                }
//                $arr[$currentRow] = $row;
//            }
//            $array[$i]["Content"] = $arr;
//            $i++;
//        }
//        spl_autoload_register(array('Think','autoload'));//must, resolve ThinkPHP and PHPExcel conflicts
//        unset($objWorksheet);
//        unset($PHPReader);
//        unset($PHPExcel);
//        unlink($file);
//        return array("error"=>1,"data"=>$array);
//    }
    }

if(!function_exists("uplExcel")) {
     function plExcel($filepath)
    {
//        vendor(PHPExcel.PHPExcel.IOFactory);
//        vendor(PHPExcel.PHPExcel);
//        vendor(PHPExcel.PHPExcel.Cell);

         // 导出Exl
         import("Org.Util.PHPExcel");
         import("Org.Util.PHPExcel.IOFactory");
         import("Org.Util.PHPExcel.Cell");
         //$objPHPExcel = new \PHPExcel();


         $objPHPExcel = new \PHPExcel();
         $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
         $objSheet = $objPHPExcel->getActiveSheet();


        if (!empty($filepath)) {
            $dotArray = explode('.', $filepath);    //把文件名安.区分，拆分成数组
            $type = end($dotArray);
            if ($type != "xls" && $type != "xlsx") {
                $ret['res'] = "0";
                $ret['msg'] = "不是Excel文件，请重新上传!";
                return json_encode($ret);
            }

            if (!file_exists($filepath)) {
                $ret['res'] = "0";
                $ret['msg'] = "上传文件丢失!" ;
                $ret['path'] = $filepath;
                $ret['chai'] = $dotArray;
                return json_encode($ret,256);
            }

            //文件的扩展名
            $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
            if ($ext == 'xlsx') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel = $objReader->load($filepath, 'utf-8');
            } elseif ($ext == 'xls') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel = $objReader->load($filepath, 'utf-8');
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $ar = array();
            $i = 0;
            $importRows = 0;
            for ($j = 2; $j <= $highestRow; $j++){
                $importRows++;
                $realName = (string)$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();//需要导入的realName
                $phone = (string)$objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();   //需要导入的phone
                $company = (string)$objPHPExcel->getActiveSheet()->getCell("C$j")->getValue(); //需要导入的company
                $job = (string)$objPHPExcel->getActiveSheet()->getCell("D$j")->getValue();     //需要导入的job
                $email = (string)$objPHPExcel->getActiveSheet()->getCell("E$j")->getValue();   //需要导入的email
                $ret['mdata'] = $this->addMemb($phone, $realName, $company, $job, $email);//这里就是我的数据库添加操作定义的一个方法啦,对应替换为自己的

                if ($ret['mdata'] && !is_Bool($ret['mdata'])) {
                    $ar[$i] = $ret['mdata'];
                    $i++;
                }
            }
            if ($i > 0) {
                $ret['res'] = "0";
                $ret['errNum'] = $i;
                $ret['allNum'] = $importRows;
                $ret['sucNum'] = $importRows - $i;
                $ret['mdata'] = $ar;
                $ret['msg'] = "导入完毕!";
                return json_encode($ret);
            }
            $ret['res'] = "1";
            $ret['allNum'] = $importRows;
            $ret['errNum'] = 0;
            $ret['sucNum'] = $importRows;
            $ret['mdata'] = "导入成功!";
            return json_encode($ret);
        } else {
            $ret['res'] = "0";
            $ret['msg'] = "上传文件失败!";
            return json_encode($ret);
        }
    }
}
