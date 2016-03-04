<?php

use common\util\TextUtils;
use common\util\UrlUtils;
?>
<div class="main">
    <div class="main-slider">
        <div id="heartslider" class="owl-carousel">
            <?php if (!empty($heart)) { ?>
                <?php foreach ($heart as $b) { ?>
                    <div class="h-item">
                        <img src="<?= !empty($b->images) ? $b->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $b->name ?>" />
                    </div><!-- h-item -->
                <?php } ?>
            <?php } ?>
        </div><!-- owl-carousel -->
    </div><!-- main-slider -->
    <div class="box">
        <div class="box-title"><div class="lb-name">Sản phẩm giảm giá</div></div>
        <div class="box-content">
            <div class="sale-home">
                <div id="saleslider" class="owl-carousel">
                    <?php if (!empty($boxs)) { ?>
                        <?php
                        foreach ($boxs as $item) {
                            $item = $item->item;
                            if (!empty($item)) {
                            ?>
                            <div class="p-item">
                                <div class="p-thumb">
                                    <?php if ($item->startPrice > $item->sellPrice) { ?>
                                        <span class="p-sale">-<?= TextUtils::calPercent($item->startPrice, $item->sellPrice) ?>%</span>
                                    <?php } ?>
                                    <a href="<?= $this->context->baseUrl.UrlUtils::item($item->name, $item->id) ?>"><img src="<?= !empty($item->images) ? $item->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $item->name ?>" /></a>
                                </div>
                                <div class="p-row">
                                    <a class="p-title" href="<?= $this->context->baseUrl.UrlUtils::item($item->name, $item->id) ?>"><?= $item->name ?></a>
                                </div>
                                <div class="p-row">
                                <?php if ($item->startPrice > $item->sellPrice) { ?>
                                    <span class="p-oldprice"><?= TextUtils::startPrice($item->startPrice) ?> đ</span><?php } ?><span class="p-price"><?= TextUtils::sellPrice($item->sellPrice) ?> đ</span>
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
                        <?php }} ?>
                    <?php } ?>
                </div><!-- owl-carousel -->
            </div><!-- sale-home -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box">
        <div class="box-title"><div class="lb-name">Sản phẩm bán chạy</div></div>
        <div class="box-content">
            <div class="product-list">
                <ul>
                    <?php if (!empty($sell)) { ?>
                        <?php
                        foreach ($sell as $item) {
                            $item = $item->item;
                            if (!empty($item)) {
                            ?>
                            <li>
                                <div class="p-item">
                                    <div class="p-thumb">
                                        <?php if ($item->startPrice > $item->sellPrice) { ?>
                                            <span class="p-sale">-<?= TextUtils::calPercent($item->startPrice, $item->sellPrice) ?>%</span>
                                        <?php } ?>
                                        <a href="<?= UrlUtils::item($item->name, $item->id) ?>"><img src="<?= !empty($item->images) ? $item->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $item->name ?>" /></a>
                                    </div>
                                    <div class="p-row">
                                        <a class="p-title" href="<?= UrlUtils::item($item->name, $item->id) ?>"><?= $item->name ?></a>
                                    </div>
                                    <div class="p-row">
                                    <?php if ($item->startPrice > $item->sellPrice) { ?>
                                        <span class="p-oldprice"><?= TextUtils::startPrice($item->startPrice) ?> đ</span><?php } ?><span class="p-price"><?= TextUtils::sellPrice($item->sellPrice) ?> đ</span>
                                    </div>
                                    
                                    <!--                            <div class="p-star">
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
                        <?php }} ?>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-list -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->