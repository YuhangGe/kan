{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> 客户端设置</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" action="{$link_prefix}admin/app/save" method="post">
                <fieldset>


                    <div class="control-group" id="app-apk">
                        <label class="control-label" for="fileApk">上传安卓客户端</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileApk" type="file">
                            <button type="button" id="btnApk" class="btn btn-primary">上传</button>
                            <span class="alert alert-info apk-upload">上传新版本apk文件</span>

                        </div>
                        {if empty($setting['apk_version'])}
                            {assign "apk_version" "1.0.0"}
                        {else}
                            {assign "apk_version" $setting['apk_version']}
                        {/if}
                        <label class="control-label" for="apkVersion">设置客户端版本</label>
                        <div class="controls">
                            <input class="input-large" id="apkVersion" value="{$apk_version}">
                            <button type="button" id="btnVersion" class="btn btn-primary">修改</button>
                            <span class="alert alert-info" >设置下载页面用户看到的安卓客户端版本</span>

                        </div>
                        {if empty($setting['apk_download_number'])}
                            {assign "apk_download_number" "0"}
                        {else}
                            {assign "apk_download_number" $setting['apk_download_number']}
                        {/if}
                        <label class="control-label" for="apkNumber">设置客户端下载量</label>
                        <div class="controls">
                            <input class="input-large" id="apkNumber" value="{$apk_download_number}">
                            <button type="button" id="btnNumber" class="btn btn-primary">修改</button>
                            <span class="alert alert-info" >设置下载页面用户看到的安卓客户端的下载量</span>

                        </div>
                    </div>
                    <style>
                        .controls {
                            margin-bottom: 10px;
                        }
                        .alert{
                            position: relative;
                            top: 2px;
                        }
                        .input-large {
                            width: 180px;
                            margin-right: 5px;
                        }
                    </style>
                </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->

{literal}
<script type="text/javascript">
    function uploadApk() {
        var fs = $("#fileApk")[0].files;
        if(fs.length===0) {
            alert("请选择文件！");
            return;
        }
        var img = fs[0];
        if(!/\.apk$/.test(img.name)) {
            alert("只能上传.apk文件！");
           return;
        }
        var fd = new FormData();
        fd.append("apk_file", img);
        $("#app-apk .apk-upload").show().text("正在上传(0%)...");
        $("#btnApk").attr("disabled", true);

        $.ajax({
            url: $.__link_prefix__ + "admin/upload/apk",
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
                    myXhr.upload.addEventListener('progress', uploadApkProcess, false); // for handling the progress of the upload
                }
                return myXhr;
            },
            success : showApk
        });
    }

    function uploadApkProcess(e) {
        if(e.lengthComputable){
            $("#app-apk .apk-upload").text("正在上传("+Math.round(e.loaded/ e.total * 100)+"%)...");
        }
    }

    function showApk(rtn) {
        if(rtn.success!==true) {
            alert("网络错误，请重试！");
        } else {
            noty({text: '上传成功！', layout:'topCenter', 'type' : 'success', 'timeout' : 1000});
        }
        $("#app-apk .apk-upload").text("上传成功！");
        $("#btnApk").attr("disabled", false);
    }

    function viewReady() {
        $("#btnApk").click(uploadApk);
        $("#btnVersion").click(setApkVersion);
        $("#btnNumber").click(setApkDownloadNuber);
    }

    function setApkVersion() {
        var v = $("#apkVersion").val().trim();
        if(v==="" || /^\d+(\.\d+)*$/.test(v)===false) {
            alert("请输入正确的版本号。比如 1.3.4 ");
            return;
        }
        $.post($.__link_prefix__ + "admin/setting/save", {
            setting: {
                'apk_version' : v
            }
        }, function(rtn) {
            if(!rtn.success) {
                alert("修改失败。请重试。")
            } else {
                noty({text: '修改成功！', layout:'topCenter', 'type' : 'success', 'timeout' : 1000});
            }
        }, "json");
    }
    function setApkDownloadNuber() {
        var v = $("#apkNumber").val().trim();
        if(v==="" || /^\d+$/.test(v)===false) {
            alert("请输入正确的下载量，应该是一个数字。");
            return;
        }
        $.post($.__link_prefix__ + "admin/setting/save", {
            setting: {
                'apk_download_number' : v
            }
        }, function(rtn) {
            if(!rtn.success) {
                alert("修改失败。请重试。")
            } else {
                noty({text: '修改成功！', layout:'topCenter', 'type' : 'success', 'timeout' : 1000});
            }
        }, "json");
    }
</script>
{/literal}