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
        <div class="checkout-title">Đơn hàng của bạn</div>
    </div><!-- col -->
</div><!-- row -->
<div class="row">
    <div class="col-sm-12">
        <div class="checkout-table">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="35%">Tên sản phẩm</th>
                            <th width="10%" class="text-center">Xoá</th>
                            <th width="15%" class="text-center">Số lượng</th>
                            <th width="20%" class="text-right">Đơn giá</th>
                            <th width="20%" class="text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order) && !empty($order->items)) { ?>
                            <?php
                            $total = 0;
                            foreach ($order->items as $item) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="grid">
                                            <div class="img"><a href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->sku) ?>"><img src="<?= !empty($item->image) ? $item->image : $this->context->baseUrl . 'no-image.jpg' ?>" alt="<?= $item->name ?>" /></a></div>
                                            <div class="g-content">
                                                <div class="g-row">
                                                    <a class="g-title" href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->sku) ?>"><?= $item->name ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><span class="fa fa-times cursor-pointer" onclick="order.removeItem('<?= $item->sku ?>')"></span></td>
                                    <td class="text-center">
                                        <input name="quantity" data-key="<?= $item->sku ?>" onchange="order.updateItem('<?= $item->sku ?>')" type="text" class="form-control text-inlineblock" value="<?= $item->quantity ?>" />
                                    </td>
                                    <td class="text-right"><?= TextUtils::sellPrice($item->sellPrice) ?> VNĐ</td>
                                    <td class="text-right"><?= TextUtils::sellPrice($item->sellPrice * $item->quantity) ?> VNĐ</td>
                                </tr>
                                <?php
                                $total += $item->sellPrice * $item->quantity;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="4"><b>Tổng:</b></td>
                                <td class="text-right"><b class="text-danger"><?= TextUtils::sellPrice($total) ?> VNĐ</b></td>
                            </tr>
                        </tfoot>
                    <?php } else { ?>
                        <tr><td colspan="5" class="text-center"> Không có sản phẩm nào bấm vào <a href="<?= $this->context->baseUrl ?>">đây</a> để quay lại trang chủ </td></tr>
<?php } ?>
                </table>
            </div><!-- table-responsive -->
        </div><!-- checkout-table -->
    </div><!-- col -->
</div><!-- row -->
<?php if (!empty($order) && !empty($order->items)) { ?>
    <form id="form-add">
        <div class="row">
            <div class="col-sm-6">
                <div class="checkout-info">
                    <h4>Phương thức thanh toán:</h4>
                    <div class="checkout-form form">
                        <div class="form-group">
                            <div class="radio">
                                <label><input name="paymentMethod" type="radio" value="<?= PaymentMethod::COD ?>" checked /> Thanh toán trực tiếp khi nhận hàng</label>
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <div class="radio">
                                <label><input name="paymentMethod" type="radio" value="<?= PaymentMethod::ATM ?>" /> Thanh toán chuyển khoản Ngân hàng</label>
                            </div>
                        </div><!-- form-group -->
                    </div><!-- checkout-form -->
                </div>
            </div><!-- col -->
            <div class="col-sm-6">
                <div class="checkout-form form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Họ và tên <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="name" type="text" value="" class="form-control" />
                        </div>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">Địa chỉ email <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="email" type="text" value="<?= $order->email ?>" class="form-control" />
                        </div>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">Điện thoại <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="phone" type="text" class="form-control" />
                        </div>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">Địa chỉ <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input name="address" type="text" class="form-control" />
                        </div>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">Ghi chú</label>
                        <div class="col-sm-8">
                            <textarea name="note" cols="" rows="3" class="form-control"></textarea>
                        </div>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="button" onclick="order.paymentSteepOne()" class="btn btn-primary btn-lg">Đặt hàng</button>
                        </div>
                    </div><!-- form-group -->
                </div><!-- checkout-form -->
            </div><!-- col -->
        </div><!-- row -->
    </form>
<?php } ?>