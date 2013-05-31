<?php
/**
 * User: xiaoge
 * At: 13-5-25 11:05
 * Email: abraham1@163.com
 */


class RegisterForm extends CFormModel {
    public $username;
    public $password;
    public $nick_name;
    public $type;


    public function rules() {
        return array(
            array('username, nick_name, password', 'required'),
            array('password', 'length', "min"=>6),
            array('username', 'checktype')
        );
    }

    public function checktype($attribute,$params) {
        if(preg_match("/^\\d+$/", $this->username)){
            $this->type = "phone";
        } else if(strpos($this->username, "@")!==false) {
            $this->type = "email";
        }
      //  echo $this->type;
    }

    private  function assign_server($user_id) {
        $s_list = Yii::app()->params['KanKanImageServer'];
        $s_len = count($s_list);
        return $s_list[$user_id % $s_len];
    }

    public function save() {
        $user = new User();
        if($this->type=="phone") {
            $user->phone = $this->username;
        } else if($this->type=="email"){
            $user->email = $this->username;
        } else {
//            echo '01';
            return false;
        }

//        $criteria=new CDbCriteria;
//        $criteria->select='user_id';
//        $criteria->condition= $this->type.'=:userName or nick_name=:nickName';
//        $criteria->params=array(':userName'=>$this->username, ':nickName'=>$this->nick_name);
//        $record = User::model()->find($criteria);

        $record = User::model()->findIdByAttributes(array($this->type=>$this->username, 'nick_name'=>$this->nick_name), "OR");
        if($record!=null) {
            /*
             * 用户昵称，手机或者邮箱都不可以重复
             */
//            echo '02';
            return false;
        }

        $user->nick_name = $this->nick_name;
        $user->password = PwdHelper::encode($this->password);

        $transaction = Yii::app()->db->beginTransaction(); //创建事务
        try {
            $user->save(false);
            $user->image_server = $this->assign_server($user->user_id);
            $user->update(array("image_server"));
            $ufn = new UserFanNumber();
            $ufn -> user_id = $user->user_id;
            $ufn -> save();
            $ufn = new UserFriendNumber();
            $ufn -> user_id = $user->user_id;
            $ufn -> save();
            $transaction->commit(); //提交事务会真正的执行数据库操作
            $rtn = true;
        } catch (Exception $e) {
            $transaction->rollback(); //如果操作失败, 数据回滚
            echo $e->getMessage();
            $rtn = false;
        }

        return $rtn;
    }
}