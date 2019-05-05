<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>创建 App</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <style type="text/css">
        body{
            margin: 0px;
            padding: 0px;
            background-color: #CCCCCC;
        }
        .panel{

        }
        .form-horizontal{
            padding: 10px 20px;
        }
        .btns{
            display: flex;
            justify-content: center;
        }
        .div-a{ float:left;width:50%;}
        .div-b{ float:left;width:50%;}
        .div-c{ float:left;width:100%;}
    </style>
    <script src="user.js"></script>
</head>


<body>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">创建 App</div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data">

            <div class="div-c">
                <label>应用名称</label>
                <input type="text" class="form-control" name="name" value="应用名称"/>
            </div>
            <div class="div-a">
                <label>副标题</label>
                <input type="text" class="form-control" name="subname" value="副标题"/>
            </div>
            <div class="div-b">
                <label>描述</label>
                <input type="text" class="form-control" name="describe" value="描述描述描述描述"/>
            </div>
            <div class="div-a">
                <label>bundle_id</label>
                <input type="text" class="form-control" name="bundleid" value="com.vhallyun.sdk"/>
            </div>
            <div class="div-b">
                <label>0 iOS，1 Android</label>
                <input type="text" class="form-control" name="type" value="0"/>
            </div>
            <div class="div-a">
                <label>版本号</label>
                <input type="text" class="form-control" name="ver" value="1.0"/>
            </div>
            <div class="div-b">
                <label>build版本号</label>
                <input type="text" class="form-control" name="ver_build" value="1.0.0.0"/>
            </div>
            <div class="div-c">
                <label>logo 57x57</label>
<!--                <input type="file" class="form-control" name="logo0"/>-->
                <input type="file" name="logo0" id="logo0" value="" placeholder="logo 57x57">
            </div>
            <div class="div-c">
                <label>logo 512x512</label>
<!--                <input type="file" class="form-control" name="logo1"/>-->
                <input type="file" name="logo1" id="logo1" value="" placeholder="logo 512x512">
            </div>
            <div class="div-c">
                <label>上传软件包</label>
<!--                <input type="file" class="form-control" name="package"/>-->
                <input type="file" name="package" id="package" value="" placeholder="上传软件包<">
            </div>


            <div class="div-c">
                <input type="button" class="btn btn-primary" value="创建 App" id="submit" onclick="postData();"/>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>

        </form>
    </div>
</div>

<!-- bootstrap的核心js文件 -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
<script type="text/javascript">
    function postData(){
        var formData = new FormData();
        formData.append("logo0",$("#logo0")[0].files[0]);
        formData.append("logo1",$("#logo1")[0].files[0]);
        formData.append("package",$("#package")[0].files[0]);

        formData.append("name",$("input[name='name']").val());
        formData.append("subname",$("input[name='subname']").val());
        formData.append("describe",$("input[name='describe']").val());
        formData.append("type",$("input[name='type']").val());
        formData.append("ver",$("input[name='ver']").val());
        formData.append("token",getUserToken());
        formData.append("ver_build",$("input[name='ver_build']").val());
        formData.append("bundle_id",$("input[name='bundleid']").val());
        console.log(formData.get("name").toString());
        console.log(formData.get("type").toString());
        console.log(formData.get("ver").toString());

        $.ajax({
            url:'../apps/create', /*接口域名地址*/
            type:'post',
            data: formData,
            contentType: false,
            processData: false,
            success:function(res){
                var obj = res;
                //判断是否为JSON对象
                if(typeof(res) == "object" &&
                    Object.prototype.toString.call(res).toLowerCase() == "[object object]" && !res.length){
                }
                else
                    obj = JSON.parse(res);

                if(!obj){
                    console.log("非json数据");
                }else{
                    if (parseInt(obj.code)== 200){
                        location = "index.php";
                    }
                    else{
                        console.log(obj.code + obj.msg);
                    }
                }
            }
        })
    }



</script>
</html>