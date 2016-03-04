var contact = {};
contact.add = function() {
    ajaxSubmit({
        service: '/contact/save',
        id: 'form-contact',
        contentType: 'json',
        drawl: true,
        done: function(rs) {
            if (rs.success) {
                popup.msg(rs.message);
                $('input[name=email]').val('');
            } else {
                popup.msg(rs.message);
            }
        }
    });
};
contact.save = function() {
    ajaxSubmit({
        service: '/contact/savecontact',
        id: 'form-contacts',
        contentType: 'json',
        done: function(rs) {
            if (rs.success) {
                popup.msg(rs.message);
                $('input').val('');
                $('textarea').val('');
                location.reload();
            } else {
                popup.msg(rs.message);
            }
        }
    });
};
