<?php
namespace Admin\Controller;
use Think\Controller;
include('exif.php');
class UploaderController extends Controller {
    //初始化方法
    public function _initialize(){
        load('@.functions');
        D("account")->checkLogin();
        $this->assign('menu_active',strtolower(CONTROLLER_NAME));
        $this->assign('menu_secoud_active',strtolower(ACTION_NAME));
    }
    /**
     * [upload_img 图片上传]
     * @return [type] [description]
     */
    public function start($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time'; 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $picAddr = $saveUrl;
            $exif = exif_read_data($picAddr);
            $image = imagecreatefromjpeg($picAddr);
            if($exif['Orientation'] == 3) {
                $result = imagerotate($image, 180, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 6) {
                $result = imagerotate($image, -90, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 8) {
                $result = imagerotate($image, 90, 0);
                imagejpeg($result, $picAddr, 100);
            }
            isset($result) && imagedestroy($result);
            imagedestroy($image);
            $imgUrl = $this->cropImage($picAddr,72,19);
            $array = array(
                'info'=>'succ',
                'information_pic_path'=>substr($imgUrl, 1),
                'pic_path'=>substr($picAddr, 1),
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    /**
     * 首页特殊不生成缩略图
     */
    public function start2($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $array = array(
                'info'=>'succ',
                'url'=>substr($saveUrl, 1),
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    /**
     * [upload_img 首页图片上传]
     * @return [type] [description]
     */
    public function start1($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $picAddr = $saveUrl;
            $exif = exif_read_data($picAddr);
            $image = imagecreatefromjpeg($picAddr);//载入图像
            if($exif['Orientation'] == 3) {
                $result = imagerotate($image, 180, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 6) {
                $result = imagerotate($image, -90, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 8) {
                $result = imagerotate($image, 90, 0);
                imagejpeg($result, $picAddr, 100);
            }
            isset($result) && imagedestroy($result);
            imagedestroy($image);
            $imgUrl = $this->cropImage($picAddr,100,100);
            $array = array(
                'info'=>'succ',
                'url'=>substr($imgUrl, 1),
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    /**
     * [upload_img 专家图片上传]
     * @return [type] [description]
     */
    public function start4($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $picAddr = $saveUrl;
            $exif = exif_read_data($picAddr);
            $image = imagecreatefromjpeg($picAddr);
            if($exif['Orientation'] == 3) {
                $result = imagerotate($image, 180, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 6) {
                $result = imagerotate($image, -90, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 8) {
                $result = imagerotate($image, 90, 0);
                imagejpeg($result, $picAddr, 100);
            }
            isset($result) && imagedestroy($result);
            imagedestroy($image);
            $imgUrl = $this->cropImage($picAddr,169,247);
            $array = array(
                'info'=>'succ',
                'url'=>substr($imgUrl, 1),
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    /**
     * [upload_img 实验室图片上传]
     * @return [type] [description]
     */
    public function start5($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $picAddr = $saveUrl;
            $exif = exif_read_data($picAddr);
            $image = imagecreatefromjpeg($picAddr);
            if($exif['Orientation'] == 3) {
                $result = imagerotate($image, 180, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 6) {
                $result = imagerotate($image, -90, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 8) {
                $result = imagerotate($image, 90, 0);
                imagejpeg($result, $picAddr, 100);
            }
            isset($result) && imagedestroy($result);
            imagedestroy($image);
            $imgUrl = $this->cropImage($picAddr,1490,1000);
            $base = pathinfo($picAddr);//返回路径的数组信息
            $shuiyin = $base['dirname'] .'/'. $base['filename'].'_shuiyin.'.$base['extension'];
            $addsy = new \Think\Image();
            $addsy->open("$imgUrl")->water('./Public/picture/shuiyin_tm.png',5)->save("$shuiyin");
            $array = array(
                'info'=>'succ',
                'thumb_url'=>substr($shuiyin, 1),
                'url'=>substr($saveUrl,1)
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    //新闻封面图上传
    public function start6($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath  =     './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
            $picAddr = $saveUrl;
            $exif = exif_read_data($picAddr);
            $image = imagecreatefromjpeg($picAddr);
            if($exif['Orientation'] == 3) {
                $result = imagerotate($image, 180, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 6) {
                $result = imagerotate($image, -90, 0);
                imagejpeg($result, $picAddr, 100);
            } elseif($exif['Orientation'] == 8) {
                $result = imagerotate($image, 90, 0);
                imagejpeg($result, $picAddr, 100);
            }
            isset($result) && imagedestroy($result);
            imagedestroy($image);
            $imgUrl = $this->cropImage($picAddr,350,205);
            $base = pathinfo($picAddr);//返回路径的数组信息
            $shuiyin = $base['dirname'] .'/'. $base['filename'].'_shuiyin.'.$base['extension'];
            $addsy = new \Think\Image();
            $addsy->open("$imgUrl")->water('./Public/picture/shuiyin.png',1)->save("$shuiyin");
            $array = array(
                'info'=>'succ',
                'thumb_url'=>substr($shuiyin, 1),
                'url'=>substr($saveUrl,1)
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    /**
     * 缩略图
     */
    private function cropImage($img,$width=0,$height=0){
        $image = new \Think\Image(); 
        $image->open($img);
        $base = pathinfo($img);//返回路径的数组信息
        $thumb = $base['dirname'] .'/'. $base['filename'].'_thumb.'.$base['extension'];
        $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_CENTER)->save($thumb);
        return $thumb;
    }

//ueditor上传
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }

    //多图上传
    public function webup(){
        $config = array(
            'mimes'         =>  array(), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './Public/attached/', //保存根路径
            'savePath'      =>  '',//保存路径
            'savename'      => 'time'
        );
        $upload = new \Think\Upload($config);// 实例化上传类


        $info   =   $upload->upload();

        if(!$info) {

            $this->error($upload->getError());// 上传错误提示错误信息

        }else {// 上传成功
            //dump($info);

            foreach ($info as $va) {
                $saveUrl = './Public/attached/'.$va['savepath'].$va['savename'];
                $imgUrl = $this->cropImage($saveUrl,100,100);
                $this->ajaxReturn($imgUrl);
            }

        }
    }
    /**
     * [upload_img 文件上传]
     * @return [type] [description]
     */
    public function dataUpload($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('pdf', 'pptx', 'ppt', 'doc','docx');
        $upload->rootPath  =     './Public/file/data/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/file/data/'.$info['file']['savepath'].$info['file']['savename'];
            $array = array(
                'info'=>'succ',
                'save_path'=>substr($saveUrl, 1),
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
    public function excelUpload($return=false){
        $upload = new \Think\Upload();
        $upload->maxSize   =     0 ;
        $upload->exts      =     array('xls', 'xlsx');
        $upload->rootPath  =      './Public/attached/'; // 设置附件上传根目录
        $upload->savePath  =     '';
        $upload->saveName = 'time';
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $array['info'] = $upload->getError();
        }else{// 上传成功 获取上传文件信息
            $saveUrl = './Public/attached/'.$info['file']['savepath'].$info['file']['savename'];
//            $saveUrl = str_replace("ThinkPHP/","",$saveUrl);
            $saveUrl = str_replace("/","\\",$saveUrl);
            $array = array(
                'info'=>'succ',
                'save_path'=>$saveUrl,
            );
            if($return){
                return $array;
            }else{
                echo json_encode($array);
            }
        }
    }
}