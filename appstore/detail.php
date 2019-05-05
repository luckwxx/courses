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

    .panel1{
        width: 100%;
        position: absolute;
        top: 300px;
        /*margin-top: -140px;*/
        text-align:right;
        margin-right: 20px;
    }
    .div-a{ float:left;width:100%;}
    .div-b{ float:left;width:100%;}
    .div-c{ float:left;width:100%;}

    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="user.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
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
        <h1>App 详情</h1>
    </div>

    <div class="panel1 panel-primary">
        <div class="panel1-heading">
            <div class="panel1-title">上传 新版本</div>
        </div>
        <div class="panel1-body">
            <form class="form-horizontal" enctype="multipart/form-data">
                <div class="div-a">
                    <label>版本号</label>
                    <input type="text" class="form-control" name="ver" value="1.0"/>
                </div>
                <div class="div-b">
                    <label>build版本号</label>
                    <input type="text" class="form-control" name="ver_build" value="1.0.0.0"/>
                </div>
                <div class="div-c">
                    <label>上传软件包</label>
                    <!--                <input type="file" class="form-control" name="package"/>-->
                    <input type="file" name="package" id="package" value="" placeholder="上传软件包<">
                </div>


                <div class="div-c">
                    <input type="button" class="btn btn-primary" value="上 传" id="submit" onclick="postData();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </div>

            </form>
        </div>
    </div>

</div>

<script type="text/javascript">

    function appsDetail(){

        var app_id = GetUrlParam("app_id");

        var param = {"app_id":app_id};
        $.post("../apps/detail",param,function(data){
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
                elem_li.innerHTML = "查询为空"; // 设置元素的内容
                document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

            }else{
                if (parseInt(obj.code)== 200){
                    console.log(obj.data);

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML =   obj.data.name+"("+obj.data.app_id +")"; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML =   "------ " + obj.data.subname; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML = "简介："+ obj.data.describe; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML = "版本：v"+ obj.data.ver; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML = " build 版本：v"+ obj.data.ver_build; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去

                    var elem_li = document.createElement('li'); // 生成一个 li元素
                    elem_li.innerHTML = "<a type=\"button\" class=\"download\" href=\"../upload/apps/"+obj.data.id + "/" +"1.0" +"\"/>下载安装</a>  "; // 设置元素的内容
                    document.getElementById('apps').appendChild(elem_li); // 添加到UL中去
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
        appsDetail();
    }


    $(function(){
        $("#logout").on("click",function(){
            delLoginData();
            location = "index.php";
        });
    });


    function postData(){
        var formData = new FormData();
        formData.append("package",$("#package")[0].files[0]);
        formData.append("ver",$("input[name='ver']").val());
        formData.append("token",getUserToken());
        formData.append("ver_build",$("input[name='ver_build']").val());
        formData.append("app_id",GetUrlParam("app_id"));

        $.ajax({
            url:'../apps/createver', /*接口域名地址*/
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
                        location = "detail.php?app_id="+GetUrlParam("app_id");
                    }
                    else{
                        console.log(obj.code + obj.msg);
                    }
                }
            }
        })
    }

</script>


</body>
</html>