<?php
/**
 * User: xiaoge
 * At: 13-6-8 7:02
 * Email: abraham1@163.com
 */



class SearchUserForm extends CFormModel{
    public $nick_name;
    public $sex;
    public $constellation;
    public $company;
    public $hobby;
    public $fan_number;
    public $friend_number;
    public $email;
    public $phone;
    public $age_from;
    public $age_to;
    public $offset;
    public $length;

    public $distance;
    public $lat;
    public $lng;

    const USER_COLUMN = "user.user_id,level,email,phone,nick_name,sex,constellation,birthday,personalsay,company,hobby,big_avatar,small_avatar,fan_number,friend_number";

   // const USER_COLUMN = "user.user_id,level,email,phone,nick_name,sex,constellation,birthday,personalsay,company,hobby,big_avatar,small_avatar,fan_number,friend_number";

    public function rules() {
        return array(
            array('sex, constellation, fan_number, friend_number, phone, age_from, age_to, distance','numerical', 'integerOnly'=>true),
            array('sex', 'in', 'range'=>array(0,1)),
            array('constellation', 'numerical', 'min'=>1, 'max'=>12),
            array('age_from, age_to', 'numerical', 'min'=>0, 'max'=>100),
            array('nick_name, company, hobby', 'length', 'min'=>3),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),
            array('email', 'length', 'max'=>100),
            array('lat, lng','numerical')
        );
    }
    private function searchEmail() {
        $r = User::model()->find(array(
            'select'=> self::USER_COLUMN,
            'condition'=>'email=:e',
            'params'=>array(':e'=>$this->email)
        ));
        return $r;
    }
    private function searchPhone() {
        $r = User::model()->find(array(
            'select'=> self::USER_COLUMN,
            'condition'=>'phone=:p',
            'params'=>array(':p'=>$this->phone)
        ));
        return $r;
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

        if($this->sex!==null) {
            $cdt[] = "sex=:sex";
            $par[":sex"] = $this->sex;
        }
        if($this->constellation!==null) {
            $cdt[] = "constellation=:co";
            $par[":co"] = $this->constellation;
        }
        if($this->age_from!==null && $this->age_to!==null && $this->age_from<$this->age_to) {
            $year = (int)date("Y");
            $md = date("-m-d");

            $b_young = strtotime(($year-$this->age_from).$md);
            $b_old = strtotime(($year-$this->age_to).$md);

            $cdt[] = "birthday between :b_old and :b_young";
            $par[":b_old"]=$b_old;
            $par[":b_young"]=$b_young;
        }
        if($this->fan_number!==null) {
            $cdt[] = "fan_number >= :fan_n";
            $par[":fan_n"] = $this->fan_number;
        }
        if($this->friend_number!==null) {
            $cdt[] = "friend_number >= :friend_n";
            $par[":friend_n"] = $this->friend_number;
        }
        if($this->nick_name!==null) {
            $cdt[] = "nick_name LIKE :nick_name";
            $par[":nick_name"] = '%'.strtr($this->nick_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }
        if($this->company!==null) {
            $cdt[] = "company LIKE :cpy";
            $par[":cpy"] = '%'.strtr($this->company,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        $uid = Yii::app()->user->id;

        $join = "";
        if($this->distance!==null && $this->lat!==null && $this->lng!==null) {
            $dlng =  2 * asin(sin($this->distance / (2 * 6371)) / cos(deg2rad($this->lat)));
            $dlng = rad2deg($dlng);

            $dlat = $this->distance/6371;
            $dlat = rad2deg($dlat);

            $lat_left = $this->lat - $dlat;
            $lat_right = $this->lat + $dlat;
            $lng_left = $this->lng - $dlng;
            $lng_right = $this->lng + $dlng;

            $join = " (select user_id, address, GETDISTANCE(lat, lng, {$this->lat},{$this->lng}) as distance from user_location where user_id<>$uid and lat between $lat_left and $lat_right and lng between $lng_left and $lng_right order by distance limit 1000) ua where ua.user_id=user.user_id";
        }

        if(count($cdt)===0 && $join=="") {
            return null;
        }

        $cdt_str = join("  AND  ", $cdt);

        $sql = "select ".self::USER_COLUMN.($join==""?"":", ua.distance, ua.address ")." from user ".($join=="" ? " where $cdt_str" : ", $join and $cdt_str ").($join==""?"":" order by ua.distance ")." limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $par);

    }
}