<?php
/**
 * User: xiaoge
 * At: 13-6-8 4:11
 * Email: abraham1@163.com
 */


class ViewForm extends CFormModel {
    public $photo_id;
    public $video_id;
    public $user_id;
    public $type;

    private $max_view_each_day;

    public function __construct() {
        parent::__construct();
        $r = Setting::model()->findByPk("max_view_each_day");
        if($r === null) {
            $this->max_view_each_day = 5;
        } else {
            $this->max_view_each_day = $r->value;
        }
    }
    public function rules(){
        return array(
            array('type', 'required'),
            array("user_id", 'numerical', 'integerOnly'=>true),
            array('type', 'in', 'range'=>array("photo", "video")),
            array("photo_id", 'numerical', 'integerOnly'=>true),
            array("video_id", 'numerical', 'integerOnly'=>true),
        );
    }

    private function viewPhoto() {
        if($this->photo_id===null) {
            return false;
        }
        $today = strtotime("12:00:00");
        $r = PhotoView::model()->find("photo_id=:pId AND user_id=:uId", array(':pId'=>$this->photo_id,':uId'=>$this->user_id));
        if($r === null) {
            $m = Photo::model()->findBySql("select photo_id from photo where photo_id=:pId", array(":pId"=>$this->photo_id));
            if($m===null) {
                return false;
            }
            $m = new PhotoView();
            $m->user_id = $this->user_id;
            $m->photo_id = $this->photo_id;
            $m->view_time = $today;
            $m->view_number = 1;

            if(!$m->save(false)) {
                return false;
            }
        } else {
            if($r->view_time<$today) {
                Yii::app()->db
                    ->createCommand("update photo_view set view_number=1 , view_time=$today where photo_id=:pId and user_id=:uId")
                    ->query(array(":pId"=>$this->photo_id, ":uId"=>$this->user_id));
            } else if($r->view_number <= $this->max_view_each_day){
                /*
                 * 如果用户当天的浏览量小于定义的最大浏览量，则加1
                 */
                PhotoView::model()->updateCounters(array("view_number"=>1), "photo_id=:pId and user_id=:uId", array(":pId"=>$this->photo_id, ":uId"=>$this->user_id));
            } else {
                /*
                 * 否则为了防止使用代码刷人气，直接返回
                 */
                return true;
            }
        }
        return Photo::model()->updateCounters(array("view_number"=>1), "photo_id=:pId", array(":pId"=>$this->photo_id));
    }

    private function viewVideo() {
        if($this->video_id===null) {
            return false;
        }
        $today = strtotime("12:00:00");
        $r = VideoView::model()->find("video_id=:pId AND user_id=:uId", array(':pId'=>$this->video_id,':uId'=>$this->user_id));

        if($r === null) {
            $m = Video::model()->findBySql("select video_id from video where video_id=:pId", array(":pId"=>$this->video_id));

            if($m===null) {
                return false;
            }

            $m = new VideoView();
            $m->user_id = $this->user_id;
            $m->video_id = $this->video_id;
            $m->view_time = $today;
            $m->view_number = 1;


            if(!$m->save(false)) {
                return false;
            }

        } else {
            if($r->view_time<$today) {
                Yii::app()->db
                    ->createCommand("update video_view set view_number=1 , view_time=$today where video_id=:pId and user_id=:uId")
                    ->query(array(":pId"=>$this->video_id, ":uId"=>$this->user_id));
            } else if($r->view_number <= $this->max_view_each_day){
                /*
                 * 如果用户当天的浏览量小于定义的最大浏览量，则加1
                 */
                VideoView::model()->updateCounters(array("view_number"=>1), "video_id=:pId and user_id=:uId", array(":pId"=>$this->video_id, ":uId"=>$this->user_id));
            } else {
                /*
                 * 否则为了防止使用代码刷人气，直接返回
                 */
                return true;
            }
        }
        return Video::model()->updateCounters(array("view_number"=>1), "video_id=:pId", array(":pId"=>$this->video_id));
    }

    public function view() {
        $this->user_id = Yii::app()->user->id;
        if($this->type === "photo") {
            return $this->viewPhoto();
        } elseif($this->type==='video'){
            return $this->viewVideo();
        } else {
            return false;
        }
    }
}