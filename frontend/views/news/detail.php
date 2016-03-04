<?php

use common\util\TextUtils;
use common\util\UrlUtils;
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
        <li><a href="<?= $this->context->baseUrl . UrlUtils::news() ?>"><i class="fa fa-long-arrow-right"></i>Tin tức</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $detail->name ?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $detail->name ?></div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="box-news">
                <div class="maincontent">
                    <?= $detail->detail ?>
                </div><div class="box-share">
                <ul>
                    <li><div class="fb-like" data-href="<?= $this->context->baseUrl . UrlUtils::news($detail->alias) ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
                    <li><div class="fb-share-button" data-href="<?= $this->context->baseUrl . UrlUtils::news($detail->alias) ?>" data-layout="button_count"></div></li>
                    <li><div data-size="standard" class="g-plusone" data-annotation="none" data-width="65" data-href="<?= $this->context->baseUrl . UrlUtils::news($detail->alias) ?>"></div></li>
                    <li><div class="g-plus" data-action="share" data-annotation="none" data-height="24" data-href="<?= $this->context->baseUrl . UrlUtils::news($detail->alias) ?>"></div></div></li>
                </ul>
            </div><!-- box-share -->
                <div class="box-other">
                    <div class="bo-title">Bài viết liên quan:</div>
                    <ul>
                        <?php foreach ($newss as $new) { ?>
                            <?php if ($new->id != $detail->id) { ?>
                                <li><a href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>"><?= $new->name ?><span> (<?= TextUtils::convertTime($new->createTime) ?>)</span></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div><!-- box-other -->
            </div><!-- box-news -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->