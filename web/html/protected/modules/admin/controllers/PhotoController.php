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
        $total = Photo::model()->count();
        $total_page = floor($total/self::PER_PAGE);
        if($pi>$total_page) {
            $pi = $total_page;
        }
        $off = $pi * self::PER_PAGE;
        $len = self::PER_PAGE;
        $photo_list = Yii::app()->db->createCommand("select * from photo limit $off, $len")->queryAll();

        $this->sendAjax(array(
            'photo_list' => $photo_list,
            'page_index' => $pi,
            'total_page' => $total_page
        ), true);
    }

}