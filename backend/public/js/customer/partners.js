var partners = {};

partners.grid = function() {
    layout.title("Quản trị đối tác");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Đối tác", "#partners/grid"],
        ["Danh sách đối tác"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/partners/grid',
        data: search,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/partners/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

partners.changeActive = function(id) {
    ajax({
        service: '/partners/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="partners.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[data-key='" + id + "']").addClass("success");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
partners.changeHome = function(id) {
    ajax({
        service: '/partners/changehome',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-home='" + id + "']").html('<label class="label label-' + (resp.data.home == 1 ? 'success' : 'danger') + '" >' + (resp.data.home == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="partners.changeHome(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.home == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[data-key='" + id + "']").addClass("success");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
partners.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa đối tác này không ?", function() {
        ajax({
            service: '/partners/remove',
            data: {id: id},
            done: function(resp) {
                if (resp.success) {
                    $("tr[data-key='" + id + "']").addClass("danger");
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};
partners.add = function() {
    popup.open('popup-add', 'Tạo mới đối tác', Fly.template('/partners/add.tpl', null), [
        {
            title: 'Tạo mới',
            style: 'btn-success',
            fn: function() {
                ajaxSubmit({
                    service: '/partners/change',
                    id: 'form-add',
                    contentType: 'json',
                    done: function(rs) {
                        if (rs.success) {
                            popup.close('popup-add');
                            rs.next = $('tr[data-key]').length;
                            rs.edit = false;
                            var td = $('tr[data-key]').get(eval(0));
                            $(td).after(Fly.template('/partners/tr.tpl', rs));
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
                popup.close('popup-add');
            }
        }
    ]);
};
partners.edit = function(id) {
    ajax({
        service: '/partners/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit', 'Sửa thông tin đối tác', Fly.template('/partners/edit.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-success',
                        fn: function() {
                            ajaxSubmit({
                                service: '/partners/change',
                                id: 'form-edit',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        popup.close('popup-edit');
                                        rs.next = $('tr[data-key').index($('tr[data-key="' + rs.data.id + '"]'));
                                        rs.edit = true;
                                        $('tr[data-key="' + rs.data.id + '"]').html(Fly.template('/partners/tr.tpl', rs));
                                        $('tr[data-key="' + rs.data.id + '"]').addClass('success');
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
                            popup.close('popup-edit');
                        }
                    }
                ]);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

partners.changePosition = function(id) {
    var position = $('input[rel-data="' + id + '"]').val();
    if (position == '' || position == null) {
        popup.msg("Bạn phải nhập vị trí hiển thị!");
        return;
    }
    if (isNaN(position)) {
        popup.msg("Vị trí hiển thị phải là số !");
        return;
    }
    ajax({
        service: '/partners/changeposition',
        data: {id: id, position: position},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $('tr[data-key="' + id + '"]').addClass("info");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
partners.drawl = function(id) {
    ajax({
        service: '/partners/getall',
        loading: false,
        done: function(resp) {
            if (resp.success) {
                var html = '<option value="">Chọn hãng sản xuất</option>';
                if (resp.data != null && resp.data.length > 0) {
                    $.each(resp.data, function() {
                        if (this.id == id) {
                            html += '<option value="' + this.id + '" selected>-- ' + this.name + '</option>';
                        } else {
                            html += '<option value="' + this.id + '">-- ' + this.name + '</option>';
                        }

                    });
                }
                $('select[name=partnersId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};