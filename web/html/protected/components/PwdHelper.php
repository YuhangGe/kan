<?php
/**
 * User: xiaoge
 * At: 13-5-27 9:45
 * Email: abraham1@163.com
 */


class PwdHelper {
    public static function encode($pwd) {
        $slen = strlen($pwd);
        if($slen<6) {
            //密码不应该小于6位
            return "";
        }
        $i1 = $pwd[0];
        $i2 = $pwd[$slen-1];
        if(!preg_match("/[0-9a-zA-Z\\.\\/]/", $i1)) {
            //ge
            $i1 = "g";
        }
        if(!preg_match("/[0-9a-zA-Z\\.\\/]/", $i2)) {
            //wang
            $i2 = "w";
        }
        //使用crypt和md5双重加密，我勒个去。
        $p1 = crypt($pwd, $i1.$i2);
        return md5(substr($p1, 2));
    }
}