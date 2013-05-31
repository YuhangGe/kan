<?php
/**
 * User: xiaoge
 * At: 13-5-28 2:03
 * Email: abraham1@163.com
 */


class UserFriendForm extends CFormModel {
    public $user_id;

    public function rules() {
        return array(
            array("user_id","required"),
            array('user_id','numerical', 'integerOnly'=>true)
        );
    }

    public function friend($type = 'friend') {
        $id1 = $this->user_id;
        $id2  = Yii::app()->user->id;

        $record1 = User::model()->findColumnByPk(array('user_id', 'nick_name', 'small_avatar'), $id1);
        if($record1===null) {
            //用户不存在
//            echo CJSON::encode($record);
            return false;
        }
        $record2 = User::model()->findColumnByPk(array('user_id', 'nick_name', 'small_avatar'), $id2);
        if($record2===null) {
            return false;
        }
        if($id1 == $id2) {
            return false;
        } else if($id1>$id2) {
            $id2 = $id1;
            $id1 = Yii::app()->user->id;
            $nm2 = $record1->nick_name;
            $nm1 = $record2->nick_name;
            $av1 = $record2->small_avatar;
            $av2 = $record1->small_avatar;
        } else {
            $nm1 = $record1->nick_name;
            $nm2 = $record2->nick_name;
            $av1 = $record1->small_avatar;
            $av2 = $record2->small_avatar;
        }
        /*
         * 保证小号的id在前
         */
        $record = UserFriend::model()->findByAttributes(array('user_id_1'=>$id1, 'user_id_2'=>$id2));
//        echo(CJSON::encode($record));

        if($type=='friend') {
            if($record!==null) {
                //已经是朋友
                return false;
            }
        } else {
            if($record===null) {
                //本来就不是朋友
                return false;
            }
        }

        if($type == 'friend') {
            $uf = new UserFriend();
            $uf->user_id_1=$id1;
            $uf->user_id_2=$id2;
            $uf->user_name_1=$nm1;
            $uf->user_name_2=$nm2;
            $uf->user_avatar_1=$av1;
            $uf->user_avatar_2=$av2;
            if(!$uf->save(false)) {
                return false;
            }
        } else {
            if(!$record->delete()) {
                return false;
            }
        }


        $c = $type == 'friend' ? 1 : -1;
        UserFriendNumber::model()->updateCounters(array("friend_number"=>$c), "user_id=:userId", array(":userId"=>$id1));
        UserFriendNumber::model()->updateCounters(array("friend_number"=>$c), "user_id=:userId", array(":userId"=>$id2));

        return true;
    }
    public function unfriend() {
        return $this->friend("unfriend");
    }
}