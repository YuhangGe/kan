{assign 'menu_items' [
['label'=>'活动管理', 'child_items' =>
    [
        ['label'=>'所有活动', 'url'=>'/admin/default/index'],
        ['label'=>'添加活动', 'url'=>'/admin/default/add'],
        ['label'=>'活动详情', 'url'=>'/admin/default/detail']
    ]
],
['label'=>'用户管理', 'child_items' =>
    [
        ['label'=>'所有用户', 'url'=>'/admin/user/index'],
        ['label'=>'用户详情', 'url'=>'/admin/user/detail'],
        ['label'=>'星客选拔', 'url'=>'/admin/star/index']
    ]
],
['label'=>'照片管理', 'child_items' =>
    [
        ['label'=>'查看照片', 'url'=>'/admin/photo/index']
    ]
],
['label'=>'视频管理', 'child_items' =>
    [
        ['label'=>'查看照片', 'url'=>'/admin/video/index'],
        ['label'=>'上传视频', 'url'=>'/admin/video/post']
    ]
],
['label'=>'聊天管理', 'child_items' =>
    [
        ['label'=>'查看记录', 'url'=>'/admin/photo/index']
    ]
]

]}
<!doctype html>
<html>
<head>
    <!--
        @developer @白羊座小葛
    -->
    <meta charset="utf-8">
    <title>看看后台管理</title>

    <link id="bs-css" href="/css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="/css/charisma-app.css" rel="stylesheet">
    <link href="/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href='/css/fullcalendar.css' rel='stylesheet'>
    <link href='/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
    <link href='/css/chosen.css' rel='stylesheet'>
    <link href='/css/uniform.default.css' rel='stylesheet'>
    <link href='/css/colorbox.css' rel='stylesheet'>
    <link href='/css/jquery.cleditor.css' rel='stylesheet'>
    {*<link href='/css/jquery.noty.css' rel='stylesheet'>*}
    {*<link href='/css/noty_theme_default.css' rel='stylesheet'>*}
    <link href='/css/elfinder.min.css' rel='stylesheet'>
    <link href='/css/elfinder.theme.css' rel='stylesheet'>
    <link href='/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='/css/opa-icons.css' rel='stylesheet'>
    <link href='/css/uploadify.css' rel='stylesheet'>

    <link href="/css/admin.css" rel="stylesheet">
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="/js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">
        $.browser = {};
        $.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
        $.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
        $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
        $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
        $.log = function(msg) {
            console.log(msg);
        }
    </script>
    <!-- The fav icon -->
    <link rel="shortcut icon" href="/img/favicon.ico">

</head>

<body>
<!-- topbar starts -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/admin/default/index"> <img alt="Logo" src="/img/logo20.png" /> <span>看看后台管理</span></a>



            <!-- user dropdown starts -->
            <div class="btn-group pull-right" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i>
                    <span class="hidden-phone"> admin</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    {*<li><a href="#">Profile</a></li>*}
                    {*<li class="divider"></li>*}
                    <li><a href="/admin/login/logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->


        </div>
    </div>
</div>
<!-- topbar ends -->
<div class="container-fluid">
    <div class="row-fluid">

        <!-- left menu starts -->
        <div class="span2 main-menu-span">
            <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    {foreach $menu_items as $pm}
                        {assign "child_menu_items" $pm['child_items']}
                        <li class="nav-header hidden-tablet">{$pm['label']}</li>
                        {foreach $child_menu_items as $cm}
                        <li style="margin-left: -2px;"><a href="{$cm['url']}" class="ajax-link"><i class="icon-home"></i><span class="hidden-tablet"> {$cm['label']}</span></a></li>
                        {/foreach}
                    {/foreach}

                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <!-- left menu ends -->


        <div id="content" class="span10">
            <!-- content starts -->

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Test</a>
                    </li>
                </ul>
            </div>


            {$content}


        </div>

    </div>

    <hr/>

    <footer>
        <p class="pull-left">&copy; <a href="#" target="_blank">快播动漫影视文化</a> <?php echo date('Y') ?></p>
        <p class="pull-right">Powered by: <a href="#">Abraham</a></p>
    </footer>


</div><!--/.fluid-container-->

<!-- external javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<!-- jQuery UI -->
<script src="/js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="/js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="/js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="/js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="/js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="/js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="/js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="/js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="/js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="/js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="/js/bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="/js/bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="/js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="/js/bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="/js/jquery.cookie.js"></script>
<!-- calander plugin -->
<script src='/js/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='/js/jquery.dataTables.min.js'></script>

<!-- chart libraries start -->
<script src="/js/excanvas.js"></script>
<script src="/js/jquery.flot.min.js"></script>
<script src="/js/jquery.flot.pie.min.js"></script>
<script src="/js/jquery.flot.stack.js"></script>
<script src="/js/jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="/js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="/js/jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="/js/jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="/js/jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="/js/jquery.noty.js"></script>
<!-- file manager library -->
<script src="/js/jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="/js/jquery.uploadify-3.1.min.js"></script>

<script src="/js/jquery.simpleRouter.js"></script>

<!-- history.js for cross-browser state change on ajax -->
<script src="/js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="/js/charisma.js"></script>


</body>
</html>
