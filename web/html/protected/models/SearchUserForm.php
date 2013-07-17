<?php
/**
 * User: xiaoge
 * At: 13-6-8 7:02
 * Email: abraham1@163.com
 */



class SearchUserForm extends CFormModel{
    public $user_id;
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
    public $address;

    public $distance;
    public $lat;
    public $lng;

    public $select;

    const ADMIN_SELECT = "user.user_id, nick_name";
    const USER_COLUMN = "user.user_id,level,email,phone,nick_name,sex,constellation,birthday,personalsay,company,hobby,big_avatar,small_avatar,fan_number,friend_number";

   // const USER_COLUMN = "user.user_id,level,email,phone,nick_name,sex,constellation,birthday,personalsay,company,hobby,big_avatar,small_avatar,fan_number,friend_number";

    public function rules() {
        return array(
            array('user_id, sex, constellation, fan_number, friend_number, phone, age_from, age_to, distance','numerical', 'integerOnly'=>true),
            array('sex', 'in', 'range'=>array(0,1)),
            array('constellation', 'numerical', 'min'=>1, 'max'=>12),
            array('age_from, age_to', 'numerical', 'min'=>0, 'max'=>100),
            array('nick_name, company, hobby', 'length', 'min'=>1),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1),
            array('email', 'length', 'min'=>5, 'max'=>20),
            array('address', 'length', 'min'=>2, 'max'=>20),
            array('lat, lng','numerical')
        );
    }
    private function searchEmail() {
        $uid = Yii::app()->user->id;

        $r = User::model()->findAll(array(
            'select'=> $this->select,
            'condition'=>"user_id<>$uid and email=:e",
            'params'=>array(':e'=>$this->email)
        ));
        return array($r);
    }
    private function searchPhone() {
        $uid = Yii::app()->user->id;

        $r = User::model()->findAll(array(
            'select'=> $this->select,
            'condition'=>"user_id<>$uid and phone=:p",
            'params'=>array(':p'=>$this->phone)
        ));
        return array($r);
    }
    private function searchId() {
        $r = User::model()->findBySql("select ".self::ADMIN_SELECT." from user where user_id = :uId", array(":uId"=>$this->user_id));
        return array($r);
    }
    public function search($select = self::USER_COLUMN) {
        $this->select = $select;

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

        if($this->user_id!==null) {
            return $this->searchId();
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

        if($this->age_from!==null && $this->age_to!==null && $this->age_from<=$this->age_to) {
            $year = (int)date("Y");
            $md = date("-m-d");

//            if($this->age_from===$this->age_to) {
                $b_young = strtotime(($year-$this->age_from).$md);
                $b_old = strtotime(($year-$this->age_to-1).$md);
//            } else {
//                $b_young = strtotime(($year-$this->age_from).$md);
//                $b_old = strtotime(($year-$this->age_to - 1).$md);
//            }


            $cdt[] = "birthday between :b_old and :b_young";

//            echo $b_old.",".$b_young;

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
            $join = " (select user_id, address, GETDISTANCE(lat, lng, {$this->lat},{$this->lng}) as distance from user_location where user_id<>$uid and lat between $lat_left and $lat_right and lng between $lng_left and $lng_right order by distance limit 1000) ua where ua.user_id=user.user_id";
        } else if($this->address!==null) {
            $s_add = true;
            $join = " (select user_id, address from user_location where user_id<>$uid and address like :add limit 1000) ua where ua.user_id = user.user_id ";
            $par[':add'] = '%'.strtr($this->address,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if(count($cdt)===0 && $join=="") {
            return null;
        }

        $cdt_str = join("  AND  ", $cdt);

        $sql = "select {$this->select} ".($s_dis?", ua.distance, ua.address ":"").($s_add?", ua.address ":"")." from user ".(($s_dis||$s_add)? (", $join".($cdt_str==""?"":" and $cdt_str and user.user_id<>$uid ")) : " where $cdt_str and user.user_id<>$uid").($s_dis?" order by ua.distance ":"")." limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $par);

    }

}