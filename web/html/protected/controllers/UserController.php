<?php
/**
 * User: xiaoge
 * At: 13-5-26 12:04
 * Email: abraham1@163.com
 */


class UserController extends Controller {
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }



    public function actionInfo() {
        if(!isset($_POST['user_id'])) {
            return;
        }
        $user = User::model()->findByPk($_POST['user_id']);
        if($user === null) {
            $this->sendAjax(null);
        }

        $info = $user->attributes;
        unset($info['password']);
        unset($info['real_name']);

        $my_id = Yii::app()->user->id;
        if($user->user_id === $my_id) {
            $info['relation'] = array("me");
            $this->sendAjax($info, true);
        } else if($user->user_id > $my_id) {
            $id1 = $my_id;
            $id2 = $user->user_id;
        } else {
            $id1 = $user->user_id;
            $id2 = $my_id;
        }
        /*
         * 首先看是否是互粉好友
         * 在互粉好友关系表中，一定是id小的被放在user_id_1,id大的放在user_id_2，这个在插入数据库时会保证。
         */
        $record = UserFriend::model()->findByAttributes(array('user_id_1'=>$id1, "user_id_2"=>$id2));
        if($record !== null) {
            $info['relation'] = array("friend");
        } else {
            $info['relation'] = array();
        }
        /*
         * 然后看当前登陆用户是否是该用户的粉丝，即是否关注了对方。
         */
        $record = UserFan::model()->findByAttributes(array("user_id"=>$user->user_id, "fan_id"=>$my_id));
        if($record !== null) {
            $info['relation'][] = "fan";
        }
        /*
         * 最后检查当前登陆用户是否被该用户关注
         */
        $record = UserFan::model()->findByAttributes(array("user_id"=>$my_id, "fan_id"=>$user->user_id));
        if($record !== null) {
            $info['relation'][] = "follow";
        }

        $this->sendAjax($info, true);

    }

    /*
     * 得到某个用户的粉丝
     */
    public function actionFans() {
        $ufl = new UserFanList();
        $ufl->attributes = $_POST;
        if(!$ufl->validate()) {
            $this->sendAjax(null);
        }
        $data = $ufl->get();
        if($data === null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($data, true);
        }
    }
    /*
     * 得到某个用户的好友
     */
    public function actionFriends() {
        $ufl = new UserFriendList();
        $ufl->attributes = $_POST;
        if(!$ufl->validate()) {
            $this->sendAjax(null);
        }
        $data = $ufl->get();
        if($data === null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($data, true);
        }
    }
    /*
     * 得到某个用户关注的用户
     */
    public function actionFollows() {
        $ufl = new UserFanList();
        $ufl->attributes = $_POST;
        if(!$ufl->validate()) {
            $this->sendAjax(null);
        }
        $data = $ufl->getFollow();
        if($data === null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($data, true);
        }
    }

    public function actionLocation() {
        if(!isset($_POST['user_id'])) {
            return;
        } else {
            $uid = (int)$_POST['user_id'];
        }
        if(empty($uid)||$uid<0) {
            return;
        }
        $r = UserLocation::model()->findByPk($uid);
        if($r!==null) {
            $this->sendAjax(array(
                'lat'=>$r->lat,
                'lng'=>$r->lng,
                'time'=>$r->time,
                'address'=>$r->address
            ), true);
        } else {
            $this->sendAjax(null);
        }
    }
}