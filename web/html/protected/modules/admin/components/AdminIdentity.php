<?php
/**
 * User: xiaoge
 * At: 13-5-31 3:25
 * Email: abraham1@163.com
 */


class AdminIdentity extends CUserIdentity{
    private $_id;
    private $_name;

    public function getId() {
        return $this->_id;
    }

    public function getName(){
        return $this->_name;
    }

    public function isAdmin() {
        return $this->getState("isAdmin", false);
    }

    public function authenticate()
    {
//        echo CJSON::encode(Yii::app()->params);
//die();
        if($this->username === Yii::app()->params['adminName'] && PwdHelper::encode($this->password) === Yii::app()->params['adminPassword']) {
            $this->_id = 1;
            $this->_name = "Admin";
            $this->setState("isAdmin", true);
            $this->errorCode = self::ERROR_NONE;
        } else {
            $this->errorCode =  self::ERROR_UNKNOWN_IDENTITY;
        }
        return !$this->errorCode;
    }
}