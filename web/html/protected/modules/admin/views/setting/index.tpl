{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> 系统设置</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" action="{$link_prefix}admin/setting/save" method="post">
                <fieldset>


                    {if empty($setting['background'])}
                        {assign "bg_url" ""}
                    {else}
                        {assign "bg_url" $setting['background']}
                    {/if}
                    <div class="control-group" id="st-background">
                        <label class="control-label" for="fileImage">首页背景</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileImage" type="file">
                            <span>
                                <img style="max-height: 200px; max-width: 200px;" src="{$bg_url}" alt="海报预览"/>
                                <span class="alert alert-info st-upload hide" style="position: relative; top: 5px;">上传图片后显示预览</span>

                            </span>
                        </div>
                        <input type="hidden" name="stBg" id="stBg" value="{$bg_url}"/>
                    </div>
                    {if empty($setting['max_view_each_day'])}
                        {assign "max_view" 10}
                    {else}
                        {assign "max_view" $setting['max_view_each_day']}
                    {/if}
                    <div class="control-group">
                        <label class="control-label" for="stView">每日最大浏览量</label>
                        <div class="controls">
                            <input class="input focused" id="stView" type="text" value={$max_view}>
                            <span class="alert alert-info">说明：每个用户每天为某张照片最多贡献的点击量</span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="btnModify" class="btn btn-primary">提交修改</button>
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


        function modifySetting() {

            if($("#stBg").val().trim()==="") {
                alert("请先上传首页背景图片！");
                return;
            }
            if(!/\d+/.test($("#stView").val().trim())) {
                alert("每日最大浏览量请输入数字！")
                return;
            }

            $("#btnModify").text("正在处理...").attr('disabled', true);
            $.post($.__link_prefix__ + "admin/setting/save", {
                'setting' : {
                    'background' : $("#stBg").val().trim(),
                    'max_view_each_day' : $("#stView").val().trim()
                }
            }, function(rtn) {
                if(!rtn.success) {
                    alert("修改失败。请重试。")
                } else {
                    noty({text: '修改成功！', layout:'topCenter', 'type' : 'success', 'timeout' : 1000});
                }
                $("#btnModify").text("提交修改").attr('disabled', false);

            }, "json");
        }

        function uploadImage() {
            var fs = $("#fileImage")[0].files;
            if(fs.length===0) {
                return;
            }
            $("#st-background .st-upload").show().text("正在上传(0%)...");
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
                $("#st-background .st-upload").text("正在上传("+Math.round(e.loaded/ e.total * 100)+"%)...");
            }
        }
        function showImage(rtn) {
            if(!rtn.success) {
                alert("上传失败，请重试。");
            }
            $("#st-background .st-upload").hide();
            $("#st-background img").attr("src", rtn.data.image_url).show();
            $("#stBg").val(rtn.data.image_url);
        }

        function viewReady() {
            $("#btnModify").click(modifySetting);
            $("#fileImage").change(uploadImage);
        }
    </script>
{/literal}