<?php
/**
 * User: xiaoge
 * At: 13-6-2 10:46
 * Email: abraham1@163.com
 */


class PhotoController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    /*

    public function actionPost() {
        $m = new Photo();
        $m->attributes = $_POST;
        $m->user_id = Yii::app()->user->id;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $r = UserActive::model()->find(array("select"=>"photo_number",
            "condition"=>"act_id=:aId AND user_id=:uId",
            "params"=>array(":aId"=>$m->act_id, ":uId"=>$m->user_id)));

        if($r===null || $r->photo_number>=8) {
            $this->sendAjax(null);
        }

        $transaction = Yii::app()->db->beginTransaction(); //创建事务
        try {
            $m->save(false);
            $mv = new PhotoViewNumber();
            $mv->photo_id = $m->photo_id;
            $mv->save(false);
            UserActive::model()->updateCounters(array("photo_number"=>1), "user_id=:uId AND act_id=:aId", array(":uId"=>$m->user_id, ":aId"=>$m->act_id));
            $transaction->commit(); //提交事务会真正的执行数据库操作
            $rtn = true;
        } catch (Exception $e) {
            $transaction->rollback(); //如果操作失败, 数据回滚
            echo $e->getMessage();
            $rtn = false;
        }

        $this->sendAjax($rtn, true);
    }
    */

    public function actionLocationList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "location";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }

    }
    public function actionTimeList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "time";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionViewList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "view";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionRandList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type="rand";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionUserList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type="user";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionActiveList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "active";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionLastViewList() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "last";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }
}