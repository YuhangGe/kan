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
                    <a class="btn btn-info"  id="starBtn" href="javascript:;" onclick="openStar(this);" style="width: 70px;">
                        <i class="icon-edit icon-white"></i>
                        星客选拔
                    </a>
                    <a class="btn btn-info"  id="modifyBtn" href="javascript:;" onclick="openModify(this);" style="width: 70px;">
                        <i class="icon-edit icon-white"></i>
                        修改活动
                    </a>
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
            #starBtn, #modifyBtn{
                float: right;
                position: relative;
                top: -28px;
                margin-right: 15px;
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


<div class="modal hide fade" id="modifyDialog" style="width: 900px;margin: -250px 0 0 -450px; ">
    <div class="modal-header">
        {*<button type="button" class="close" data-dismiss="modal">×</button>*}
        <h3>修改活动</h3>
    </div>
    <div class="modal-body">
            <fieldset>
                {*<legend></legend>*}
                <div class="control-group">
                    <label class="control-label" for="txtName">活动名称</label>
                    <div class="controls">
                        <input class="input-xlarge focused" name="act_name" id="txtName" type="text" >
                        {*<span style="color: red;margin-left: 5px;">*</span>*}
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="typeSelect">活动类型</label>
                    <div class="controls">
                        <select id="typeSelect" name="act_type">
                            <option value="0" selected>才艺</option>
                            <option value="1">表演</option>
                            <option value="2">简历</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dataBeginTime">开始日期</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge datepicker" id="dataBeginTime" value="{$smarty.now|date_format:"%Y-%m-%d"}">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="dataEndTime">结束日期</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge datepicker" id="dataEndTime" value="{$smarty.now|date_format:"%Y-%m-%d"}">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="fileImage">活动海报</label>
                    <div class="controls">
                        <input class="input-file uniform_on" id="fileImage" type="file">
                            <span>
                                <img id="actPoster" style="max-height: 200px; max-width: 200px;" alt="海报预览"/>
                                <span class="alert alert-info hide" id="actUpload" style="position: relative; top: 5px;"></span>

                            </span>
                    </div>
                    <input type="hidden" name="actImage" id="actImage" value=""/>
                </div>
                <div class="control-group">
                    <label class="control-label" for="txtDescription">活动详情</label>
                    <div class="controls">
                        <textarea class="ckeditor input-xxlarge" id="txtDescription" rows="7" style=""></textarea>
                    </div>
                </div>

            </fieldset>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" id="btnCancelModify" data-dismiss="modal">取消</a>
        <a href="#" id="btnDoModify" class="btn btn-primary">修改</a>
    </div>
</div>

{literal}
<script type="text/javascript">
    var SType = "act_name";
    var CUR_ACT = null;
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
            "(\\d+)\\!" : function(arg, id) {
                modifyActive(id);
            },
            "\\d+" : function(id) {
                showActive(id);
            }
        }).start();

        $("#nameRadio").change(setSearchType);
        $("#idRadio").change(setSearchType);
        $("#btnSearch").click(doSearch);

        $("#btnDoModify").click(doModifyActive);
        $("#fileImage").change(uploadImage);
        $("#btnCancelModify").click(function() {
            window.location.href=$.__link_prefix__ + "admin/default/detail#"+ CUR_ACT.act_id;
        })
    }

    function showActive(id, callback) {
        if(CUR_ACT!==null && Number(CUR_ACT.act_id)===Number(id)) {
            return;
        }
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
            $("#modifyBtn").attr("act_id", act.act_id);
            $("#act-detail .begin-time .span10").text($.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.begin_time)*1000)));
            $("#act-detail .end-time .span10").text($.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.end_time)*1000)));
            $("#act-detail .act-image img").attr("src", act.image);
            $("#act-detail .act-description .span10").html(act.description);

            CUR_ACT = act;
            if(typeof callback==='function') {
                callback();
            }
        }, 'json');
    }

    function openStar(btn) {
        window.location.href=$.__link_prefix__ + "admin/star/index#"+$(btn).attr("act_id");
    }

    function openModify(btn) {
        window.location.href=$.__link_prefix__ + "admin/default/detail#"+$(btn).attr("act_id")+"!";
    }


    function modifyActive(id) {
        if(CUR_ACT === null || Number(CUR_ACT.act_id)!==Number(id)) {
            showActive(id, function() {
                modifyActive(id);
            });
            return;
        }
        $("#txtName").val(CUR_ACT.act_name);
        $("#typeSelect").val(CUR_ACT.act_type);
        $("#dataBeginTime").val($.datepicker.formatDate("yy-mm-dd", new Date(Number(CUR_ACT.begin_time)*1000)));
        $("#dataEndTime").val($.datepicker.formatDate( "yy-mm-dd", new Date(Number(CUR_ACT.end_time)*1000)));
        $("#actPoster").attr("src", CUR_ACT.image).show();
        $("#actImage").val(CUR_ACT.image);
        $("#txtDescription").val(CUR_ACT.description);
        $("#modifyDialog").modal("show");
    }

    function uploadImage() {
        var fs = $("#fileImage")[0].files;
        if(fs.length===0) {
            return;
        }
        $("#actUpload").show().text("正在上传(0%)...");
        var img = fs[0];
        var fd = new FormData();
        fd.append("image_file", img);
        $.ajax({
            url: $.__link_prefix__ + "admin/upload/image",
            data: fd,
            dataType : "json",
            //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',

            xhr: function() {  // custom xhr
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // check if upload property exists
                    myXhr.upload.addEventListener('progress', uploadProcess, false); // for handling the progress of the upload
                }
                return myXhr;
            },
            success : showImage
        });
    }

    function uploadProcess(e) {
        if(e.lengthComputable){
            $("#actUpload").text("正在上传("+Math.round(e.loaded/ e.total * 100)+"%)...");
        }
    }
    function showImage(rtn) {
        if(!rtn.success) {
            alert("上传失败，请重试。");
            return;
        }
        $("#actUpload").hide();
        $("#actPoster").attr("src", rtn.data.image_url).show();
        $("#actImage").val(rtn.data.image_url);
    }

    function doModifyActive() {
        if($("#txtName").val()==="") {
            alert("请输入活动名称！");
            return;
        }
        $("#btnDoModify").text("正在处理...").attr('disabled', true);
        $.post($.__link_prefix__ + "admin/default/modify", {
            'act_id' : CUR_ACT.act_id,
            'act_name' : $("#txtName").val().trim(),
            'act_type' : $("#typeSelect").val(),
            'begin_time' : Math.round($("#dataBeginTime").datepicker("getDate").getTime() / 1000),
            'end_time' : Math.round($("#dataEndTime").datepicker("getDate").getTime()/1000),
            'image' : $("#actImage").val(),
            'description' : $("#txtDescription").val().trim()
        }, function(rtn) {
            $("#btnDoModify").text("修改").attr('disabled', false);

            if(!rtn.success) {
                alert("修改活动失败。请重试。")
            } else {
                $("#modifyDialog").modal("hide");
                CUR_ACT = null;
                window.location.href= $.__link_prefix__ + "admin/default/detail#"+rtn.data.act_id;
            }
        }, "json");
    }

</script>
{/literal}