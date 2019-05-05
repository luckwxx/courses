<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <script
            src="https://code.jquery.com/jquery-3.4.0.js"
            integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
            crossorigin="anonymous"></script>
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
        <h2><a type="button" id="create" href="create.php"/>创建 App</a></h2>
        <h2>App 列表</h2>
    </div>
</div>

<script type="text/javascript">

    function appsList(){
        var param = {"pos_id":0, "size":30};
        $.post("../apps/applist",param,function(data){
            var obj = data;
            //判断是否为JSON对象
            if(typeof(data) == "object" &&
                Object.prototype.toString.call(data).toLowerCase() == "[object object]" && !data.length){
                // alert("is JSON 0bject");
            }
            else
                obj = JSON.parse(data);

            if(!obj){
                var elem_li = document.createElement('li'); // 生成一个 li元素
                elem_li.innerHTML = "暂无数据"; // 设置元素的内容
                document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

            }else{
                if (parseInt(obj.code)== 200){
                    for(let index in obj.data) {
                        console.log(index,obj.data[index]);

                        var elem_li = document.createElement('li'); // 生成一个 li元素
                        elem_li.innerHTML = obj.data[index].id + "   <a type=\"button\" class=\"app_detail\" href=\"detail.php?app_id="+obj.data[index].id +"\"/>" + obj.data[index].name + "</a>  " + obj.data[index].describe; // 设置元素的内容
                        document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                        // $("#apps tbody").append(obj.data[index].toString()+"<br>");
                    };
                }
                else{
                    alert(obj.msg);
                }
            }
        });
    }



    var loginData = loadLoginData();
    document.getElementById("login").style.display      = (!loginData)?"block":"none";
    document.getElementById("reg").style.display        = (!loginData)?"block":"none";
    document.getElementById("logout").style.display     = (!loginData)?"none":"block";
    document.getElementById("apps").style.display       = (!loginData)?"none":"block";
    document.getElementById("nickname").style.display   = (!loginData)?"none":"block";
    if(!loginData){
        document.getElementById("nickname").textContent="";
        var el = document.getElementById('apps');
        var childs = el.childNodes;
        for(var i = childs .length - 1; i >= 0; i--) {
            el.removeChild(childs[i]);
        }
    }
    else {
        document.getElementById("nickname").textContent = loginData['nickname'];
        appsList();
    }

    $(function(){
        $("#logout").on("click",function(){
            delLoginData();
            location = "index.php";
        });
    });

</script>


</body>
</html>