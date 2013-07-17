<?php
/**
 * User: xiaoge
 * At: 13-5-31 10:33
 * Email: abraham1@163.com
 */


class UserController extends AController {
    public function actionIndex() {
        $this->render("index");
    }

    public function actionDetail() {
        $this->render("detail");
    }

    public function actionGetDetail() {
        if(!isset($_POST['user_id'])) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['user_id']);
        if(empty($aid)||$aid<0) {
            $this->sendAjax(null);
        }
        $act = User::model()->findByPk($_POST['user_id']);
        if($act===null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($act, true);
        }
    }

    public function actionSearch() {
        if(!isset($_POST['search_type']) || !isset($_POST['search_value'])) {
            $this->sendAjax(null);
        }
        $st = $_POST['search_type'];
        $sv = $_POST['search_value'];
        $m = new SearchUserForm();
        if($st==="nick_name") {
            $m->nick_name = $sv;
        } elseif ($st==="user_id") {
            $m->user_id = $sv;
        } else {
            $this->sendAjax(null);
        }

        $rtn = array();
        if($m->validate()) {
            $rtn = $m->search(SearchUserForm::ADMIN_SELECT);
        }

        $this->sendAjax($rtn, true);
    }

    public function actionStar() {
        $this->render("star");
    }

    public function actionSInfo() {
        if(!isset($_POST['user_id'])) {
            $this->sendAjax(null);
        }
        $r =  User::model()->findBySql("select nick_name, user_id, `level` from user where user_id = :uId", array(":uId"=>$_POST['user_id']));
        if($r!==null) {
            $this->sendAjax($r, true);

        } else {
            $this->sendAjax(null);

        }
    }
    public function actionInfo() {
        if(!isset($_POST['user_id'])) {
            $this->sendAjax(null);
        }
        $r =  User::model()->findBySql("select nick_name, user_id, `level` from user where user_id = :uId", array(":uId"=>$_POST['user_id']));
        if($r!==null) {
            $user = $r->attributes;
            if($user['level']<2) {
                $user['last_active'] = "-1";
            } else {
                $rs = Yii::app()->db->createCommand("select a.act_name, a.act_id from star s, active a where s.act_id=a.act_id and s.user_id=:uId order by s.time desc limit 200")->queryAll(true,array(":uId"=>$_POST['user_id']));

                if($rs === null || count($rs)===0) {
                    $user['last_active'] = "-1";
                } else {
                    $user['last_active'] = $rs[0]['act_id'];
                    $user['star_active_list'] = $rs;
                }
            }
//            echo CJSON::encode($user);

            $this->sendAjax($user, true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['user_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $uid = intval($_POST['user_id']);
        if(empty($uid)) {
            $this->sendAjax(null);
        }


        $par = array(":uId"=>$uid);

        UserFan::model()->deleteAll("(user_id=:uId or fan_id=:uId) and user_id>0", $par);
        UserFriend::model()->deleteAll("(user_id_1=:uId or user_id_2=:uId) and user_id_1>0", $par);
        UserLocation::model()->deleteAll("user_id=:uId", $par);
        Photo::model()->deleteAll("user_id=:uId", $par);;
        Video::model()->deleteAll("user_id=:uId", $par);
        Winner::model()->deleteAll("user_id=:uId", $par);
        UserActive::model()->deleteAll("user_id=:uId", $par);

        if(User::model()->deleteByPk($uid)){

            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}