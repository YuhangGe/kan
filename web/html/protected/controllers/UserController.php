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
        $my_id = Yii::app()->user->id;

        $r = UserLocation::model()->findByPk($my_id);

        if($r===null || $r->lat===null || $r->lng===null) {
            $sql = "select u.*, -1 as distance from `user` u where u.user_id=:uId";
        } else {
            $sql = "select u.*, GETDISTANCE(ua.lat, ua.lng, {$r->lat},{$r->lng}) as distance from `user` u, user_location ua where u.user_id=:uId and u.user_id=ua.user_id";
        }

        $rs = Yii::app()->db->createCommand($sql)->queryAll(true, array(":uId"=>$_POST['user_id']));
//        $user = User::model()->findByPk($_POST['user_id']);
        if($rs === null || count($rs)===0) {
            $this->sendAjax(null);
        }
        $user = $rs[0];
        if($user['distance']==null) {
            $user['distance'] = -1;
        }
//        $info = $user->attributes;
        unset($user['password']);

        $rs = Yii::app()->db->createCommand("select v.video_name, v.video_id, w.time, w.poster_url from winner w, video v where w.video_id=v.video_id and w.user_id=$my_id order by w.`time` desc limit 1")->queryAll();

        if($rs===null || count($rs)===0) {
            $r = null;
        } else {
            $r = $rs[0];
        }
        $user['winner_poster_url'] = $r === null ? null : $r['poster_url'];
        $user['winner_video_name'] = $r === null ? null : $r['video_name'];
        $user['winner_video_id'] = $r === null ? null : $r['video_id'];
        $user['winner_time'] = $r === null ? null : $r['time'];

        if($user['user_id'] === $my_id) {
            $user['relation'] = array("me");
            $this->sendAjax($user, true);
        } else if($user['user_id'] > $my_id) {
            $id1 = $my_id;
            $id2 = $user['user_id'];
        } else {
            $id1 = $user['user_id'];
            $id2 = $my_id;
        }
        /*
         * 首先看是否是互粉好友
         * 在互粉好友关系表中，一定是id小的被放在user_id_1,id大的放在user_id_2，这个在插入数据库时会保证。
         */
        $record = UserFriend::model()->findByAttributes(array('user_id_1'=>$id1, "user_id_2"=>$id2));
        if($record !== null) {
            $user['relation'] = array("friend");
        } else {
            $user['relation'] = array();
        }
        /*
         * 然后看当前登陆用户是否是该用户的粉丝，即是否关注了对方。
         */
        $record = UserFan::model()->findByAttributes(array("user_id"=>$user['user_id'], "fan_id"=>$my_id));
        if($record !== null) {
            $user['relation'][] = "fan";
        }
        /*
         * 最后检查当前登陆用户是否被该用户关注
         */
        $record = UserFan::model()->findByAttributes(array("user_id"=>$my_id, "fan_id"=>$user['user_id']));
        if($record !== null) {
            $user['relation'][] = "follow";
        }

        $this->sendAjax($user, true);

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