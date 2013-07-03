<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
    private $_name;


    public function getId() {
        return $this->_id;
    }

    public function getName(){
        return $this->_name;
    }
    /**
     * @return bool
     */
    public function authenticate()
	{
        if(preg_match("/^\\d+$/", $this->username)){
            $type = "phone";
        } else if(strpos($this->username, "@")!==false) {
            $type = "email";
        } else {
            $type = "nick_name";
        }

        $record = User::model()->findColumnByAttributes(array("user_id", "nick_name","small_avatar", "level","password"), array($type=>$this->username));


//        echo (CJSON::encode($record));
        //echo PwdHelper::encode($this->password) === $record->password;

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password !== PwdHelper::encode($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
//            echo $this->_id;
            $this->_id=$record->user_id;
            $this->_name = $record->nick_name;
            $user = Yii::app()->user;
            $user->avatar = $record->small_avatar;
            $user->level = $record->level;
            $this->errorCode=self::ERROR_NONE;
        }
        //return false;
        return !$this->errorCode;
	}
}