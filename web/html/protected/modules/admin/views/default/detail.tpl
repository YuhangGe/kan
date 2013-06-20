{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> 活动详情</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
                <a class="btn btn-info"  id="starBtn" href="javascript:;" onclick="openStar(this);" style="width: 70px;">
                    <i class="icon-edit icon-white"></i>
                    星客选拔
                </a>
            </div>
        </div>

        <div class="box-content" id="act-detail" style="min-height: 400px;">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span>没有选择活动。请在右边查找活动然后查看详情。</span>
            </div>
            <div class="row-fluid hide act-content">
                <div class="page-header">
                    <h3>活动标题   <small>活动类型</small></h3>

                </div>
                <div class="begin-time row-fluid">
                    <div class="span2"><strong>开始时间</strong></div>
                    <div class="span10">2013年6月13日</div>
                </div>
                <div class="end-time row-fluid">
                    <div class="span2"><strong>结束时间</strong></div>
                    <div class="span10">2013年6月13日</div>
                </div>
                <div class="act-image row-fluid">
                    <div class="span2"><strong>活动海报</strong></div>
                    <div class="span6">
                        <img alt="活动海报"/>
                    </div>
                </div>
                <hr/>
                <div class="act-description row-fluid">
                    <div class="span2"><strong>活动描述</strong></div>
                    <div class="span10">
                        xxx
                    </div>
                </div>
            </div>

        </div>
        <style>
            .act-content{
                padding-left: 15px;
            }
        </style>
    </div><!--/span-->

    <div class="box span3" >
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
            <ul>

            </ul>


                {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    var SType = "act_name";
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
        $("#act-search .alert").hide();

        var _v = $("#txtValue").val().trim();
        if(_v==="") {
            $("#act-search .act-require").show();
            return;
        }
        $.post($.__link_prefix__ + "admin/default/search", {
            search_type : SType,
            search_value : _v
        }, function(rtn) {
            if(!rtn.success) {
                alert('网络错误，请重试！');
                return;
            }
            $("#act-search .alert").hide();

            var _u = $("#act-search ul").html("");
            var list = rtn.data;
            if(list.length===0) {
                $("#act-search .act-result").show();
            }
            for(var i=0;i<list.length;i++) {
                var act = list[i];
                $("<li></li>").html("<a href='"+ $.__link_prefix__ + "admin/default/detail#"+act.act_id+"'>"+act.act_name+"</a>")
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
        $.post($.__link_prefix__ + "admin/default/getDetail", {
            'act_id' : id
        }, function(rtn) {
            if(!rtn.success) {
                alert("网络错误，请重试。");
                return;
            }
            var act = rtn.data, TYPE = ['才艺','表演', '简历'];
            $("#act-detail .alert").hide();
            $("#act-detail .act-content").show();
            $("#act-detail .page-header h3").html(act.act_name+"<small style='margin-left: 10px;'>"+TYPE[Number(act.act_type)]+"</small>");
            $("#starBtn").attr("act_id",act.act_id);
            $("#act-detail .begin-time .span10").text($.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.begin_time)*1000)));
            $("#act-detail .end-time .span10").text($.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.end_time)*1000)));
            $("#act-detail .act-image img").attr("src", act.image);
            $("#act-detail .act-description .span10").html(act.description);
        }, 'json');
    }

    function openStar(btn) {
        window.location.href=$.__link_prefix__ + "admin/star/index#"+$(btn).attr("act_id");
    }
</script>
{/literal}