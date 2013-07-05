{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


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

            <table aoDataSource="{$link_prefix}admin/table/active" aoOrderBy="end_time" aoColumns="active" fnDrawCallback="active" class="table table-striped table-bordered bootstrap-datatable datatable">
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


<div id="table-edit-row-template" style="display: none">
    <a class="btn btn-success edit-view" href="{$link_prefix}admin/default/detail#ACT_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/default/detail#ACT_ID!">
        <i class="icon-edit icon-white"></i>
        修改活动
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/star/index#ACT_ID">
        <i class="icon-edit icon-white"></i>
        演客选拔
    </a>
    <a class="btn btn-danger edit-del" href="javascript:delActive('ACT_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>


{literal}

<script type="text/javascript">
    function viewStart() {
        window.fnDrawCallback = {
            'active' : function() {
                $.colorbox.remove();
                $(".active_image").colorbox({transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
            }
        };
        window.aoColumns = {'active' : [
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
                if(data===null || data.trim() === "") {
                    return "未上传";
                } else {
                    return "<a href='"+data+"' class='active_image'>显示图片</a>";
                }
            }
            },
            {
                "mData" : "act_id",
                "sClass" : "editRow",
                "mRender" : function(data) {
                    return  document.getElementById("table-edit-row-template").innerHTML.replace(/ACT_ID/g, data);
                }
            }
        ]};
    }


    function delActive(id) {
        var pwd = prompt("请输入管理员密码确认删除");
        if(pwd.trim()==="") {
            return;
        }
        $.post($.__link_prefix__+"admin/default/delete", {
            password : pwd,
            act_id : id
        }, function(rtn) {
            if(!rtn.success) {
                alert('删除失败！');
                return;
            }
            alert("删除成功");
            $(".datatable").DataTable().fnDraw();
        }, "json");
    }
</script>

{/literal}


