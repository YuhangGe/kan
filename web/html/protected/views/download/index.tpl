{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

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
            <a href="{$url_prefix}download/kankan.apk">本地下载</a><br/><br/>
            <a href="http://pan.baidu.com/share/link?shareid=2669592924&uk=503944991">百度网盘下载</a>
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