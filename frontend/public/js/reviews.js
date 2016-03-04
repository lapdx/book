var reviews = {};
reviews.add = function() {

    ajaxSubmit({
        service: '/reviews/add',
        id: 'form-add',
        contentType: 'json',
        done: function(rs) {
            if (rs.success) {
                popup.msg(rs.message, function() {
                    location.reload();
                });
            } else {
                popup.msg(rs.message);
            }
        }
    });
};
