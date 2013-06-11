<div class="container-fluid">

<div class="row-fluid">

    <div class="row-fluid">
        <div class="span12 center login-header">
            <h2>看看后台管理登陆</h2>
        </div><!--/span-->
    </div><!--/row-->

    <div class="row-fluid">
        <div class="well span5 center login-box">
            <div class="alert alert-info">
                请使用管理员账户密码登陆
            </div>
            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="input-prepend" title="Username" data-rel="tooltip">
                        <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="ALoginForm[username]" id="username" type="text" value="" />
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-prepend" title="Password" data-rel="tooltip">
                        <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="ALoginForm[password]" id="password" type="password" value="" />
                    </div>
                    <div class="clearfix"></div>

                    {*<div class="input-prepend">*}
                        {*<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>*}
                    {*</div>*}
                    <div class="clearfix"></div>

                    <p class="center span5">
                        <button type="submit" class="btn btn-primary">登陆</button>
                    </p>
                </fieldset>
            </form>
        </div><!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->