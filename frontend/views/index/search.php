<?php

use common\util\TextUtils;
use common\util\UrlUtils;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Tìm kiếm</li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">Kết quả tìm kiếm cho từ khóa:<?= Yii::$app->request->get('keyword') ?></div>
        </div><!-- box-title -->
    </div><!-- box -->
    <div class="box box-gray">
        <div class="box-title">
            <div class="box-sort">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="bs-text" id="display">Hiển thị: <span class="text-danger"><?= $dataPage->dataCount ?></span> sản phẩm trên tổng số <span class="text-danger"><?= ceil($dataPage->dataCount / $dataPage->pageSize) ?></span> trang</span>
                        <a class="bs-button" href="#" style="display:none;"><i class="fa fa-th-list"></i></a>
                        <a class="bs-button active" href="#" style="display:none;"><i class="fa fa-th"></i></a>
                    </div><!-- col -->
                </div><!-- rox -->
            </div><!-- box-sort -->
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-list">
                <ul id="item">
                    <?php if ($dataPage->dataCount > 0) { ?>
                        <?php foreach ($dataPage->data as $item) { ?>

                            <li>
                                <div class="p-item">
                                    <div class="p-thumb">
                                        <?php if ($item->startPrice > $item->sellPrice) { ?>
                                            <span class="p-sale">-<?= TextUtils::calPercent($item->startPrice, $item->sellPrice) ?>%</span>
                                        <?php } ?>
                                        <a href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><img src="<?= empty($item->images) ? $this->context->baseUrl . 'images/no-image.jpg' : $item->images[0] ?>" alt="<?= $item->name ?>"></a>
                                    </div>
                                    <div class="p-row">
                                        <a class="p-title" href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><?= $item->name ?></a>
                                    </div>
                                    <div class="p-row">
                                        <?php if ($item->startPrice > $item->sellPrice) { ?>
                                            <span class="p-oldprice"><?= TextUtils::startPrice($item->startPrice) ?> đ</span>
                                            <span class="p-price"><?= TextUtils::sellPrice($item->sellPrice) ?> đ</span>
                                        <?php } else { ?>
                                            <span class="p-price"><?= TextUtils::sellPrice($item->sellPrice) ?> đ</span>
                                        <?php } ?>
                                    </div>
<!--                                    <div class="p-star">
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
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-list -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box-control">
        <div class="pagination-router">
            <?php
            $pagination = new Pagination(['totalCount' => $dataPage->dataCount]);
            $pagination->setPageSize($dataPage->pageSize);
            $pagination->setPage($dataPage->page - 1);
            ?>
            <?=
            LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel' => 'Tiếp',
                'prevPageLabel' => 'Sau',
                'maxButtonCount' => 5
            ]);
            ?>
        </div><!-- pagination-router -->
    </div><!-- box-control -->
</div>