<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> 所有图片</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">

            <ul class="thumbnails gallery">

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

</div><!--/row-->

{literal}
<script type="text/javascript">
    CUR_PAGE = 0;
    MAX_PAGE = 1;
    function loadPage(idx) {
        $.post("/admin/photo/page", {
            'page_index' : idx
        }, function(rtn) {
            if(!rtn.success) {
                alert("网络错误！请重试。");
                return;
            }
            var _d = rtn.data;
            CUR_PAGE = _d.page_index;
            MAX_PAGE = _d.total_page;
            var _u = $(".gallery").html("");
            for(var i=0;i<_d.photo_list.length;i++) {
                var p = _d.photo_list[i];
                $("<li class='thumbnail'></li>").append(
                    $("<a class='kan-photo' href='"+ p.image_url +"' title='所属用户："+ p.user_name+"，所属活动："+ p.act_name+"'></a>").append($("<img src='"+p.thumb_url+"'/>"))
                ).append(
                    "<p>所属用户：<a href='/admin/user/detail#"+ p.user_id+"'>"+ p.user_name+"</a></p>"
                   +"<p>所属活动：<a href='/admin/default/detail#"+ p.act_id+"'>"+ p.act_name+"</a></p>"
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
        loadPage(0);
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
</script>
{/literal}