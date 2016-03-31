<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="product_content">
    <div class="container">
        <nav class="b-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="<?=Url::home()?>" class="breadcrumb">Trang chủ</a>
                    <a href="<?=Url::toRoute(['item/category', 'id' => $item->category->id])?>" class="breadcrumb"><?=Html::encode($item->category->name)?></a>
                    <a href="<?=Url::toRoute(['item/detail', 'id' => $item->id])?>" class="breadcrumb"><?=Html::encode($item->name)?></a>
                </div>
            </div>
        </nav>

        <div class="row">
            <div id="service_left" class="col s12 m12 l9">
                <div class="service_info">
                    <div id="service_info_left" class="col s12 m6 l4">
                        <div id="sync1" class="owl-carousel">
                            <?php if(empty($item->getAllImages())): ?>
                                <div class="item"><?=Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg')?></div>
                                <div class="item"><?=Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg')?></div>
                            <?php else: foreach($item->getAllImages() as $image):?>
                                <div class="item"><?=Html::img('@web/'.$image->imageId)?></div>
                            <?php endforeach;endif?>
                        </div>
                        <div id="sync2" class="owl-carousel">
                            <?php if(empty($item->getAllImages())): ?>
                                <div class="item"><a href="#"><?=Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg')?></a></div>
                                <div class="item"><a href="#"><?=Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg')?></a></div>
                            <?php else: foreach($item->getAllImages() as $image):?>
                                <div class="item"><a href="#"><?=Html::img('@web/'.$image->imageId)?></a></div>
                            <?php endforeach;endif?>
                        </div>
                    </div>
                    <div id="service_info_right" class="col s12 m6 l8">
                        <h1 class="product-name" itemprop="name"><?=Html::encode($item->name)?></h1>
                        <p class="product-availability">Tình trạng: <span> Còn hàng </span></p>
                        <p class="product-price">
                            <?php if($item->sellPrice != $item->startPrice) echo number_format($item->sellPrice,0,',','.').'đ <span>'.number_format($item->startPrice,0,',','.').'đ </span>';else echo number_format($item->sellPrice,0,',','.').'đ'?>
                        </p>
                        <?php $item->content = strip_tags($item->content);?>
                        <p class="product-description short"><?=substr($item->content,0,580)?>.....<span class="text-blue" id="expand" href="#">Xem thêm</span></p>
                        <p class="product-description full" style="display: none"><?=$item->content?> <span class="text-blue" id="collapse" href="#">Thu gọn</span></p>
                        <a class="product-item-cart add_to_cart" id="add_to_cart" data-id="<?=$item->id?>"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            
            <div id="service_right" class="col s12 m12 l3">
                <?php if(!empty($selling)):?>
                    <div class="sb-block background-white">
                        <div class="sb-block-title">
                            <h2>Sản phẩm bán chạy</h2>
                        </div>
                        <div class="sb-block-content sb-products">
                            <ul>
                                <?php foreach($selling as $sell):
                                $item = $sell->book;?>
                                <li class="product-item-mini">
                                    <a href="<?=Url::toRoute(['item/detail', 'id' => $item->id])?>">
                                        <?= Html::img('@web/'.$item->getThumbnailImageUrl(),['class'=>'pim-image'])?>
                                        <h3 class="pim-name"><?=Html::encode($item->name)?></h3>
                                        <p class="pim-description"><?=substr(strip_tags($item->content),0,100)?></p>
                                        <?php if($item->sellPrice != $item->startPrice):?>
                                            <p class="pim-price"> <?=$item->sellPrice?>₫ <span> <?=$item->startPrice?>₫ </span></p> 
                                        <?php else:?>
                                            <p class="pim-price"> <?=$item->sellPrice?>₫</p>
                                        <?php endif?>
                                    </a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
            <?php endif?>
            <div class="sb-block">
                <a href="#">
                    <?=Html::img('@web/images/banner_category_sidebar.png',['class'=>'img-responsive'])?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="cc-products">
    <div class="container">
        <h2 class="cc-products-title">Sản phẩm Liên quan</h2>
        <div class="row">
            <?php foreach($item->category->getTopParentCategory()->getAllItem() as $relative):?>
                <div class="col s12 m6 l3">
                    <div class="product-item-category">
                        <div class="product-item">
                            <a href="<?=Url::toRoute(['item/detail', 'id' => $relative->id])?>">
                                <?=Html::img('@web/'.$relative->getThumbnailImageUrl())?>
                                <span class="product-item-name"><?=Html::encode($relative->name)?></span>
                            </a>
                            <?php if($relative->sellPrice != $relative->startPrice):?>
                                <span class="product-item-price-sale"><?=number_format($relative->startPrice,0,',','.')?>đ</span>
                            <?php endif?>
                            <span class="product-item-price"><?=number_format($relative->sellPrice,0,',','.')?>đ</span>
                            <a class="product-item-cart add_to_cart waves-effect waves-light" id="add_to_cart" data-id="<?=$item->id?>"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('a#add_to_cart').click(function(){
            $.ajax({
                url: '<?=Yii::$app->homeUrl?>item/add_to_cart',
                method: 'POST',
                data: {
                    id: $(this).data('id'),
                    quantity: 1,
                    type: 'add',
                }
            })
            .done(function(data) {
                data = JSON.parse(data);
                Materialize.toast('Bạn đã thêm sản phẩm vào giỏ hàng thành công!', 4000)
                $('.item_cart').text(data.total);
            })
            .fail(function() {
                console.log("error");
            });
        })
        $('#expand').click(function(){
            $('.short').hide();
            $('.full').show();
        });
        $('#collapse').click(function(){
            $('.full').hide();
            $('.short').show();
        })
    })
</script>