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

            <table data-source="/admin/table/user" order-by="user_id" {*="{$act_list['start']}" iEnd="{$act_list['end']}" iTotal="{$act_list['total']}"*}  class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>头像</td>
                    <td>等级</td>
                    <th>昵称</th>
                    <th>姓别</th>
                    <th>Email</th>
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
    <a class="btn btn-success edit-view" href="/admin/default/detail#ACT_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    {*<a class="btn btn-info" href="#">*}
    {*<i class="icon-edit icon-white"></i>*}
    {*编辑*}
    {*</a>*}
    <a class="btn btn-danger edit-del" href="javascript:delActive('ACT_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>

{literal}

    <script type="text/javascript">
        function viewStart() {
            window.aoColumns = [
                { "mData": "user_id"},
                { "mData" : "small_avatar", "mRender": function(data) {
                    return "<img src='"+data+"' style='max-height:80px;max-width:80px;/>";
                }
                },
                { "mData": "level", "mRender" : function(data) {
                    return ['普通','秀客','星客'][Number(data)];
                }
                },
                { "mData": "act_type", "mRender" : function(data) {
                    return ['才艺','表演','简历'][Number(data)];
                }
                },
                { "mData": "begin_time","mRender": function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
                }
                },
                { "mData": "end_time","mRender": function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
                } },
                { "mData": "image" , "mRender" : function(data) {
                    return "<a href='"+data+"' target='_blank'>"+(data.length<38?data:"http://..."+data.substr(data.length-30))+"</a>";
                }
                },
                {
                    "mData" : "act_id",
                    "sClass" : "editRow",
                    "mRender" : function(data) {
                        return  document.getElementById("table-edit-row-template").innerHTML.replace(/ACT_ID/g, data);
                    }
                }
            ];
        }


        function delActive(id) {
            if(confirm("确认删除用户？", "删除")) {
                $.log("del:"+id);
            }
        }
    </script>

{/literal}
