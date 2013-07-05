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
    public $video_big_url;
    public $video_small_url;

    public function rules() {
        return array(
            array("act_id, user_id", "required"),
            array("act_id, user_id", 'numerical', 'integerOnly'=>true),
            array("video_name", "length", "min"=>1, "max"=>20),
            array("video_big_url, video_small_url", "length", "min"=>1, "max"=>150)
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
            return true;
        }
        $m = Active::model()->find(array(
            'select'=>'act_name',
            'condition'=>'act_id=:aId',
            'params'=>array(':aId'=>$this->act_id)
        ));
        if($m === null) {
            //如果活动不存在
            return false;
        } else {
            $act_name = $m->act_name;
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

        if(!$m->save(false)){
            return false;
        } else {
            return true;
        }


//        $m = new Notify();
//        $m->to_user_id = $this->user_id;
//        $m->time = time();
//        $m->type = 0;
//        $m->content = "恭喜您已经在{$act_name}活动中当选为星客。请完善您的手机和真实姓名信息，我们会在近期与您取得联系。";

//        return $m->save(false);
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
        $i_fn = "star_".$this->user_id."_".$this->act_id."_".$_tag;

        $sif = FileHelper::savePhoto("image_file", $dir, $i_fn);
        if($sif==false) {
            return false;
        }

        return Star::model()->updateAll(array('poster_url'=>Yii::app()->params['staticServer']."/".$sif), "user_id=:uId and act_id=:aId", array(':uId'=>$this->user_id,':aId'=>$this->act_id));

    }

    public function video() {

        if($this->video_big_url===null || $this->video_small_url===null || $this->video_name===null) {
            return false;
        }
        $r = Star::model()->find(array(
            'select'=>'user_id',
            'condition'=>'user_id=:uId and act_id=:aId',
            'params'=>array(':uId'=>$this->user_id,':aId'=>$this->act_id)
        ));
        if($r===null) {
            //不是星客
            return false;
        }



        $vr = Video::model()->find(array("select"=>"video_id","condition"=>"user_id=:uId and act_id=:aId", "params"=>array(":uId"=>$this->user_id,":aId"=>$this->act_id)));



        if($vr!==null) {
            return $vr->updateAll(array(
                "video_name"=>$this->video_name,
                "big_url"=>$this->video_big_url,
                "small_url"=>$this->video_small_url
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
            $m->video_name = $this->video_name;
            $m->upload_time = time();
            $m->big_url = $this->video_big_url;
            $m->small_url = $this->video_small_url;

            return $m->save();
        }


    }
}