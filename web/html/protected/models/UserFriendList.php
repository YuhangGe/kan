<?php
/**
 * User: xiaoge
 * At: 13-5-28 3:09
 * Email: abraham1@163.com
 */


class UserFriendList extends CFormModel {
    public $user_id;
    public $offset;
    public $length;

    public function  rules() {
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

//        echo $this->offset;
//        echo $this->length;
        $sql1 = "select uf.user_id_1 as user_id, u.nick_name, u.level as `level`, u.small_avatar, u.fan_number, u.friend_number
            from user_friend uf, user u where u.user_id = uf.user_id_1 and uf.user_id_2 = {$this->user_id}";

        $rs1 = Yii::app()->db->createCommand($sql1)->queryAll();

        $sql2 = "select uf.user_id_2 as user_id, u.nick_name, u.level as `level`, u.small_avatar, u.fan_number, u.friend_number
            from user_friend uf, user u where u.user_id = uf.user_id_2 and uf.user_id_1 = {$this->user_id}";

        $rs2 = Yii::app()->db->createCommand($sql2)->queryAll();

        return array_merge($rs1, $rs2);

    }
}