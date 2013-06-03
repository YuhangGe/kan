<?php
/**
 * User: xiaoge
 * At: 13-6-1 4:58
 * Email: abraham1@163.com
 */


class ActiveController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionList() {
        $f = new ActiveList();
        $f->attributes = $_POST;
        $list = $f->get();

        if($list===null) {
            $this->sendAjax(null);
        } else {

            $this->sendAjax($list, true);
        }
    }

    public function actionInfo() {
        if(!isset($_POST['act_id'])) {
            return;
        }
        $r = Active::model()->findByPk($_POST['act_id']);
        if($r!==null) {
            $r2 = UserActive::model()->find(array('select'=>'act_id', 'condition'=>'act_id=:aId AND user_id=:uId', 'params'=>array(':aId'=>$_POST['act_id'],'uId'=>Yii::app()->user->id)));
            $this->sendAjax(array(
                'act_name'=>$r->act_name,
                'begin_time'=>$r->begin_time,
                'end_time'=>$r->end_time,
                'image'=>$r->image,
                'description'=>$r->description,
                'user_id' => $r2 === null ? null : Yii::app()->user->id
            ), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionCreate() {
        //if(!Yii::app()->user->isAdmin()) {
            //必须管理员
            //return;
        //}
        $m = new Active();
        $m->attributes = $_POST;
        if($m->validate() && $m->save()) {
            $this->sendAjax(true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionJoin() {
        if(!isset($_POST['act_id'])) {
            return;
        }
        $r = Active::model()->find(array('select'=>'end_time', 'condition'=>'act_id=:aId', 'params'=>array(':aId'=>$_POST['act_id'])));
        if($r===null) {
            return;
        }
        if($r->end_time<time()) {
            $this->sendAjax("活动已经过期",false);
        }
        $m = new UserActive();
        $m->act_id = $_POST['act_id'];
        $m->user_id = Yii::app()->user->id;
        if($m->validate() && $m->save()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionIsjoin() {
        $m = new UserActive();
        $m->act_id = $_POST['act_id'];
        $m->user_id = Yii::app()->user->id;
        if($m->validate(array('act_id', 'user_id'))) {
            $this->sendAjax($m->isUserJoin(), true);
        } else {
            $this->sendAjax(null);
        }
    }
}