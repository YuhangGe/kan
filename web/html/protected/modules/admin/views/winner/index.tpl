{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 已选星客</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="{$link_prefix}admin/table/winnerSelected" aoColumns="selected" fnDrawCallback="selected" class="table table-striped table-star-selected table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>昵称</th>
                    <th>获奖海报</th>
                    <th>获奖视频</th>
                    <th>获奖时间</th>
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
    </div><!--/span-->
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> 视频人气</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <table aoDataSource="{$link_prefix}admin/table/winnerRank" aoColumns="rank" fnDrawCallback="rank" class="table table-striped table-star-rank table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>视频名称</th>
                    <th>所属演客</th>
                    <th>上传时间</th>
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
    </div><!--/span-->
</div>


<div id="table-row-selected-template" style="display: none">

    <a class="btn btn-info" href="javascript:uploadPoster('VIDEO_ID');">
        <i class="icon-edit icon-white"></i>
        上传海报
    </a>

    <a class="btn btn-danger" href="javascript:cancelStar('VIDEO_ID');">
        <i class="icon-trash icon-white"></i>
        取消星客
    </a>
</div>

<div id="table-row-rank-template" style="display: none">

    <a class="btn btn-info" href="javascript:chooseStar('VIDEO_ID');">
        <i class="icon-edit icon-white"></i>
        选为星客
    </a>
    {*<a class="btn btn-danger edit-del" href="javascript:delActive('USER_ID');">*}
        {*<i class="icon-trash icon-white"></i>*}
        {**}
    {*</a>*}
</div>

<div class="modal hide fade" id="posterDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>上传海报</h3>
    </div>
    <div class="modal-body">
        <input type="hidden" value="0" id="poster-video-id">
        <div class="alert alert-info" id="poster-process" style="position: relative; top: 5px;">为星客上传获奖海报</div>

        <div class="control-group" id="act-detail">
            <label class="control-label" for="fileImage">上传海报</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileImage" type="file">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">取消</a>
        <a href="#" class="btn btn-primary">上传</a>
    </div>
</div>

{literal}
    <script type="text/javascript">

        function viewStart() {
            window.fnDrawCallback = {
                'selected' : function() {
                    $.colorbox.remove();
                    $(".poster_image").colorbox({transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
                }
            };
            window.aoColumns = {'selected' : [
                { "mData": "video_id"},
                { "mData": "user_name"},
                { "mData" : "winner_poster", "mRender" : function(data) {
                    if(data===null) {
                        return "未上传"
                    } else {
                        return "<a class='poster_image' href='"+data+"'/>查看图片</a>";
                    }
                }},
                { "mData" : "video_name"},
                { "mData" : "time", "mRender" : function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));

                }},
                { "mData": "vote_number"
                },
                { "mData": "view_number"
                },
                { "mData": "score"},


                {
                    "mData" : "video_id",
                    "mRender" : function(data) {
                        return document.getElementById("table-row-selected-template").innerHTML.replace(/VIDEO_ID/g, data);
                    }
                }
            ], "rank" : [
                { "mData": "video_id"},
                { "mData": "video_name"},

                { "mData": "user_name" },
                { "mData" : "upload_time", "mRender" : function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));

                }},
                { "mData": "vote_number"
                },
                { "mData": "view_number"
                },
                { "mData": "score"},


                {
                    "mData" : "winner_id",
                    "mRender" : function(data, type, aoData) {
                        return document.getElementById("table-row-rank-template").innerHTML.replace(/VIDEO_ID/g, data===null?aoData.video_id:"-1");
                    }
                }
            ]};
        }

        /*
         * 当框架已经全部加载好后会调用这个函数，初始化与当前页面有关的东西
         */
        function viewReady(){
            $("#fileImage").change(uploadImage);
        }

        function chooseStar(video_id) {
            if(video_id==="-1") {
                alert("已经是星客！");
                return;
            }
            $.post($.__link_prefix__ + "admin/winner/choose", {
                video_id : video_id
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                reloadStarSelected();

            }, "json");
        }

        function cancelStar(video_id) {
            $.post($.__link_prefix__ + "admin/winner/cancel", {
                video_id : video_id
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                reloadStarSelected();

            }, "json");
        }

        function uploadPoster(video_id) {
            $("#poster-video-id").val(video_id);
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
            fd.append("video_id", $("#poster-video-id").val());

            $.ajax({
                url: $.__link_prefix__ + "admin/winner/poster",
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
            reloadStarSelected();
        }

        function reloadStarSelected() {
            $(".table-star-selected").DataTable().fnDraw();

        }
    </script>
{/literal}