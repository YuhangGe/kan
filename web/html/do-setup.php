<?php
/**
 * User: xiaoge
 * At: 13-6-25 3:21
 * Email: abraham1@163.com
 */
function pwd($pwd) {
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

function sendAjax($data, $success=true) {
    $rtn = array();
    if($data===null) {
        $rtn['success'] = false;
    } else {
        $rtn['success'] = $success;
        $rtn['data'] = $data;
    }
    echo json_encode($rtn);
    die();
}

$keys = array('username','password','db_address', 'db_name', 'db_username', 'db_password');

foreach($keys as $key) {
    if(!isset($_POST[$key]) || empty($_POST[$key])) {
        sendAjax("need params", false);
    }
}
/*
 * 用户名密码是kankan和123456
 */
if($_POST['username']!=='kankan' && pwd($_POST['password'])!=='880f15fa6a37bde5dfcf8a17ee193e7b') {
    sendAjax("need password", false);
}

require("setup_db.php");

try {
    $db = new PDO("mysql:host={$_POST['db_address']};dbname={$_POST['db_name']};charset=utf8", $_POST['db_username'], $_POST['db_password']);
    foreach ($sql_arr as $sql) {
        $db->exec($sql);
    }
} catch (PDOException $e) {
    sendAjax($e->getMessage(), false);
}


/*
 * 接下来设置配置文件
 */

$path = explode("/", $_SERVER['PATH_INFO']);
$c = count($path);

if($c<2) {
    /*
     * 出现未知错误
     */
    sendAjax("system error", false);
}

$path = array_slice($path, 0, $c-1);
$my_path =  join("/", $path)."/";


$url_prefix = $my_path;
$link_prefix = $my_path."index.php/";

$conf = file_get_contents(dirname(__FILE__)."/protected/config/main_tpl.conf");

$params = array(
    'DB_CONNECT_STRING' => "mysql:host={$_POST['db_address']};dbname={$_POST['db_name']};charset=utf8",
    'DB_USERNAME' => $_POST['db_username'],
    'DB_PASSWORD' => $_POST['db_password'],
    'URL_PREFIX' => $url_prefix,
    'LINK_PREFIX' => $link_prefix,
    'STATIC_SERVER' => "http://".$_SERVER['HTTP_HOST'].$my_path."upload"
);

foreach ($params as $k=>$p) {
    $conf =  str_replace($k,$p,$conf);
}

file_put_contents(dirname(__FILE__)."/protected/config/main.php", $conf);

sendAjax(array(
    'login_url' => "http://".$_SERVER['HTTP_HOST'].$link_prefix."admin/login"
), true);





