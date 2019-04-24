var token;
function saveLoginToken(curtoken, type = 'localStorage') {
    token = curtoken;
    if (type == 'session') {
        sessionStorage.setItem('token', curtoken);
    } else {
        localStorage.setItem('token', curtoken);
    }
}

function loadLoginToken(type = 'localStorage') {
    if (type == 'session') {
        token = sessionStorage.getItem('token');
    } else {
        token = localStorage.getItem('token');
    }
    return token;
}

//localStorage删除指定键对应的值
function delLoginToken(){
    localStorage.removeItem('token');
}