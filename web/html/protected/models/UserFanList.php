<?php
/**
 * User: xiaoge
 * At: 13-5-28 1:15
 * Email: abraham1@163.com
 */


class UserFanList extends CFormModel{
    public $user_id;
    public $offset;
    public $length;

    public function rules() {
        return array(
            array("user_id", "required"),
            array("offset, user_id", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }

    public function get() {

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


        $sql = "select uf.fan_id as user_id, u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
            from user_fan uf, user u where u.user_id = uf.fan_id and uf.user_id = {$this->user_id} limit {$this->offset}, {$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;

    }

    public function getFollow() {
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


        $sql = "select uf.user_id as user_id, u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
            from user_fan uf, user u where u.user_id = uf.user_id and uf.fan_id = {$this->user_id} limit {$this->offset}, {$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
}