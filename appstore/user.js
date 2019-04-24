
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

