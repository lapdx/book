var item = {};

item.grid = function() {
    layout.title("Quản trị item");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Item", "#item/grid"],
        ["Danh sách item"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/item/grid',
        data: search,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/item/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

item.changeActive = function(id) {
    ajax({
        service: '/item/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hoạt động' : 'Tạm khóa') + '</label><i onclick="item.changeActive(\'' + id + '\');" style="cursor: pointer" class="pull-right glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[data-key='" + id + "']").addClass("success");
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

item.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa item này không ?", function() {
        ajax({
            service: '/item/remove',
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
item.add = function() {
    popup.open('popup-add', 'Tạo mới item', Fly.template('/item/add.tpl', null), [
        {
            title: 'Tạo mới',
            style: 'btn-success',
            fn: function() {
                ajaxSubmit({
                    service: '/item/change',
                    id: 'form-add',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                            popup.close('popup-add');
                            rs.next = $('tr[data-key]').length;
                            rs.edit = false;
                            var td = $('tr[data-key]').get(eval(0));
                            $(td).after(Fly.template('/item/tr.tpl', rs));
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
    setTimeout(function() {
        category.draw();
        partners.drawl();
//        editor("description", {});
    });
};
item.edit = function(id) {
    ajax({
        service: '/item/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit', 'Sửa thông tin item', Fly.template('/item/edit.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-success',
                        fn: function() {
                            ajaxSubmit({
                                service: '/item/change',
                                id: 'form-edit',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        popup.close('popup-edit');
                                        rs.edit = true;
                                        $('tr[data-key="' + rs.data.id + '"]').html(Fly.template('/item/tr.tpl', rs));
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
                setTimeout(function() {
                    category.draw(resp.data.categoryId);
                    partners.drawl(resp.data.partnersId);
//                    editor("description", {});
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

item.content = function(id) {
    ajax({
        service: '/item/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit', 'Nội dung', Fly.template('/item/content.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-success',
                        fn: function() {
                            ajaxSubmit({
                                service: '/item/content',
                                id: 'form-edit',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        popup.close('popup-edit');
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
                ], 'modal-lg');
                setTimeout(function() {
                    editor("content", {});
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
