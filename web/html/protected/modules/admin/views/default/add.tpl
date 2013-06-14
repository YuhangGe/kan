
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> 新建活动</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" action="/admin/default/add" method="post">
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
                    <div class="control-group" id="act-detail">
                        <label class="control-label" for="fileImage">活动海报</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileImage" type="file">
                            <span>
                                <img style="max-height: 200px; max-width: 200px; display: none;" alt="海报预览"/>
                                <span class="alert alert-info act-upload" style="position: relative; top: 5px;">上传海报后显示预览</span>

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
                    <div class="form-actions">
                        <button type="button" id="btnCreate" class="btn btn-primary">新建活动</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->

{*<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>*}
{*<script src="/ckeditor/adapters/jquery.js" type="text/javascript"></script>*}

{literal}
<script type="text/javascript">


    function createActive() {
        if($("#txtName").val()==="") {
            alert("请输入活动名称！");
            return;
        }
        if($("#actImage").val().trim()==="") {
            alert("请先上传海报！");
            return;
        }

        $("#btnCreate").text("正在处理...").attr('disabled', true);
        $.post("/admin/default/create", {
            'act_name' : $("#txtName").val().trim(),
            'act_type' : $("#typeSelect").val(),
            'begin_time' : Math.round($("#dataBeginTime").datepicker("getDate").getTime() / 1000),
            'end_time' : Math.round($("#dataEndTime").datepicker("getDate").getTime()/1000),
            'image' : $("#actImage").val(),
            'description' : $("#txtDescription").val().trim()
        }, function(rtn) {
            if(!rtn.success) {
                alert("新建活动失败。请重试。")
                $("#btnCreate").text("新建活动").attr('disabled', false);

            } else {
                noty({text: '新建活动成功！5秒后跳转到该活动页面。', layout:'topCenter', 'type' : 'success'});
                window.setTimeout(function() {
                    window.location.href = "/admin/default/detail#"+rtn.data.act_id;
                }, 5000);
            }

        }, "json");
    }

    function uploadImage() {
        var fs = $("#fileImage")[0].files;
        if(fs.length===0) {
            return;
        }
        $("#act-detail .act-upload").show().text("正在上传(0%)...");
        var img = fs[0];
        var fd = new FormData();
        fd.append("image_file", img);
        $.ajax({
            url: "/admin/upload/image",
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
            $("#act-detail .act-upload").text("正在上传("+Math.round(e.loaded/ e.total * 100)+"%)...");
        }
    }
    function showImage(rtn) {
        if(!rtn.success) {
            alert("上传失败，请重试。");
            $("#act-detail .act-upload").text("上传海报后显示预览");
        }
        $("#act-detail .act-upload").hide();
        $("#act-detail img").attr("src", rtn.data.image_url).show();
        $("#actImage").val(rtn.data.image_url);
    }

    function viewReady() {
        $("#btnCreate").click(createActive);
        $("#fileImage").change(uploadImage);
    }
</script>
{/literal}