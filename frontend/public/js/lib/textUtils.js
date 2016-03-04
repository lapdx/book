var textUtils = {};


textUtils.createAlias = function (str) {
    if (str === null || str === '')
        return '';
    return textUtils.removeDiacritical(str).replace(/\W/g, "-").toLowerCase();
};

textUtils.removeDiacritical = function (str) {
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

Number.prototype.toMoney = function (decimals, decimal_sep, thousands_sep) {
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

textUtils.drawAlias = function (obj) {
    $("input[data-alias=alias]").val(textUtils.createAlias($(obj).val()));
};

textUtils.hashParam = function () {
    var urlParams;
    var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
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

textUtils.queryParam = function () {
    var urlParams;
    var match,
            pl = /\+/g, // Regex for replacing addition symbol with a space
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) {
                return decodeURIComponent(s.replace(pl, " "));
            },
            query = window.location.search.substring(1);
    urlParams = {};
    while (match = search.exec(query))
        urlParams[decode(match[1])] = decode(match[2]);
    return urlParams;
};

textUtils.formatTime = function (time, format) {
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

textUtils.percentFormat = function (startPrice, sellPrice, discount, discountPrice, discountPercent) {
    var percent = 0;
    if (!discount && startPrice > sellPrice) {
        percent = (startPrice - sellPrice) / startPrice;
    } else {
        if (discountPercent > 0) {
            discountPrice = sellPrice * ((100 - discountPercent) / 100);
        } else {
            discountPrice = sellPrice - discountPrice;
        }
        if (startPrice <= sellPrice) {
            startPrice = sellPrice;
        }
        percent = (startPrice - discountPrice) / startPrice;
    }
    percent *= 100;
    percent = Math.ceil(percent);
    return percent.toMoney(0, ',', '.');
};

textUtils.startPrice = function (startPrice, sellPrice, discount) {
    if (!discount && startPrice <= sellPrice) {
        return "0";
    }
    if (discount && startPrice <= sellPrice) {
        startPrice = sellPrice;
    }
    if (startPrice > 0) {
        return startPrice.toMoney(0, ',', '.');
    }
    return "";
};

textUtils.sellPrice = function (sellPrice, discount, discountPrice, discountPercent) {
    if (discount) {
        if (discountPercent > 0) {
            sellPrice = eval(sellPrice) * (100 - eval(discountPercent)) / 100;
        } else {
            sellPrice = eval(sellPrice) - eval(discountPrice);
        }
    }
    return sellPrice.toMoney(0, ',', '.');
};
textUtils.discountPrice = function (startPrice, sellPrice, discount, discountPrice, discountPercent) {
    if (discount && startPrice <= sellPrice) {
        startPrice = sellPrice;
    }
    if (discount) {
        if (discountPercent > 0) {
            sellPrice = eval(sellPrice) * (100 - eval(discountPercent)) / 100;
        } else {
            sellPrice = eval(sellPrice) - eval(discountPrice);
        }
    }
    var price = (eval(startPrice) - eval(sellPrice));
    price = (price > 0 ? price : 0);
    return price.toMoney(0, ',', '.');
};

textUtils.buildQuery = function (params) {
    var i = 1;
    var queryString = "";
    $.each(params, function (key, val) {
        if (typeof val != 'undefined' && val !== null && val !== "") {
            if (i === 1)
                queryString += "?";
            else
                queryString += "&";
            queryString += key + "=" + val;
            i++;
        }
    });
    return queryString;
};

textUtils.createKeyword = function (str) {
    if (str === null || str === '')
        return '';
    return textUtils.removeDiacritical(str.replace(/ /g, "+").trim().toLowerCase());
};