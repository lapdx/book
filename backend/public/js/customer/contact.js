var contact = {};

contact.grid = function() {
    layout.title("Quản trị liên hệ");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Liên hệ", "#contact/grid"],
        ["Danh sách liên hệ"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/contact/grid',
        data: search,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/contact/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                    $('input[data-search=createTimeFrom]').timeSelect(true);
                    $('input[data-search=updateTimeFrom]').timeSelect(true);
                    $('input[data-search=createTimeTo]').timeSelect(true);
                    $('input[data-search=updateTimeTo]').timeSelect(true);
                }, 300);

            } else {
                popup.msg(resp.message);
            }
        }
    });

};

contact.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa liên hệ này không ?", function() {
        ajax({
            service: '/contact/remove',
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
contact.add = function() {
    popup.open('popup-add', 'Tạo mới thương hiệu', Fly.template('/contact/add.tpl', null), [
        {
            title: 'Tạo mới',
            style: 'btn-success',
            fn: function() {
                ajaxSubmit({
                    service: '/contact/change',
                    id: 'form-contact',
                    contentType: 'json',
                    loading:false,
                    done: function(rs) {
                        if (rs.success) {
                            popup.close('popup-add');
                            rs.next = $('tr[data-key]').length;
                            rs.edit = false;
                            var td = $('tr[data-key]').get(eval(0));
                            $(td).after(Fly.template('/contact/tr.tpl', rs));
                            $('tr[data-key="' + rs.data.id + '"]').addClass('success');
                        } else {
                            popup.msg(rs.message);
                        }
                    }
                });
                $('#popup-add').removeAttr('style');
                $('#popup-add').attr('style', 'position: absolute;overflow: visible;display:block');
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
contact.edit = function(id) {
    ajax({
        service: '/contact/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit', 'Sửa thông tin liên hệ', Fly.template('/contact/add.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-success',
                        fn: function() {
                            ajaxSubmit({
                                service: '/contact/change',
                                id: 'form-contact',
                                contentType: 'json',
                                loading:false,
                                done: function(rs) {
                                    if (rs.success) {
                                        popup.close('popup-edit');
                                        rs.next = $('tr[data-key').index($('tr[data-key="' + rs.data.id + '"]'));
                                        rs.edit = true;
                                        $('tr[data-key="' + rs.data.id + '"]').html(Fly.template('/contact/tr.tpl', rs));
                                        $('tr[data-key="' + rs.data.id + '"]').addClass("success");
                                    } else {
                                        popup.msg(rs.message);
                                    }
                                }
                            });
                            $('#popup-edit').removeAttr('style');
                            $('#popup-edit').attr('style', 'position: absolute;overflow: visible;display:block');
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
contact.detail = function(id) {
    ajax({
        service: '/contact/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit', 'Chi tiết thông tin liên hệ', Fly.template('/contact/detail.tpl', resp), [
                    
                ]);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};