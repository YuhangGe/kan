<?php
/**
 * User: xiaoge
 * At: 13-6-16 1:54
 * Email: abraham1@163.com
 */


class VideoList extends CFormModel{
    public $type;
    public $offset;
    public $length;
    public $lat;
    public $lng;
    public $time;
    public $user_id;
    public $act_id;

    public function rules(){
        return array(
            array('type', 'required'),
            array('type', 'in', 'range'=>array("location", "time", "view", "rand", "user", "active", "last")),
            array("time, act_id, user_id", 'numerical', 'integerOnly'=>true),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),
            array('lat, lng', 'numerical')
        );
    }

    private  function getLocationList() {
        if($this->lat === null || $this->lng === null) {
            return array();
        }
        $uid = Yii::app()->user->id;
        $STEP = array(0.005, 0.01, 0.015, 0.02, 0.025, 0.03, 0.04, 0.06, 0.08, 0.1);
        $STEP_C = 10;
        $total = 0;
        $got = false;

        for($idx=0;$idx<$STEP_C;$idx++) {
            $S = $STEP[$idx];
            $lat_top = $this->lat - $S / 2;
            $lat_bottom = $this->lat + $S / 2;
            $lng_left = $this->lng - $S;
            $lng_right = $this->lng + $S;

            $cdt = "user_level>=1 AND user_id<>$uid AND (lat between $lat_top AND $lat_bottom) AND (lng between $lng_left AND $lng_right)";
            $r = Yii::app()->db->createCommand("SELECT count(*) as u_number FROM user_location WHERE $cdt")->queryAll();
            if($r === null || count($r)===0) {
                return array();
            } else {
                $r = $r[0];
                $total += $r['u_number'];
            }
            if($total>$this->offset+$this->length) {
                $got = true;
                break;
            }elseif($total>$this->offset) {
                $got = true;
            }
        }

        if(!$got) {
            return array();
        }


        $sql = "select p.*, ua2.distance
            from video as p,
            (select p1.user_id,p1.video_id,p1.act_id,u_a.distance
              from video as p1,
                (select user_id, GETDISTANCE(lat, lng, {$this->lat}, {$this->lng}) as distance
                    from user_location
                      where $cdt
                      order by distance
                      limit {$this->offset}, {$this->length}
                ) as u_a where u_a.user_id = p1.user_id and p1.user_id<>$uid order by video_id desc
            ) as ua2
            where ua2.video_id=p.video_id
            group by ua2.user_id order by ua2.distance";


        /*
         * 取出附近用户最新上传的一张照片
         * 其中的GETDISTANCE是mysql的函数，参考数据库.txt文档
         */
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;

    }

    private function getTimeList() {
        if($this->time===null) {
            $this->time = time();
        }
        $sql = "select * from video where upload_time<={$this->time}
                order by upload_time desc limit {$this->offset},{$this->length}";

        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
    private function getViewList() {
        $sql = "select p.* from video p order by vote_number*10 + view_number desc limit {$this->offset},{$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    private function getLastList() {
        $r = Active::model()->findBySql("select act_id from active order by end_time desc limit 1");
        if($r===null) {
            return array();
        }
        $sql = "select p.* from video p where act_id={$r->act_id} order by vote_number*10 + view_number desc limit {$this->offset},{$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
    private function getRandList() {
        $sql = "SELECT *
              FROM video AS r1 JOIN
                   (SELECT (RAND() *
                                 (SELECT MAX(video_id)
                                    FROM video)) AS id)
                    AS r2
             WHERE r1.video_id >= r2.id
             ORDER BY r1.video_id ASC
             LIMIT 1";
        $rs = array();
        for($i=0;$i<$this->length;$i++) {
            $r = Yii::app()->db->createCommand($sql)->queryAll();
            if($r!==null) {
                $rs[]=$r[0];
            }
        }
        return $rs;
    }

    private function getUserList() {
        if($this->user_id===null) {
            return array();
        }
        $sql = "select * from video where user_id={$this->user_id} order by upload_time desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    private function getActiveList() {
        if($this->act_id===null) {
            return array();
        }
        $rs = Video::model()->findAll(array(
            "condition"=>"act_id=:aId order by upload_time desc limit {$this->offset},{$this->length}",
            "params" => array(":aId"=>$this->act_id)
        ));
        if($rs!==null) {
            return $rs;
        } else {
            return array();
        }
    }
    public function get() {
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
        switch($this->type) {
            case 'location':
                return $this->getLocationList();
                break;
            case 'time':
                return $this->getTimeList();
                break;
            case 'view' :
                return $this->getViewList();
                break;
            case "rand" :
                return $this->getRandList();
                break;
            case "user" :
                return $this->getUserList();
                break;
            case "active":
                return $this->getActiveList();
                break;
            case "last" :
                return $this->getLastList();
                break;
            default:
                return array();
        }
    }


}