meta = {};

meta.config = function(type, objectId) {
    ajax({
        service: '/meta/get',
        data: {type: type, objectId: objectId},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                resp.type = type;
                resp.objectId = objectId;
                console.log(resp);
                popup.open('popup-edit-banner', 'Cấu hình.', Fly.template('/meta/config.tpl', resp), [
                    {
                        title: 'Cập nhật',
                        style: 'btn-primary',
                        fn: function() {
                            ajaxSubmit({
                                service: '/meta/save',
                                id: 'form-config',
                                contentType: 'json',
                                loading: false,
                                done: function(rs) {
                                    if (rs.success) {
                                        popup.msg(rs.message, function() {
                                            popup.close('popup-edit-banner');
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
                        fn: function() {
                            popup.close('popup-edit-banner');
                        }
                    }
                ]);
            } else {
                popup.msg(resp.message);
            }
        }
    });
};