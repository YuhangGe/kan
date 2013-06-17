<?php
/**
 * User: xiaoge
 * At: 13-6-17 4:04
 * Email: abraham1@163.com
 */


class SearchVideoForm extends CFormModel{
    public $video_id;
    public $video_name;
    public $offset;
    public $length;

    public $select;

    const ADMIN_SELECT = "video_id, video_name ";
    const ALL_SELECT = " * ";

    public function rules(){
        return array(
            array('video_id', 'numerical', 'integerOnly'=>true),
            array('video_name', 'length', 'min'=>1),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }
    private function searchActId() {
        $r =  Video::model()->find(array("select"=>$this->select, "condition"=>"video_id=:aId", "params"=>array(":aId"=>$this->video_id)));
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
        if($this->video_id!==null) {
            return $this->searchActId();
        }
        $cdt = array();
        $par = array();

        if($this->video_name!==null) {
            $cdt[] = "video_name LIKE :video_name";
            $par[":video_name"] = '%'.strtr($this->video_name,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
        }

        if(count($cdt)===0) {
            return array();
        }

        $cdt_str = join("  AND  ", $cdt);


        $sql = "select {$this->select} from video where $cdt_str limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll(true, $par);
    }
}