<?php
/**
 * User: xiaoge
 * At: 13-7-12 1:42
 * Email: abraham1@163.com
 */


class SearchForm extends CFormModel{
    public $type;
    public $nick_name;
    public $act_name;
    public $video_name;
    public $tag;
    public $sex;
    public $age_from;
    public $age_to;
    public $constellation;
    public $distance;

    public $offset;
    public $length;

    private $lat;
    private $lng;
    private $user_par = array();
    private $user_cdt = array();
    private $act_cdt = array();
    private $video_cdt = array();

    private $dis_join = "";
    private $s_dis = false;

    public function rules() {
        return array(
            array('type', 'required'),
            array('distance, sex, age_from, age_to', 'numerical', 'integerOnly'=>true),
            array('constellation', 'numerical', 'min'=>1, 'max'=>12),
            array('act_name, nick_name, video_name, tag', 'length', 'min'=>1, 'max'=>15),
            array('distance', 'numerical', 'min'=>1),

            array('age_from, age_to', 'numerical', 'min'=>0, 'max'=>100),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),

        );
    }
    private function check() {
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>200) {
            //一次最多取200条
            $this->length = 200;
        } else {
            $this->length = intval($this->length);
        }

        if($this->sex!==null) {
            $this->user_cdt[] = "user.sex=:sex";
            $this->user_par[":sex"] = $this->sex;
        }
        if($this->constellation!==null) {
            $this->user_cdt[] = "user.constellation=:co";
            $this->user_par[":co"] = $this->constellation;
        }

        if($this->age_from!==null && $this->age_to!==null && $this->age_from<=$this->age_to) {
            $year = (int)date("Y");
            $md = date("-m-d");

            $b_young = strtotime(($year-$this->age_from).$md);
            $b_old = strtotime(($year-$this->age_to-1).$md);
            $this->user_cdt[] = "user.birthday between :b_old and :b_young";

            $this->user_par[":b_old"]=$b_old;
            $this->user_par[":b_young"]=$b_young;
        }

        $uid = Yii::app()->user->id;

        if($this->distance!==null) {
            $r = UserLocation::model()->findByPk($uid);
            if($r!==null && $r->lat!==null && $r->lng!==null) {
                $dlng =  2 * asin(sin($this->distance /1000 / (2 * 6371)) / cos(deg2rad($r->lat)));
                $dlng = rad2deg($dlng);

                $dlat = $this->distance/6371;
                $dlat = rad2deg($dlat);

                $lat_left = $r->lat - $dlat;
                $lat_right = $r->lat + $dlat;
                $lng_left = $r->lng - $dlng;
                $lng_right = $r->lng + $dlng;


                $this->dis_join = " (select user_id, address, GETDISTANCE(lat, lng, {$r->lat},{$r->lng}) as distance from user_location where ".($this->type==='user' ? "user_id<>$uid and " : ""). " lat between $lat_left and $lat_right and lng between $lng_left and $lng_right order by distance limit 1000) ua where ua.user_id=user.user_id";
                $this->lat = $r->lat;
                $this->lng = $r->lng;
                $this->s_dis = true;
            }
        }

        if($this->nick_name!==null) {
            $this->user_cdt[] = "user.nick_name LIKE :nick_name";
            $this->user_par[":nick_name"] = '%'.strtr($this->nick_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if($this->act_name !==null) {
//            echo 'act';
            $this->act_cdt[] = "active.act_name LIKE :act_name";
            $this->video_cdt[] = "video.act_name LIKE :act_name";

            $this->user_par[":act_name"] = '%'.strtr($this->act_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';

        }

        if($this->tag !== null) {
            $this->user_cdt[] = "(user.company LIKE :tag OR user.hobby LIKE :tag)";
            $this->user_par[":tag"] = '%'.strtr($this->tag,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if($this->video_name!==null) {
            $this->video_cdt[] = "video.video_name LIKE :vid_name";
            $this->user_par[":vid_name"] = '%'.strtr($this->video_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';

        }
    }
    private function s_user() {
        $this->check();
        $uid = Yii::app()->user->id;

        $cdt_str = join("  AND  ", $this->user_cdt);
        $act_str = join("  AND  ", $this->act_cdt);

//        print_r($this->act_cdt);

        $sql = "select user.*, 0 as chat_number ".($this->s_dis?", ua.distance, ua.address ":"")." from user ".
            ($this->s_dis
                ? (", $this->dis_join and user.user_id<>$uid".($cdt_str==""?"":" and $cdt_str "))
                : ($cdt_str==""?"where user.user_id<>$uid":" where $cdt_str and user.user_id<>$uid")).
            ($act_str==""?"":" AND user.user_id in(select user_active.user_id from active, user_active where user_active.act_id=active.act_id and $act_str)").
            ($this->s_dis?" order by ua.distance ":"")." limit {$this->offset},{$this->length} ";

        $rs = Yii::app()->db->createCommand($sql)->queryAll(true, $this->user_par);
        if(count($rs)===0) {
            return $rs;
        }
        $u_arr = array();
        foreach ($rs as $r) {
            $u_arr[] = $r['user_id'];
        }
        $sql = "select count(*) as count, from_user_id from chat where to_user_id={$uid} and from_user_id in(".join(",", $u_arr).") group by from_user_id";
        $cs = Yii::app()->db->createCommand($sql)->queryAll();
        foreach($cs as $c) {
            $idx = array_search($c["from_user_id"], $u_arr);
            if($idx!==FALSE) {
                $rs[$idx]['chat_number'] = $c["count"];
            }
        }

        return $rs;
    }

    private function s_active(){
        $this->check();
        $uid = Yii::app()->user->id;

        $cdt_str = join("  AND  ", $this->user_cdt);
        $act_str = join("  AND  ", $this->act_cdt);

        if($cdt_str!=="" || $this->s_dis) {
            $u_sql = "(select user_active.act_id from user_active, user ".
                ($this->s_dis
                    ? (", $this->dis_join ".($cdt_str==""?"":" and $cdt_str "))
                    : ($cdt_str==""?"where ":" where $cdt_str and "))." user.user_id=user_active.user_id )";
        } else {
            $u_sql = "";

        }
        if($u_sql=="" && $act_str=="") {
            $wh = "";
        } else {
            $wh = "where $act_str";
            if($act_str=="" && $u_sql!="") {
                $wh.=" active.act_id in $u_sql";
            } elseif($act_str!="" && $u_sql!="") {
                $wh.=" and active.act_id in $u_sql";
            }
        }
        $sql = "select active.*, ua.user_id  from active LEFT OUTER JOIN user_active ua ON (ua.act_id = active.act_id AND ua.user_id=$uid) $wh order by end_time desc limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $this->user_par);


    }

    private function s_video(){
        $this->check();
        $uid = Yii::app()->user->id;

        $cdt_str = join("  AND  ", $this->user_cdt);
        $vid_str = join("  AND  ", $this->video_cdt);

        if($cdt_str!=="" || $this->s_dis) {
            $u_sql = "(select user.user_id from user ".
                ($this->s_dis
                    ? (", $this->dis_join ".($cdt_str==""?"":" and $cdt_str "))
                    : ($cdt_str==""?"":" where $cdt_str ")).")";
        } else {
            $u_sql = "";

        }
        if($u_sql=="" && $vid_str=="") {
            $wh = "";
        } else {
            $wh = "where $vid_str";
            if($vid_str=="" && $u_sql!="") {
                $wh.=" video.user_id in $u_sql";
            } elseif($vid_str!="" && $u_sql!="") {
                $wh.=" and video.user_id in $u_sql";
            }
        }
        $sql = "select video.*  from video $wh order by upload_time desc limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $this->user_par);
    }

    public function search() {
        switch($this->type) {
            case 'user':
                return $this->s_user();
            case 'active':
                return $this->s_active();
            case 'video':
                return $this->s_video();
        }
        return array();
    }
}