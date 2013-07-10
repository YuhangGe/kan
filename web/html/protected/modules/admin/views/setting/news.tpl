{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 新闻</h2>
            <div class="box-icon">
                <a class="btn btn-info" href="javascript:createNews();" style="width: 80px;">
                    <i class="icon-edit icon-white"></i>
                    新建新闻
                </a>
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table id="news-table" aoDataSource="{$link_prefix}admin/table/news" aoColumns="news"  class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>内容</td>
                    <td>发布时间</td>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->


<div id="table-edit-row-template" style="display: none">

    {*<a class="btn btn-danger edit-del" href="javascript:delNews('NEWS_ID');">*}
        {*<i class="icon-trash icon-white"></i>*}
        {*删除*}
    {*</a>*}
    <a class="btn btn-info edit-modify" href="javascript:;">
        <i class="icon-edit icon-white"></i>
        修改
    </a>
</div>


<div class="modal hide fade" id="newsDialog">
    <div class="modal-header">
        <h3>发布新闻</h3>
    </div>
    <div class="modal-body">
        <fieldset>

            <div class="control-group">
                <label class="control-label" for="txtContent">新闻内容</label>
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
        MODE = "new";
        ID = 0;

        function viewStart() {
            window.aoColumns = {'news' : [
                { "mData": "news_id"},
                { "mData" : "content"},

                {"mData" : "time", "mRender" : function(time) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(time)*1000));
                }
                },
                {
                    "mData" : "news_id",
                    "sClass" : "editRow",
                    "mRender" : function(data) {
                        return  document.getElementById("table-edit-row-template").innerHTML.replace(/NEWS_ID/g, data);
                    }
                }
            ]};

        }


        function delNews(id) {
            if(confirm("确认删除？", "删除")) {
                $.log("del:"+id);
            }
        }

        function createNews() {
            $("#newsDialog .modal-header h3").text("发布新闻");
            $("#txtContent").val("");
            $("#newsDialog").modal("show");

            MODE = "new";
        }

        function modifyNews(id, msg) {
            $("#newsDialog .modal-header h3").text("修改新闻");
            $("#txtContent").val(msg);
            $("#newsDialog").modal("show");

            MODE = "modify";
            ID = id;
        }
        function doCreateNews() {
            var cnt = $("#txtContent").val().trim();
            if(cnt === "") {
                alert("请输入内容！");
                return;
            }
            $("#btnDoModify").text("正在提交...").attr('disabled', true);

            $.post($.__link_prefix__ + "admin/news/post", {
                content : cnt
            }, function(rtn) {
                $("#btnDoModify").text("提交").attr('disabled', false);
                if(!rtn.success) {
                    alert("网络错误，请重试。");
                } else {
                    $("#newsDialog").modal("hide");
                    $("#news-table").DataTable().fnDraw();

                }
            },'json');
        }
        function doModifyNews(id) {
            var cnt = $("#txtContent").val().trim();
            if(cnt === "") {
                alert("请输入内容！");
                return;
            }
            $("#btnDoModify").text("正在提交...").attr('disabled', true);

            $.post($.__link_prefix__ + "admin/news/modify", {
                news_id : ID,
                content : cnt
            }, function(rtn) {
                $("#btnDoModify").text("提交").attr('disabled', false);
                if(!rtn.success) {
                    alert("网络错误，请重试。");
                } else {
                    $("#newsDialog").modal("hide");
                    $("#news-table").DataTable().fnDraw();
                }
            },'json');
        }

        function viewReady() {
            $("#btnDoModify").click(function() {
                if(MODE === 'new') {
                    doCreateNews();
                } else {
                    doModifyNews();
                }
            });
            $("#news-table").on("click", "tr a.edit-modify", function() {
                var p = $(this).parents("tr");
                var id = $(p.children()[0]).text();
                var msg = $(p.children()[1]).text();
                modifyNews(id, msg);
            });
        }
    </script>

{/literal}
