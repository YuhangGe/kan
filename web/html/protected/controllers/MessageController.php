<?php
/**
 * User: xiaoge
 * At: 13-7-3 9:25
 * Email: abraham1@163.com
 */


class MessageController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    /**
     * 得到最外层的消息列表。第一条是最新新闻（如果有的话）
     * 第二条是最新系统消息（如果有的话）
     * 接下来的条数是留言。
     */
    public function actionOverviewList() {
        $m = new MessageForm();
        $m->attributes = $_POST;
        $this->sendAjax($m->getOverviewList(), true);
    }
    /*
     * 得到详细消息列表。如果from_user_id==-1是新闻，
     * -2是系统通知，>=0是和某个用户的聊天对话。
     */
    public function actionDetailList() {
        $m = new MessageForm();
        $m->attributes = $_POST;
        $this->sendAjax($m->getDetailList(), true);
    }
}