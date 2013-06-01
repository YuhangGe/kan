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
        $r = $f->get();
        if($r===null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($r, true);
        }
    }

    public function actionInfo() {
        if(!isset($_POST['act_id'])) {
            return;
        }
        $r = Active::model()->findByPk($_POST['act_id']);
        if($r!==null) {
            $this->sendAjax(array(
                'act_name'=>$r->act_name,
                'begin_time'=>$r->begin_time,
                'end_time'=>$r->end_time,
                'image'=>$r->image,
                'description'=>$r->description
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
}