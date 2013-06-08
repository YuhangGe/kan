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

    public function rules(){
        return array(
            array('type', 'required'),
            array('type', 'in', 'range'=>array("location", "time", "view", "rand")),
            array("time", 'numerical', 'integerOnly'=>true, 'min'=>0),
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

            $cdt = "user_level=1 AND user_id<>$uid AND (lat>$lat_top AND lat<$lat_bottom) AND (lng>$lng_left AND lng<$lng_right)";
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


        $sql = "select p.*, ua2.distance
            from photo as p,
            (select p1.user_id,p1.photo_id,p1.act_id,u_a.distance
              from photo as p1 left join
                (select user_id, GETDISTANCE(lat, lng, {$this->lat}, {$this->lng}) as distance
                    from user_location
                      where $cdt
                      order by distance
                      limit {$this->offset}, {$this->length}
                ) as u_a on u_a.user_id = p1.user_id where p1.user_id<>$uid order by photo_id desc
            ) as ua2
            where ua2.photo_id=p.photo_id
            group by ua2.user_id order by ua2.distance";


        /*
         * 取出附近用户最新上传的一张照片
         * 其中的GETDISTANCE是mysql的函数，参考数据库.txt文档
         */
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;

    }

    private function getTimeList() {
        $sql = "select *
                from (select * from photo order by photo_id desc) p2
                group by user_id
                having upload_time<={$this->time}
                order by upload_time limit {$this->offset},{$this->length}";

        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
    private function getViewList() {
        $sql = "select * from photo order by HOT(vote_number, view_number) desc limit {$this->offset},{$this->length}";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    private function getRandList() {
        $sql = "SELECT *
              FROM photo AS r1 JOIN
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
    public function get() {
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>200) {
            //一次最多取50条
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
            default:
                return array();
        }
    }


}