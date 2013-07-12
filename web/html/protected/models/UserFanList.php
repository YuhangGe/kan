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


//        $sql = "select uf.fan_id as user_id, u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
//            from user_fan uf, user u where u.user_id = uf.fan_id and uf.user_id = {$this->user_id} limit {$this->offset}, {$this->length}";
//        $rs = Yii::app()->db->createCommand($sql)->queryAll();

        $sql = "select uf2.fan_id as user_id, uf2.chat_number, u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
            from (select uf.*, ifnull(ct.count, 0) as chat_number from user_fan uf left join (SELECT count(*) as count, from_user_id from chat where to_user_id={$this->user_id} and from_user_id in(select fan_id from user_fan where user_id={$this->user_id} ) group by from_user_id ) as ct on ct.from_user_id=uf.fan_id where user_id={$this->user_id} limit {$this->offset},{$this->length}) as uf2, user u where u.user_id = uf2.fan_id";

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


//        $sql = "select uf.user_id as user_id, u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
//            from user_fan uf, user u where u.user_id = uf.user_id and uf.fan_id = {$this->user_id} limit {$this->offset}, {$this->length}";
        $sql = "select uf2.user_id, uf2.chat_number , u.nick_name as nick_name, u.level as `level`, u.small_avatar as small_avatar, u.fan_number as fan_number, u.friend_number as friend_number
            from (select uf.*, ifnull(ct.count, 0) as chat_number from user_fan uf left join (SELECT count(*) as count, to_user_id from chat where from_user_id={$this->user_id} and to_user_id in(select user_id from user_fan where fan_id={$this->user_id} ) group by from_user_id ) as ct on ct.to_user_id=uf.user_id where uf.fan_id={$this->user_id} limit {$this->offset},{$this->length}) as uf2, user u where u.user_id = uf2.user_id";

        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
}