<?php
/**
 * User: xiaoge
 * At: 13-6-17 10:28
 * Email: abraham1@163.com
 */


class PhotoController extends AController{

    const PER_PAGE = 20;
    public function actionIndex() {
        $this->render("index");

    }
    public function actionPage() {
        if(!isset($_POST["page_index"])) {
            return;
        }
        $pi = intval($_POST["page_index"]);
        if($pi!==0 && (empty($pi) || $pi<0)) {
            return;
        }

        $cdt = array();
        $par = array();
        $nick_name = "";
        $act_name = "";

        if(!empty($_POST['user_id'])) {
            $cdt[] = "user_id=:uId";
            $par[':uId'] = $_POST['user_id'];
            $r = User::model()->findBySql("select nick_name from user where user_id=:uId", $par);
            if($r!==null) {
                $nick_name = $r->nick_name;
            }
        }
        if(!empty($_POST['act_id'])) {
            $cdt[] = "act_id=:aId";
            $par[':aId'] = $_POST['act_id'];
            $r = Active::model()->findBySql("select act_name from active where act_id=:aId", array(":aId"=>$_POST['act_id']));
            if($r!==null) {
                $act_name = $r->act_name;
            }
        }

        if(count($cdt)>0) {
            $total = Photo::model()->count(join(" AND ", $cdt), $par);
            $wh = "where ".join(" AND ", $cdt);
        } else {
            $total = Photo::model()->count();
            $wh = "";
        }
        $total_page = floor($total/self::PER_PAGE);
        if($pi>$total_page) {
            $pi = $total_page;
        }
        $off = $pi * self::PER_PAGE;
        $len = self::PER_PAGE;
        $photo_list = Yii::app()->db->createCommand("select * from photo $wh order by photo_id desc limit $off, $len")->queryAll(true, $par);

        $this->sendAjax(array(
            'nick_name' => $nick_name,
            'act_name' => $act_name,
            'photo_list' => $photo_list,
            'page_index' => $pi,
            'total_page' => $total_page
        ), true);
    }

    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['photo_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['photo_id']);
        if(empty($aid)) {
            $this->sendAjax(null);
        }


        if(Photo::model()->deleteAllByAttributes(array("photo_id"=>$aid))){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }


    }

    public function actionModifyHot() {
        if(!isset($_POST['user_id']) || !isset($_POST['act_id']) || !isset($_POST['vote_number']) || !isset($_POST['view_number'])) {
            $this->sendAjax(null);
        }
        $ps = Photo::model()->findAllBySql("select photo_id from photo where user_id=:uId and act_id=:aId", array(":uId"=>$_POST['user_id'], ":aId"=>$_POST['act_id']));
        if($ps === null || count($ps)===0) {
            $this->sendAjax(null);
        }
//        $c = count($ps);
        $vn1 = intval($_POST['vote_number']);
        $vn2 = intval($_POST['view_number']);

        if(($vn1!==0 && empty($vn1)) || ($vn2!==0 && empty($vn2))) {
            $this->sendAjax(null);
        }

        $i = 0;
        foreach($ps as $p) {
            if($i===0) {
                Photo::model()->updateByPk($p->photo_id, array("vote_number"=>$vn1, "view_number"=>$vn2));
            } else {
                Photo::model()->updateByPk($p->photo_id, array("vote_number"=>0, "view_number"=>0));
            }
            $i++;
        }
        $vn3 = $vn1 * 10 + $vn2;

        Yii::app()->db->createCommand("update star set act_vote = $vn1, act_view = $vn2, act_score= $vn3 where user_id=:uId and act_id=:aId")->query(array(":uId"=>$_POST['user_id'], ":aId"=>$_POST['act_id']));

        $this->sendAjax(true, true);
    }
}