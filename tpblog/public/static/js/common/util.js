function getQueryString(name,url=window.location.href){
    var _= {};
    name += ''
    url += ''
    url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        _[key] = value;
    });
    return _[name]
}



