<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
            echo '\%';
//        $thumbs = array('http://farm9.staticflickr.com/8450/8014700704_c1ac5e6e9b_m.jpg','http://farm8.staticflickr.com/7173/6430214673_6a80d19700_m.jpg', 'http://farm8.staticflickr.com/7161/6430213513_02b5542890_n.jpg','http://farm5.staticflickr.com/4135/4852548105_041d544a61_n.jpg','http://farm4.staticflickr.com/3413/3544044637_9a9a491978_m.jpg');
//        $urls = array('http://farm9.staticflickr.com/8450/8014700704_c1ac5e6e9b_z.jpg','http://farm8.staticflickr.com/7173/6430214673_6a80d19700_b.jpg','http://farm8.staticflickr.com/7161/6430213513_02b5542890_b.jpg','http://farm5.staticflickr.com/4135/4852548105_f47030ce09_o.jpg','http://farm4.staticflickr.com/3413/3544044637_208058c8b4_o.jpg');

//        for($i=7;$i<8;$i++) {
////            for($a=0;$a<2;$a++) {
//                $act_id = 1;//rand(1, 40);
////                $sql = "insert into user_active(user_id, act_id) values($i, $act_id)";
////                $r = Yii::app()->db->createCommand($sql)->query();
////                if($r===null) {
////                    echo "error.";
////                    return;
////                }
////                echo $sql."<br/>";
//                for($j=0;$j<7;$j++) {
//                    $pidx = rand(0, 4);
//                    $sql = "insert into photo(user_id, act_id, user_name, act_name, image_url, thumb_url, upload_time) values($i, $act_id,'test','test', '{$urls[$pidx]}', '{$thumbs[$pidx]}', 1370535786)";
//                    $r = Yii::app()->db->createCommand($sql)->query();
//                    if($r===null) {
//                        echo "error.";
//                        return;
//                    }
//                    echo $sql."<br/>";
//                }
////            }
//
//        }


    }

    function actionDo() {
//        echo CJSON::encode($_GET);
        $this->render("do");
    }
    function actionGoodInfo() {
        phpinfo();
    }
    function actionAvatar() {
        $this->render("avatar");
    }
}