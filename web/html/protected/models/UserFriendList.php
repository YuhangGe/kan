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
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
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

        $records = UserFriend::model()->findAll("user_id_1=:userId OR user_id_2=:userId LIMIT :offset, :length", array(":userId"=>$this->user_id,":offset"=>$this->offset, ":length"=>$this->length));
        if($records === null) {
            return null;
        }
        $rtn = array();
        foreach($records as $r) {
            if($r->user_id_1 == $this->user_id) {
                $id = $r->user_id_2;
                $nm = $r->user_name_2;
                $av = $r->user_avatar_2;
            } else {
                $id = $r->user_id_1;
                $nm = $r->user_name_1;
                $av = $r->user_avatar_1;
            }
            $rtn[] = array('user_id'=>$id, 'nick_name'=>$nm, 'small_avatar'=>$av);
        }
        return $rtn;
    }
}