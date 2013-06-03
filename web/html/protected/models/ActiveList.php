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
            array('act_type', 'in', 'range'=>array(0,1,2)),
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


      //  $criteria=new CDbCriteria;
        //$criteria->select= "t.act_id, t.act_name, t.begin_time, t.end_time, t.image";
        //$criteria->join = "LEFT JOIN `user_active` `user` ON (t.act_id=`user`.act_id)";
        //$criteria->condition  = "t.act_type=:type LIMIT :offset, :length";
        //$criteria->params = array(":type"=>$this->act_type, ":offset"=>$this->offset, ":length"=>$this->length);
        $uid = Yii::app()->user->id;
        $off = $this->offset;
        $len = $this->length;
        $tp = $this->act_type;
//        return Active::model()
//            ->with(array('user_active'=>array('select'=>'user_id', 'condition'=>'user_id=:uId', 'params'=>array(':uId'=>$uid))))
//            ->findAll(array(
//                'condition'=>'act_type=:type',
//                'params'=>array(':type'=>$this->act_type),
//                'offset' => $this->offset,
//                'limit' => $this->length
//            ));

        return Yii::app()->db->createCommand("SELECT t.act_name, t.begin_time, t.end_time, t.image, u.user_id FROM active t LEFT OUTER JOIN user_active u ON (u.act_id = t.act_id AND u.user_id=$uid) WHERE t.act_type=$tp LIMIT $off, $len")
            ->queryAll();
        //return Active::model()->with("user_id")->findAllByAttributes(array("act_type"=>$this->act_type));
    }
}