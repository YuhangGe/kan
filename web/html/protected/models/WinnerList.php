<?php
/**
 * User: xiaoge
 * At: 13-7-5 1:34
 * Email: abraham1@163.com
 */


class WinnerList extends CFormModel{
    public $type;
    public $offset;
    public $length;
    public $user_id;
    public $video_id;

    public function rules() {
        return array(
            array('type', 'required'),
            array('type', 'in', 'range'=>array("user", "video")),
            array("user_id, video_id", 'numerical', 'integerOnly'=>true),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }
    private function _off_len() {
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>50) {
            //一次最多取200条
            $this->length = 200;
        } else {
            $this->length = intval($this->length);
        }
    }
    /*
     *
     */
    public function get() {

        $this->_off_len();

        $tm = time();

        $r = Active::model()->findBySql("select act_id from active where end_time<$tm order by end_time desc, act_id desc limit 1");
        if($r===null) {
            return array();
        }

//       echo CJSON::encode($r);
        if($this->type === "user") {

            $sql = "select w.user_id, w.time, w.poster_url, u.nick_name, v.video_id, v.video_name, v.vote_number, v.view_number, v.vote_number*10 + v.view_number as score_number from winner w, `user` u, video v where w.user_id=u.user_id and v.video_id=w.video_id and v.act_id={$r->act_id} order by score_number desc, w.time desc limit {$this->offset}, {$this->length}";
            return Yii::app()->db->createCommand($sql)->queryAll();

        } elseif($this->type==="video" && $this->user_id!==null) {
//            $r = Video::model()->findBySql("select v.* from video v, winner w where w.video_id=v.video_id and v.user_id=:uId order by w.time desc limit 1", array(":uId"=>$this->user_id));

            if($this->video_id===null) {
                $r = Winner::model()->findBySql("select video_id from winner where user_id={$this->user_id} order by time desc limit 1");
                if($r===null) {
                    return array();
                }
                $this->video_id = $r->video_id;
            }

            $r = Video::model()->findByPk($this->video_id);
            if($r === null) {
                return array();
            }
            $rs = Video::model()->findAllBySql("select * from video where user_id=:uId and video_id<>:vId order by upload_time desc limit 200", array(":uId"=>$this->user_id, ":vId"=>$r->video_id));

            $rtn = array($r);
            foreach ($rs as $a) {
                $rtn[] = $a;
            }

            return $rtn;

        } else {
            return array();
        }

    }
}