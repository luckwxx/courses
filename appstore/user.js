
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

function isPC() {
    var sUserAgent = navigator.userAgent.toLowerCase();
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    var bIsAndroid = sUserAgent.match(/android/i) == "android";
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    if (!(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) ){
        return true;
    }else{
        //window.location.href='http://m.jb51.net';
        return false;
    }
}
