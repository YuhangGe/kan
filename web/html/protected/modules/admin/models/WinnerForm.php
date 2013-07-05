<?php
/**
 * User: xiaoge
 * At: 13-7-5 12:59
 * Email: abraham1@163.com
 */


class WinnerForm extends CFormModel{
    public $video_id;
    public $time;
    public $poster_url;

    public function rules() {
        return array(
            array("video_id", "required"),
            array("video_id", 'numerical', 'integerOnly'=>true),
            array("poster_url", "length", "min"=>1, "max"=>150)
        );
    }

    public function choose(){
        $r = Winner::model()->findByPk($this->video_id);
        if($r!==null) {
            //已经是星客
            return true;
        }
        $r = Video::model()->findByPk($this->video_id);
        if($r===null) {
            return false;
        }
//        echo CJSON::encode($r);

        $m = new Winner();
        $m->video_id = $this->video_id;
        $m->user_id = $r->user_id;
        $m->time = time();
        return $m->save();
    }

    public function cancel() {

        return Winner::model()->deleteAllByAttributes(array("video_id"=>$this->video_id));

    }

    public function poster() {
        if(!isset($_FILES['image_file'])) {
            return false;
        }
        $r = Winner::model()->findByPk($this->video_id);
        if($r===null) {
            return false;
        }
        $dir = "poster";
        $_tag = time().rand(0, 10000);
        $i_fn = "winner_".$this->video_id."_".$_tag;

        $sif = FileHelper::savePhoto("image_file", $dir, $i_fn);
        if($sif===false) {
            return false;
        }

        return Winner::model()->updateAll(array('poster_url'=>Yii::app()->params['staticServer']."/".$sif), "video_id=:pId", array(':pId'=>$this->video_id));

    }
}