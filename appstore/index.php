<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App Store</title>

    <style type="text/css">
        body{
            margin: 0px;
            padding: 0px;
            background-color: #CCCCCC;
        }
        .panel{
            width: 100%;
            position: absolute;
            top: 3%;
            /*margin-top: -140px;*/
            text-align:right;
            margin-right: 20px;
        }

        .login{
            width: 100%;
            float: right;
        }

        .apps{
            width: 100%;
            margin-top: 40px;
        }

        .form-horizontal{
            padding: 10px 20px;
        }
        .btns{
            display: flex;
            justify-content: center;
        }
    </style>
    <script src="user.js"></script>
</head>

<body>
<div>
    <div class="panel panel-primary">
        <div class="login">
            <a type="button" id="nickname"/></a>
            <a type="button" id="login"  href="login.php"/>登录</a>
            <a type="button" id="reg"    href="reg.php"/>注册</a>
            <a type="button" id="logout" href=""/> 退出</a>
        </div>
    </div>

    <div class="apps" id="apps" >
        <h1>App 列表</h1>
    </div>
</div>

<script type="text/javascript">
    var loginData = loadLoginData();
    document.getElementById("login").style.display      = (!loginData)?"block":"none";
    document.getElementById("reg").style.display        = (!loginData)?"block":"none";
    document.getElementById("logout").style.display     = (!loginData)?"none":"block";
    document.getElementById("apps").style.display       = (!loginData)?"none":"block";
    document.getElementById("nickname").style.display   = (!loginData)?"none":"block";
    if(!loginData)
        document.getElementById("nickname").textContent="";
    else
        document.getElementById("nickname").textContent=loginData['nickname'];

</script>

<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
<script type="text/javascript">
    $(function(){
        $("#logout").on("click",function(){
            delLoginData();
            location = "index.php";
        });
    });
</script>


</body>
</html>