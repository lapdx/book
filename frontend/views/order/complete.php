<?php

use common\models\enu\PaymentMethod;
use common\util\TextUtils;
use common\util\UrlUtils;
?>
<ol class="breadcrumb">
    <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
    <li class="active"><i class="fa fa-long-arrow-right"></i>Giỏ hàng</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="checkout-title">Đặt hàng thành công</div>
    </div><!-- col -->
</div><!-- row -->
<div class="checkout-info">
    <div class="cf-code">MÃ ĐƠN HÀNG: <span class="text-danger"><?= $order->id ?></span></div>
    <p>Cám ơn bạn đã mua hàng tại hoalua.vn!
        <br />Bạn đã chọn hình thức Thanh toán: <b><?= $order->paymentMethod == PaymentMethod::COD ? 'Thanh toán trực tiếp khi nhận hàng' : 'Chuyển khoản ngân hàng' ?></b>, số tiền cần thanh toán để đặt hàng là: <span class="text-danger"><?= TextUtils::sellPrice($order->totalPrice) ?> đ</span></p>
    <br />
    <p>Bạn có muốn:</p>
    <p>Xem lại <a href="<?= $this->context->baseUrl . UrlUtils::orderDetail($order->id) ?>">Hóa đơn mua hàng.</a></p>
    <p>Trở về <a href="<?= $this->context->baseUrl ?>">Trang chủ.</a></p>
</div><!-- checkout-info -->