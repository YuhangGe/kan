{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 视频</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="{$link_prefix}admin/table/video" aoColumns="video" fnDrawCallback="video" class="table table-video table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>节目名称</th>
                    <th>所属星客</th>
                    <th>所属活动</th>
                    <th>上传时间</th>
                    <th>视频海报</th>
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
    <a class="btn btn-success" href="{$link_prefix}admin/video/detail#VIDEO_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看视频
    </a>
    <a class="btn btn-info" href="javascript:uploadPoster('VIDEO_ID');">
        <i class="icon-edit icon-white"></i>
        上传海报
    </a>
    <a class="btn btn-danger" href="javascript:delVideo('VIDEO_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>

<div class="modal hide fade" id="posterDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>上传海报</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="poster-process" style="position: relative; top: 5px;">为视频上传海报</div>

        <div class="control-group" id="act-detail">
            <label class="control-label" for="fileImage">上传海报</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileImage" type="file">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">取消</a>
        {*<a href="#" class="btn btn-primary">Save changes</a>*}
    </div>
</div>

{literal}

    <script type="text/javascript">

        CUR_VIDEO = 0;

        function viewStart() {
            window.fnDrawCallback = {
                'video' : function() {
                    $.colorbox.remove();
                    $(".poster_image").colorbox({transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
                }
            };
                        window.aoColumns = {'video' : [
                            { "mData": "video_id"},
                            { "mData": "video_name" },
                            { "mData": "user_name", "mRender" : function(data, type, ooData) {
                                return "<a href='"+ $.__link_prefix__ + "admin/user/detail#"+ooData['user_id']+"'>"+data+"</a>";
                            }
                            },
                            { "mData": "act_name", "mRender" : function(data, type, ooData) {
                                return "<a href='"+ $.__link_prefix__ +"admin/default/detail#"+ooData['act_id']+"'>"+data+"</a>";
                            }
                            },
                            { "mData": "upload_time","mRender": function(data) {
                                return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
                            }
                            },
                            { "mData": "poster_url","mRender": function(data) {
                                if(data===null || data.trim() === "") {
                                    return "未上传";
                                } else {
                                    return "<a class='poster_image' href='"+data+"'>查看图片</a>";
                                }
                            }
                            },
                            {
                                "mData" : "video_id",
                                "mRender" : function(data) {
                                    return  document.getElementById("table-edit-row-template").innerHTML.replace(/VIDEO_ID/g, data);
                                }
                            }
                        ]};

        }


        function delVideo(id) {
            if(confirm("确认删除视频？", "删除")) {
                $.log("del:"+id);
            }
        }

        function viewReady() {
            $("#fileImage").change(uploadImage);
        }
        function uploadPoster(video_id) {
            CUR_VIDEO = video_id;
            $("#posterDialog").modal("show");
        }
        function uploadImage() {
            var fs = $("#fileImage")[0].files;
            if(fs.length===0) {
                return;
            }
            $("#poster-process").show().text("正在上传(0%)...");
            var img = fs[0];
            var fd = new FormData();
            fd.append("image_file", img);
            fd.append("video_id", CUR_VIDEO);

            $.ajax({
                url: $.__link_prefix__ + "/admin/video/poster",
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
                $("#poster-process").text("正在上传("+Math.round(e.loaded/ e.total * 100)+"%)...");
            }
        }

        function showImage(rtn) {
            if(!rtn.success) {
                alert('网络错误，请重试。');
                return;
            }
            $("#posterDialog").modal("hide");
            $(".table-video").DataTable().fnDraw();

        }

        function delVideo(id) {
            var pwd = prompt("请输入管理员密码确认删除");
            if(pwd.trim()==="") {
                return;
            }
            $.post($.__link_prefix__+"admin/video/delete", {
                password : pwd,
                video_id : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert('删除失败！');
                    return;
                }
                alert("删除成功");
                $(".table-video").DataTable().fnDraw();
            }, "json");
        }

    </script>

{/literal}


