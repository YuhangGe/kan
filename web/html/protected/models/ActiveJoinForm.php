<?php
/**
 * User: xiaoge
 * At: 13-6-15 5:35
 * Email: abraham1@163.com
 */


class ActiveJoinForm extends CFormModel{
    public $act_id;
    public $photo_number;
    public $thumb_files;
    public $image_files;
    public $intro;
    public $slogan;

    private static $FILE_TYPE = array('image/jpg', 'image/jpeg', 'image/bmp', 'image/gif', 'image/gif', 'image/png');
    private static $FILE_EXT = array('jpg', 'jpeg', 'png', 'bmp', 'gif');

    public function rules(){
        return array(
            array('act_id, photo_number', 'required'),
            array('act_id, photo_number', 'numerical', 'integerOnly'=>true),
            array('photo_number', 'numerical', 'min'=>1, 'max'=>8),
            array('intro', 'length', 'max'=>300),
            array('slogan', 'length', 'max'=>25),
            array('files', 'check_file')
        );
    }

    public function check_file() {
        $err = false;
        $this->thumb_files = array();
        $this->image_files = array();
        for($i=0;$i<$this->photo_number;$i++) {
            if(!isset($_FILES["image-$i"]) || !isset($_FILES["thumb-$i"])) {
                $err = true;
                break;
            }
            $this->thumb_files[] = $thumb = $_FILES["thumb-$i"];
            $this->image_files[] = $image = $_FILES["image-$i"];
            if(!empty($thumb["error"]) || !empty($image["error"])) {
                $err = true;
                break;
            }
            if(!in_array($thumb["type"],  self::$FILE_TYPE) || !in_array($image["type"], self::$FILE_TYPE)) {
                $err = true;
                break;
            }
            $temp_arr = explode(".", $image["name"]);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $image_ext = strtolower($file_ext);
            $temp_arr = explode(".", $thumb["name"]);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $thumb_ext = strtolower($file_ext);
            if(!in_array($image_ext, self::$FILE_EXT) || !in_array($thumb_ext, self::$FILE_EXT)) {
                $err = true;
                break;
            }
        }
        if($err) {
            $this->addError("files", "image files invalidate");
        }
    }

    private function savePhoto() {
        return false;
    }
    public function join() {

        $ar = Active::model()->find(array(
            'select'=>'act_id, act_name',
            'condition'=>'act_id=:aId',
            'params'=>array(':aId'=>$this->act_id)
        ));
        if($ar===null) {
            //活动不存在
            return false;
        }
        $uid = Yii::app()->user->id;
        $uar = UserActive::model()->find(array(
            'select'=>'user_id',
            'condition'=>'user_id=:uId and act_id=:aId',
            'params'=>array(':uId'=>$uid, ':aId'=>$this->act_id)
        ));
        if($uar!==null) {
            //已经报过名了。
            return false;
        }
        $transaction = Yii::app()->db->beginTransaction(); //创建事务
        try {
            $m = new UserActive();
            $m->user_id = $uid;
            $m->act_id = $this->act_id;
            $m->photo_number = $this->photo_number;
            if($this->intro!==null) {
                $m->intro = $this->intro;
            }
            if($this->slogan!==null) {
                $m->slogan = $this->slogan;
            }
            if(!$m->save(false)){
                throw new Exception("error on save new UserActive");
            }
            $dir = "photo/{$this->act_id}";
            $c_time = time();
            for($i=0;$i<$this->photo_number;$i++) {
                $_time = $c_time + $i*5;
                $_tag = $_time.rand(0, 1000);
                $_i_fn = "image_".$uid."_".$_tag;
                $_t_fn = "thumb_".$uid."_".$_tag;
                $_i_url = FileHelper::directSaveFile($this->image_files[$i], $_i_fn, $dir);
                if($_i_url === false) {
                    throw new Exception("error on save photo files");
                }
                $_t_url = FileHelper::directSaveFile($this->thumb_files[$i], $_t_fn, $dir);
                if($_t_url === false) {
                    throw new Exception("error on save photo files");
                }
                $m = new Photo();
                $m->act_id = $this->act_id;
                $m->user_id = $uid;
                $m->act_name = $ar->act_name;
                $m->user_name = Yii::app()->user->name;
                $m->upload_time = $_time;
                $m->thumb_url = Yii::app()->params['staticServer']."/".$_t_url;
                $m->image_url = Yii::app()->params['staticServer']."/".$_i_url;
                if(!$m->save(false)) {
                    throw new Exception("error on save photo to database");
                }
            }
            $transaction->commit(); //提交事务会真正的执行数据库操作
            return true;
        } catch (Exception $e) {
            $transaction->rollback(); //如果操作失败, 数据回滚
            echo $e->getMessage();
            return false;
        }
    }
}