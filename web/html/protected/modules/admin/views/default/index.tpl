{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <span id='h-title'>所有活动</span></h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="{$link_prefix}admin/table/active"  aoColumns="active" fnDrawCallback="active" class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>活动名称</th>
                    <th>活动类型</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>活动海报</th>
                    <th>活动状态</th>
                    <th>报名数</th>
                    <th>演客数</th>
                    <th>星客数</th>
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
        查看
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/default/detail#ACT_ID!">
        <i class="icon-edit icon-white"></i>
        修改
    </a>
    <a class="btn btn-info edit-view" href="{$link_prefix}admin/user/index#ACT_ID">
        <i class="icon-edit icon-white"></i>
        用户
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/star/index#ACT_ID">
        <i class="icon-edit icon-white"></i>
        演客
    </a>
     <a class="btn btn-danger edit-del" href="javascript:delActive('ACT_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>


{literal}

<script type="text/javascript">
    USER_ID = null;
    function viewTableParams(aoData) {

        if(USER_ID!==null) {
            aoData.push({'name' : 'user_id' , 'value' : USER_ID});
        }
    }


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
                return ['表演','才艺','简历'][Number(data)];
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
              "mData" : "end_time", "mRender" : function(data) {
                    var t = Number(data)*1000, _d = new Date().getTime();
                    if(t>_d) {
                        return "进行中";
                    } else {
                        return "已结束";
                    }
              }
            },
            {
                "mData" : "join_n"
            },
            {
                "mData" : "star_n"
            },
            {
                "mData" : "winner_n", "mRender" : function(data, type, aoData) {
                    var t = Number(aoData.end_time)*1000, _d = new Date().getTime();
                if(t>_d) {
                    return "未结束";
                } else {
                    return data;
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

    function viewReady() {
        $.Router.register({
            "\\d+" : function(user_id) {
                USER_ID = user_id;
                $(".datatable").DataTable().fnDraw();
                $.post($.__link_prefix__ + "admin/user/sInfo", {
                    user_id : USER_ID
                }, function(rtn) {
                    if(!rtn.success) {
                        alert("出现网络错误！请刷新重试。");
                        return;
                    }
                    $("#h-title").text(rtn.data.nick_name + " 参加的活动");
                },"json");
            },
            ".*" : function() {
                USER_ID = -1;
                $(".datatable").DataTable().fnDraw();
                $("#h-title").text("所有活动");
            }
        }).start();
    }
</script>

{/literal}


