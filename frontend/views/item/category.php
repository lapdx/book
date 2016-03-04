<?php
use common\util\UrlUtils;
?>
<div class="main">
    <ol class="breadcrumb">
        <li><a href="#">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Sản phẩm</li>
    </ol> 
    <div class="box box-gray">
        <div class="box-title"><div class="lb-name">Danh mục sản phẩm</div></div>
        <div class="box-content">
            <div class="product-category">
                <ul>
                    <?php if (!empty($category)) { ?>
                        <?php foreach ($category as $c) { ?>
                            <?php if ($c->parentId == 0) { ?>
                    <input type="hidden" name="categoryId" value="<?= $c->id ?>">
                                <li>
                                    <div class="pc-item">
                                        <div class="pc-thumb"><a href="<?= $this->context->baseUrl.UrlUtils::browse($c->alias) ?>"><img src="<?= !empty($c->images) ? $c->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $c->name ?>" /></a></div>
                                        <div class="pc-title"><a href="<?= $this->context->baseUrl.UrlUtils::browse($c->alias) ?>"><?= $c->name ?></a></div>
                                    </div>	<!-- pc-item -->
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-category -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->