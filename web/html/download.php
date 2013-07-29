<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>下载看看客户端</title>
    <script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">

        function getInfo() {
            $.post("index.php/setting/get", {
                key : ['apk_download_number', 'apk_version']
            }, function(rtn) {
                if(rtn.success===false) {
                    alert("当前网络出现问题，请刷新重试!");
                    return;
                }
                for(var i=0;i<rtn.data.length;i++) {
                    var _d = rtn.data[i];
                    switch (_d.key) {
                        case 'apk_version':
                            $("#apk_version").text(_d.value);
                            break;
                        case 'apk_download_number':
                            $("#apk_download_number").text(_d.value);
                            break;
                    }
                }
            }, "json");
        }
        $(function() {
            getInfo();
            window.setInterval(getInfo, 10000);
        })
    </script>
</head>
<body>
<h2>下载看看客户端</h2>
<div>
    <h3>安卓客户端</h3>
    <div>
        <a href="index.php/download/apk">本地下载</a>（当前版本：<span id="apk_version">1.0.0</span>，当前下载量：<span id="apk_download_number">0</span>）<br/><br/>
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
