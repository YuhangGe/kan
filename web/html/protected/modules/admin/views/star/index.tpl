{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
<div class="box span12">
    <div class="box-header well" data-original-title>
        <h2><i class="icon-font"></i> 所有演客</h2>
        <div class="box-icon">
            {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
            {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
        </div>
    </div>
    <div class="box-content" id="score-detail" style="min-height: 200px;">
        <table aoDataSource="{$link_prefix}admin/table/starAll" iDisplayLength="5" aoSortedBy="act_score" fnDrawCallback="selected" aoColumns="selected" class="table table-star-selected table-striped table-bordered bootstrap-datatable datatable">
            <thead>
            <tr>
                <td>ID</td>
                <th>昵称</th>
                <th>喜欢</th>
                <th>浏览</th>
                <th>人气</th>
                <th>海报</th>
                <th>获选日期</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
</div>
</div>

<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> 演客选拔</h2>
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
                    <div class="span4"><h2>活动标题   <small>活动类型</small></h2></div>
                    <div class="span8">2013年6月13日 - 2013年6月13日</div>
                </div>
                <hr/>
                <div class="row-fluid">
                    <h3>已选演客</h3>
                    <table aoDataSource="{$link_prefix}admin/table/starSelected" aoSortedBy="act_score" fnDrawCallback="selected" aoColumns="selected" class="table table-star-selected table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <th>昵称</th>
                            <th>喜欢</th>
                            <th>浏览</th>
                            <th>人气</th>
                            <th>海报</th>
                            <th>获选日期</th>
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
                    <table aoDataSource="{$link_prefix}admin/table/starRank" aoSortedBy="act_score" aoColumns="rank" class="table table-star-rank table-striped table-bordered bootstrap-datatable datatable">
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
    <a class="btn btn-success" href="{$link_prefix}admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        详情
    </a>
    <a class="btn btn-info" href="javascript:uploadPoster('USER_ID');">
    <i class="icon-edit icon-white"></i>
       海报
    </a>
    <a class="btn btn-info" href="javascript:showUploadVideo('USER_ID');">
        <i class="icon-edit icon-white"></i>
        上传视频
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/photo/index#uUSER_ID">
        <i class="icon-edit icon-white"></i>
        查看照片
    </a>
    <a class="btn btn-info" href="{$link_prefix}admin/video/user#USER_ID">
        <i class="icon-edit icon-white"></i>
        查看视频
    </a>
    <a class="btn btn-danger" href="javascript:cancelStar('USER_ID');">
        <i class="icon-trash icon-white"></i>
        取消演客
    </a>

</div>

<div id="table-row-rank-template" style="display: none">
    <a class="btn btn-success" href="{$link_prefix}admin/user/detail#USER_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看详情
    </a>
    <a class="btn btn-info" href="javascript:chooseStar('STAR_ID');">
        <i class="icon-edit icon-white"></i>
        选为演客
    </a>
    <a class="btn btn-info" href="javascript:modifyHot('USER_ID');">
        <i class="icon-edit icon-white"></i>
        修改人气
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
        <div class="alert alert-info" id="poster-process" style="position: relative; top: 5px;">为演客上传获奖海报</div>

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


<div class="modal hide fade" id="hotDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>修改人气</h3>
    </div>
    <div class="modal-body">
        <div class="control-group">
            <label class="control-label" for="txtVote">喜欢</label>
            <div class="controls">
                <input class="input-file uniform_on" id="txtVote" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="txtView">浏览</label>
            <div class="controls">
                <input class="input-file uniform_on" id="txtView" type="text">
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">取消</a>
            <a href="#" id="btnModifyHot" class="btn btn-primary">修改</a>
    </div>

</div>


<div class="modal hide fade" id="videoDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>上传视频</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="video-process">为演客上传视频节目。如果是优酷一类的网站不区分高清和普清地址，则只要简单的给两个相同的地址就行了。</div>
        <div class="control-group">
            <label class="control-label" for="fileImage">节目名称</label>
            <div class="controls">
                <input class="input-file uniform_on" id="txtVideoName" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fileImage">视频海报</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileVideoPoster" type="file">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fileImage">高清视频</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileBigVideo">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fileImage">普清视频</label>
            <div class="controls">
                <input class="input-file uniform_on" id="fileSmallVideo">
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
    USER_ID = null;
    function modifyHot(id) {
        var rs = $(".table-star-rank tbody tr");
        var cr = null;
        for(var i=0;i<rs.length;i++) {
            var _r = $(rs[i]), _d = _r.find("td:first");
            if(_d.text().trim() === id) {
                cr = _r;
                break;
            }
        }
        if(cr === null) {
            alert("出现错误，请刷新网页重试.");
            return;
        }
        USER_ID = id;
        var tds = cr.find("td");
        var name = tds.eq(1).text(), vote=tds.eq(2).text(), view=tds.eq(3).text();
        $("#hotDialog h3").text("修改 " + name + " 的人气指数");
        $("#txtVote").val(vote.trim());
        $("#txtView").val(view.trim());
        $("#hotDialog").modal("show");
    }

    function doModifyHot() {
        var vote = $("#txtVote").val().trim(), view = $("#txtView").val().trim();
        if(/^\d+$/.test(vote) && /^\d+$/.test(view)) {
            $.post($.__link_prefix__ +"admin/photo/modifyHot", {
                user_id : USER_ID,
                act_id : CUR_ACT,
                vote_number : vote,
                view_number : view
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试！');
                    return;
                }
                $(".datatable").each(function(){
                    $(this).DataTable().fnDraw();
                });
                $("#hotDialog").modal("hide");

            }, "json");
        } else {
            alert("数据不合法！");
            return;
        }
    }
</script>
{/literal}

{literal}
    <script type="text/javascript">
        var SType = "act_name", CUR_ACT = null, CUR_USER = null;

        function viewStart() {
            window.fnDrawCallback = {
                'selected' : function() {
                    $.colorbox.remove();
                    $(".poster_image").colorbox({transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
                }
            };
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
                        return "<a class='poster_image' href='"+data+"'/>查看图片</a>";
                    }
                }},
                { "mData" : "time", "mRender" : function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
                }},
                {
                    "mData" : "user_id",
                    "mRender" : function(data) {
                        return document.getElementById("table-row-selected-template").innerHTML.replace(/USER_ID/g, data===null? "-1" :data);
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
                    "mData" : "star_id",
                    "mRender" : function(data, type, aoData) {
                        var rtn = document.getElementById("table-row-rank-template").innerHTML.replace(/STAR_ID/g, data===null?aoData.user_id:"-1");
                        return rtn.replace(/USER_ID/g, aoData.user_id);
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
            $.post( $.__link_prefix__ +"admin/default/search", {
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
                    $("<li></li>").html("<a href='"+$.__link_prefix__ +"admin/star/index#"+act.act_id+"'>"+act.act_name+"</a>")
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
            $("#btnModifyHot").click(doModifyHot);
            $("#btnUploadVideo").click(uploadVideo);
        }

        function showActive(id) {
            $(".dataTables_info").hide();
            $.post($.__link_prefix__+"admin/default/getDetail", {
                'act_id' : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert("网络错误，请重试。");
                    return;
                }
                var act = rtn.data, TYPE = ['表演', '才艺','简历'];
                $("#score-detail .alert").hide();
                $("#score-detail .score-content").show();
                $("#score-detail .score-info .span4 h2").html(act.act_name+"<small style='margin-left: 10px;'>"+TYPE[Number(act.act_type)]+"</small>");
                $("#score-detail .score-info .span9").text(
                        $.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.begin_time)*1000))
                      + " - "
                      + $.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.end_time)*1000))
                );
                CUR_ACT = act.act_id;
                $(".datatable").each(function(){
                    $(this).DataTable().fnDraw();
                });

            }, 'json');
        }

        function viewTableParams(aoData) {
            if(CUR_ACT!==null) {
                aoData.push({'name' : 'act_id' , 'value' : CUR_ACT});
            }
        }

        function chooseStar(user_id) {
            if(user_id==="-1") {
                alert("已经是星客！");
                return;
            }
            $.post($.__link_prefix__ + "admin/star/choose", {
                user_id : user_id,
                act_id : CUR_ACT
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                reloadStarSelected();

            }, "json");
        }

        function cancelStar(user_id) {
            $.post($.__link_prefix__ + "admin/star/cancel", {
                user_id : user_id,
                act_id : CUR_ACT
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试.');
                    return;
                }
                reloadStarSelected();

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
                url: $.__link_prefix__ + "admin/star/poster",
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
        function showUploadVideo(user_id) {
            CUR_USER = user_id;
            $("#videoDialog").modal("show");
        }
        function uploadVideo() {
            var ps = $("#fileVideoPoster")[0].files;
            if(ps.length===0) {
                alert("请选择视频的预览图片！");
                return;
            }
            var bf = $("#fileBigVideo").val().trim();
            if(bf.length===0) {
                alert("请选择要上传的高清视频！");
                return;
            }
            var sf = $("#fileSmallVideo").val().trim();
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
            fd.append("video_poster", ps[0]);
            fd.append("video_big_url", bf);
            fd.append("video_small_url", sf);
            fd.append("video_name", v_n);
            fd.append("user_id", CUR_USER);
            fd.append("act_id", CUR_ACT);

            $.ajax({
                url: $.__link_prefix__ + "admin/star/video",
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
            alert("上传成功，将跳转到用户视频管理页面。");
            window.location.href = $.__link_prefix__ + "admin/video/user#"+CUR_USER;

//            $(".table-star-selected").DataTable().fnDraw();
        }
    </script>
{/literal}