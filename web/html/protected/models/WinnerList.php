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

    public function rules() {
        return array(
            array('type', 'required'),
            array('type', 'in', 'range'=>array("user", "video")),
            array("user_id", 'numerical', 'integerOnly'=>true),
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


        if($this->type === "user") {
            $sql = "select w.user_id, w.time, w.poster_url,v.video_name, u.nick_name from winner w, `user` u, video v where w.user_id=u.user_id and v.video_id=w.video_id order by w.time desc limit {$this->offset}, {$this->length}";
            return Yii::app()->db->createCommand($sql)->queryAll();

        } elseif($this->type==="video" && $this->user_id!==null) {
            $r = Video::model()->findBySql("select v.* from video v, winner w where w.video_id=v.video_id and v.user_id=:uId order by w.time desc limit 1", array(":uId"=>$this->user_id));
            if($r === null) {
                return array();
            }
            $rs = Video::model()->findAllBySql("select * from video where user_id=:uId and video_id<>:vId", array(":uId"=>$this->user_id, ":vId"=>$r->video_id));

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