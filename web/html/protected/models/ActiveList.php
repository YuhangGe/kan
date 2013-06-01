<?php
/**
 * User: xiaoge
 * At: 13-6-1 5:01
 * Email: abraham1@163.com
 */


class ActiveList extends CFormModel {
    public $act_type;
    public $offset;
    public $length;

    public function rules() {
        return array(
            array('act_type', 'required'),
            array('act_type', 'numerical', 'integerOnly'=>true),
            array('act_type', 'in'=>array(0,1,2)),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }

    public function get() {
        if(!$this->validate()) {
            return null;
        }
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>50) {
            //一次最多取50条
            $this->length = 50;
        } else {
            $this->length = intval($this->length);
        }

        $criteria=new CDbCriteria;
        $criteria->select= "act_id, begin_time, end_time, image";
        $criteria->condition  = "act_type=:type LIMIT :offset, :length";
        $criteria->params = array(":type"=>$this->act_type, ":offset"=>$this->offset, ":length"=>$this->length);



        return Active::model()->findAll($criteria);

    }
}