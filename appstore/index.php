<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>App Store</title>
    <script src="js/user.js"></script>
    <script type="text/javascript" src="js/jquery.min.js" ></script>


    <style type="text/css">

        .login{
            position:absolute;
            right:20px;
            width: 200px;
        }

        div.img
        {
            margin:3px;
            border:1px solid #bebebe;
            height:auto;
            width:auto;
            float:left;
            text-align:center;
        }
        div.img img
        {
            display:inline;
            margin:3px;
            border:1px solid #bebebe;
        }
        div.img a:hover img
        {
            border:1px solid #333333;
        }
        div.desc
        {
            text-align:center;
            font-weight:normal;
            width:150px;
            font-size:12px;
            margin:10px 5px 10px 5px;
        }

    </style>
</head>

<body>
<div class="head">
    <div class="panel panel-primary">
    </div>

    <div class="login">
            <a type="button" id="nickname"/></a>

        <div class="login-left" style="width: 80px">
            <a type="button" id="login"  href="login.php"/>登录</a>
        </div>
        <div class="login_right" style="width: 80px">
            <a type="button" id="reg"  href="reg.php"/>注册</a>
        </div>
        <div class="logout" style="width: 80px">
            <a type="button" id="logout" href=""/> 退出</a>
        </div>
    </div>
</div>


<div class="applist" id="applist" >
    <h2><a type="button" id="create" href="create.php"/>创建 App</a></h2>
    <h2>App 列表</h2>
</div>


<div class="apps" id="apps" >

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

                        var elem_div = document.createElement('div'); // 生成一个 li元素
                        elem_div.className = "img";
                        var str = '<a target="_blank" href="detail.php?app_id='+ obj.data[index].id +
                            '"><img src="'+ obj.data[index].logo0 +
                            '" alt="'+ obj.data[index].name +
                            '" width="160" height="160"></a><div class="desc">'+ obj.data[index].name +
                            '</div>';
                        elem_div.innerHTML = str; // 设置元素的内容
                        document.getElementById('apps').appendChild(elem_div); // 添加到UL中去

                        // $("#apps tbody").append(obj.data[index].toString()+"<br>");
                    };
                }
                else{
                    alert(obj.msg);
                }
            }
        });
    }



    window.onload = function (){
        appsList();
    }

    var loginData = loadLoginData();
    document.getElementById("login").style.display      = (!loginData)?"block":"none";
    document.getElementById("reg").style.display        = (!loginData)?"block":"none";
    document.getElementById("logout").style.display     = (!loginData)?"none":"block";
    // document.getElementById("apps").style.display       = (!loginData)?"none":"block";
    document.getElementById("nickname").style.display   = (!loginData)?"none":"block";
    document.getElementById("create").style.display   = (isPC() && loginData)?"block":"none";

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