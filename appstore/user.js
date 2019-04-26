
function saveLoginData(loginData, type = 'localStorage') {
    if (type == 'session') {
        sessionStorage.setItem('loginData', loginData);
    } else {
        localStorage.setItem('loginData', loginData);
    }
}

function loadLoginData(type = 'localStorage') {
    var loginData;
    if (type == 'session') {
        loginData = sessionStorage.getItem('loginData');
    } else {
        loginData = localStorage.getItem('loginData');
    }

    return JSON.parse(loginData);
}

//localStorage删除指定键对应的值
function delLoginData(){
    localStorage.removeItem('loginData');
}


function isLogin(){
    var loginData = loadLoginData();
    return  (loginData != null);
}

function getUserToken() {
    var loginData = loadLoginData();
    if(loginData)
    {
        return loginData['token'];
    }
    return '';
}


//paraName 等找参数的名称
function GetUrlParam(paramName) {
    var url = document.location.toString();
    var arrObj = url.split("?");

    if (arrObj.length > 1) {
        var arrPara = arrObj[1].split("&");
        var arr;

        for (var i = 0; i < arrPara.length; i++) {
            arr = arrPara[i].split("=");

            if (arr != null && arr[0] == paramName) {
                return arr[1];
            }
        }
        return "";
    }
    else {
        return "";
    }
}