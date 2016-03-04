var order = {};
order.addCartItem = function(id) {
    var quantity = $("input[rel=quantity]").val();
    if (isNaN(quantity)) {
        popup.msg("Số lượng phải nhập số !");
        return;
    } else {
        quantity = parseInt(quantity);
    }
    if (quantity < 1) {
        popup.msg("Vui lòng chọn số lượng cần mua !");
        return;
    }
    ajax({
        service: '/order/addtocart',
        data: {id: id, quantity: quantity},
        loading: true,
        done: function(resp) {
            if (resp.success) {
                var total = 0;
                popup.msg(resp.message, function() {
                    $.each(resp.data.items, function() {
                        total += this.sellPrice * this.quantity;
                    });
                    $('span.bc-price').html(textUtils.sellPrice(total) + "VNĐ");
                });

            } else {
                popup.msg(resp.message);
                return;
            }
        }
    });
};

order.paymentSteepOne = function() {
    ajaxSubmit({
        service: '/order/save',
        id: 'form-add',
        contentType: 'json',
        loading: true,
        done: function(rs) {
            if (rs.success) {
                window.location.href = baseUrl+'dat-hang-thanh-cong-'+rs.data.id+'.html';
            } else {
                popup.msg(rs.message);
            }
        }
    });
};

order.updateItem = function(id) {
    var quantity = $("input[data-key=" + id + "]").val();
    if (isNaN(quantity)) {
        popup.msg("Số lượng phải nhập số !");
        return;
    } else {
        quantity = parseInt(quantity);
    }
    if (quantity < 1) {
        popup.msg("Vui lòng chọn số lượng cần mua !");
    }
    ajax({
        service: '/order/updatecart',
        data: {id: id, quantity: quantity},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                popup.msg("Thay đổi số lượng thành công !", function() {
                    location.reload();
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};
order.removeItem = function(id) {
    popup.confirm("Bạn chắc chắn muốn xóa sản phẩm này không?", function() {
        ajax({
            service: '/order/removefromcart',
            data: {id: id},
            loading: false,
            done: function(resp) {
                if (resp.success) {
                    popup.msg("Sản phẩm đã bị xóa !", function() {
                        location.reload();
                    });
                } else {
                    popup.msg(resp.message);
                    return;
                }
            }
        });
    }, function() {
    });
};