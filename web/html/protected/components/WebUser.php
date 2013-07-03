<?php
/**
 * User: xiaoge
 * At: 13-5-31 3:23
 * Email: abraham1@163.com
 */


class WebUser extends CWebUser{
    public $avatar;
    public $level;

    public function isAdmin() {
        return $this->getState("isAdmin", false);
    }

}