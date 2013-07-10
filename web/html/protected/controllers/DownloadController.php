<?php
/**
 * User: xiaoge
 * At: 13-7-6 12:11
 * Email: abraham1@163.com
 */


class DownloadController extends Controller{
    private function download($file) {
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
    public function actionIndex() {
        $this->render("index");
    }

    public function actionApk() {

    }
}