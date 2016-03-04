order = {};
order.grid = function() {
    layout.title("Quản trị đơn hàng");
    layout.breadcrumb([
        ["Trang chủ", "#index/grid"],
        ["đơn hàng", "#order/grid"],
        ["Quản lý đơn hàng"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 100;
    }

    ajax({
        service: '/order/grid',
        data: search,
        loading: true,
        done: function(resp) {
            if (resp.success) {
                layout.container(Fly.template("/order/grid.tpl", resp));
                setTimeout(function() {
                    viewUtils.initSearch("search");
                    $('input[data-search=createTimeFrom]').timeSelect();
                    $('input[data-search=createTimeTo]').timeSelect();
                    $('input[data-search=updateTimeFrom]').timeSelect();
                    $('input[data-search=updateTimeTo]').timeSelect();
                }, 300);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

order.remove = function(id) {
    popup.confirm("Bạn có chắc chắn muốn xóa đơn hàng này?", function() {
        ajax({
            service: '/order/remove',
            data: {id: id},
            loading: false,
            done: function(resp) {
                if (resp.success) {
                        $('tr[data-key=' + id + ']').addClass('danger');
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    });
};
