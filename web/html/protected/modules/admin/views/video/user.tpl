{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> <span id="user-title">用户视频</span></h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content" id="user-detail" style="min-height: 400px;">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span>没有选择用户。请在右边查找用户然后查看详情。</span>
            </div>
            <div id="user-content" class="row-fluid hide user-content">
                <div>
                    <a class="btn btn-info" style="float: right; margin-right: 20px;" href="javascript:postVideo();">上传新视频</a>
                </div>
                <table aoDataSource="{$link_prefix}admin/table/userVideo" aoAutoLoad="false" aoColumns="video" fnDrawCallback="video" class="table table-video table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <th>节目名称</th>
                        <th>所属演客</th>
                        {*<th>所属活动</th>*}
                        <th>上传时间</th>
                        <th>视频海报</th>
                        <th>获奖</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>

        </div>
    </div><!--/span-->

    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>查找用户</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="user-search" style="min-height: 400px">
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchOption" id="nameRadio" value="name" checked="">
                        用户昵称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchOption" id="idRadio" value="id">
                        用户ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
                        </div>
                    </div>
                    <div class="alert alert-error user-require hide">
                        {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                        <span>请输入搜索内容！</span>
                    </div>
                </div>
            </div>

            <div class="alert alert-error user-result hide">
                {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                <span>没有符合条件的用户！</span>
            </div>
            <ul>

            </ul>


            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div>


<div id="table-edit-row-template" style="display: none">
    <a class="btn btn-success" href="{$link_prefix}admin/video/detail#VIDEO_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看视频
    </a>
    <a class="btn btn-info" href="javascript:modifyVideo('VIDEO_ID');">
        <i class="icon-edit icon-white"></i>
        编辑
    </a>
    <a class="btn btn-info" href="javascript:STAR_OP('VIDEO_ID');">
        <i class="icon-edit icon-white"></i>
        STAR_NAME
    </a>
    <a class="btn btn-danger" href="javascript:delVideo('VIDEO_ID');">
      <i class="icon-trash icon-white"></i>
      删除
    </a>
</div>


<div class="modal hide fade" id="videoDialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>上传视频</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="video-process">为演客上传视频节目。如果是优酷一类的网站不区分高清和普清地址，则只要简单的给两个相同的地址就行了。</div>
        <div class="control-group" id="divSelect">
            <label class="control-label" for="selectAct">选择活动</label>
            <div class="controls" id="selectActCon">
                {*<select id="selectAct">*}
                    {*<option>Option 1</option>*}
                    {*<option>Option 2</option>*}
                    {*<option>Option 3</option>*}
                    {*<option>Option 4</option>*}
                    {*<option>Option 5</option>*}
                {*</select>*}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="txtVideoName">节目名称</label>
            <div class="controls">
                <input class="input-file uniform_on" id="txtVideoName" type="text">
            </div>
        </div>
        <div class="control-group" id="divTime">
            <label class="control-label" for="uploadTime">上传日期</label>
            <div class="controls">
                <input type="text" class="input-xlarge datepicker" id="uploadTime" value="{$smarty.now|date_format:"%Y-%m-%d"}">
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
    VIDEO_ID = null;
    ACT_ID = null;

    function viewTableParams(aoData) {
        if(USER_ID!==null) {
            aoData.push({'name' : 'user_id' , 'value' : USER_ID});
        }
    }
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
//            { "mData": "act_name", "mRender" : function(data, type, ooData) {
//                return "<a href='"+ $.__link_prefix__ +"admin/default/detail#"+ooData['act_id']+"'>"+data+"</a>";
//            }
//            },
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
                "mData" : "is_winner", "mRender" : function(data) {
                    return data==='1' ? "是" : "否";
                }
            }
            ,
            {
                "mData" : "video_id",
                "mRender" : function(data, type, aoData) {
                    var rtn =  document.getElementById("table-edit-row-template").innerHTML.replace(/VIDEO_ID/g, data);
                    rtn = rtn.replace(/STAR_OP/g, aoData.is_winner==='1' ? "cancelStar" : "chooseStar");
                    rtn = rtn.replace(/STAR_NAME/g, aoData.is_winner === '1' ? '取消获奖' : "选为获奖");
                    return rtn;
                }
            }
        ]};

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
            $(".table-video").DataTable().fnDraw();

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
            $(".table-video").DataTable().fnDraw();
        }, "json");
    }


    function modifyVideo(id) {
        var rs = $(".table-video tbody tr");
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
        VIDEO_ID = id;
        var tds = cr.find("td");
        var name = tds.eq(1).text();
        var tm = tds.eq(3).text().trim(), ms = tm.match(/(\d+)年(\d+)月(\d)+日/);

        $("#txtVideoName").val(name);
        $("#uploadTime").val(ms[1]+"-"+ms[2]+"-"+ms[3]);
        $("#videoDialog h3").text("编辑视频 - " + name);
        $("#divSelect").hide();
        $("#divTime").show();
        $("#videoDialog").modal("show");
    }
    function postVideo() {
        if(USER_ID===null) {
            alert("出现错误，请刷新网页重试.");
            return;
        }
        if(ACT_ID==null || Number(ACT_ID)<0) {
            alert("当前用户还不是演客，不能给他上传视频。");
            return;
        }
        VIDEO_ID = null;
        var d = new Date();
        $("#divSelect").show();
        $("#divTime").hide();
        $("#txtVideoName").val();
        $("#uploadTime").val(d.getFullYear()+"-"+ (d.getMonth()+1)+"-"+ d.getDate());
        $("#videoDialog h3").text("上传新视频");
        $("#videoDialog").modal("show");
    }
