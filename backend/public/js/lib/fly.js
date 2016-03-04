var Fly = {};

Fly.init = function (_config) {
    _config = $.extend(_config, {});
    Fly.baseUrl = _config.baseUrl;
    Fly.tpl = _config.template;
    Fly.beforeLoad = _config.beforeLoad;
    Fly.load = _config.load;
    Fly.error_404 = _config.error_404;
    Fly.default = ["index", "grid"];
    if (typeof _config.default != 'undefined') {
        Fly.default = _config.default;
    }
    if (Fly.load) {
        Fly.load();
    }
};

Fly.navigate = function () {
    var params = $(location).attr("hash").replace('#', '').split("?");
    if (params[0] == "") {
        params = Fly.default;
    }
    if (Fly.beforeLoad) {
        Fly.beforeLoad();
    }
    params = params[0].split('/');
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
            if (Fly.error_404)
                Fly.error_404();
        }
    }
};

Fly.template = function (template, data) {
    try {
        return new EJS({
            url: Fly.baseUrl + Fly.tpl + template
        }).render(data);
    } catch (err) {
        console.log(err);
        return "";
    }
};
