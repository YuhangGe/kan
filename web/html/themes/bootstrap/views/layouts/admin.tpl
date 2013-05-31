<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>KanKan Admin</title>

	{$Yii->bootstrap->register()}

    <link rel="stylesheet" type="text/css" href="/css/admin_styles.css" />

</head>

<body>


{assign "cur_url" "`$this->uniqueid`/`$this->action->Id`"}

{$this->widget('bootstrap.widgets.TbNavbar',
[
    'type'=>'inverse',
    'brand'=>'看看后台管理',
    'brandUrl'=>'#',
    'items'=>
    [
        [
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>
            [
                ['label'=>'活动', 'url'=>['/admin/default/index'], 'active'=>{$cur_url=='admin/default/index'} ],
                ['label'=>'用户', 'url'=>['/admin/user'], 'active'=>{$cur_url=='admin/user/index'}],
                ['label'=>'照片', 'url'=>['/admin/image'], 'active'=>{$cur_url=='admin/image/index'}],
                ['label'=>'视频', 'url'=>['/admin/vedio'], 'active'=>{$cur_url=='admin/vedio/index'}],
                ['label'=>'登陆', 'url'=>['/admin/default/login'], 'visible'=>{!$Yii->user->isAdmin()}, 'active'=>{$cur_url=='admin/default/login'}],
                ['label'=>"登出", 'url'=>['/admin/default/logout'],'visible'=>{$Yii->user->isAdmin()}]
            ]
        ]
    ]
],
true)}
<div class="container" id="page">


    <div id="content">
        {$content}

    </div>

	<div class="clear"></div>

</div><!-- page -->

<div id="footer">
    版权所有 &copy;{$smarty.now|date_format:'%Y'} 南京快播动漫
</div><!-- footer -->

</body>
</html>
