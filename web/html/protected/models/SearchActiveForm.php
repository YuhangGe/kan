<?php
/**
 * User: xiaoge
 * At: 13-6-13 1:44
 * Email: abraham1@163.com
 */


class SearchActiveForm extends CFormModel{
    public $act_id;
    public $act_name;
    public $offset;
    public $length;

    public $select;

    const ADMIN_SELECT = "act_id, act_name ";
    const ALL_SELECT = " * ";

    public function rules(){
        return array(
            array('act_id', 'numerical', 'integerOnly'=>true),
            array('act_name', 'length', 'min'=>1),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }
    private function searchActId() {
       $r =  Active::model()->find(array("select"=>$this->select, "condition"=>"act_id=:aId", "params"=>array(":aId"=>$this->act_id)));
        if($r===null) {
            return array();
        } else {
            return array($r);
        }
    }

    public function search($select = self::ALL_SELECT) {
        if($select == self::ADMIN_SELECT || $select == self::ALL_SELECT) {
            $this->select = $select;
        } else {
            return null;
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
        if($this->act_id!==null) {
            return $this->searchActId();
        }
        $cdt = array();
        $par = array();

        if($this->act_name!==null) {
            $cdt[] = "act_name LIKE :act_name";
            $par[":act_name"] = '%'.strtr($this->act_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if(count($cdt)===0) {
            return array();
        }

        $cdt_str = join("  AND  ", $cdt);


        $sql = "select {$this->select} from active where $cdt_str limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $par);
    }
}