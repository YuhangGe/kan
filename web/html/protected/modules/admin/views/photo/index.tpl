{assign 'url_prefix' $Yii->params['url_prefix']}
{assign 'link_prefix' $Yii->params['link_prefix']}


<div class="row-fluid sortable">
    <div class="box span9">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> <span id="photo-title">所有图片</span></h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">
            <div id="no-photo-tip" class="alert alert-info">当前没有满足条件的照片</div>
            <ul class="thumbnails gallery" style="min-height: 400px;">

                {*<li id="image-<?php echo $i ?>" class="thumbnail">*}
                    {*<a style="background:url(img/gallery/thumbs/<?php echo $i ?>.jpg)" title="Sample Image <?php echo $i ?>" href="img/gallery/<?php echo $i ?>.jpg"><img class="grayscale" src="img/gallery/thumbs/<?php echo $i ?>.jpg" alt="Sample Image <?php echo $i ?>"></a>*}
                {*</li>*}

            </ul>
            <div class="page-info" style="padding-left: 18px;">
                <p>第0页，共0页</p>
            </div>
            <div class="dataTables_paginate paging_bootstrap pagination" style="text-align: center;">
                <ul>
                    <li class="prev disabled"><a href="javascript:loadPrevPage();">← 上一页</a></li>
                    <li class="next disabled"><a href="javascript:loadNextPage();">下一页 → </a></li>
                </ul>
            </div>
        </div>
    </div><!--/span-->


    <div class="box span3">
        <div class="box-header well" data-original-title>
            <h3>用户筛选</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>
        <div class="box-content" id="user-search" style="height: 260px">
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchUserOption" id="nameUserRadio" checked>
                        用户昵称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchUserOption" id="idUserRadio">
                        用户ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtUserValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnUserSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
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
            <div style="overflow: auto; height: 190px;">
                <ul>

                </ul>
            </div>



            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>

    <div class="box span3" >
        <div class="box-header well" data-original-title>
            <h3>活动筛选</h3>
            {*<div class="box-icon">*}
            {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            {*</div>*}
        </div>

        <div class="box-content" id="act-search" style="height: 260px">
            <div class="control-group">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="searchActOption" id="nameActRadio"  checked="">
                        活动名称
                    </label>
                    <label class="radio">
                        <input type="radio" name="searchActOption" id="idActRadio" >
                        活动ID
                    </label>
                    <div class="row-fluid">
                        <div class="span9">
                            <input class="focused" name="searchValue" id="txtActValue" type="text" style="width:96%" >

                        </div>
                        <div class="span3">
                            <button id="btnActSearch" style="float:right;" class="btn btn-small btn-primary">搜索</button>
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
            <div style="overflow: auto; height: 190px;">
                <ul>

                </ul>

            </div>


            {*<span style="color: red;margin-left: 5px;">*</span>*}
        </div>
    </div>
</div><!--/row-->

{literal}
<script type="text/javascript">
    var SUType = "nick_name";
    function setUserSearchType() {
        if($("#nameUserRadio").parent().hasClass("checked")) {
            SUType = "nick_name";
        } else if($("#idUserRadio").parent().hasClass("checked")){
            SUType = "user_id";
        } else {
            throw "unknown type";
        }

    }
    function doUserSearch() {
        $("#user-search .alert").hide();

        var _v = $("#txtUserValue").val().trim();
        if(_v==="") {
            $("#user-search .user-require").show();
            return;
        }
        $.post($.__link_prefix__ + "admin/user/search", {
            search_type : SUType,
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
                var _a = ACT_ID === -1 ? "" : "a"+ACT_ID;
                $("<li></li>").html("<a href='"+$.__link_prefix__ + "admin/photo/index#"+"u"+user.user_id+_a+"'>"+user.nick_name+"</a>")
                        .appendTo(_u);
            }
        }, "json");
    }
</script>
{/literal}

{literal}
<script type="text/javascript">
    var SAType = "act_name";
    var CUR_ACT = null;
    function setActSearchType() {
        if($("#nameActRadio").parent().hasClass("checked")) {
            SAType = "act_name";
        } else if($("#idActRadio").parent().hasClass("checked")){
            SAType = "act_id";
        } else {
            throw "unknown type";
        }

    }
    function doActSearch() {
        $("#act-search .alert").hide();

        var _v = $("#txtActValue").val().trim();
        if(_v==="") {
            $("#act-search .act-require").show();
            return;
        }
        $.post($.__link_prefix__ + "admin/default/search", {
            search_type : SAType,
            search_value : _v
        }, function(rtn) {
            if(!rtn.success) {
                alert('网络错误，请重试！');
                return;
            }
            $("#act-search .alert").hide();

            var ul = $("#act-search ul").html("");
            var list = rtn.data;
            if(list.length===0) {
                $("#act-search .act-result").show();
            }
            for(var i=0;i<list.length;i++) {
                var act = list[i];
                var _u = USER_ID === -1 ? "" : "u"+USER_ID;
                $("<li></li>").html("<a href='"+ $.__link_prefix__ + "admin/photo/index#"+_u+"a"+act.act_id+"'>"+act.act_name+"</a>")
                        .appendTo(ul);
            }
        }, "json");
    }
