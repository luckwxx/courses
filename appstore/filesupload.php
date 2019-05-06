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
    <script src="js/user.js"></script>
</head>


<body>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">上传文件到 baby</div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data">

            <div class="div-c">
                <label>选择文件</label>
<!--                <input type="file" class="form-control" name="logo0"/>-->
                <input type="file" name="logo0" id="logo0"  multiple="multiple">
            </div>



            <div class="div-c">
                <input type="button" class="btn btn-primary" value="上传" id="submit" onclick="postData();"/>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>

        </form>
    </div>
</div>

<!-- bootstrap的核心js文件 -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript">
    function postData(){
        var formData = new FormData();

        // formData.append("name",$("input[name='name']").val());
        // formData.append("logo0",$("#logo0")[0].files[0]);

        for(var i=0, f; f=$("#logo0")[0].files[i]; i++){
            formData.append(i, f);
        }

        $.ajax({
            url:'../apps/test', /*接口域名地址*/
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
                        // location = "index.php";
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