<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 活动</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table data-source="/admin/table/active" order-by="end_time" {*="{$act_list['start']}" iEnd="{$act_list['end']}" iTotal="{$act_list['total']}"*}  class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>活动名称</th>
                    <th>活动类型</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>活动海报</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Active</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>


<div id="table-edit-row-template" style="display: none">
    <a class="btn btn-success edit-view" href="/admin/default/index#ACT_ID">
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
            { "mData": "act_id"},
            { "mData": "act_name" },
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


    /*
     * 当框架已经全部加载好后会调用这个函数，初始化与当前页面有关的东西
     */
    function viewReady(){
        $.Router.register({
            "\\d+" : function(id) {
                showActive(id);
            }
        }).start();
    }

    function showActive(id) {

    }

    function delActive(id) {
        if(confirm("确认删除活动？", "删除")) {
            $.log("del:"+id);
        }
    }
</script>

{/literal}


