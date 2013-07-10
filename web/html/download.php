<?php
/**
 * User: xiaoge
 * At: 13-7-10 10:48
 * Email: abraham1@163.com
 */

function download_file($file) {
    $filename = basename($file);
    header('Content-Description: File Transfer');
    header("Content-type: application/octet-stream");

    $ua = $_SERVER["HTTP_USER_AGENT"];

    $encoded_filename = urlencode($filename);
    $encoded_filename = str_replace("+", "%20", $encoded_filename);

    header('Content-Type: application/octet-stream');

    if (preg_match("/MSIE/", $ua)) {
        header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    } else if (preg_match("/Firefox/", $ua)) {
        header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
    } else {
        header('Content-Disposition: attachment; filename="' . $filename . '"');
    }
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length:'. filesize($file));

    ob_clean();
    flush();
    readfile($file);

}

if(!empty($_GET['type'])) {
    $path = dirname(__FILE__);

    switch($_GET['type']) {
        case 'apk' :
            download_file($path."/download/kankan.apk");
            break;
        case 'ios' :
            break;
        case 'windows' :
            break;
        default:
            break;
    }
} else { ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>下载看看客户端</title>
</head>
<body>
<h2>下载看看客户端</h2>
<div>
    <h3>安卓客户端</h3>
    <div>
        <a href="download.php?type=apk">本地下载</a><br/><br/>
    </div>
</div>
<div>
    <h3>苹果客户端</h3>
    <div>敬请期待...</div>
</div>
<div>
    <h3>windows phone客户端</h3>
    <div>敬请期待...</div>
</div>
</body>
</html>

<?php }