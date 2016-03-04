<?php

use common\util\TextUtils;
use common\util\UrlUtils;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Tin tức</li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">Tin tức</div>
            <!--                        <div class="box-share">
                                            <ul>
                                            <li><img src="data/facebook-like.png" alt="facebook" /></li>
                                            <li><img src="data/googleplus-like.png" alt="facebook" /></li>
                                        </ul>
                                    </div> box-share -->
        </div><!-- box-title -->
        <div class="box-content">
            <div class="news-list">
                <?php if (!empty($dataPage->data)) { ?>
    <?php foreach ($dataPage->data as $new) { ?>
                        <div class="grid">
                            <div class="img"><a href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>"><img src="<?= (isset($new->images[0]) ? $new->images[0] : $this->context->baseUrl . 'images/no_avatar.png') ?>" alt="<?= $new->name ?>"></a></div>
                            <div class="g-content">
                                <div class="g-row">
                                    <a class="g-title" href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>"><h2 class="g-title"><?= $new->name ?></h2></a>
                                </div>
                                <div class="g-row">
                                    <span class="g-time"><?= TextUtils::convertTime($new->createTime) ?></span>
                                </div>
                                <div class="g-row">
        <?= $new->description ?>
                                </div>
                                <a class="g-view" href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>">Xem tiếp...</a>
                            </div>
                        </div><!-- grid -->
                    <?php } ?>
<?php } ?>
            </div><!-- news-list -->
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
</div><!-- main -->