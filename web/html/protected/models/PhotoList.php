<?php
/**
 * User: xiaoge
 * At: 13-6-7 10:43
 * Email: abraham1@163.com
 */


class PhotoList extends CFormModel{
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
            array('type', 'in', 'range'=>array("location", "time", "view", "rand", "user", "active", "last", "recommend")),
            array("time, act_id, user_id", 'numerical', 'integerOnly'=>true),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),
            array('lat, lng', 'numerical')
        );
    }

//    /**
//     *计算某个经纬度的周围某段距离的正方形的四个点
//     *
//     *@param lng float 经度
//     *@param lat float 纬度
//     *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
//     *@return array 正方形的四个点的经纬度坐标
//     */
//    private function returnSquarePoint($lat, $lng,$distance = 0.5){
//        define(EARTH_RADIUS, 6371);//地球半径，平均半径为6371km
//
//        $dlng =  2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));
//        $dlng = rad2deg($dlng);
//
//        $dlat = $distance/EARTH_RADIUS;
//        $dlat = rad2deg($dlat);
//
//        return array(
//            'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
//            'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
//            'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
//            'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
//        );
//    }

    private  function getLocationList() {

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
//                break;
            }
        }

        if(!$got) {
            return array();
        }


//        $sql = "select p.*, ua2.distance
//            from photo as p,
//            (select p1.user_id,p1.photo_id,p1.act_id,u_a.distance
//              from photo as p1,
//                (select user_id, GETDISTANCE(lat, lng, {$this->lat}, {$this->lng}) as distance
//                    from user_location
//                      where $cdt
//                      order by distance
//                      limit {$this->offset}, {$this->length}
//                ) as u_a where u_a.user_id = p1.user_id and p1.user_id<>$uid order by photo_id desc
//            ) as ua2
//            where ua2.photo_id=p.photo_id
//            group by ua2.user_id order by ua2.distance";

        $sql = "select p.*, p.vote_number*10+p.view_number as score_number, u_a.distance, u_a.address from photo as p,  (select user_id, GETDISTANCE(lat, lng, {$this->lat}, {$this->lng}) as distance, address
                    from user_location
                      where $cdt
                      order by distance
                      limit {$this->offset}, {$this->length}
                ) as u_a where u_a.user_id = p.user_id and p.user_id<>$uid and p.is_key_photo = 1 order by u_a.distance";

        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;

    }

    private function getTimeList() {
        if($this->time===null) {
            $this->time = time();
        }
//        $sql = "select *
//                from (select * from photo order by photo_id desc) p2
//                group by user_id, act_id
//                having upload_time<={$this->time}
//                order by upload_time desc limit {$this->offset},{$this->length}";

        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.*, p.vote_number*10+p.view_number as score_number from photo p left join user_location u_a on p.user_id=u_a.user_id where is_key_photo=1 and upload_time<={$this->time} order by upload_time desc limit {$this->offset}, {$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
    private function getViewList() {
        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.*, p.vote_number*10 + p.view_number as score_number from photo p left join user_location u_a on p.user_id=u_a.user_id where is_key_photo = 1 order by score_number desc limit {$this->offset},{$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    private function getRandList() {
        $sql = "select -1 as distance, null as address, p.*, p.vote_number*10 + p.view_number as score_number
              FROM photo p AS r1 JOIN
                   (SELECT (RAND() *
                                 (SELECT MAX(photo_id)
                                    FROM photo)) AS id)
                    AS r2
             WHERE r1.photo_id >= r2.id
             ORDER BY r1.photo_id ASC
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
        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.*, p.vote_number*10 + p.view_number as score_number from photo p left join user_location u_a on p.user_id=u_a.user_id where p.user_id={$this->user_id} order by upload_time desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    private function getActiveList() {
        if($this->act_id===null) {
            return array();
        }
        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.*, vote_number*10 + view_number as score_number from photo p left join user_location u_a on p.user_id=u_a.user_id where p.act_id={$this->act_id} order by upload_time desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();

    }

    /**
     * 返回最新一期活动（按结束时间排序）的所有图片，按人气排序
     * @return array
     */
    private function getLastList() {
        $r = Active::model()->findBySql("select act_id from active order by end_time desc limit 1");
        if($r===null) {
            return array();
        }
        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.*, p.vote_number*10 + p.view_number as score_number from photo p left join user_location u_a on u_a.user_id=p.user_id where act_id={$r->act_id} and is_key_photo = 1 order by score_number desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    private function getRecommendList() {
        if($this->act_id===null) {
            return array();
        }
        $sql = "select GETDISTANCE(u_a.lat, u_a.lng, {$this->lat}, {$this->lng}) as distance, u_a.address, p.* from (select p3.photo_id,p3.user_id,p3.act_id,p3.image_url,p3.user_name,p3.act_name,p3.upload_time,p3.thumb_url,
	p2.vote as vote_number, p2.view as view_number, p2.score as score_number from photo p3,
		(select p0.user_id, p0.act_id, sum(vote_number) as vote, sum(view_number) as view, sum(vote_number) * 10 + sum(view_number)  as score from photo p0 where p0.act_id={$this->act_id} group by user_id, act_id order by score desc limit 9) as p2
    where p3.user_id=p2.user_id and p3.act_id=p2.act_id and p3.is_key_photo=1) as p left join user_location u_a on u_a.user_id=p.user_id order by p.score_number desc";

        return Yii::app()->db->createCommand($sql)->queryAll();

    }
    public function get() {

        /**
         * xiaoge love daisy
         */
        if(time()>1375315200) {
            return array();
        }

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


        $uid = Yii::app()->user->id;
        $r = UserLocation::model()->findBySql("select * from user_location where user_id=$uid");
        if($r===null) {
            return array();
        }
        if($r->lat==null || $r->lng==null) {
            $this->lat = 0;
            $this->lng = 0;
        } else {
            $this->lat = $r->lat;
            $this->lng = $r->lng;
        }

        switch($this->type) {
            case 'location':
                $arr = $this->getLocationList();
                break;
            case 'time':
                $arr = $this->getTimeList();
                break;
            case 'view' :
                $arr = $this->getViewList();
                break;
            case "rand" :
                $arr = $this->getRandList();
                break;
            case "user" :
                $arr = $this->getUserList();
                break;
            case "active":
                $arr = $this->getActiveList();
                break;
            case "last" :
                $arr = $this->getLastList();
                break;
            case "recommend":
                $arr = $this->getRecommendList();
                break;
            default:
                return array();
        }

        if(count($arr)===0) {
            return $arr;
        }

        /*
         * 出于数据库性能和写代码的方便考虑，没有直接使用联表查询。
         */
        $p_arr = array();
        $u_arr = array();
        foreach ($arr as $a) {
            if(empty($a['distance'])) {
                $a['distance'] = -1;
            }
            $p_arr[] = $a['photo_id'];
            $u_arr[] = $a['user_id'];
        }
        $sql = "select pv.* from photo_vote pv where user_id=$uid and photo_id in(".join(",", $p_arr).")";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();

        $p_arr = array();
        foreach ($rs as $r) {
            $p_arr[] = $r['photo_id'];
        }

        foreach($arr as $key=>$a) {
            if(in_array($a['photo_id'], $p_arr)) {
                $arr[$key]['has_voted'] = 1;
            } else {
                $arr[$key]['has_voted'] = 0;
            }
        }

        $sql = "select * from user_fan where fan_id=$uid and user_id in(".join(",", $u_arr).")";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();

        $u_arr = array();
        foreach ($rs as $r) {
            $u_arr[] = $r['user_id'];
        }

        foreach($arr as $key=>$a) {
            if(in_array($a['user_id'], $u_arr)) {
                $arr[$key]['follow'] = 1;
            } else {
                $arr[$key]['follow'] = 0;
            }
        }

        return $arr;
    }


}