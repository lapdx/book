var viewUtils = {};

viewUtils.dataPage = function (data, sort) {
    var html = '<div class="pull-left">\
                <span class="ft-text">Có tất cả <b class="text-danger">' + data.dataCount + '</b> bản ghi trong <b class="text-danger">' + data.pageCount + '</b> trang</span>\
            </div>';
    if (typeof sort != 'undefined' && sort.length > 0) {
        html += '<select class="form-control" data-search="sort" >';
        $.each(data, function () {
            html += '<option value="' + this[0] + '" >' + this[1] + '</option>';
        });
        html += '</select>';
    }
    html += '<div class="pull-right">';
    html += '<ul class="pagination">';
    html += (data.page > 3) ? '<li class="pointer" ><a onclick="viewUtils.page(1)">«</a></li>' : '<li class="disabled"><a>«</a></li>';
    html += (data.page > 2) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) - 1) + ')">&LeftArrow;</a></li>' : '<li class="disabled"><a>&LeftArrow;</a></li>';
    html += (data.page > 3) ? '<li class="pointer"  ><a>...</a></li>' : '';
    html += (data.page >= 3) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) - 2) + ')" >' + (eval(data.page) - 2) + '</a></li>' : '';
    html += (data.page >= 2) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) - 1) + ')" >' + (eval(data.page) - 1) + '</a></li>' : '';
    html += '<li class="active"><a>' + data.page + '</a></li>';
    html += (eval(data.pageCount - data.page) >= 1) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) + 1) + ')" >' + (eval(data.page) + 1) + '</a></li>' : '';
    html += (eval(data.pageCount - data.page) >= 2) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) + 2) + ')" >' + (eval(data.page) + 2) + '</a></li>' : '';
    html += (eval(data.pageCount - data.page) > 4) ? '<li class="pointer"  ><a>...</a></li>' : '';
    html += (eval(data.pageCount - data.page) > 2) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + (eval(data.page) - 1) + ')">&rarr;</a></li>' : '<li class="disabled"><a>&rarr;</a></li>';
    html += (eval(data.pageCount - data.page) > 2) ? '<li class="pointer"  ><a onclick="viewUtils.page(' + data.pageCount + ')">»</a></li>' : '<li class="disabled"><a>»</a></li>';
    html += '</ul>';
    html += '</div>';
    return html;
};


viewUtils.btnSearch = function (_form) {
    var url = $("#" + _form).attr("action");
    $.each($('#' + _form + '  input, #' + _form + '  select'), function () {
        if ($(this).attr('remove') !== true && $(this).val() !== '') {
            if (url.indexOf('?') > -1) {
                url += '&';
            } else {
                url += '?';
            }
            var name = $(this).attr('name');
            if (typeof name != 'undefined')
                url += $(this).attr('name') + '=' + $(this).val();
        }
    });
    location.href = url;
};

viewUtils.btnReset = function (_form) {
    $.each($('#' + _form + '  input, #' + _form + '  select'), function () {
        if ($(this).attr('remove') !== true && $(this).val() !== '') {
            if ($(this).prop("tagName") == 'SELECT') {
                $(this).val('0');
            } else {
                $(this).val('');
            }
        }
    });
};

viewUtils.initSearch = function (_form) {
    var params = textUtils.hashParam();
    $.each(params, function (key, val) {
        $('#' + _form + ' [data-search="' + key + '"]').val(val);
        $(".tag-search").append('<a>' + key + ':' + val + '</a>');
    });
};


viewUtils.page = function (_page) {
    var params = textUtils.hashParam();
    params.page = _page;
    var queryString = $(location).attr("hash").replace('#', '').split("?")[0];
    var i = 1;
    $.each(params, function (key, val) {
        if (typeof val != 'undefined' && val !== null) {
            if (i === 1)
                queryString += "?";
            else
                queryString += "&";
            queryString += key + "=" + val;
            i++;
        }
    });
    location.hash = queryString;
};