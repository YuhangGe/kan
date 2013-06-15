<?php
/**
 * User: xiaoge
 * At: 13-5-28 1:58
 * Email: abraham1@163.com
 */


class UserFanForm extends CFormModel {
    public $user_id;

    public function rules() {
        return array(
            array("user_id","required"),
            array('user_id','numerical', 'integerOnly'=>true)
        );
    }


    public function follow($type = "follow") {
        $record = User::model()->findIdByAttributes(array("user_id"=>$this->user_id));
        if($record===null) {
            //关注对象不存在
            return false;
        }
        $fid = Yii::app()->user->id;

        $record = UserFan::model()->findByAttributes(array('user_id'=>$this->user_id, 'fan_id'=>$fid));
        if($type == "follow") {
            if($record!==null) {
                //已经关注
                return true;
            }
        } else {
            if($record===null) {
                //本来就没有关注
                return true;
            }
        }

        if($type == "follow") {
            $uf = new UserFan();
            $uf->user_id = $this->user_id;
            $uf->fan_id = $fid;
            if(!$uf->save(false)) {
                return false;
            }
        } else {
            if(!$record->delete()) {
                return false;
            }
        }

        User::model()->updateCounters(array("fan_number"=>($type=="follow"?1:-1)), "user_id=:userId", array(":userId"=>$this->user_id));

        return true;

    }

    public function unfollow() {
        return $this->follow("unfollow");
    }

}