category = {};
category.grid = function() {
    layout.title("Quản trị danh mục sản phẩm");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Danh mục sản phẩm", "#category/grid"],
        ["Danh sách sản phẩm"]
    ]);

    ajax({
        service: '/category/grid',
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/category/grid.tpl", resp));
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.changeActive = function(id) {
    ajax({
        service: '/category/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="category.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $("tr[rel-data=" + id + "]").addClass('success');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};



category.changePosition = function(id) {
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
        service: '/category/changeposition',
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

category.drawcategory = function(parentId) {
    ajax({
        service: '/category/grid',
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
category.add = function() {
    popup.open('popup-add-newscategory', 'Thêm mới danh mục.', Fly.template('/category/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            fn: function() {
                ajaxSubmit({
                    service: '/category/save',
                    id: 'add-category',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                            var html = Fly.template('/category/tradd.tpl', rs);
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
    category.drawcategory();
};

category.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa danh mục này?", function() {
        ajax({
            service: '/category/remove',
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

category.edit = function(id) {
    ajax({
        service: '/category/getbyid',
        loading: false,
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit-newscategory', 'Sửa chữa danh mục.', Fly.template('/category/add.tpl', resp), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/category/save',
                                id: 'add-category',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        var html = Fly.template('/category/tradd.tpl', rs);
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
                category.drawcategory(resp.data.parentId);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
category.draw = function(id) {
    ajax({
        service: '/category/grid',
        loading: false,
        done: function(resp) {
            if (resp.success) {
                var html = '<option value="">Chọn danh mục</option>';
                if (resp.data != null && resp.data.length > 0) {
                    $.each(resp.data, function(key,value) {
                        if (this.parentId == 0) {
                            if(id == this.id){
                            html += '<option selected value="' + this.id + '">-- ' + this.name + '</option>';
                        }else{
                            html += '<option value="' + this.id + '">-- ' + this.name + '</option>';
                        }
                            $.each(resp.data, function() {
                                if (this.parentId == value.id) {
                                    if(id == this.id){
                                    html += '<option selected value="' + this.id + '">---- ' + this.name + '</option>';
                                    }else{
                                    html += '<option value="' + this.id + '">---- ' + this.name + '</option>';
                                    }
                                }
                            });
                        }
                    });
                }
                $('select[name=categoryId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};