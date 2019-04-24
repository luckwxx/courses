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
        }

        .loginbtn{
            width: 130px;
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
        <div class="loginbtn">
            <a type="button" id="login"  href="login.php"/>登录</a>
            <a type="button" id="reg"    href="reg.php"/>注册</a>
            <a type="button" id="logout" href=""/> 退出</a>
        </div>
    </div>

    <div class="apps" id="apps" >
        <h3>adsghdgfh</h3>
    </div>
</div>

<script type="text/javascript">
    var token = loadLoginToken();
    document.getElementById("login").style.visibility  = (!token)?"visible":"hidden";
    document.getElementById("reg").style.visibility    = (!token)?"visible":"hidden";
    document.getElementById("logout").style.visibility = (!token)?"hidden":"visible";
    document.getElementById("apps").style.visibility = (!token)?"hidden":"visible";
</script>

<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
<script type="text/javascript">
    $(function(){
        $("#logout").on("click",function(){
            delLoginToken();
            location = "index.php";
        });
    });
</script>


</body>
</html>