{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> <span id="notify-title">所有通知</span></h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content" id="notify-detail" style="min-height: 400px;">

            <div id="notify-content" class="row-fluid notify-content">
                {*<div class="alert alert-info">*}
                    {*当前列出了所以系统发出的通知。如果需要管理员向某个用户发送通知，请在用户管理页面的用户列表中点击发送通知。*}
                {*</div>*}
                <div id="divNotify" class="hide">
                    <a href="javascript:postNotify();" class="btn btn-info" style="float: right; margin-right: 20px;">发送新通知</a>
                </div>
                <table aoDataSource="{$link_prefix}admin/table/notify" aoAutoLoad="false" aoColumns="notify" fnDrawCallback="notify" class="table table-notify table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <th>用户</th>
                        <th>内容</th>
                        <th>时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>

        </div>
    </div><!--/span-->

    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>用户筛选</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="user-search" style="height: 360px">
            <div>
                查找用户并查看发给他的所有通知
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchUserOption" id="nameUserRadio" checked>
                        用户昵称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchUserOption" id="idUserRadio">
                        用户ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtUserValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnUserSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
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
            <div style="overflow: auto; height: 290px;">
                <ul>

                </ul>
            </div>



            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>

    <div class="box span3" >
        <div class="box-header well" data-original-title>
            <h3>内容筛选</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>

        <div class="box-content" id="act-search" style="height: 360px">
            <div>
                通过关键字查看相关通知发给的所有用户
            </div>
            <div class="control-group">
                <div class="controls">
                    {*<label class="radio">*}
                        {*<input type="radio" name="searchActOption" id="nameActRadio"  checked="">*}
                        {*活动名称*}
                    {*</label>*}
                    {*<label class="radio">*}
                        {*<input type="radio" name="searchActOption" id="idActRadio" >*}
                        {*活动ID*}
                    {*</label>*}
                    <p>消息内容</p>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtActValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnActSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
                        </div>
                    </div>
                    <div class="alert alert-error act-require hide">
                        {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                        <span>请输入搜索内容！</span>
                    </div>
                </div>
            </div>

            <div class="alert alert-error act-result hide">
                {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                <span>没有符合条件的活动！</span>
            </div>
            <div style="overflow: auto; height: 290px;">
                <ul>

                </ul>

            </div>


            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>

</div>


<div id="table-edit-row-template" style="display: none">

    <a class="btn btn-info" href="javascript:modifyNotify('NOTIFY_ID');">
        <i class="icon-edit icon-white"></i>
        编辑
    </a>
    <a class="btn btn-info" href="javascript:quickPostNotify('USER_ID');">
        <i class="icon-edit icon-white"></i>
        新通知
    </a>
    <a class="btn btn-danger" href="javascript:delNotify('NOTIFY_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>

<div class="modal hide fade" id="notifyDialog">
    <div class="modal-header">
        <h3>发布通知</h3>
    </div>
    <div class="modal-body">
        <fieldset>

            <div class="control-group">
                <label class="control-label" for="txtContent">通知内容</label>
                <div class="controls">
                    <textarea class="input-xxlarge" id="txtContent" rows="7" style=""></textarea>
                </div>
            </div>

        </fieldset>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" id="btnCancelModify" data-dismiss="modal">取消</a>
        <a href="#" id="btnDoModify" class="btn btn-primary">提交</a>
    </div>
</div>


{literal}
    <script type="text/javascript">
        USER_ID = null;
        NOTIFY_ID = null;
        USER_NAME = null;

        function viewTableParams(aoData) {
            if(USER_ID!==null) {
                aoData.push({'name' : 'user_id' , 'value' : USER_ID});
            }
        }
        function viewStart() {

            window.aoColumns = {'notify' : [
                { "mData": "notify_id"},
                { "mData": "nick_name", "mRender" : function(data, type, ooData) {
                    return "<a href='"+ $.__link_prefix__ + "admin/user/detail#"+ooData['to_user_id']+"'>"+data+"</a>";
                }
                },
                { "mData" : "content"},

                {"mData" : "time", "mRender" : function(time) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(time)*1000));
                }
                },
                {
                    "mData" : "notify_id",
                    "sClass" : "editRow",
                    "mRender" : function(data, type, aoData) {
                        var rtn = document.getElementById("table-edit-row-template").innerHTML.replace(/NOTIFY_ID/g, data);
                        return rtn.replace(/USER_ID/g, aoData.user_id);
                    }
                }

            ]};

        }


        var SUType = "nick_name";
        function setUserSearchType() {
            if($("#nameUserRadio").parent().hasClass("checked")) {
                SUType = "nick_name";
            } else if($("#idUserRadio").parent().hasClass("checked")){
                SUType = "user_id";
            } else {
                throw "unknown type";
            }

        }
        function doUserSearch() {
            $("#user-search .alert").hide();

            var _v = $("#txtUserValue").val().trim();
            if(_v==="") {
                $("#user-search .user-require").show();
                return;
            }
            $.post($.__link_prefix__ + "admin/user/search", {
                search_type : SUType,
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
                    $("<li></li>").html("<a href='"+$.__link_prefix__ + "admin/message/notify#"+user.user_id+"'>"+user.nick_name+"</a>")
                            .appendTo(_u);
                }
            }, "json");
        }

        function showUserNotify(id) {
            USER_ID = id;
            $.post($.__link_prefix__ + "admin/user/sInfo", {
                user_id : id
            }, function(rtn) {
                if(rtn.success!==true) {
                    alert("出现网络错误，请刷新网页！");
                    return;
                }
                $("#divNotify").show();
                USER_NAME = rtn.data.nick_name;
                $("#notify-title").text("发送给 " + rtn.data.nick_name + " 的通知");

                $(".table-notify").DataTable().fnDraw();

            },"json");
        }

        /*
         * 当框架已经全部加载好后会调用这个函数，初始化与当前页面有关的东西
         */
        function viewReady(){
            $.Router.register({
                "\\d+" : function(id) {
                    showUserNotify(id);
                }
            }).start();

            $("#nameUserRadio").change(setUserSearchType);
            $("#idUserRadio").change(setUserSearchType);
            $("#btnUserSearch").click(doUserSearch);
            $("#btnDoModify").click(doPostNotify);
        }

        function delNotify(id) {
            var pwd = prompt("请输入管理员密码确认删除");
            if(pwd.trim()==="") {
                return;
            }
            $.post($.__link_prefix__+"admin/notify/delete", {
                password : pwd,
                notify_id : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert('删除失败！');
                    return;
                }
                alert("删除成功");
                $(".table-video").DataTable().fnDraw();
            }, "json");
        }

        function quickPostNotify(id) {
            USER_ID = id;
            $.post($.__link_prefix__ + "admin/user/sInfo", {
                user_id : id
            }, function(rtn) {
                if(rtn.success!==true) {
                    alert("出现网络错误，请刷新网页！");
                    return;
                }

                USER_NAME = rtn.data.nick_name;
                postNotify();
            },"json");
        }

        function postNotify() {
            if(USER_ID===null) {
                return;
            }
            NOTIFY_ID = null;
            $("#txtContent").val("");
            $("#notifyDialog h3").text("给 "+ USER_NAME+" 发送通知");
            $("#notifyDialog").modal("show");

        }

        function modifyNotify(id) {
            var rs = $(".table-notify tbody tr");
            var cr = null;
            for(var i=0;i<rs.length;i++) {
                var _r = $(rs[i]), _d = _r.find("td:first");
                if(_d.text().trim() === id) {
                    cr = _r;
                    break;
                }
            }
            if(cr === null) {
                alert("出现错误，请刷新网页重试.");
                return;
            }
            NOTIFY_ID = id;
            var tds = cr.find("td");
            var cnt = tds.eq(2).text();
            $("#txtContent").val(cnt);
            $("#notifyDialog h3").text("修改通知");
            $("#notifyDialog").modal("show");
        }

        function doPostNotify() {
            var cnt = $("#txtContent").val().trim();
            if(cnt==="") {
                alert("请输入内容！");
                return;
            }
            $.post($.__link_prefix__ + "admin/notify/" + (NOTIFY_ID===null?"post":"modify"), {
                notify_id : NOTIFY_ID,
                to_user_id : USER_ID,
                content : cnt
            }, function(rtn) {
                if(!rtn.success) {
                    alert("操作失败，请刷新网页重试！");
                    return;
                }
                $("#notifyDialog").modal("hide");
                $(".table-notify").DataTable().fnDraw();
            }, "json");
        }
    </script>
{/literal}