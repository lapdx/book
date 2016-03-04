var Fly = {};
Fly.init = function (_config) {
    _config = $.extend(_config, {});
    Fly.baseUrl = _config.baseUrl;
    Fly.tmp = _config.template;
    Fly.upload = _config.upload;
    Fly.default = _config.default;
    Fly.layout = _config.layout;
    if (typeof Fly.layout !== "undefined")
        Fly.layout;
    Fly.navigate();
};

Fly.navigate = function () {
    var params = $(location).attr("hash").replace('#', '').split("?");
    if (params.length == 0) {
        params = ["index", "grid"];
    }
    params = params[0].split('/');
    if (params.length <= 1 && params[0] === '') {
        params = Fly.default.split('/');
    }
    if (params.length === 1) {
        params.push("grid");
    }
    Fly.navigate.action(params);
    $(window).bind('hashchange', function () {
        params = $(location).attr("hash").replace('#', '').split("?");
        params = params[0].split('/');
        if (params.length <= 1 && params[0] === '') {
            params = Fly.default.split('/');
        }
        Fly.navigate.action(params);
    });
};

Fly.navigate.action = function (params) {
    for (var i = params.length; i > 0; i--) {
        try {
            var action = window[params[0]];
        }
        catch (err) {
        }
        for (var j = 1; j < i; j++) {
            try {
                action = action[params[j]];
            }
            catch (err) {
            }
        }
        try {
            action(params);
            break;
        }
        catch (err) {
            console.log(err);
            document.location = '#';
        }
    }
};

Fly.param = function (name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var url = $(location).attr("hash").replace('#', '');
    url = (url === null || url === '' || url.length <= 1) ? Fly.default : url[1];

    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(url);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
};

Fly.GET = function (name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
};

Fly.createAlias = function (str) {
    return Fly.removeDiacritical(str).replace(/\W/g, "-").toLowerCase();
};

Fly.removeDiacritical = function (str) {
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, "a");
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, "e");
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, "i");
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, "o");
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, "u");
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, "y");
    str = str.replace(/(đ)/g, "d");
    str = str.replace(/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g, "A");
    str = str.replace(/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g, "E");
    str = str.replace(/(Ì|Í|Ị|Ỉ|Ĩ)/g, "I");
    str = str.replace(/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g, "O");
    str = str.replace(/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g, "U");
    str = str.replace(/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g, "Y");
    str = str.replace(/(Đ)/g, "D");
    return str;
};

Fly.formatTime = function (time, format) {
    var months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    time = parseFloat(time);
    var a = new Date(time);
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var day = a.getDate();
    var hour = a.getHours();
    var minute = a.getMinutes();
    var second = a.getSeconds();
    var time = "";
    if (format === 'day') {
        time = day + "/" + month + "/" + year;
    } else if (format === 'hour') {
        time = hour + ":" + minute + " " + day + "/" + month + "/" + year;
    } else if (format === 'time') {
        time = day + "/" + month + "/" + year + " " + hour + ":" + minute + ":" + second;
    } else if (format === 'hourfirst') {
        time = hour + ":" + minute + ":" + second + " " + day + "/" + month + "/" + year;
    }
    return time;
};

Fly.redirect = function (_url, _time, _baseUrl) {
    _time = _time > 0 ? _time : 0;
    _baseUrl = typeof _baseUrl != 'undefined' && _baseUrl !== null ? _baseUrl : baseUrl;
    var t = _time / 1000;
    setInterval(function () {
        t = eval(t - 1);
        if (t >= 0)
            $('span.r-time').html('<div class="help-block">Hệ thống sẽ chuyển tự động chuyển trang trong vòng ' + eval(t) + ' giây</div>')
    }, 1000);
    setTimeout("location.href = '" + _baseUrl + _url + "';", _time);
};

Fly.template = function (template, data) {
    try {
        return new EJS({
            url: baseUrl + '/tpl' + template
        }).render(data);
    } catch (err) {
//        console.log(err);
        return "";
    }
};