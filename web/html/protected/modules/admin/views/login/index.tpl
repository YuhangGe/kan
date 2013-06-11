
{*<h4>登陆后台</h4>*}
{*{assign "form"  $this->beginWidget('bootstrap.widgets.TbActiveForm',*}
{*[*}
{*'id'=>'verticalForm',*}
{*'htmlOptions' => ['class'=>'well']*}
{*]*}
{*)}*}

{*{$form->textFieldRow($model, 'username', ['class'=>'span3'])}*}
{*{$form->passwordFieldRow($model, 'password', ['class'=>'span3'])}*}
{*<br/>*}
{*{$this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'label'=>'登陆'], true)}*}

{*{assign "form_end" $this->endWidget()}*}


<div class="container-fluid">

    <div class="row-fluid">

        <div class="row-fluid">
            <div class="span12 center login-header">
                <h2>看看后台管理登陆</h2>
            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid">
            <div class="well span5 center login-box">

                {if $login_failed}
                    <div class="alert alert-error">
                        账户名或密码错误，请重新输入或联系管理员
                    </div>
                {else}
                    <div class="alert alert-info">
                        请使用管理员账户密码登陆
                    </div>
                {/if}

                <form class="form-horizontal" action="/admin/login" method="post">
                    <fieldset>
                        <div class="input-prepend" title="Username" data-rel="tooltip">
                            <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="ALoginForm[username]" id="username" type="text" value="admin" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password" data-rel="tooltip">
                            <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="ALoginForm[password]" id="password" type="password" value="admin123456" />
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