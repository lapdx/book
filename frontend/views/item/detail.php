<?php

use common\util\TextUtils;
use common\util\UrlUtils;

$home = isset($this->context->var["home"]) ? $this->context->var["home"] : '';
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li><a href="<?= $this->context->baseUrl ?>"><i class="fa fa-long-arrow-right"></i><?= $detail->categoryName ?></a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $detail->name ?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $detail->name ?></div>
            <div class="box-share">
                <ul>
                    <li><div class="fb-like" data-href="<?= $this->context->baseUrl . UrlUtils::item($detail->name, $detail->id) ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
                    <li><div data-size="standard" class="g-plusone" data-annotation="bubble" data-width="300" data-href="<?= $this->context->baseUrl . UrlUtils::item($detail->name, $detail->id) ?>"></div></li>
                </ul>
            </div><!-- box-share -->
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-desc">
                <div class="row sm-reset-5">
                    <div class="col-sm-6 padding-left-5">
                        <div class="product-image">
                            <?php if ($detail->sellPrice < $detail->startPrice) { ?>
                                <span class="pi-sale">-<?= TextUtils::calPercent($detail->startPrice, $detail->sellPrice) ?>%</span>
                            <?php } ?>
                            <div class="pi-inner">
                                <img id="myCloudZoom" class="cloudzoom" src="<?= empty($detail->images) ? $this->context->baseUrl . 'images/no-image.jpg' : $detail->images[0] ?>" data-cloudzoom ="zoomSizeMode: 'image', zoomImage: '<?= empty($detail->images) ? $this->context->baseUrl . 'images/no-image.jpg' : $detail->images[0] ?>'" alt="Click to view image!" />
                            </div>
                        </div><!-- product-image -->
                        <div class="pi-slider">
                            <?php if ($detail->sellPrice < $detail->startPrice) { ?>
                                <span class="pi-sale">-<?= TextUtils::calPercent($detail->startPrice, $detail->sellPrice) ?>%</span>
                            <?php } ?>
                            <div id="imageslider" class="owl-carousel">
                                <?php if (empty($detail->images)) { ?>
                                    <div class="pi-item active">
                                        <a class="cloudzoom-gallery" href="<?= $this->context->baseUrl ?>images/no-image.jpg" data-cloudzoom="useZoom:'.cloudzoom', image:'<?= $this->context->baseUrl ?>images/no-image.jpg' "><img src="<?= $this->context->baseUrl ?>images/no-image.jpg"></a>
                                    </div>
                                    <?php
                                } else {
                                    $i = 0;
                                    foreach ($detail->images as $image) {
                                        $i++;
                                        ?>
                                        <div class="pi-item <?= $i == 1 ? 'active' : '' ?>">
                                            <a class="cloudzoom-gallery" href="<?= $image ?>" data-cloudzoom="useZoom:'.cloudzoom', image:'<?= $image ?>' "><img src="<?= $image ?>"></a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div><!-- owl-carousel -->
                        </div><!-- pi-slider -->
                    </div><!-- col -->
                    <div class="col-sm-6 padding-all-5">
                        <div class="pd-center">
                            <div class="pd-title"><h1><?= $detail->name ?></h1></div>
                            <div class="pd-row">
                                <p><?= $detail->description ?></p>
                            </div><!-- pd-row -->
                            <?php if ($detail->sellPrice < $detail->startPrice) { ?>
                                <div class="pd-row">
                                    <label style="color:#fa8600">Giá chính hãng:</label>
                                    <div class="pd-text"><span class="pd-oldprice"><?= TextUtils::startPrice($detail->startPrice) ?> VNĐ</span></div>
                                </div><!-- pd-row -->
                                <div class="pd-row">
                                    <label style="color:#fa8600">Giá khuyến mại:</label>
                                    <div class="pd-text"><span class="pd-price"><?= TextUtils::sellPrice($detail->sellPrice) ?> VNĐ</span></div>
                                </div><!-- pd-row -->
                            <?php } else { ?>
                                <div class="pd-row">
                                    <label style="color:#fa8600">Giá bán :</label>
                                    <div class="pd-text"><span class="pd-price"><?= TextUtils::startPrice($detail->sellPrice) ?> VNĐ</span></div>
                                </div><!-- pd-row -->
                            <?php } ?>
                            <?php if (!empty($detail->gift)) { ?>
                                                            <div class="pd-row">
                                    <label style="color:#fa8600">QUÀ TẶNG :</label>
                                    <div class="pd-text"><span class="pd-price"><?= $detail->gift ?></span></div>
                                </div><!-- pd-row -->
                            <?php } ?>
                            <div class="pd-row">
                                <label style="color:#fa8600">Số lượng:</label>
                                <div class="pd-text">
                                    <input name="quantity" rel="quantity" type="text" class="form-control pd-qty" value="1" />
                                    <a class="btn btn-primary btn-buy" onclick="order.addCartItem('<?= $detail->id ?>')" style="background-color:#fa8600">Đặt mua</a>
                                </div>
                            </div><!-- pd-row -->
                            <div class="box-support">
                                <div class="support-title"><i class="fa fa-phone"></i>Liên hệ ngay để có giá tốt nhất!</div>
                                <div class="support-content">
                                    <p><b>Hà Nội:</b> <?= !empty($home) ? $home->address1 : '' ?> Tel: <span class="text-danger"><?= !empty($home) ? $home->tel1 : '' ?></span></p>
                                    <p><b>Hà Nội:</b> <?= !empty($home) ? $home->address2 : '' ?> Tel : <span class="text-danger"><?= !empty($home) ? $home->tel2 : '' ?></span></p>
                                    <p><b>TP. HCM:</b> <?= !empty($home) ? $home->address3 : '' ?> Tel : <span class="text-danger"><?= !empty($home) ? $home->tel3 : '' ?></span></p>
                                </div><!-- support-content -->
                            </div><!-- box-support -->
                        </div><!-- pd-center -->
                    </div><!-- col -->
                </div><!-- row -->
                <div class="pd-tabs" role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
                        <li role="presentation"><a href="#comments" role="tab" data-toggle="tab">Bình luận - Đánh giá</a></li>
                    </ul><!-- nav-tabs -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="description">
                            <div class="maincontent">                                            
                                <?= $detail->content ?>
                            </div><!-- maincontent -->
                        </div><!-- tab-pane -->
                        <div role="tabpanel" class="tab-pane" id="comments">
                            <div class="fb-comments" data-href="<?= $this->context->baseUrl . UrlUtils::item($detail->name, $detail->id) ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
                        </div><!-- tab-pane -->
                    </div><!-- tab-content -->
                </div><!-- pd-tabs -->
            </div><!-- product-desc -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box">
        <div class="box-title"><div class="lb-name">Sản phẩm cùng loại</div></div>
        <div class="box-content">
            <div class="product-list">
                <ul>
                    <?php if (!empty($items)) { ?>
                        <?php
                        foreach ($items as $item) {
                            if ($item->id != $detail->id) {
                                ?>
                                <li>
                                    <div class="p-item">
                                        <div class="p-thumb">
                                            <?php if ($item->startPrice > $item->sellPrice) { ?>
                                                <span class="p-sale">-<?= TextUtils::calPercent($item->startPrice, $item->sellPrice) ?>%</span>
                                            <?php } ?>
                                            <a href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><img src="<?= !empty($item->images) ? $item->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $item->name ?>" /></a>
                                        </div>
                                        <div class="p-row">
                                            <a class="p-title" href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><?= $item->name ?></a>
                                        </div>
                                        <div class="p-row">
                                            <span class="p-oldprice"><?= TextUtils::startPrice($item->startPrice) ?> đ</span><span class="p-price"><?= TextUtils::sellPrice($item->sellPrice) ?> đ</span>
                                        </div>
                                        <!--                                <div class="p-star">
                                                                            <i class="fa fa-star active"></i>
                                                                            <i class="fa fa-star active"></i>
                                                                            <i class="fa fa-star active"></i>
                                                                            <i class="fa fa-star active"></i>
                                                                            <i class="fa fa-star active"></i>
                                                                        </div>-->
                                        <div class="p-row">
                                            <?= $item->description ?>
                                        </div>
                                    </div><!-- p-item -->
                                </li>
                            <?php }
                        }
                        ?>
<?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-list -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->