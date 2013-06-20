{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> 用户详情</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content" id="user-detail" style="min-height: 400px;">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span>没有选择用户。请在右边查找活动然后查看详情。</span>
            </div>
            <div class="row-fluid hide user-content">
                <div class="user-base row-fluid">
                    <div class="span3"><img style="width: 100px;height: 100px;" src="{$url_prefix}img/avatar.png" /></div>
                    <div class="span7">
                        <h4>白羊座小葛</h4>
                        <p>秀客(0粉丝，0好友)</p>
                        <p>男</p>
                    </div>
                </div>
                <hr/>
                <div class="user-birthday row-fluid">
                    <div class="span3"><strong>生日</strong></div>
                    <div class="span7">1990年4月2日(白羊座)</div>
                </div>
                <div class="user-email row-fluid">
                    <div class="span3"><strong>邮箱</strong></div>
                    <div class="span7">xxx</div>
                </div>
                <div class="user-phone row-fluid">
                    <div class="span3"><strong>手机</strong></div>
                    <div class="span7">
                        xxx
                    </div>
                </div>
                <div class="user-real_name row-fluid">
                    <div class="span3"><strong>真实姓名</strong></div>
                    <div class="span7">xxx</div>
                </div>
                <div class="user-company row-fluid">
                    <div class="span3"><strong>所在单位</strong></div>
                    <div class="span7">xxx</div>
                </div>
                <div class="user-hobby row-fluid">
                    <div class="span3"><strong>兴趣爱好</strong></div>
                    <div class="span7">xxx</div>
                </div>
                <div class="user-personalsay row-fluid">
                    <div class="span3"><strong>个性签名</strong></div>
                    <div class="span7">
                        xxx
                    </div>
                </div>
                <style>
                    .user-content .span3 {
                        text-align: right;
                    }
                </style>
            </div>

        </div>
    </div><!--/span-->

    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>查找用户</h3>
            {*<div class="box-icon">*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="user-search" style="min-height: 400px">
            <div class="control-group">
                <div class="controls">
                        <label class="radio">
                            <input type="radio" name="searchOption" id="nameRadio" value="name" checked="">
                            用户昵称
                        </label>
                        <label class="radio">
                            <input type="radio" name="searchOption" id="idRadio" value="id">
                            用户ID
                        </label>
                        <div class="row-fluid">
                            <div class="span9">
                                <input class="focused" name="searchValue" id="txtValue" type="text" style="width:96%" >

                            </div>
                            <div class="span3">
                                <button id="btnSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
                            </div>
                        </div>
                        <div class="alert alert-error user-require hide">
                            {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                            <span>请输入搜索内容！</span>
                        </div>
                </div>
            </div>

            <div class="alert alert-error user-result hide">
                {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                <span>没有符合条件的用户！</span>
            </div>
            <ul>

            </ul>


                {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    var SType = "nick_name";
    function setSearchType() {
        if($("#nameRadio").parent().hasClass("checked")) {
            SType = "nick_name";
        } else if($("#idRadio").parent().hasClass("checked")){
            SType = "user_id";
        } else {
            throw "unknown type";
        }

    }
    function doSearch() {
        $("#user-search .alert").hide();

        var _v = $("#txtValue").val().trim();
        if(_v==="") {
            $("#user-search .user-require").show();
            return;
        }
        $.post($.__link_prefix__ + "admin/user/search", {
            search_type : SType,
            search_value : _v
        }, function(rtn) {
            if(!rtn.success) {
                alert('网络错误，请重试！');
                return;
            }
            $("#user-search .alert").hide();

            var _u = $("#user-search ul").html("");
            var list = rtn.data;
            if(list.length===0) {
                $("#user-search .user-result").show();
            }
            for(var i=0;i<list.length;i++) {
                var user = list[i];
                $("<li></li>").html("<a href='"+$.__link_prefix__ + "admin/user/detail#"+user.user_id+"'>"+user.nick_name+"</a>")
                        .appendTo(_u);
            }
        }, "json");
    }
    /*
     * 当框架已经全部加载好后会调用这个函数，初始化与当前页面有关的东西
     */
    function viewReady(){
        $.Router.register({
            "\\d+" : function(id) {
                showUser(id);
            }
        }).start();

        $("#nameRadio").change(setSearchType);
        $("#idRadio").change(setSearchType);
        $("#btnSearch").click(doSearch);
    }

    var CO = "摩羯座,水瓶座,双鱼座,白羊座,金牛座,双子座,巨蟹座,狮子座,处女座,天秤座,天蝎座,射手座".split(",");

    function showUser(id) {
        $.post($.__link_prefix__ + "admin/user/getDetail", {
            'user_id' : id
        }, function(rtn) {
            if(!rtn.success) {
                alert("网络错误，请重试。");
                return;
            }
            var user = rtn.data;
            $("#user-detail .alert").hide();
            $("#user-detail .user-content").show();
            $("#user-detail .user-base .span3 img").attr('src', user.small_avatar===null?$.__url_prefix__ + 'img/avatar.png':user.small_avatar);
            $("#user-detail .user-base .span7").html(
                "<h4>"+user.nick_name+"</h4><br/>"
               +"<p>"+['普客','秀客','星客'][Number(user.level)]+"("+user.fan_number+"粉丝，"+user.friend_number+"好友)</p>"
               +"<p>"+['男','女'][Number(user.sex)]+"</p>"
            );

            $("#user-detail .user-birthday .span7").text(
                    user.birthday === null ? "(无)" :
                        $.datepicker.formatDate("yy年mm月dd日", new Date(Number(user.birthday)*1000))
                      +"("+CO[Number(user.constellation)]+")"
            );
            $("#user-detail .user-email .span7").text(user.email===null?'(无)':user.email);
            $("#user-detail .user-phone .span7").text(user.phone===null?'(无)':user.phone);
            $("#user-detail .user-real_name .span7").text(user.real_name===null?'(无)':user.real_name);
            $("#user-detail .user-company .span7").text(user.company===null?'(无)':user.company);
            $("#user-detail .user-hobby .span7").text(user.hobby===null?'(无)':user.hobby);
            $("#user-detail .user-personalsay .span7").text(user.personalsay===null?'(无)':user.personalsay);

        }, 'json');
    }
</script>
{/literal}