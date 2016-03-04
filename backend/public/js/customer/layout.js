var layout = {};
layout.init = function () {
    layout.title();
    if (account != null && account != "") { 
        layout.navigation();
    }
};

layout.breadcrumb = function (_data) {

    var breadcrumb = ' <li><a href="' + Fly.baseUrl + '"><span class="glyphicon glyphicon-home"></span></a></li>';
    if (typeof _data !== "undefined") {
        $.each(_data, function (index, bcrumb) {
            if (typeof bcrumb === 'object' && bcrumb.length >= 2) {
                breadcrumb += '<li><a href="' + bcrumb[1] + '" ' + (bcrumb.length >= 3 ? 'target="_blank"' : '') + ' >' + bcrumb[0] + '</a></li>';
            } else if (typeof bcrumb === 'object' && bcrumb.length === 1) {
                breadcrumb += '<li class="active" >' + bcrumb[0] + '</li>';
            }
        });
    }
    $("ol[data-rel=breadcrumb]").html(breadcrumb);
};

layout.title = function (title) {
    $("[data-rel=title]").html(typeof title === 'undefined' || title === '' ? 'Hệ thống quản trị' : title);
};

layout.container = function (_html) {
    $("div[data-rel=container]").html(_html);
};

layout.navigation = function () {
    ajax({
        service: '/function/getassignment',
        data: {userId: account},
        done: function (resp) {
            if (resp.success) {
                $("div[data-rel=navigation]").html(Fly.template("/widget/navigation.tpl", resp.data));
                setTimeout(function () {

                    $.each($("li[data-nav]"), function () {
                        $.each($(this).find("li"), function () {
                            var li = this;
                            var flag = false;
                            $.each(resp.data.assignments, function () {
                                if (this.item_name.indexOf($(li).attr("data-item")) !== -1) {
                                    flag = true;
                                    return false;
                                }
                            });
                            if (!flag) {
                                $(li).remove();
                            }
                        });
                        if ($(this).find("li").length == 0) {
                            $(this).remove();
                        } else {
                            $(this).css({"display": "block"});
                        }
                    });

                }, 300);
            }
        }
    });
};