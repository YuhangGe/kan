<?php
/**
 * User: xiaoge
 * At: 13-7-3 9:49
 * Email: abraham1@163.com
 */


class NewsForm extends CFormModel{
    public $user_id;
    public $offset;
    public $length;

    public function rules(){
        return array(
            array('user_id', 'numerical', 'integerOnly'=>true),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }

    private function _off_len() {
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
    }

    /*
     * 得到所有新闻列表。包括已读和未读。
     * 当前版本已读未读是个保留概念，不提供相应实现。只有一个接口。
     */
    public function all_list() {
        $this->_off_len();

        $sql = "select * from news limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();

    }
}