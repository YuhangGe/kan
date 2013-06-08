<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:19
 * Email: abraham1@163.com
 */


class UploadController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    private function savePhoto($name, $dir, $file_name) {
        if(!isset($_FILES[$name])) {
            return false;
        }
        $file = $_FILES[$name];
        if(!empty($file['error'])) {
            return false;
        }
        $ftype = $file['type'];
        if(!in_array($ftype, array('image/jpg', 'image/jpeg', 'image/bmp', 'image/gif', 'image/gif', 'image/png'))) {
            return false;
        }

//        echo CJSON::encode($file);


        $temp_arr = explode(".", $file['name']);
        $file_ext = array_pop($temp_arr);
        $file_ext = trim($file_ext);
        $file_ext = strtolower($file_ext);

        if(!in_array($file_ext, array('jpg', 'jpeg', 'png', 'bmp', 'gif'))) {
            return false;
        }

        if(move_uploaded_file($file['tmp_name'], Yii::app()->params['uploadDir']."/".$dir."/".$file_name.".".$file_ext)) {
            return $dir."/".$file_name.".".$file_ext;
        } else {
            return false;
        }
    }

    public function actionPhoto() {
//        print_r($_FILES);

        if(!isset($_POST['act_id']) || !isset($_FILES['image_file']) || !isset($_FILES['thumb_file'])) {
            $this->sendAjax(null);
        }
        $aid = (int)$_POST['act_id'];

        if(empty($aid) || $aid<0) {
            $this->sendAjax(null);
        }
        $uid = Yii::app()->user->id;
        $r = UserActive::model()->find(array("select"=>"photo_number",
            "condition"=>"act_id=:aId AND user_id=:uId",
            "params"=>array(":aId"=>$aid, ":uId"=>$uid)));

//        echo CJSON::encode($r);
        if($r===null || $r->photo_number >= 8) {
            /*
             * 用户没有报名或者已经上传了8张以上图片
             */
            $this->sendAjax(null);
        }

        $dir = "photo/".$aid;
        $_tag = time().rand(0, 1000000);
        $i_fn = "image_".$uid."_".$_tag;
        $t_fn = "thumb_".$uid."_".$_tag;

        $sif = $this->savePhoto("image_file", $dir, $i_fn);
        if($sif==false) {
            $this->sendAjax(null);
        }
        $tif = $this->savePhoto("thumb_file", $dir, $t_fn);
        if($tif==false) {
            unlink(Yii::app()->params['uploadDir']."/".$sif);
            $this->sendAjax(null);
        }

        $s_path = Yii::app()->params['staticServer'];
        $this->sendAjax(array(
            'image_url'=>  $s_path.'/'.$sif,
            'thumb_url'=> $s_path.'/'.$tif
        ), true);
    }

    public function actionAvatar() {
        if(!isset($_FILES['image_file']) || !isset($_FILES['thumb_file']) || !isset($_FILES['small_file'])) {
            $this->sendAjax(null);
        }
        $uid = Yii::app()->user->id;
        $dir = "avatar";
        $_tag = time().rand(0, 1000000);
        $i_fn = "large_".$uid."_".$_tag;
        $t_fn = "thumb_".$uid."_".$_tag;
        $s_fn = "small_".$uid."_".$_tag;

        $iif = $this->savePhoto("image_file", $dir, $i_fn);
        if($iif==false) {
            $this->sendAjax(null);
        }
        $tif = $this->savePhoto("thumb_file", $dir, $t_fn);
        if($tif==false) {
            unlink(Yii::app()->params['uploadDir']."/".$iif);
            $this->sendAjax(null);
        }
        $sif = $this->savePhoto("small_file", $dir, $s_fn);
        if($sif==false) {
            unlink(Yii::app()->params['uploadDir']."/".$iif);
            unlink(Yii::app()->params['uploadDir']."/".$tif);
            $this->sendAjax(null);
        }

        $s_path = Yii::app()->params['staticServer'];
        $this->sendAjax(array(
            'image_url'=>  $s_path.'/'.$iif,
            'thumb_url'=> $s_path.'/'.$tif,
            'small_url'=> $s_path.'/'.$sif
        ), true);

    }


}