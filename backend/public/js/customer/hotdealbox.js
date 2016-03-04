var hotdealbox = {};
hotdealbox.grid = function () {
    layout.title("Quản trị sản phẩm nội bật");
    layout.breadcrumb([
        ["Dashboad", "#hotdealbox/grid"],
        ["Sản phẩm nội bật", "#hotdealbox/grid"],
        ["Danh sách sản phẩm nội bật"]
    ]);
    ajax({
        service: '/hotdealbox/grid',
        loading: true,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/hotdealbox/grid.tpl", resp));
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

hotdealbox.add = function () {
    popup.open('popup-hotdealbox-add', 'Thêm sản phẩm nổi bật', Fly.template('/hotdealbox/save.tpl', null), [
        {
            title: 'Lưu',
            style: 'btn-success',
            fn: function () {
                ajaxSubmit({
                    service: '/hotdealbox/save',
                    id: 'form-save',
                    loading: false,
                    contentType: 'json',
                    done: function (rs) {
                        if (rs.success) {
                            popup.msg(rs.message, function () {
                                var html = Fly.template("/hotdealbox/tradd.tpl", rs.data);
                                console.log(html);
                                $('tbody[rel-data="body-data"]').prepend(html);
                                popup.close('popup-hotdealbox-add');
                            });
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
            fn: function () {
                popup.close('popup-hotdealbox-add');
            }
        }
    ]);
};
hotdealbox.changeActive = function (id) {
    ajax({
        service: '/hotdealbox/changeactive',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="hotdealbox.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
hotdealbox.changeType = function (id) {
    ajax({
        service: '/hotdealbox/changetype',
        data: {id: id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("div[data-key-type='" + id + "']").html('<label class="label label-' + (resp.data.type == 'selling' ? 'success' : 'danger') + '" >' + (resp.data.type == 'selling' ? 'Bán chạy' : 'Nổi bật') + '</label><i onclick="hotdealbox.changeType(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-check"/>');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

hotdealbox.remove = function (id) {
    popup.confirm("Bạn có chắc chắn muốn xóa sản phẩm nổi bật này?", function () {
        ajax({
            service: '/hotdealbox/remove',
            data: {id: id},
            loading: false,
            done: function (resp) {
                if (resp.success) {
                    $('tr[data-key=' + id + ']').remove();
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};