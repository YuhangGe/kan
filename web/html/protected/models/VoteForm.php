<?php
/**
 * User: xiaoge
 * At: 13-6-8 3:55
 * Email: abraham1@163.com
 */


class VoteForm extends CFormModel{
    public $photo_id;
    public $video_id;
    public $user_id;
    public $type;

    public function rules(){
        return array(
            array('type', 'required'),
            array("user_id", 'numerical', 'integerOnly'=>true),
            array('type', 'in', 'range'=>array("photo", "video")),
            array("photo_id", 'numerical', 'integerOnly'=>true),
            array("video_id", 'numerical', 'integerOnly'=>true),
        );
    }

    private function votePhoto() {
        if($this->photo_id===null) {
            return false;
        }
        $m = Photo::model()->findBySql("select photo_id from photo where photo_id=:pId", array(":pId"=>$this->photo_id));
        if($m===null) {
            return false;
        }
        $r = PhotoVote::model()->find("photo_id=:pId AND user_id=:uId", array(':pId'=>$this->photo_id,':uId'=>$this->user_id));
        if($r === null) {
            $m = new PhotoVote();
            $m->user_id = $this->user_id;
            $m->photo_id = $this->photo_id;
            if($m->save(false)){
                return Photo::model()->updateCounters(array("vote_number"=>1), "photo_id=:pId", array(":pId"=>$this->photo_id));
            }

        }
        return false;
    }

    private function voteVideo() {
        if($this->video_id===null) {
            return false;
        }
        $m = Video::model()->findBySql("select video_id from video where video_id=:pId", array(":pId"=>$this->video_id));
        if($m===null) {
            return false;
        }
        $r = VideoVote::model()->find("video_id=:pId AND user_id=:uId", array(':pId'=>$this->video_id,':uId'=>$this->user_id));
        if($r === null) {
            $m = new VideoVote();
            $m->user_id = $this->user_id;
            $m->video_id = $this->video_id;

            if($m->save(false)){
                return Video::model()->updateCounters(array("vote_number"=>1), "video_id=:pId", array(":pId"=>$this->video_id));
            }
        }
        return false;
    }

    public function vote() {
        $this->user_id = Yii::app()->user->id;
        if($this->type === "photo") {
            return $this->votePhoto();
        } elseif($this->type==='video'){
            return $this->voteVideo();
        } else {
            return false;
        }
    }
}