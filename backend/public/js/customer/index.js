var index = {};

index.grid = function() {
    layout.title("Quản trị thông tin cơ bản");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["Thông tin", "#index/grid"],
        ["Thông tin cơ bản"]
    ]);

    ajax({
        service: '/home/get',
        data: {id: 1},
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/home/grid.tpl", resp));
            } else {
                popup.msg(resp.message);
            }
        }
    });

};
index.edit = function(id) {
    ajax({
        service: '/home/get',
        data: {id: id},
        done: function(resp) {
            if (resp.success) {
                console.log(resp.data);
                popup.open('popup-edit', 'Thay đổi thông tin', Fly.template('/home/add.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-success',
                        fn: function() {
                            ajaxSubmit({
                                service: '/home/change',
                                id: 'form-contact',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        location.reload();
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
                setTimeout(function() {
                    editor("bank", {});
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};