</script>

{/literal}


{literal}
<script type="text/javascript">
    CUR_PAGE = 0;
    MAX_PAGE = 1;
    USER_ID = -1;
    ACT_ID = -1;

    function loadPage(idx) {
        var data = {
            'page_index' : idx
        };
        if(USER_ID!==-1) {
            data['user_id'] =  USER_ID;
        }
        if(ACT_ID!==-1) {
            data['act_id'] = ACT_ID;
        }
        $.post($.__link_prefix__ + "admin/photo/page", data, function(rtn) {
            if(!rtn.success) {
                alert("网络错误！请重试。");
                return;
            }
            var _d = rtn.data;
            CUR_PAGE = _d.page_index;
            MAX_PAGE = _d.total_page;
            var _tt = "所有图片";
            if(_d.nick_name.trim()!=="" && _d.act_name.trim()!=="") {
                _tt = _d.nick_name+" 在活动 "+_d.act_name+" 中上传的所有图片";
            } else if(_d.nick_name.trim()!=="") {
                _tt = _d.nick_name+" 上传的所有图片";

            } else if(_d.act_name.trim()!=="") {
                _tt = "活动 "+_d.act_name+" 中上传的所有图片";
            }
            $("#photo-title").text(_tt);

            var _u = $(".gallery").html("");
            if(_d.photo_list.length === 0) {
                $("#no-photo-tip").show();
            } else {
                $("#no-photo-tip").hide();
            }
            for(var i=0;i<_d.photo_list.length;i++) {
                var p = _d.photo_list[i];
                $("<li class='thumbnail'></li>").append(
                    $("<a class='kan-photo' href='"+ p.image_url +"' title='所属用户："+ p.user_name+"，所属活动："+ p.act_name+"'></a>").append($("<img src='"+p.thumb_url+"'/>"))
                ).append(
                    "<p>所属用户：<a href='"+$.__link_prefix__ + +"admin/user/detail#"+ p.user_id+"'>"+ p.user_name+"</a></p>"
                   +"<p>所属活动：<a href='"+$.__link_prefix__ + "admin/default/detail#"+ p.act_id+"'>"+ p.act_name+"</a></p>"
                   +'<p onclick="delPhoto('+ p.photo_id+');" class="gallery-delete btn hide"><i class="icon icon-red icon-close"></i></p>'
                        ).appendTo(_u);
            }
            $(".page-info").text("第"+(CUR_PAGE+1)+"页，共"+(MAX_PAGE+1)+"页");
            $.colorbox.remove();
            $('.kan-photo').colorbox({rel:'thumbnail .kan-photo', transition:"elastic", maxWidth:"95%", maxHeight:"95%"});

            if(CUR_PAGE === MAX_PAGE) {
                $(".pagination .next").addClass("disabled");
            } else {
                $(".pagination .next").removeClass("disabled");
            }
            if(CUR_PAGE === 0) {
                $(".pagination .prev").addClass("disabled");
            } else {
                $(".pagination .prev").removeClass("disabled");
            }
        }, 'json');
    }
    function viewReady() {

        $.Router.register({
            "u(\\d+)a(\\d+)" : function(arg, uid, aid) {
                USER_ID = uid;
                ACT_ID = aid;
                loadPage(0);
            },
            "u(\\d+)" : function(arg, uid) {
                USER_ID = uid;
                ACT_ID = -1;
                loadPage(0);
            },
            "a(\\d+)" : function(arg, aid) {
                USER_ID = -1;
                ACT_ID = aid;
                loadPage(0);
            },
            ".*" : function() {
                USER_ID = -1;
                ACT_ID = -1;
                loadPage(0);
            }
        }).start();

        $("#nameUserRadio").change(setUserSearchType);
        $("#idUserRadio").change(setUserSearchType);
        $("#btnUserSearch").click(doUserSearch);

        $("#nameActRadio").change(setActSearchType);
        $("#idActRadio").change(setActSearchType);
        $("#btnActSearch").click(doActSearch);
    }
    function loadNextPage() {
        if(CUR_PAGE<MAX_PAGE) {
            loadPage(CUR_PAGE+1);
        }
    }
    function loadPrevPage() {
        if(CUR_PAGE>0) {
            loadPage(CUR_PAGE-1);
        }
    }

    function delPhoto(id) {
        var pwd = prompt("请输入管理员密码确认删除");
        if(pwd.trim()==="") {
            return;
        }
        $.post($.__link_prefix__+"admin/photo/delete", {
            password : pwd,
            photo_id : id
        }, function(rtn) {
            if(!rtn.success) {
                alert('删除失败！');
                return;
            }
            alert("删除成功");
            loadPage(CUR_PAGE);
        }, "json");
    }
</script>
{/literal}