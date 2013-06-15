<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> 星客选拔</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content" id="score-detail" style="min-height: 400px;">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span>没有选择活动。请在右边查找活动然后查看详情。</span>
            </div>
            <div class="row-fluid hide score-content">
                <div class="score-info score-info row-fluid">
                    <div class="span3"><h2>活动标题   <small>活动类型</small></h2></div>
                    <div class="span9">2013年6月13日 - 2013年6月13日</div>
                </div>
                <hr/>
                <div class="row-fluid">
                    <h3>已选星客</h3>
                    <table data-source="/admin/table/starSelected" class="table table-star-selected table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <th>昵称</th>
                            <th>喜欢</th>
                            <th>浏览</th>
                            <th>人气</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
                <hr/>
                <div class="row-fluid">
                    <h3>人气排名</h3>
                    <table data-source="/admin/table/starRank" class="table table-star-rank table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <th>昵称</th>
                            <th>喜欢</th>
                            <th>浏览</th>
                            <th>人气</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div><!--/span-->


    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>查找活动</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="act-search" style="min-height: 400px">
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchOption" id="nameRadio" value="name" checked="">
                        活动名称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchOption" id="idRadio" value="id">
                        活动ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
                        </div>
                    </div>
                    <div class="alert alert-error score-require hide">
                        {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                        <span>请输入搜索内容！</span>
                    </div>
                </div>
            </div>

            <div class="alert alert-error score-result hide">
                {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                <span>没有符合条件的活动！</span>
            </div>
            <ul>

            </ul>


            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div>

<div id="table-row-selected-template" style="display: none">
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

<div id="table-row-rank-template" style="display: none">
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
        var SType = "act_name", CUR_ACT = null;

        function viewStart() {
            window.aoColumns = [
                { "mData": "user_id"},
                { "mData": "user_name" },
                { "mData": "act_vote"
                },
                { "mData": "act_view"
                },
                { "mData": "act_score"},
                {
                    "mData" : "table_type",
                    "sClass" : "editRow",
                    "mRender" : function(data, type, ooData) {
                        return data + ooData.user_id;
                       // return  document.getElementById("table-edit-row-template").innerHTML.replace(/USER_ID/g, data);
                    }
                }
            ];
        }
        function setSearchType() {
            if($("#nameRadio").parent().hasClass("checked")) {
                SType = "act_name";
            } else if($("#idRadio").parent().hasClass("checked")){
                SType = "act_id";
            } else {
                throw "unknown type";
            }

        }
        function doSearch() {
            $("#score-search .alert").hide();

            var _v = $("#txtValue").val().trim();
            if(_v==="") {
                $("#score-search .score-require").show();
                return;
            }
            $.post("/admin/star/search", {
                search_type : SType,
                search_value : _v
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试！');
                    return;
                }
                $("#score-search .alert").hide();

                var _u = $("#score-search ul").html("");
                var list = rtn.data;
                if(list.length===0) {
                    $("#score-search .score-result").show();
                }
                for(var i=0;i<list.length;i++) {
                    var act = list[i];
                    $("<li></li>").html("<a href='/admin/star/index#"+act.act_id+"'>"+act.act_name+"</a>")
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
                    showActive(id);
                }
            }).start();

            $("#nameRadio").change(setSearchType);
            $("#idRadio").change(setSearchType);
            $("#btnSearch").click(doSearch);
        }

        function showActive(id) {
            $(".dataTables_info").hide();
            $.post("/admin/default/getDetail", {
                'act_id' : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert("网络错误，请重试。");
                    return;
                }
                var act = rtn.data, TYPE = ['才艺','表演', '简历'];
                $("#score-detail .alert").hide();
                $("#score-detail .score-content").show();
                $("#score-detail .score-info .span3 h2").html(act.act_name+"<small style='margin-left: 10px;'>"+TYPE[Number(act.act_type)]+"</small>");
                $("#score-detail .score-info .span9").text(
                        $.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.begin_time)*1000))
                      + " - "
                      + $.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.end_time)*1000))
                );
                CUR_ACT = act.act_id;
                $('.datatable').each(function() {
                    $(this).DataTable().fnReloadAjax();
                });
            }, 'json');
        }

        function viewTableParams(aoData) {
            if(CUR_ACT!==null) {
                aoData.push({'name' : 'act_id' , 'value' : CUR_ACT});
            }
        }

    </script>
{/literal}