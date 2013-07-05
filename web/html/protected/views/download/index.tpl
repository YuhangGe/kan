{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>kan kan</title>
</head>
<body>
    <h3>下载看看客户端</h3>
    <div>
        <a href="{$url_prefix}download/kankan.apk">安卓客户端</a><br/>
    </div>
</body>
</html>