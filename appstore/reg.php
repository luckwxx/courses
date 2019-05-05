<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <style type="text/css">
        body{
            margin: 0px;
            padding: 0px;
            background-color: #CCCCCC;
        }
        .panel{
            width: 380px;
            height: 350px;
            position: absolute;
            left: 50%;
            margin-left: -190px;
            top: 50%;
            margin-top: -175px;
        }
        .form-horizontal{
            padding: 10px 20px;
        }
        .btns{
            display: flex;
            justify-content: center;
        }
    </style>
</head>


<body>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">用户注册</div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label>用户名</label>
                <input type="text" class="form-control" name="account"/>
                <input type="text" class="form-control" name="type" value="1" style="display:none"/>
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" name="password" />
            </div>
            <div class="form-group">
                <label>确认密码</label>
                <input type="password" class="form-control" name="rePwd" />
            </div>

            <div class="form-group btns">
                <input type="button" class="btn btn-primary" value="确定注册" id="submit"/>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a type="button" class="btn btn-success" href="login.php"/>返回登录</a>
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
    $(function(){
        $("#submit").on("click",function(){
            var param = {"account":$("input[name='account']").val(),
                "password":$("input[name='password']").val(),
                "type":$("input[name='type']").val(),
                "nickname":$("input[name='account']").val()};
            // console.log(str);
            $.post("../user/register",param,function(data){

                var obj = data;
                //判断是否为JSON对象
                if(typeof(data) == "object" &&
                    Object.prototype.toString.call(data).toLowerCase() == "[object object]" && !data.length){
                    // alert("is JSON 0bject");
                }
                else
                    obj = JSON.parse(data);

                if(!obj){
                    alert("注册失败！因为啥我不知道！");
                }else{
                    if (parseInt(obj.code)== 200){
                        alert("注册成功！即将跳转登陆页！");
                        location = "login.php";
                    }
                    else{
                        alert(obj.msg);
                    }
                }
            });
        });
    });
</script>
</html>