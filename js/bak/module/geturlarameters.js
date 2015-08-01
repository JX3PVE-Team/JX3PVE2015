/**
 * get location.search parameters
 * @param  {[type]} paras [description]  is string
 * getRequest('string');
 */
var getRequest = function(paras){
    var url = location.search;
    var _request = {};

    if( url.indexOf("?") != -1){
        var str = url.substr(1),
            i = 0,
            strs = str.split("&");

        for( ;i<strs.length;i+=1 ){
            _request[strs[i].split('=')[0]] = unescape(strs[i].split('=')[1]);
        }
    }

    var value = _request[paras.toLowerCase()];
    if(typeof(value) == "undefined"){
        return "";
    } else {
        return value;
    }
};