</script>
{/literal}

{literal}
    <script type="text/javascript">
        var SType = "nick_name";
        function setSearchType() {
            if($("#nameRadio").parent().hasClass("checked")) {
                SType = "nick_name";
            } else if($("#idRadio").parent().hasClass("checked")){
                SType = "user_id";
            } else {
                throw "unknown type";
            }

        }
        function doSearch() {
            $("#user-search .alert").hide();

            var _v = $("#txtValue").val().trim();
            if(_v==="") {
                $("#user-search .user-require").show();
                return;
            }
            $.post($.__link_prefix__ + "admin/user/search", {
                search_type : SType,
                search_value : _v
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试！');
                    return;
                }
                $("#user-search .alert").hide();

                var _u = $("#user-search ul").html("");
                var list = rtn.data;
                if(list.length===0) {
                    $("#user-search .user-result").show();
                }
                for(var i=0;i<list.length;i++) {
                    var user = list[i];
                    $("<li></li>").html("<a href='"+$.__link_prefix__ + "admin/video/user#"+user.user_id+"'>"+user.nick_name+"</a>")
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
                    showVideo(id);
                }
            }).start();

            $("#nameRadio").change(setSearchType);
            $("#idRadio").change(setSearchType);
            $("#btnSearch").click(doSearch);
            $("#btnUploadVideo").click(uploadVideo);

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

            var u_t = $("#uploadTime").val().trim();
            if(!/^\d+\-\d+\-\d+$/.test(u_t)) {
                alert("请设置节目上传时间！");
                return;
            }
            $("#video-process").show().text("正在上传(0%)...");

            ACT_ID = $("#selectAct").val();

            var fd = new FormData();
            fd.append("video_poster", ps[0]);
            fd.append("video_big_url", bf);
            fd.append("video_small_url", sf);
            fd.append("video_name", v_n);
            fd.append("user_id", USER_ID);
            fd.append("act_id", ACT_ID);

            if(VIDEO_ID!==null) {
                fd.append("upload_time", u_t);
                fd.append("video_id", VIDEO_ID);
            }
            $.ajax({
                url: $.__link_prefix__ + (VIDEO_ID!==null ? "admin/video/modify" : "admin/star/video"),
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
            $(".table-video").DataTable().fnDraw();
        }

        function showVideo(id) {
            USER_ID = id;
            $.post($.__link_prefix__ + "admin/user/info", {
                user_id : id
            }, function(rtn) {
                if(rtn.success!==true) {
                    alert("出现网络错误，请刷新网页！");
                    return;
                }
                var la = Number(rtn.data.last_active);
                if(la<0) {
                    ACT_ID = -1;
                } else {
                    ACT_ID = la;
                    var _sel = $("<select id='selectAct' data-rel='chosen' style='width: 280px;'></select>");
                    for(var i=0;i<rtn.data.star_active_list.length;i++) {
                        var _a = rtn.data.star_active_list[i];
                        $("<option value='"+_a.act_id+"'>"+_a.act_name+"</option>").appendTo(_sel);
                    }
                    _sel.appendTo($("#selectActCon").html(""));
                    _sel.chosen();
                }
                $("#user-title").text(rtn.data.nick_name + " 的视频");
                $("#user-detail .alert").hide();
                $("#user-content").show();
                $(".datatable").DataTable().fnDraw();
            }, 'json');

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