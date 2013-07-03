<?php
/**
 * User: xiaoge
 * At: 13-7-3 9:27
 * Email: abraham1@163.com
 */


class MessageForm extends CFormModel{
    public $from_user_id;
    public $to_user_id;

    public $offset;
    public $length;

    public function rules(){
        return array(
            array('from_user_id, to_user_id', 'numerical', 'integerOnly'=>true),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }

    private function getNewsList() {
        $m = new NewsForm();
        $m->user_id = $this->to_user_id;
        $m->offset = $this->offset;
        $m->length = $this->length;
        return $m->all_list();
    }
    private function getNotifyList() {
        $m = new NotifyForm();
        $m->user_id = $this->to_user_id;
        $m->offset = $this->offset;
        $m->length = $this->length;
        return $m->all_list();
    }
    private function getChatList() {
        $m = new ChatForm();
        $m->from_user_id = $this->from_user_id;
        $m->to_user_id = $this->to_user_id;
        $m->offset = $this->offset;
        $m->length = $this->length;
        return $m->dialog();
    }

    public function getOverviewList() {
        $this->_off_len();
        $this->to_user_id = Yii::app()->user->id;

        $cm = new ChatForm();
        $cm->to_user_id = $this->to_user_id;
        $cm->offset = $this->offset;
        $cm->length = $this->length;

        if($this->offset===0) {
            $news_count = News::model()->count();
            $notify_count = Notify::model()->count("to_user_id=:uId and is_read=0", array(':uId'=>$this->to_user_id));

            $data = array(
                'total_chat'=> $cm->unread_count(),
                'total_news'=>$news_count,
                'total_notify'=>$notify_count,
                'list'=>array()
            );


            $r = News::model()->findBySql("select * from news order by news_id desc limit 1");
            if($r !== null) {
                $data['list'][] = $r;
            } else {
                $data['list'][] = null;
            }

            $r = Notify::model()->findBySql("select * from notify where to_user_id=:uId and is_read=0 order by notify_id desc limit 1",array(':uId'=>$this->to_user_id));
            if($r !== null) {
                $data['list'][] = $r;
            } else {
                $data['list'][] = null;
            }

        } else {
            $data = array(
                'total_chat'=> 0,
                'total_news'=>0,
                'total_notify'=>0,
                'list' => array()
            );
        }



        $rs = $cm->unread_list();
        foreach ($rs as $r) {
            $data['list'][] = $r;
        }


        return $data;
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


    public function getDetailList() {
        if($this->from_user_id === null) {
            return array();
        }
        $this->_off_len();
        $this->to_user_id = Yii::app()->user->id;

        switch($this->from_user_id) {
            case -1:
                return $this->getNewsList();
                break;
            case -2:
                return $this->getNotifyList();
                break;
            default:
                return $this->getChatList();
                break;
        }
    }
}