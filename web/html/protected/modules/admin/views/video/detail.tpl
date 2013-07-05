{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-font"></i> 视频详情</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content" id="video-detail" style="min-height: 400px;">
            <div class="alert alert-info alert-video">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <span>没有选择视频。请在右边查找视频然后查看详情。</span>
            </div>
            <div class="row-fluid hide video-content">
                <div class="page-header">
                    <h3>节目标题</h3>
                </div>
                <div class="video-time row-fluid">
                    <div class="span2"><strong>上传时间</strong></div>
                    <div class="span10">xxx</div>
                </div>
                <div class="video-user row-fluid">
                    <div class="span2"><strong>所属星客</strong></div>
                    <div class="span10">白羊座小葛</div>
                </div>
                <div class="video-act row-fluid">
                    <div class="span2"><strong>所属活动</strong></div>
                    <div class="span10">那些花儿海选</div>
                </div>
                <div class="video-poster row-fluid">
                    <div class="span2"><strong>视频海报</strong></div>
                    <div class="span10">未上传</div>
                </div>
                <hr/>
                <div class="row-fluid">
                    <div class="span2"><strong>视频</strong></div>
                    <div class="span6 my_player">
                        <div>
                            <label class="radio">
                                <input type="radio" name="hdOption" id="bigVideoRadio" value="big" checked="">
                                高清
                            </label>
                            <label class="radio">
                                <input type="radio" name="hdOption" id="smallVideoRadio" value="small">
                                普清
                            </label>
                        </div>
                        <div id="video_player_container">
                            <video id="video_player" class="video-js vjs-default-skin"
                                   controls preload="auto">
                                {*<source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />*}
                                {*<source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />*}
                                {*<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />*}
                            </video>
                        </div>
                    </div>
                    <div class="span6 other_player hide">
                        <div class="alert alert-info">当前视频为第三方视频，点击打开视频查看。</div>
                        <a href="javascript:;" onclick="openVideo();">打开视频</a>
                    </div>
                </div>

            </div>
            <style>
                .video-content {
                    padding-left: 15px;
                }
            </style>
        </div>

    </div><!--/span-->

    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>查找视频节目</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="video-search" style="min-height: 400px">
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchOption" id="nameRadio" value="name" checked="">
                        节目名称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchOption" id="idRadio" value="id">
                        节目ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
                        </div>
                    </div>
                    <div class="alert alert-error video-require hide">
                        {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                        <span>请输入搜索内容！</span>
                    </div>
                </div>
            </div>

            <div class="alert alert-error video-result hide">
                {*<button type="button" class="close" data-dismiss="alert">×</button>*}
                <span>没有符合条件的视频！</span>
            </div>
            <ul>

            </ul>


            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div>

<link href="{$url_prefix}video-js/video-js.css" rel="stylesheet">
<script src="{$url_prefix}video-js/video.dev.js"></script>
<script>
    videojs.options.flash.swf = "{$url_prefix}video-js/video-js.swf"
    video_player = null;
    vp = null;
</script>

{literal}
    <script type="text/javascript">
        var VideoURL = {
            'big' : "",
            'small' : ""
        };
        var SType = "video_name";
        function setSearchType() {
            if($("#nameRadio").parent().hasClass("checked")) {
                SType = "video_name";
            } else if($("#idRadio").parent().hasClass("checked")){
                SType = "video_id";
            } else {
                throw "unknown type";
            }

        }
        function loadVideo(url) {
            if(!/\.mp4$/.test(url)) {
                $(".other_player a").attr("onclick", "openVideo('"+url+"');");
                $(".other_player").show();
                $(".my_player").hide();
                return;
            } else {
                $(".other_player").hide();
                $(".my_player").show();
            }
            if(vp===null) {
                vp = videojs("video_player", {'width':500, 'height':375});
                vp.src({type:'video/mp4', src : url});

            } else {
                vp.pause();
                vp.bigPlayButton.show();
                window.setTimeout(function() {
                    vp.src({type:'video/mp4', src : url});
                }, 100);
            }


        }
        function setVideoType() {
            if($("#bigVideoRadio").parent().hasClass("checked")) {
                 loadVideo(VideoURL.big);
            } else if($("#smallVideoRadio").parent().hasClass("checked")){
                loadVideo(VideoURL.small);
            }


        }
        function doSearch() {
            $("#video-search .alert").hide();

            var _v = $("#txtValue").val().trim();
            if(_v==="") {
                $("#video-search .video-require").show();
                return;
            }
            $.post($.__link_prefix__ + "admin/video/search", {
                search_type : SType,
                search_value : _v
            }, function(rtn) {
                if(!rtn.success) {
                    alert('网络错误，请重试！');
                    return;
                }
                $("#video-search .alert").hide();

                var _u = $("#video-search ul").html("");
                var list = rtn.data;
                if(list.length===0) {
                    $("#video-search .video-result").show();
                }
                for(var i=0;i<list.length;i++) {
                    var act = list[i];
                    $("<li></li>").html("<a href='"+$.__link_prefix__ + "admin/video/detail#"+act.video_id+"'>"+act.video_name+"</a>")
                            .appendTo(_u);
                }
            }, "json");
        }
        /*
         * 当框架已经全部加载好后会调用这个函数，初始化与当前页面有关的东西
         */
        function viewReady(){
            video_player = $("#video_player_container");
            vp = null;
            $.Router.register({
                "\\d+" : function(id) {
                    showVideo(id);
                }
            }).start();

            $("#nameRadio").change(setSearchType);
            $("#idRadio").change(setSearchType);
            $("#bigVideoRadio").change(setVideoType);
            $("#smallVideoRadio").change(setVideoType);

            $("#btnSearch").click(doSearch);
        }

        function showVideo(id) {
            $.post($.__link_prefix__ + "admin/video/getDetail", {
                'video_id' : id
            }, function(rtn) {
                if(!rtn.success) {
                    alert("网络错误，请重试。");
                    return;
                }
                var act = rtn.data;
                $("#video-detail .alert-video").hide();
                $("#video-detail .video-content").show();
                $("#video-detail .page-header h3").html(act.video_name);
                $("#video-detail .video-time .span10").text($.datepicker.formatDate("yy年mm月dd日", new Date(Number(act.upload_time)*1000)));
                $("#video-detail .video-poster .span10").html(
                    act.poster_url === null || act.poster_url.trim()==="" ? "未上传" : "<img style='max-width: 300px;max-height: 300px' src='"+act.poster_url+"'/>"
                );
                $("#video-detail .video-user .span10").html("<a href='"+$.__link_prefix__ + "admin/user/detail#"+act.user_id+"'>"+act.user_name+"</a>");
                $("#video-detail .video-act .span10").html("<a href='"+$.__link_prefix__ + "admin/default/detail#"+act.act_id+"'>"+act.act_name+"</a>");

                VideoURL.big = act.big_url;
                VideoURL.small = act.small_url;

                loadVideo(act.big_url);
            }, 'json');
        }

        function openVideo(url) {
            window.location.href=url;
        }
    </script>
{/literal}