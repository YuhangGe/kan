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
                    <table aoDataSource="/admin/table/starSelected" aoSortedBy="act_score" aoColumns="selected" class="table table-star-selected table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <th>昵称</th>
                            <th>喜欢</th>
                            <th>浏览</th>
                            <th>人气</th>
                            <th>海报</th>
                            <th>视频</th>
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
                    <table aoDataSource="/admin/table/starRank" aoSortedBy="act_score" aoColumns="rank" class="table table-star-rank table-striped table-bordered bootstrap-datatable datatable">
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
        <div class="box-content" id="score-search" style="min-height: 400px">
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
    <a class="btn btn-success" href="/admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        详情
    </a>
    <a class="btn btn-info" href="javascript:uploadPoster('USER_ID');">
    <i class="icon-edit icon-white"></i>
       海报
    </a>
    <a class="btn btn-info" href="javascript:showUploadVideo('USER_ID');">
        <i class="icon-edit icon-white"></i>
        视频
    </a>
    <a class="btn btn-danger" href="javascript:cancelStar('USER_ID');">
        <i class="icon-trash icon-white"></i>
        取消星客
    </a>
</div>

<div id="table-row-rank-template" style="display: none">
    <a class="btn btn-success" href="/admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    <a class="btn btn-info" href="javascript:chooseStar('USER_ID');">
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
        {*<a href="#" class="btn btn-primary">Save changes</a>*}
    </div>
</div>

<div class="modal hide fade" id="videoDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>上传视频</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="video-process">为星客上传视频节目</div>
        <div class="alert alert-warning">视频格式必须是mp4的h264格式，并且使用<a href='#'>qt-faststart（点击下载）</a>程序将视频文件进行头部转换，以支持边缓冲边播放！</div>
        <div class="control-group">
            <label class="control-label" for="fileImage">节目名称</label>
            <div class="controls">
                <input class="input-file uniform_on" id="txtVideoName" type="text">
            </div>
        </div>
        {*<div class="control-group">*}
            {*<label class="control-label" for="fileImage">视频预览</label>*}
            {*<div class="controls">*}
                {*<input class="input-file uniform_on" id="fileVideoPoster" type="file">*}
            {*</div>*}
        {*</div>*}
        <div class="control-group">
            <label class="control-label" for="fileImage">高清视频</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileBigVideo" type="file">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fileImage">普清视频</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileSmallVideo" type="file">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">取消</a>
        <a href="#" id="btnUploadVideo" class="btn btn-primary">上传</a>
    </div>
</div>
{literal}
    <script type="text/javascript">
        var SType = "act_name", CUR_ACT = null, CUR_USER = null;

        function viewStart() {
            window.aoColumns = {'selected' : [
                { "mData": "user_id"},
                { "mData": "user_name" },
                { "mData": "act_vote"
                },
                { "mData": "act_view"
                },
                { "mData": "act_score"},
                { "mData" : "poster_url", "mRender" : function(data) {
                    if(data===null) {
                        return "未上传"
                    } else {
                        return "<img style='max-width: 200px;max-height: 200px' src='"+data+"'/>";
                    }
                }},
                { "mData" : "video_id", "mRender" : function(data) {
                    if(data===null) {
                        return "未上传"
                    } else {
                        return "<a href='/admin/video/detail#"+data+"'>查看视频</a>";
                    }
                }},
                {
                    "mData" : "user_id",
                    "mRender" : function(data) {
                        return document.getElementById("table-row-selected-template").innerHTML.replace(/USER_ID/g, data);
                    }
                }
            ], "rank" : [
                { "mData": "user_id"},
                { "mData": "user_name" },
                { "mData": "act_vote"
                },
                { "mData": "act_view"
                },
                { "mData": "act_score"},

                {
                    "mData" : "user_id",
                    "mRender" : function(data) {
                        return document.getElementById("table-row-rank-template").innerHTML.replace(/USER_ID/g, data);
                    }
                }
            ]};
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
            $.post("/admin/default/search", {
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
            $("#fileImage").change(uploadImage);
            $("#btnUploadVideo").click(uploadVideo);
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

        function chooseStar(user_id) {
            $.post("/admin/star/choose", {
                user_id : user_id,
                act_id : CUR_ACT
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                $(".table-star-selected").DataTable().fnReloadAjax();
            }, "json");
        }

        function cancelStar(user_id) {
            $.post("/admin/star/cancel", {
                user_id : user_id,
                act_id : CUR_ACT
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                $(".table-star-selected").DataTable().fnReloadAjax();
            }, "json");
        }

        function uploadPoster(user_id) {
            CUR_USER = user_id;
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
            fd.append("user_id", CUR_USER);
            fd.append("act_id", CUR_ACT);

            $.ajax({
                url: "/admin/star/poster",
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
            $(".table-star-selected").DataTable().fnReloadAjax();
        }

        function showUploadVideo(user_id) {
            CUR_USER = user_id;
            $("#videoDialog").modal("show");
        }
        function uploadVideo() {
//            var ps = $("#fileVideoPoster")[0].files;
//            if(ps.length===0) {
//                alert("请选择视频的预览图片！");
//                return;
//            }
            var bf = $("#fileBigVideo")[0].files;
            if(bf.length===0) {
                alert("请选择要上传的高清视频！");
                return;
            }
            var sf = $("#fileSmallVideo")[0].files;
            if(sf.length===0) {
                alert("请选择要上传的普清视频！");
                return;
            }
            var v_n = $("#txtVideoName").val().trim();
            if(v_n==="") {
                alert("请输入节目名称！");
                return;
            }
            $("#video-process").show().text("正在上传(0%)...");

            var fd = new FormData();
//            fd.append("video_poster", ps[0]);
            fd.append("big_file", bf[0]);
            fd.append("small_file", sf[0]);
            fd.append("video_name", v_n);
            fd.append("user_id", CUR_USER);
            fd.append("act_id", CUR_ACT);

            $.ajax({
                url: "/admin/star/video",
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
                        myXhr.upload.addEventListener('progress', uploadVideoProcess, false); // for handling the progress of the upload
                    }
                    return myXhr;
                },
                success : afterVideo
            });
        }

        function uploadVideoProcess(e) {
            if(e.lengthComputable){
                $("#video-process").text("正在上传 ，请耐心等待("+Math.round(e.loaded/ e.total * 100)+"%)...");
            }
        }

        function afterVideo(rtn) {
            if(!rtn.success) {
                alert('网络错误，请重试。');
                return;
            }
            $("#video-process").text("为星客上传视频节目");
            $("#videoDialog").modal("hide");
            $(".table-star-selected").DataTable().fnReloadAjax();
        }
    </script>
{/literal}