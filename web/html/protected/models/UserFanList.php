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


        $records = UserFan::model()->findAll("user_id=:userId LIMIT :offset, :length", array(":userId"=>$this->user_id, ":offset"=>$this->offset, ":length"=>$this->length));
        if($records === null) {
            return null;
        }
        $rtn = array();
        foreach($records as $r) {
            $rtn[] = array('user_id'=>$r->fan_id, 'nick_name'=>$r->fan_name, 'small_avatar'=>$r->fan_avatar);
        }
        return $rtn;
    }
}