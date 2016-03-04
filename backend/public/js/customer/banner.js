banner = {};
banner.grid = function() {
    layout.title("Quản trị Banner");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Banner", "#banner/grid"],
        ["Danh sách banner"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }
    ajax({
        service: '/banner/grid',
        data: search,
        loading: true,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/banner/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                }, 300);

            } else {
                popup.msg(resp.message);
            }
        }
    });
};
banner.changeActive = function(id) {
    ajax({
        service: '/banner/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="banner.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

banner.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn banner này?", function() {
        ajax({
            service: '/banner/remove',
            data: {id: id},
            loading: false,
            done: function(resp) {
                if (resp.success) {
                        $('tr[rel-data=' + id + ']').addClass('danger');
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};

banner.add = function() {
    popup.open('popup-add-banner', 'Thêm mới banner.', Fly.template('/banner/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            loading: false,
            fn: function() {
                ajaxSubmit({
                    service: '/banner/add',
                    id: 'add-banner',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                                var html = Fly.template('/banner/tradd.tpl', rs);
                                $('#mytable tbody[rel-data="bodydata"]').prepend(html);
                                popup.close('popup-add-banner');
                        } else {
                            popup.msg(rs.message);
                        }
                    }
                });
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function() {
                popup.close('popup-add-banner');
            }
        }
    ]);
    setTimeout(function() {
        $('input[data-info=startTime]').timeSelect();
        $('input[data-info=endTime]').timeSelect();
    }, 300);
};

banner.edit = function(id) {
    var index = $("tr[rel-data='" + id + "'] td:nth-child(1)").text();
    ajax({
        service: '/banner/get',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit-banner', 'Sửa banner.', Fly.template('/banner/add.tpl', resp), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/banner/add',
                                id: 'add-banner',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    rs.data.index = index;
                                    if (rs.success) {
                                            var html = Fly.template('/banner/tredit.tpl', rs);
                                            $("tr[rel-data='" + id + "']").empty().html(html).addClass('success');
                                            popup.close('popup-edit-banner');
                                    } else {
                                        popup.msg(rs.message);
                                    }
                                }
                            });
                        }
                    },
                    {
                        title: 'Hủy',
                        style: 'btn-default',
                        fn: function() {
                            popup.close('popup-edit-banner');
                        }
                    }
                ]);
                setTimeout(function() {
                    $('input[data-info=startTime]').timeSelect();
                    $('input[data-info=endTime]').timeSelect();
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};