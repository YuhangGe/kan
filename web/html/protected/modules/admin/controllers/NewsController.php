<?php
/**
 * User: xiaoge
 * At: 13-7-3 1:52
 * Email: abraham1@163.com
 */


class NewsController extends AController{
    public function actionPost() {
        $m = new News();
        $m->content = $_POST['content'];
        $m->time = time();
        if($m->save()) {
            $this->sendAjax(array(
                'news_id' => $m->news_id
            ), true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionModify() {
        if(empty($_POST['news_id'])||empty($_POST['content'])) {
            $this->sendAjax(null);
        }
        $m = News::model()->findByPk($_POST['news_id']);
        if($m===null) {
            $this->sendAjax(null);
        }
        $m->content = $_POST['content'];
        if($m->save()) {
            $this->sendAjax(array(
                'news_id' => $m->news_id
            ), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['news_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['news_id']);
        if(empty($aid)) {
            $this->sendAjax(null);
        }


        if(News::model()->deleteAllByAttributes(array("news_id"=>$aid))){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }


    }
}