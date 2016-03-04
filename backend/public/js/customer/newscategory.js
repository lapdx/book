newscategory = {};
newscategory.grid = function() {
    layout.title("Quản trị danh mục tin tức");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Danh mục tin tức", "#newscategory/grid"],
        ["Danh sách tin tức"]
    ]);

    ajax({
        service: '/newscategory/grid',
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/newscategory/grid.tpl", resp));
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
newscategory.changeActive = function(id) {
    ajax({
        service: '/newscategory/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[rel-data=" + id + "]").addClass('success');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
newscategory.changeMenu = function(id) {
    ajax({
        service: '/newscategory/changemenu',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-menu='" + id + "']").html('<label class="label label-' + (resp.data.menu == 1 ? 'success' : 'danger') + '" >' + (resp.data.menu == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="newscategory.changeMenu(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.menu == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[rel-data=" + id + "]").addClass('success');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};



newscategory.changePosition = function(id) {
    var position = $('input[rel-data="' + id + '"]').val();
    if (position == '' || position == null) {
        popup.msg("Bạn phải nhập vị trí hiển thị!");
        return;
    }
    if (isNaN(position)) {
        popup.msg("Vị trí phải là số");
        return;
    }
    ajax({
        service: '/newscategory/changeposition',
        data: {id: id, position: position},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("tr[rel-data=" + id + "]").addClass('info');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

newscategory.drawcategory = function(parentId) {
    ajax({
        service: '/newscategory/grid',
        loading: false,
        done: function(resp) {
            if (resp.success) {
                var html = '<option value="0">Là danh mục gốc</option>';
                if (resp.data != null && resp.data.length > 0) {
                    $.each(resp.data, function() {
                        if (this.parentId == 0) {
                            if (this.id == parentId) {
                                html += '<option value="' + this.id + '" selected>-- ' + this.name + '</option>';
                            } else {
                                html += '<option value="' + this.id + '">-- ' + this.name + '</option>';
                            }

                        }
                    });
                }
                $('select[name=parentId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
newscategory.add = function() {
    popup.open('popup-add-newscategory', 'Thêm mới danh mục.', Fly.template('/newscategory/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            fn: function() {
                ajaxSubmit({
                    service: '/newscategory/save',
                    id: 'add-category',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                            var html = Fly.template('/newscategory/tradd.tpl', rs);
                            if (rs.data.parentId == 0) {
                                $('tbody[rel-data="bodydata"]').prepend(html);
                            } else {
                                $('tr[rel-data=' + rs.data.parentId + ']').after(html);
                            }
                            popup.close('popup-add-newscategory');
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
                popup.close('popup-add-newscategory');
            }
        }
    ]);
    newscategory.drawcategory();
};

newscategory.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa danh mục này?", function() {
        ajax({
            service: '/newscategory/remove',
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

newscategory.edit = function(id) {
    ajax({
        service: '/newscategory/getbyid',
        loading: false,
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit-newscategory', 'Sửa chữa danh mục.', Fly.template('/newscategory/add.tpl', resp), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/newscategory/save',
                                id: 'add-category',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                            var html = Fly.template('/newscategory/tradd.tpl', rs);
                                            $('tr[rel-data=' + id + ']').remove();
                                            if (rs.data.parentId == 0) {
                                                $('tbody[rel-data="bodydata"]').prepend(html);
                                            } else {
                                                $('tr[rel-data=' + rs.data.parentId + ']').after(html);
                                            }
                                            popup.close('popup-edit-newscategory');
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
                            popup.close('popup-edit-newscategory');
                        }
                    }
                ]);
                newscategory.drawcategory(resp.data.parentId);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};