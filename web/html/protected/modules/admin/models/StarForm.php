<?php
/**
 * User: xiaoge
 * At: 13-6-16 2:56
 * Email: abraham1@163.com
 */


class StarForm extends CFormModel{
    public $act_id;
    public $user_id;
    public $video_name;

    public function rules() {
        return array(
            array("act_id, user_id", "required"),
            array("act_id, user_id", 'numerical', 'integerOnly'=>true),
            array("video_name", "length", "min"=>1, "max"=>20)
        );
    }

    public function choose() {
        $r = Star::model()->find(array(
            'select' => 'user_id',
            'condition'=>'user_id=:uId and act_id=:aId',
            'params'=>array(':uId'=>$this->user_id, ':aId'=>$this->act_id)
        ));
        if($r!==null) {
            //已经是星客
            return false;
        }
        $sql = "select user_name, sum(view_number) as act_view, sum(vote_number) as act_vote, sum(view_number)+sum(vote_number)*10 as act_score
            from photo where user_id=:uId and act_id=:aId";

        $rs = Yii::app()->db->createCommand($sql)->queryAll(true, array(':uId'=>$this->user_id, ':aId'=>$this->act_id));

        if($rs===null || count($rs)===0) {
            return false;
        } else {
            $rs = $rs[0];
        }

        $m = new Star();
        $m->user_id = $this->user_id;
        $m->act_id = $this->act_id;
        $m->user_name = $rs['user_name'];
        $m->act_view = $rs['act_view'];
        $m->act_vote = $rs['act_vote'];
        $m->act_score = $rs['act_score'];
        $m->time = time();

        return $m->save(false);

    }

    public function cancel() {
        return Star::model()->deleteAllByAttributes(array("user_id"=>$this->user_id, "act_id"=>$this->act_id));
    }

    public function poster() {
        if(!isset($_FILES['image_file'])) {
            return false;
        }
        $r = Star::model()->find(array(
            'select'=>'user_id',
            'condition'=>'user_id=:uId and act_id=:aId',
            'params'=>array(':uId'=>$this->user_id,':aId'=>$this->act_id)
        ));
        if($r===null) {
            return false;
        }
        $dir = "poster";
        $_tag = time().rand(0, 10000);
        $i_fn = $this->user_id."_".$this->act_id."_".$_tag;

        $sif = FileHelper::savePhoto("image_file", $dir, $i_fn);
        if($sif==false) {
            return false;
        }

        return Star::model()->updateAll(array('poster_url'=>Yii::app()->params['staticServer']."/".$sif), "user_id=:uId and act_id=:aId", array(':uId'=>$this->user_id,':aId'=>$this->act_id));

    }

    public function video() {

        if(!isset($_FILES['big_file']) || !isset($_FILES['small_file']) || $this->video_name===null) {
            echo "!1";
            return false;
        }
        $r = Star::model()->find(array(
            'select'=>'user_id',
            'condition'=>'user_id=:uId and act_id=:aId',
            'params'=>array(':uId'=>$this->user_id,':aId'=>$this->act_id)
        ));
        if($r===null) {
            //不是星客
            echo "!2";

            return false;
        }

        $dir = "video";
        $_tag = time().rand(0, 10000);
        $i_fn = "big_".$this->user_id."_".$this->act_id."_".$_tag;
        $s_fn = "small_".$this->user_id."_".$this->act_id."_".$_tag;


        $iif = FileHelper::saveVideo("big_file", $dir, $i_fn);
        if($iif==false) {
            return false;
        }


        $sif = FileHelper::saveVideo("small_file", $dir, $s_fn);
        if($sif==false) {
            unlink(Yii::app()->params['uploadDir']."/".$iif);
            return false;
        }

        $vr = Video::model()->find(array("select"=>"video_id","condition"=>"user_id=:uId and act_id=:aId", "params"=>array(":uId"=>$this->user_id,":aId"=>$this->act_id)));

        $iif = Yii::app()->params["staticServer"]."/".$iif;
        $sif = Yii::app()->params["staticServer"]."/".$sif;

        if($vr!==null) {
            return $vr->updateAll(array(
                "video_name"=>$this->video_name,
                "big_url"=>$iif,
                "small_url"=>$sif
            ), "user_id=:uId and act_id=:aId",array(":uId"=>$this->user_id,":aId"=>$this->act_id));

        } else {
            $u = User::model()->findColumnByPk(array("nick_name"), $this->user_id);
            if($u===null) {
                return false;
            }
            $a = Active::model()->find(array("select"=>"act_name", "condition"=>"act_id=:aId", "params"=>array(":aId"=>$this->act_id)));
            if($a===null) {
                return false;
            }
            $m = new Video();
            $m->user_id = $this->user_id;
            $m->act_id = $this->act_id;
            $m->user_name = $u->nick_name;
            $m->act_name = $a->act_name;
            $m->upload_time = time();
            $m->big_url = $iif;
            $m->small_url = $sif;

            return $m->save();
        }


    }
}