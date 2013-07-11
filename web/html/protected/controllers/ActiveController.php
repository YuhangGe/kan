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


    public function actionJoin() {
        $m = new ActiveJoinForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->join()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionOldJoin() {
        if(!isset($_POST['act_id'])) {
            return;
        }
        $r = Active::model()->find(array('select'=>'end_time', 'condition'=>'act_id=:aId', 'params'=>array(':aId'=>$_POST['act_id'])));
        if($r===null) {
            return;
        }
//        echo time();
        if($r->end_time<time()) {
            $this->sendAjax("活动已经过期",false);
        }

        $uid = Yii::app()->user->id;
        $r = UserActive::model()->findByAttributes(array('act_id'=>$_POST['act_id'], 'user_id'=>$uid));
        if($r!==null) {
            $this->sendAjax(true, true);
        }

        $m = new UserActive();
        $m->attributes = $_POST;
//        echo CJSON::encode($m);

        $m->user_id = Yii::app()->user->id;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $transaction = Yii::app()->db->beginTransaction(); //创建事务
        try {
            /*
             * 一但报名，则成为秀客
             * user_location表的user_level是为了冗余，方便在基于地理位置时的查找和搜索
             */
            $m->save(false);
            Yii::app()->db->createCommand("update `user` set level=1 where user_id=:uId and level=0")->query(array(':uId'=>$m->user_id));
            Yii::app()->db->createCommand("update `user_location` set user_level=1 where user_id=:uId and user_level=0")->query(array(':uId'=>$m->user_id));
            $transaction->commit(); //提交事务会真正的执行数据库操作
            $this->sendAjax(true, true);
        } catch (Exception $e) {
            $transaction->rollback(); //如果操作失败, 数据回滚
            $this->sendAjax($e->getMessage(), false);
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

    public function actionUserList() {
        $m = new ActiveList();
        $m->attributes = $_POST;
        if($m->validate()) {
           $this->sendAjax($m->getUserList());
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionOpenList() {
        $m = new ActiveList();
        $m->attributes = $_POST;
        if($m->validate()) {
            $this->sendAjax($m->getOpenList());
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionCloseList() {
        $m = new ActiveList();
        $m->attributes = $_POST;
        if($m->validate()) {
            $this->sendAjax($m->getCloseList());
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionRecommendPhoto() {
        $m = new PhotoList();
        $m->attributes = $_POST;
        $m->type = "recommend";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionRecommendVideo() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type = "recommend";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }
}