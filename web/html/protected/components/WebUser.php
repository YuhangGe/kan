<?php
/**
 * User: xiaoge
 * At: 13-5-31 3:23
 * Email: abraham1@163.com
 */


class WebUser extends CWebUser{

    public function isAdmin() {
        return $this->getState("isAdmin", false);
    }
    /*
    public function login($identity,$duration=0) {
        parent::login($identity, $duration);
        $this->isAdmin = $identity->isAdmin();
    }

    public function logout($destroySession=true) {
        parent::logout($destroySession);
        $this->isAdmin = false;
    }
    */
}