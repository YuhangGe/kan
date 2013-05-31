<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="/js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript">
        $.log = function(msg) {
            console.log(msg);
        }
    </script>
    <title>{$Yii->name}</title>
</head>

<body>

{literal}
    <script type="text/javascript">

        function submit(type) {
            var url = $("#txtUrl").val().trim();
            if(url==="") {
                return;
            }
            var fd = new FormData();
            $("#table tr").each(function() {
                var _t = $(this);
                var _p = _t.find(".param").val().trim(), _vd, _v;
                if(_p==="") {
                    return;
                }
                _vd = _t.find(".value");
                if(_vd.attr("type")==='file' && _vd[0].files.length>1) {
                    _v = _vd[0].files[0];
                } else {
                    _v = _vd.val();
                }
                fd.append(_p, _v);
            });
            if(fd.length==0) {
                return;
            }
            if(type === 'ajax') {
                $.ajax({
                    url: url,
                    type : 'post',
                    data: fd,
                    contentType:false,
                    processData:false,
                    success : function(rtn) {
                        $("#output").html(rtn);
                    }
                });
            }
        }

        $(function() {
            $("#btnAdd").click(function() {
                $("#table tr:first").clone().appendTo($("#table"));
            });
            $("#btnSubmit").click(function() {
                submit("ajax");
            });
            $("#table").on("click", ".op_del", function() {
                var ts = $("#table tr");
                if(ts.length>1) {
                    $(this).parents("tr").remove();
                } else {
                    ts.find(".value").attr("type","text");
                    ts.find("input").val("");
                }
            }).on("change", ".param", function() {
                        var _t = $(this);
                        if(_t.val().trim()==='file' || /^file/i.test(_t.val())) {
                            _t.parents("tr").find(".value").attr("type","file");
                        }
                    });

            $("#btnSubmit2").click(function() {

            });
        });
    </script>
{/literal}


<table>
    <thead>
    <tr>
        <th>参数</th>
        <th>值</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody id="table">
    <tr>
        <td><input class="param" ></td>
        <td><input class="value"></td>
        <td><a class="op_del" href="javascript:;">删除</a></td>
    </tr>
    </tbody>
</table>
<p>URL: <input type="text" id="txtUrl"><input type="button" value="添加" id="btnAdd" />
    <input type="button" id="btnSubmit" value="提交"><input type="button" id="btnSubmit2" value="页面提交">
</p>
<div id="output">

</div>

</body>
</html>
