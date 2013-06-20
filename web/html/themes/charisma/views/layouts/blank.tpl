{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>看看后台管理-登陆</title>


    <link id="bs-css" href="{$url_prefix}css/bootstrap-cerulean.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="{$url_prefix}css/bootstrap-responsive.css" rel="stylesheet">
    <link href="{$url_prefix}css/charisma-app.css" rel="stylesheet">
    <link href="{$url_prefix}css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href='{$url_prefix}css/fullcalendar.css' rel='stylesheet'>
    <link href='{$url_prefix}css/fullcalendar.print.css' rel='stylesheet'  media='print'>
    <link href='{$url_prefix}css/chosen.css' rel='stylesheet'>
    <link href='{$url_prefix}css/uniform.default.css' rel='stylesheet'>
    <link href='{$url_prefix}css/colorbox.css' rel='stylesheet'>
    <link href='{$url_prefix}css/jquery.cleditor.css' rel='stylesheet'>
    {*<link href='{$url_prefix}css/jquery.noty.css' rel='stylesheet'>*}
    {*<link href='{$url_prefix}css/noty_theme_default.css' rel='stylesheet'>*}
    <link href='{$url_prefix}css/elfinder.min.css' rel='stylesheet'>
    <link href='{$url_prefix}css/elfinder.theme.css' rel='stylesheet'>
    <link href='{$url_prefix}css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='{$url_prefix}css/opa-icons.css' rel='stylesheet'>
    <link href='{$url_prefix}css/uploadify.css' rel='stylesheet'>

    <link href="{$url_prefix}css/admin.css" rel="stylesheet">

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="{$url_prefix}js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">
        $.browser = {};
        $.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
        $.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
        $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
        $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
        $.log = function(msg) {
            console.log(msg);
        }
        $.__link_prefix__ = "{$link_prefix}";
        $.__url_prefix__ = "{$url_prefix}";
    </script>
    <!-- The fav icon -->
    <link rel="shortcut icon" href="{$url_prefix}img/favicon.ico">

</head>

<body>

{$content}

<!-- jQuery UI -->
<script src="{$url_prefix}js/jquery-ui-1.8.21.custom.min.js"></script>
<!-- transition / effect library -->
<script src="{$url_prefix}js/bootstrap-transition.js"></script>
<!-- alert enhancer library -->
<script src="{$url_prefix}js/bootstrap-alert.js"></script>
<!-- modal / dialog library -->
<script src="{$url_prefix}js/bootstrap-modal.js"></script>
<!-- custom dropdown library -->
<script src="{$url_prefix}js/bootstrap-dropdown.js"></script>
<!-- scrolspy library -->
<script src="{$url_prefix}js/bootstrap-scrollspy.js"></script>
<!-- library for creating tabs -->
<script src="{$url_prefix}js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="{$url_prefix}js/bootstrap-tooltip.js"></script>
<!-- popover effect library -->
<script src="{$url_prefix}js/bootstrap-popover.js"></script>
<!-- button enhancer library -->
<script src="{$url_prefix}js/bootstrap-button.js"></script>
<!-- accordion library (optional, not used in demo) -->
<script src="{$url_prefix}js/bootstrap-collapse.js"></script>
<!-- carousel slideshow library (optional, not used in demo) -->
<script src="{$url_prefix}js/bootstrap-carousel.js"></script>
<!-- autocomplete library -->
<script src="{$url_prefix}js/bootstrap-typeahead.js"></script>
<!-- tour library -->
<script src="{$url_prefix}js/bootstrap-tour.js"></script>
<!-- library for cookie management -->
<script src="{$url_prefix}js/jquery.cookie.js"></script>
<!-- calander plugin -->
<script src='{$url_prefix}js/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='{$url_prefix}js/jquery.dataTables.min.js'></script>

<!-- chart libraries start -->
<script src="{$url_prefix}js/excanvas.js"></script>
<script src="{$url_prefix}js/jquery.flot.min.js"></script>
<script src="{$url_prefix}js/jquery.flot.pie.min.js"></script>
<script src="{$url_prefix}js/jquery.flot.stack.js"></script>
<script src="{$url_prefix}js/jquery.flot.resize.min.js"></script>
<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="{$url_prefix}js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="{$url_prefix}js/jquery.uniform.min.js"></script>
<!-- plugin for gallery image view -->
<script src="{$url_prefix}js/jquery.colorbox.min.js"></script>
<!-- rich text editor library -->
<script src="{$url_prefix}js/jquery.cleditor.min.js"></script>
<!-- notification plugin -->
<script src="{$url_prefix}js/jquery.noty.js"></script>
<!-- file manager library -->
<script src="{$url_prefix}js/jquery.elfinder.min.js"></script>
<!-- star rating plugin -->
<script src="{$url_prefix}js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="{$url_prefix}js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="{$url_prefix}js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="{$url_prefix}js/jquery.uploadify-3.1.min.js"></script>

<script src="{$url_prefix}js/jquery.simpleRouter.js"></script>

<!-- history.js for cross-browser state change on ajax -->
<script src="{$url_prefix}js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
{*<script src="{$url_prefix}js/charisma.js"></script>*}



</body>
</html>
