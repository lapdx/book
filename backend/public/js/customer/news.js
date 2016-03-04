news = {};
news.grid = function() {
    layout.title("Quản trị tin tức");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Tin tức", "#news/grid"],
        ["Quản lý tin tức"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/news/grid',
        data: search,
        loading: true,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/news/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                    $('input[data-search=createTime]').timeSelect();
                    $('input[data-search=createTimeTo]').timeSelect();
                    $('input[data-search=updateTime]').timeSelect();
                    $('input[data-search=updateTimeTo]').timeSelect();
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

news.add = function() {
    popup.open('popup-add-news', 'Thêm mới tin tức.', Fly.template('/news/add.tpl'), [
        {
            title: 'Thêm mới',
            style: 'btn-primary',
            loading: false,
            fn: function() {
                ajaxSubmit({
                    service: '/news/add',
                    id: 'add-news',
                    contentType: 'json',
                    loading: false,
                    done: function(rs) {
                        if (rs.success) {
                                var html = Fly.template('/news/tradd.tpl', rs);
                                $('#mytable tbody[rel-data="bodydata"]').prepend(html);
                                $('tr[rel-data='+rs.data.id+']').addClass('success');
                                popup.close('popup-add-news');
                        } else {
                            popup.msg(rs.message);
                        }
                    }
                });
                $('#popup-add-news').removeAttr('style');
                $('#popup-add-news').attr('style', 'position: absolute;overflow: visible;display:block');
                
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function() {
                popup.close('popup-add-news');
            }
        }
    ], 'modal-lg');
    setTimeout(function() {
        editor("detail", {});
    });
    news.drawcategory();
};

news.drawcategory = function(categoryId) {
    ajax({
        service: '/newscategory/grid',
        loading: false,
        done: function(resp) {
            if (resp.success) {
                var html = '';
                if (resp.data != null && resp.data.length > 0) {
                    $.each(resp.data, function() {
                        var id = this.id;
                        if (this.parentId == 0) {
                            if (this.id == categoryId) {
                                html += '<option value="' + this.id + '" selected>-- ' + this.name + '</option>';
                            } else {
                                html += '<option value="' + this.id + '">-- ' + this.name + '</option>';
                            }
                        }
                        $.each(resp.data, function() {
                            if (this.parentId == id) {
                                if (this.id == categoryId) {
                                    html += '<option value="' + this.id + '" selected>-- -- ' + this.name + '</option>';
                                } else {
                                    html += '<option value="' + this.id + '">-- -- ' + this.name + '</option>';
                                }
                            }
                        });
                    });
                }
                $('select[name=categoryId]').html(html);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

news.edit = function(id) {
    ajax({
        service: '/news/getbyid',
        loading: false,
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                popup.open('popup-edit-news', 'Sửa tin tức.', Fly.template('/news/add.tpl', resp), [
                    {
                        title: 'Sửa',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/news/add',
                                id: 'add-news',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                            $('td[data-name="' + id + '"]').empty().html(rs.data.name);
                                            $('td[data-updateTime="' + id + '"]').empty().html(textUtils.formatTime(rs.data.updateTime));
                                            $('td div[data-key-active="' + id + '"]').empty().html('<label class="label label-' + (rs.data.active == 1 ? 'success' : 'danger') + '" >' + (rs.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + rs.data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (rs.data.active == 1 ? 'check' : 'unchecked') + '" />');
                                            $('td div[data-key-nav="' + id + '"]').empty().html('<label class="label label-' + (rs.data.home == 1 ? 'success' : 'danger') + '" >' + (rs.data.home == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeHome(\'' + rs.data.id + '\')" style="cursor: pointer; margin-left: 5px" class="glyphicon glyphicon-' + (rs.data.home == 1 ? 'check' : 'unchecked') + '" />');
                                            $('td div[data-key-footer="' + id + '"]').empty().html('<label class="label label-' + (rs.data.footer == 1 ? 'success' : 'danger') + '" >' + (rs.data.footer == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label>');
                                            $('tr[rel-data='+id+']').addClass('success');
                                            popup.close('popup-edit-news');
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
                            popup.close('popup-edit-news');
                        }
                    }
                ], 'modal-lg');
                setTimeout(function() {
                    editor("detail", {});
                });
                news.drawcategory(resp.data.categoryId);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

news.changeActive = function(id) {
    ajax({
        service: '/news/changeactive',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-active='" + id + "']").html('<label class="label label-' + (resp.data.active == 1 ? 'success' : 'danger') + '" >' + (resp.data.active == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeActive(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.active == 1 ? 'check' : 'unchecked') + '" />');
                $('tr[rel-data='+id+']').addClass('success');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
news.changeHome = function(id) {
    ajax({
        service: '/news/changehome',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $("div[data-key-nav='" + id + "']").html('<label class="label label-' + (resp.data.home == 1 ? 'success' : 'danger') + '" >' + (resp.data.home == 1 ? 'Hiển thị' : 'Tạm khóa') + '</label><i onclick="news.changeHome(\'' + id + '\');" style="cursor: pointer; margin-left:5px" class="glyphicon glyphicon-' + (resp.data.home == 1 ? 'check' : 'unchecked') + '" />');
                $('tr[rel-data='+id+']').addClass('success');
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

news.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa tin tức này?", function() {
        ajax({
            service: '/news/remove',
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
