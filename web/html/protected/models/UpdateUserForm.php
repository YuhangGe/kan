<?php
/**
 * User: xiaoge
 * At: 13-5-27 9:37
 * Email: abraham1@163.com
 */


class UpdateUserForm extends CFormModel {
    public $email;
    public $phone;
    public $nick_name;
    public $real_name;
    public $sex;
    public $birthday;
    public $constellation;
    public $personalsay;
    public $company;
    public $hobby;
    public $big_avatar;
    public $small_avatar;
    public $thumb_avatar;
    public $pre_password;
    public $password;

    public function rules() {
        return array(
            array('email', 'length', 'max'=>30),
            array('sex, constellation, phone, birthday', 'numerical', 'integerOnly'=>true),
            array('nick_name', 'length', 'max'=>25),
            array('real_name', 'length', 'max'=>10),
            array('personalsay', 'length', 'max'=>50),
            array('company', 'length', 'max'=>35),
            array('hobby', 'length', 'max'=>45),
            array('big_avatar, small_avatar, thumb_avatar', 'length', 'max'=>150),
            array('pre_password, password', 'length', 'min'=>6)
        );
    }

    public function update() {
//        echo CJSON::encode($this);

        if(empty($this->nick_name)) {
            return false;
        }
        if(empty($this->email) && empty($this->phone)) {
            return false;
        }
        $p = array('nick_name'=>$this->nick_name);
        if(!empty($this->email)) {
            $p['email'] = $this->email;
        }
        if(!empty($this->phone)) {
            $p['phone'] = $this->phone;
        }
        $r = User::model()->findColumnByAttributes(array("user_id", "nick_name"), $p, "OR");
//        print_r(CJSON::encode($r));

        $user_id = Yii::app()->user->id;
        if($r === null) {
            /*
             * 说明nick_name和email和phone全部发生了修改
             */
            $n_change = true;
        } else if($r->user_id !== $user_id) {
            /*
             * 和其它用户的数据发生重复
             */
            return false;
        } else if($r->nick_name != $this->nick_name) {
            $n_change = true;
        }


        if($this->real_name !== null) {
            $p['real_name'] = $this->real_name;
        }
        if($this->sex !== null) {
            $p['sex'] = $this->sex;
        }
        if($this->birthday !== null) {
            $p['birthday'] = $this->birthday;
        }
        if($this->constellation !== null) {
            $p['$constellation'] = $this->constellation;
        }
        if($this->personalsay !== null) {
            $p['personalsay'] = $this->personalsay;
        }
        if($this->hobby !== null) {
            $p['hobby'] = $this->hobby;
        }
        if($this->company !== null) {
            $p['company'] = $this->company;
        }
        return User::model()->updateByPk($user_id, $p);



    }
    public function updateAvatar() {
        if($this->big_avatar===null||$this->small_avatar===null) {
            return false;
        }
         if(!$this->validate()) {
            return false;
        }
        $uid = Yii::app()->user->id;
        return User::model()->updateByPk($uid, array("big_avatar"=>$this->big_avatar, "small_avatar"=>$this->small_avatar));
    }
    public function updatePassword() {
        if(empty($this->pre_password) || empty($this->password)) {
            return false;
        }
        if(!$this->validate()) {
            return false;
        }
        $pre = PwdHelper::encode($this->pre_password);
        $cur = PwdHelper::encode($this->password);

        return User::model()->updateByPk(Yii::app()->user->id, array("password"=>$cur), "password=:pwd", array(":pwd"=>$pre));
    }
    public function updateQuick() {
        if(empty($this->nick_name) && empty($this->sex) && empty($this->birthday)) {
            return true;
        }
        $p = array();
        if(!empty($this->nick_name)) {
            $p['nick_name'] = $this->nick_name;
        }
        if(!empty($this->sex)) {
            $p['sex'] = $this->sex;
        }
        if(!empty($this->birthday)) {
            $p['birthday'] = $this->birthday;
        }
        return User::model()->updateByPk(Yii::app()->user->id, $p);
    }
}