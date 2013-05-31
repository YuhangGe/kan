<?php
/**
 * User: xiaoge
 * At: 13-5-31 3:37
 * Email: abraham1@163.com
 */


class ALoginForm extends CFormModel{
    public $username;
    public $password;

    public $_identity;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),

            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'username'=>'管理员账号',
            'password' => '管理员密码',
            'submit' => '登陆'
        );
    }


    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new AdminIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
                $this->addError('password','用户名或密码错误.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {

        if($this->_identity===null)
        {
            $this->_identity = new AdminIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode === AdminIdentity::ERROR_NONE)
        {
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, 0);
            return true;
        }
        else
            return false;
    }
}