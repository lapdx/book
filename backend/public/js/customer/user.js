var user = {};
user.source = null;

user.grid = function () {
    layout.title("User Grid");
    layout.breadcrumb([
        ["Dashboad", "#index/grid"],
        ["Người dùng", "#administrator/grid"],
        ["Danh sách người dùng"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/user/grid',
        data: search,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/user/grid.tpl", resp));
                setTimeout(function () {
                    viewUtils.initSearch("search");
                    $("input[data-search=startTime]").timeSelect();
                    $("input[data-search=endTime]").timeSelect();
                }, 300);

            } else {
                popup.msg(resp.message);
            }
        }
    });

};

user.changeActive = function (id) {
    ajax({
        service: '/user/changeactive',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("td[data-id='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="user.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[data-key='" + id + "']").addClass("success");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
user.setRole = function (_email) {
    ajax({
        service: '/function/getassignment',
        data: {userId: _email},
        done: function (resp) {
            if (resp.success) {
                popup.open("popup-admin-role", "Decentralized governance", Fly.template('/user/role.tpl', resp), [
                    {
                        title: '<span data-rel="btn" >Chọn<span>',
                        style: 'btn-link',
                        fn: function () {
                            var check = $("input[data-rel=check_all]").is(":checked");
                            if (check) {
                                $("span[data-rel=btn]").html("Chọn");
                            } else {
                                $("span[data-rel=btn]").html("Bỏ");
                            }
                            $("input[data-rel=check_all]").attr("checked", !check).change();
                        }
                    },
                    {
                        title: 'Cấp quyền',
                        style: 'btn-info',
                        fn: function () {
                            var form = new Object();
                            form.userId = _email;
                            form.roles = [];
                            $.each($("input[data-rel=function]"), function () {
                                if ($(this).is(":checked")) {
                                    form.roles.push($(this).attr("data-id"));
                                }
                            });

                            ajax({
                                service: '/user/assignment',
                                data: form,
                                type: 'post',
                                loading: false,
                                contentType: 'json',
                                done: function (resp) {
                                    if (resp.success) {
                                        popup.msg(resp.message, function () {
                                            popup.close('popup-admin-role');
                                            $("tr[data-key='" + _email + "']").addClass("success");
                                        });
                                    } else {
                                        popup.msg(resp.message);
                                    }
                                }
                            });

                        }
                    },
                    {
                        title: 'Cancel',
                        style: 'btn-default',
                        fn: function () {
                            popup.close('popup-admin-role');
                        }
                    }
                ]);

                setTimeout(function () {
                    $("input[data-rel=check_all]").change(function () {
                        $("input[data-group=" + $(this).attr("data-id") + "]").attr("checked", $(this).is(":checked"));
                    });
                    $.each(resp.data.assignments, function () {
                        if ($("input[data-id=" + this.item_name + "]").length > 0) {
                            $("input[data-id=" + this.item_name + "]").attr({"checked": "true"});
                        }
                    });
                }, 300);

            } else {
                popup.msg(resp.message);
            }
        }
    });
};