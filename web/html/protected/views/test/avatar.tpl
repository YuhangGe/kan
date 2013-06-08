<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" rel="text/css"/>
    <script type="text/javascript" src="/js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.js"></script>
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

        function open() {
//            $.log($("#file")[0].files);
//            return;
            var fs = $("#file")[0].files;
            if(fs.length===0) {
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e){
                var i = $("#jcrop_target");
                i[0].src = this.result;
                i[0].onload = function() {
                    jcrop.destroy();
                    i.css({
                        'width' : "",
                        'height' : ""
                    })
                    do_jcrop();
                };
            }
            reader.readAsDataURL(fs[0]);
        }

        function showPreview(c)
        {
            if (parseInt(c.w) > 0)
            {
                c.x /= bili;
                c.y /= bili;
                c.w /= bili;
                ctx.drawImage(img, Math.round(c.x), Math.round(c.y), Math.round(c.w), Math.round(c.w), 0, 0, H, H);
            }
        }

        function onSelect(c) {
            showPreview(c);
            var ni =  new Image();
            ni.src = cvs.toDataURL("image/png");
//            $.log(cvs.toDataURL());
        }
        var H = 150;

        var cvs, ctx, img, jcrop, bili;

        function do_jcrop() {
            bili = img.height / img.naturalHeight;
            $.log(bili);
            $('#jcrop_target').Jcrop({
                onChange: showPreview,
                onSelect: onSelect,
                aspectRatio: 1
            }, function() {
                jcrop = this;
            });
        }
        $(function(){

            $("#file").change(open);

            img = $("#jcrop_target")[0];
            cvs = $('#preview')[0];
            ctx = cvs.getContext("2d");
            cvs.width = H;
            cvs.height = H;

            do_jcrop();

        });

    </script>
{/literal}

<div>
    <table cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td>
                    <img style="max-height: 400px" src="http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/pool.jpg" id="jcrop_target" />
                </td>
                <td>
                    <div style="width:150px;height:150px;overflow:hidden;margin-left:5px;">
                        <canvas id="preview"></canvas>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <input type="file" id="file"/><br/>
    <input type="button" onclick="submit();" value="Upload">
</div>
<div id="output">

</div>

</body>
</html>
