var administrator = {};
administrator.source = null;

administrator.grid = function () {
    layout.title("Administrator Grid");
    layout.breadcrumb([
        ["Dashboad", "#index/grid"],
        ["System administrator", "#administrator/grid"],
        ["Administrator grid"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/administrator/grid',
        data: search,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/administrator/grid.tpl", resp));
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

administrator.changeActive = function (id) {
    ajax({
        service: '/administrator/changeactive',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("td[data-id='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="administrator.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[data-key='" + id + "']").addClass("success");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

administrator.setRole = function (_email) {
    ajax({
        service: '/function/getassignment',
        data: {userId: _email},
        done: function (resp) {
            if (resp.success) {
                popup.open("popup-admin-role", "Decentralized governance", Fly.template('/administrator/role.tpl', resp), [
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
                                service: '/administrator/assignment',
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
administrator.loadSource = function () {
    ajax({
        service: '/source/getall',
        data: {active: 1, pageSize: 1000},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                administrator.source = resp.data;
                administrator.drawlSource($("select[data-info=source]"));
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
administrator.getCode = function (id) {
    ajax({
        service: '/administrator/getcode',
        data: {id: id},
        done: function (resp) {
            if (resp.success) {
                popup.open('popup-get-code', 'Get Code', Fly.template('/administrator/getcode.tpl', resp), [
                ]);
//                administrator.loadSource();
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
//administrator.drawlSource = function(obj) {
//    if (administrator.source == null)
//        return false;
//    var selected = obj.attr("data-selected");
//    obj.html('<option value="">Source</option>');
//    $.each(administrator.source, function() {
//        if (selected == this.id) {
//            obj.append('<option selected value="' + this.id + '">' + this.id + '</option>');
//
//        } else {
//            obj.append('<option value="' + this.id + '">' + this.id + '</option>');
//        }
//    });
//};
//administrator.addApi = function() {
//    ajaxSubmit({
//        service: '/administrator/add',
//        id: 'form-add',
//        contentType: 'json',
//        done: function(rs) {
//            if (rs.success) {
//                rs.next = $('tr[data-key]').length;
//                rs.edit = false;
//                var td = $('tr[data-key]').get(eval(rs.next - 1));
//                $(td).after(Fly.template('/administrator/trrole.tpl', rs));
//            } else {
////                 administrator.loadSource();
//                popup.msg(rs.message);
//            }
//        }
//    });
//};
//administrator.removeApi = function(administratorId,sourceId){
//      popup.confirm("Are you sure delete ?", function() {
//        ajax({
//            service: '/administrator/remove',
//            data: {id: administratorId,source:sourceId},
//            done: function(resp) {
//                if (resp.success) {
//                    administrator.loadSource();
//                    $('tr[data-key="'+sourceId+'"]').addClass('danger');
//                }
//            }
//        });
//    });  
//};