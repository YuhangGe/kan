<!doctype html>
<html>
<head>
    <!--
        @developer @白羊座小葛
    -->
    <meta charset="utf-8">
    <title>setup</title>
    <link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">

    <style type="text/css">
        body {

            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">

    <link href='css/chosen.css' rel='stylesheet'>
    <link href='css/uniform.default.css' rel='stylesheet'>


    <link href="css/admin.css" rel="stylesheet">
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">
        $.browser = {};
        $.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());
        $.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
        $.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
        $.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
        $.log = function(msg) {
            console.log(msg);
        }

        $(function() {
            $('ul.main-menu li:not(.nav-header)').hover(function(){
                    $(this).animate({'margin-left':'+=5'},300);
                },
                function(){
                    $(this).animate({'margin-left':'-=5'},300);
            });
            //uniform - styler for checkbox, radio and file input
            $("input:checkbox, input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform();

            $("#btnSetup").click(function() {
                var keys = ['username', 'password', 'db_address', 'db_name', 'db_username', 'db_password'];
                var fd = {};
                for(var i=0;i<keys.length;i++) {
                    var _i = $("#"+keys[i]), _v = _i.val().trim();
                    if(_v==="") {
                        alert("请填写完整的参数!");
                        _i.focus();
                        return;
                    } else {
                        fd[keys[i]]= _v;
                    }
                }
                $.post("do-setup.php", fd, function(rtn) {
                    $.log(rtn);
                    if(!rtn.success) {
                        alert("出现错误！可能是数据库参数不正确，请确认数据库参数正确。如果还有问题，请联系开发人员。");
                    } else {
                        $(".alert-success").show();
                        $(".alert-success a").attr("href", rtn.data.login_url).text(rtn.data.login_url);
                        $("#btnSetup").text("安装成功").attr("disabled", true);
                    }
                }, "json");
            });
        });
    </script>
    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#"> <img alt="Logo" src="img/logo20.png" /> <span>安装看看</span></a>

        </div>
    </div>
</div>

<!-- topbar ends -->
<div class="container-fluid">
    <div class="row-fluid">

        <!-- left menu starts -->
        <div class="span2 main-menu-span" style="position: relative; top: 12px;">
            <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">

                    <li class="nav-header hidden-tablet"> 安装看看</li>
                        <li style="margin-left: -2px;" class="active"><a href="#" ><i class="icon-home"></i><span class="hidden-tablet"> 程序安装</span></a></li>
                    <li style="margin-left: -2px;" ><a href="javascript:showHelp();" ><i class="icon-user"></i><span class="hidden-tablet"> 使用帮助</span></a></li>

                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <!-- left menu ends -->


        <div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> 程序安装</h2>
                        <div class="box-icon">

                        </div>
                    </div>
                    <div class="box-content">
                        <div class="alert alert-info">
                            请填完所有参数后点击开始安装。其中管理员账号和密码是开发者提供的后台账号密码，你需要在此输入以确认身份。数据库的相关参数是空间提供商提供的，如果不清楚请联系提供商。
                        </div>
                        <div class="alert alert-success hide">
                            安装成功！登陆页面地址是<a href='#'>login</a>。请使用这个地址登陆后台管理。
                        </div>
                        <form class="form-horizontal">
                            <fieldset>

                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 管理员账号</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="username" type="text" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 管理员密码</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused"  id="password" type="text" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 数据库地址</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused"  id="db_address" type="text" value="localhost" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 数据库名称</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="db_name" type="text" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 数据库用户</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="db_username" type="text" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="txtName"> 数据库密码</label>
                                    <div class="controls">
                                        <input class="input-xlarge focused" id="db_password" type="text" >
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" id="btnSetup" class="btn btn-primary">开始安装</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!--/span-->

            </div><!--/row-->



        </div>

    </div>

    <hr/>

    <footer>
        <p class="pull-left">&copy; <a href="#" target="_blank">快播动漫影视文化</a> <?php echo date('Y') ?></p>
        <p class="pull-right">Powered by: <a href="#">Abraham</a></p>
    </footer>


</div><!--/.fluid-container-->

<!-- jQuery UI -->
<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>

<!-- chart libraries end -->

<!-- select or dropdown enhancer -->
<script src="js/jquery.chosen.min.js"></script>
<!-- checkbox, radio, and file input styler -->
<script src="js/jquery.uniform.min.js"></script>

</body>
</html>