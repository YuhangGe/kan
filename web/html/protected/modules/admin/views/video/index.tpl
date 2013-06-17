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

            <table aoDataSource="/admin/table/video" aoColumns="video"  class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <td>ID</td>
                    <th>节目名称</th>
                    <th>所属星客</th>
                    <th>所属活动</th>
                    <th>上传时间</th>
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
    <a class="btn btn-success edit-view" href="/admin/video/detail#VIDEO_ID">
        <i class="icon-zoom-in icon-white"></i>
        查看视频
    </a>

    <a class="btn btn-danger edit-del" href="javascript:delVideo('VIDEO_ID');">
        <i class="icon-trash icon-white"></i>
        删除
    </a>
</div>


{literal}

    <script type="text/javascript">
        function viewStart() {
            window.aoColumns = {'video' : [
                { "mData": "video_id"},
                { "mData": "video_name" },
                { "mData": "user_name", "mRender" : function(data, type, ooData) {
                    return "<a href='/admin/user/detail#"+ooData['user_id']+"'>"+data+"</a>";
                }
                },
                { "mData": "act_name", "mRender" : function(data, type, ooData) {
                    return "<a href='/admin/default/detail#"+ooData['act_id']+"'>"+data+"</a>";
                }
                },
                { "mData": "upload_time","mRender": function(data) {
                    return $.datepicker.formatDate("yy年mm月dd日", new Date(Number(data)*1000));
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
    </script>

{/literal}


