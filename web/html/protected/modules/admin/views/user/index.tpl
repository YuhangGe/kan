{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <span id="h-title">所有用户</span></h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="{$link_prefix}admin/table/user" aoColumns="user"  class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>头像</td>
                    <td>等级</td>
                    <th>昵称</th>
                    <th>姓别</th>
                    <th>邮箱</th>
                    <th>手机</th>
                    <th>生日</th>
                    <th>粉丝</th>
                    <td>好友</td>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->


<div id="table-edit-row-template" style="display: none">
    <a class="btn btn-success edit-view" href="{$link_prefix}admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/default/index#USER_ID">
        <i class="icon-edit icon-white"></i>
        活动
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/photo/index#uUSER_ID">
        <i class="icon-edit icon-white"></i>
        照片
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/video/user#USER_ID">
        <i class="icon-edit icon-white"></i>
        视频
    </a>
    {*<a class="btn btn-info" href="#">*}
    {*<i class="icon-edit icon-white"></i>*}
    {*编辑*}
    {*</a>*}
    <a class="btn btn-danger edit-del" href="javascript:delUser('USER_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>

{literal}

    <script type="text/javascript">
        CUR_ACT = null;
        function viewTableParams(aoData) {

            if(CUR_ACT!==null) {
                aoData.push({'name' : 'act_id' , 'value' : CUR_ACT});
            }
        }

        function viewStart() {
            window.aoColumns = {'user' : [
                { "mData": "user_id"},
                { "mData" : "small_avatar", "mRender": function(data) {
                    var url = (typeof data !== 'string' || data.trim()==="") ? $.__url_prefix__ + 'img/avatar.png' : data;
                    return "<img src='"+url+"' style='max-height:50px;max-width:50px;'/>";
                }
                },
                { "mData": "level", "mRender" : function(data) {
                    return ['普通','秀客','演客', '星客'][Number(data)];
                }
                },
                { "mData": "nick_name"
                },
                { "mData": "sex","mRender": function(data) {
                    return ['男','女'][Number(data)];
                }
                },
                { "mData": "email", "mRender" : function(data) {
                    return data === null ? '(无)' : data;
                }
                },
                { "mData": "phone","mRender" : function(data) {
                    return data === null ? '(无)' : data;
                }
                },
                {"mData" : "birthday", "mRender" : function(data) {
                    return data === null ? '(无)': $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
                }
                },
                { "mData": "fan_number"},
                { "mData": "friend_number"
                },
                {
                    "mData" : "user_id",
                    "sClass" : "editRow",
                    "mRender" : function(data) {
                        return  document.getElementById("table-edit-row-template").innerHTML.replace(/USER_ID/g, data);
                    }
                }
            ]};

        }


        function delUser(id) {
            var pwd = prompt("请输入管理员密码确认删除");
            if(pwd.trim()==="") {
                return;
            }
            $.post($.__link_prefix__+"admin/user/delete", {
                password : pwd,
                user_id : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert('删除失败！请重试。');
                    return;
                }
                alert("删除成功");
                $(".datatable").DataTable().fnDraw();
            }, "json");
        }

        function viewReady() {
            $.Router.register({
                "\\d+" : function(act_id) {
                    CUR_ACT = act_id;
                    $(".datatable").DataTable().fnDraw();
                    $.post($.__link_prefix__ + "admin/user/activeInfo", {
                        act_id : act_id
                    }, function(rtn) {
                        if(!rtn.success) {
                            alert("出现网络错误！请刷新重试。");
                            return;
                        }
                        $("#h-title").text("参加活动 " + rtn.data.act_name+" 的用户");
                    },"json");
                },
                ".*" : function() {
                    CUR_ACT = -1;
                    $(".datatable").DataTable().fnDraw();
                    $("#h-title").text("所有用户");

                }
            }).start();
        }
    </script>

{/literal}
