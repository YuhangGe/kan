<?php
/**
 * User: xiaoge
 * At: 13-6-1 3:59
 * Email: abraham1@163.com
 */


class LocationForm extends CFormModel{
    public $user_id;
    public $lat;
    public $lng;
    public $time;
    public $address;

    public function rules(){
        return array(
            array('user_id, lat, lng, time','required'),
            array('lat, lng', 'numerical'),
            array('user_id, time', 'numerical', 'integerOnly'=>true),
            array('address', 'length', 'max'=>150)
        );
    }

    public function update() {
        if(!$this->validate()) {
            return false;
        }
        $arr = array('lat'=>$this->lat, 'lng'=>$this->lng, 'time'=>$this->time);
        if($this->address !== null) {
            $arr['address'] = $this->address;
        }
        return UserLocation::model()->updateByPk($this->user_id, $arr);
    }
}