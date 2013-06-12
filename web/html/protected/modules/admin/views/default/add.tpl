
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> 新建活动</h2>
            <div class="box-icon">
                {*<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>*}
                {*<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>*}
                {*<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>*}
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" action="/admin/default/add" method="post">
                <fieldset>
                    {*<legend></legend>*}
                    <div class="control-group">
                        <label class="control-label" for="nameInput">活动名称</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="nameInput" type="text" >
                            {*<span style="color: red;margin-left: 5px;">*</span>*}
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeSelect">活动类型</label>
                        <div class="controls">
                            <select id="typeSelect">
                                <option value="0" selected>才艺</option>
                                <option value="1">表演</option>
                                <option value="2">简历</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="dataBeginTime">开始日期</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" id="dataBeginTime" value="06/16/13">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="dataEndTime">结束日期</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" id="dataEndTime" value="07/16/13">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fileImage">活动海报</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileImage" type="file">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="textDescription">活动详情</label>
                        <div class="controls">
                            <textarea class="ckeditor" id="textDescription" rows=5 style=""></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">新建活动</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->

{*<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>*}
{*<script src="/ckeditor/adapters/jquery.js" type="text/javascript"></script>*}