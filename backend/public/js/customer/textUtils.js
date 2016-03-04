var textUtils = {};

Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep) {
    var n = this,
            c = isNaN(decimals) ? 2 : Math.abs(decimals), //if decimal is zero we must take it, it means user does not want to show any decimal
            d = decimal_sep || '.', //if no decimal separator is passed we use the dot as default decimal separator (we MUST use a decimal separator)

            t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, //if you don't want to use a thousands separator you can pass empty string as thousands_sep value

            sign = (n < 0) ? '-' : '',
            //extracting the absolute value of the integer part of the number and converting to string
            i = parseInt(n = Math.abs(n).toFixed(c)) + '',
            j = ((j = i.length) > 3) ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
};

textUtils.drawAlias = function(obj) {
    $("input[data-alias=alias]").val(textUtils.createAlias($(obj).val()));
};

textUtils.createAlias = function(str) {
    if (str === null || str === '')
        return '';
    return textUtils.removeDiacritical(str).replace(/\W/g, "").toLowerCase();
};

textUtils.removeDiacritical = function(str) {
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

textUtils.hashParam = function() {
    var urlParams;
    var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function(s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = $(location).attr("hash").replace('#', '').split("?")[1];
    if (typeof query == 'undefined') {
        return {};
    }
    urlParams = {};
    while (match = search.exec(query))
        urlParams[decode(match[1])] = decode(match[2]);
    return urlParams;
};

textUtils.queryParam = function() {
    var urlParams;
    var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function(s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);
    urlParams = {};
    while (match = search.exec(query))
        urlParams[decode(match[1])] = decode(match[2]);
    return urlParams;
};

textUtils.buildQuery = function(params) {
    var queryString = "";
    $.each(params, function(key, val) {
        if (typeof val != 'undefined' && val != null && val != "") {
            if (i === 1)
                queryString += "?";
            else
                queryString += "&";
            queryString += key + "=" + val;
            i++;
        }
    });
    return queryString == "" ? "?" : queryString;
};

textUtils.formatTime = function(time, format) {
    var months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
    time = parseFloat(time * 1000);
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
    } else {
        time = hour + ":" + minute + ":" + second + " " + day + "/" + month + "/" + year;
    }
    return time;
};

textUtils.convertTime = function($value) {
    var $condition = Math.floor(new Date().getTime() / 1000) - eval($value);
    $text = '';
    if ($condition >= 0 && $condition <= 5) {
        $text = 'Vừa xong';
    }
    if ($condition > 5 && $condition <= 60) {
        $text = $condition + ' giây trước';
    }
    if ($condition > 60 && $condition <= 3600) {
        $minute = Math.floor($condition / 60);
        $second = $condition - ($minute * 60);
        $text = $minute + ' phút ' + $second + ' giây trước';
    }
    if ($condition > 3600 && $condition <= 86400) {
        $hour = Math.floor($condition / 3600);
        $minute = Math.floor(($condition - ($hour * 3600)) / 60);
        $text = $hour + ' giờ ' + $minute + ' phút trước';
    }
    if ($condition > 86400 && $condition <= 172800) {
        $text = 'Hôm qua, ' + textUtils.formatTime($value * 1000);
    }
    if ($condition > 172800 && $condition <= 259200) {
        $text = 'Hôm kia, ' + textUtils.formatTime($value * 1000);
    }
    if ($condition > 259200) {
        $text = textUtils.formatTime($value * 1000);
    }
    return $text;
};

textUtils.percentFormat = function(startPrice, sellPrice) {
    var percent = 0;
    if (startPrice > sellPrice)
        percent = (startPrice - sellPrice) / startPrice;

    percent *= 100;
    percent = Math.ceil(percent);
    return percent.toMoney(0, ',', '.');
};

textUtils.ucwords = function(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
        return $1.toUpperCase();
    });
};
textUtils.getQueryVariable = function() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
};
textUtils.drawAlias = function(obj) {
    $("input[data-alias=alias]").val(textUtils.createAlias($(obj).val()));
};

textUtils.createAlias = function(str) {
    if (str === null || str === '')
        return '';
    return textUtils.removeDiacritical(str).replace(/\W/g, "-").toLowerCase();
};