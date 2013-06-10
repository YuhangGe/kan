<?php
/**
 * User: xiaoge
 * At: 13-6-9 10:26
 * Email: abraham1@163.com
 */


class SearchPhotoForm extends CFormModel {
    public $email;
    public $phone;
    public $nick_name;
    public $act_name;
    public $offset;
    public $length;

    public $distance;
    public $lat;
    public $lng;
    public $address;

    public function rules() {
       return array(
           array('distance, phone', 'numerical', 'integerOnly'=>true),
           array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
           array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),
           array('email', 'length', 'min'=>5, 'max'=>20),
           array('address', 'length', 'min'=>2, 'max'=>20),
           array('lat, lng','numerical')
       );
    }

    private function searchEmail() {
        $uid = Yii::app()->user->id;

        $sql = "select photo.* from photo, user where user.email=:em and user.user_id<>$uid and user.user_id=photo.user_id limit {$this->offset},{$this->length}";
        return Yii::app()->createCommand($sql)->queryAll(true, array(":em"=>$this->email));
    }
    private function searchPhone() {
        $sql = "select photo.* from photo, user where user.phone=:phone and user.user_id<>$uid and user.user_id=photo.user_id limit {$this->offset},{$this->length}";
        return Yii::app()->createCommand($sql)->queryAll(true, array(":em"=>$this->phone));
    }
    public function search() {
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>200) {
            //一次最多取50条
            $this->length = 50;
        } else {
            $this->length = intval($this->length);
        }

        if($this->email!==null) {
            return $this->searchEmail();
        }
        if($this->phone!==null) {
            return $this->searchPhone();
        }
        $cdt = array();
        $par = array();


        if($this->nick_name!==null) {
            $cdt[] = "nick_name LIKE :nick_name";
            $par[":nick_name"] = '%'.strtr($this->nick_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }
        if($this->act_name!==null) {
            $cdt[] = "company LIKE :cpy";
            $par[":cpy"] = '%'.strtr($this->company,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        $uid = Yii::app()->user->id;

        $join = "";
        $s_dis = false;
        $s_add = false;
        if($this->distance!==null && $this->lat!==null && $this->lng!==null) {
            $dlng =  2 * asin(sin($this->distance / (2 * 6371)) / cos(deg2rad($this->lat)));
            $dlng = rad2deg($dlng);

            $dlat = $this->distance/6371;
            $dlat = rad2deg($dlat);

            $lat_left = $this->lat - $dlat;
            $lat_right = $this->lat + $dlat;
            $lng_left = $this->lng - $dlng;
            $lng_right = $this->lng + $dlng;

            $s_dis = true;
            $join = " (select user_id, address, GETDISTANCE(lat, lng, {$this->lat},{$this->lng}) as distance from user_location where user_id<>$uid and lat between $lat_left and $lat_right and lng between $lng_left and $lng_right order by distance limit 1000) ua where ua.user_id=photo.user_id";

        } else if($this->address!==null) {
            $s_add = true;
            $join = " (select user_id, address from user_location where user_id<>$uid and address like :add limit 1000) ua where ua.user_id = photo.user_id ";
            $par[':add'] = '%'.strtr($this->address,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if(count($cdt)===0 && $join=="") {
            return null;
        }
        $cdt_str = join("  AND  ", $cdt);

        $sql = "select photo.* ".($s_dis?", ua.distance, ua.address ":"").($s_add?", ua.address ":"")." from photo ".(($s_dis||$s_add)? (", $join ".($cdt_str==""?"":" and $cdt_str ")) : " where $cdt_str").($s_dis?" order by ua.distance ":"")." limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $par);
    }

}