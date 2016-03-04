(function() {

    this.btnSearch = function(_form) {
        var url = $("#" + _form).attr("action");
        $.each($('#' + _form + '  input, #' + _form + '  select'), function() {
            if ($(this).attr('remove') !== true && $(this).val() !== '') {
                if (url.indexOf('?') > -1) {
                    url += '&';
                } else {
                    url += '?';
                }
                url += $(this).attr('name') + '=' + $(this).val();
            }
        });
        location.href = url;
    };
    this.btnReset = function(_form) {
        $.each($('#' + _form + '  input, #' + _form + '  select'), function() {
            if ($(this).attr('remove') !== true && $(this).val() !== '') {
                $(this).val('');
            }
        });
        location.href = url;
    };
    this.page = function(_page) {
        var urlParams = urlParam();
        urlParams.pageIndex = _page;
        var queryString = "";
        var i = 1;
        $.each(urlParams, function(key, val) {
            if (val !== null) {
                if (i === 1)
                    queryString += "?";
                else
                    queryString += "&";
                queryString += key + "=" + val;
                i++;
            }
        });
        location.href = queryString;
    };

    this.urlParam = function() {
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
})();