<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 用户</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="/admin/table/user" aoOrderBy="user_id" aoColumns="user"  class="table table-striped table-bordered bootstrap-datatable datatable">
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
    <a class="btn btn-success edit-view" href="/admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    {*<a class="btn btn-info" href="#">*}
    {*<i class="icon-edit icon-white"></i>*}
    {*编辑*}
    {*</a>*}
    <a class="btn btn-danger edit-del" href="javascript:delActive('USER_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>

{literal}

    <script type="text/javascript">
        function viewStart() {
            window.aoColumns = {'user' : [
                { "mData": "user_id"},
                { "mData" : "small_avatar", "mRender": function(data) {
                    var url = (typeof data !== 'string' || data.trim()==="") ? '/img/avatar.png' : data;
                    return "<img src='"+url+"' style='max-height:50px;max-width:50px;'/>";
                }
                },
                { "mData": "level", "mRender" : function(data) {
                    return ['普通','秀客','星客'][Number(data)];
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


        function delActive(id) {
            if(confirm("确认删除用户？", "删除")) {
                $.log("del:"+id);
            }
        }
    </script>

{/literal}
