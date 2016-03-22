<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="main_features_section">
    <div class="container">
        <div class="row">
            <div class="b__menu col s12 m6 l2">
                <div class="mega_menu">
                    <ul class="parent-menu">
                        <?php foreach($categories as $category):?>
                            <?php if(empty($category->subCategory)):?>
                                <li><a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a></li>
                            <?php else:?>
                                <li class="parent-name">
                                    <a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a>
                                    <ul class="submenu">
                                        <?php foreach($category->subCategory as $item):?>
                                            <li><a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $item->id])?>"><?=Html::encode($item->name)?></a></li>
                                        <?php endforeach?>
                                    </ul>
                                </li>
                            <?php endif;endforeach?>
                        </ul>
                    </div>
                </div>
                <div class="b__banner col s6 m6 l9">
                    <div class="banner_home">
                        <div id="owl-slider" class="owl-carousel owl-theme">
                            <div class="item"> <a href="#"><?=Html::img('@web/images/1.jpg')?></a> </div>
                            <div class="item"> <a href="#"><?=Html::img('@web/images/2.jpg')?></a> </div>
                            <div class="item"> <a href="#"><?=Html::img('@web/images/3.jpg')?></a> </div>
                        </div>
                    </div>
                </div>
                <div class="r__banner col s6 m6 l3">
                    <div class="banner_right">
                        <a href="#"><?=Html::img('@web/images/slider_banner_top.jpg')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_block_section">
        <div class="container">
            <div class="block">
                <div class="category-item-title">
                    <h2 class="block-title">Sản phẩm mới</h2>
                </div>
                <div class="carousel">
                    <?php foreach($new_items as $item):?>
                        <div class="carousel-item">
                            <div class="product-item">
                                <?=Html::img('@web/'.$item->getThumbnailImageUrl())?>
                                <?= Html::a(Html::encode($item->name), ['item/detail', 'id' => $item->id], ['class' => 'product-item-name']) ?>
                                <?php if($item->sellPrice != $item->startPrice):?>
                                    <span class="product-item-price-sale"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                                <?php endif?>
                                <span class="product-item-price"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                                <a class="product-item-cart add_to_cart" id="add_to_cart" data-id="<?=$item->id?>"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
            </div>

            <div class="block">
                <div class="category-item-title">
                    <h2 class="block-title">Sản phẩm giảm giá</h2>
                </div>
                <div class="carousel">
                    <?php foreach($sale_items as $item):?>
                        <div class="carousel-item">
                            <div class="product-item">
                                <?=Html::img('@web/'.$item->getThumbnailImageUrl())?>
                                <?=Html::a(Html::encode($item->name), ['item/detail', 'id' => $item->id], ['class' => 'product-item-name'])?>
                                <?php if($item->sellPrice != $item->startPrice):?>
                                    <span class="product-item-price-sale"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                                <?php endif?>
                                <span class="product-item-price"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                                <a class="product-item-cart add_to_cart" id="add_to_cart" data-id="<?=$item->id?>"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
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
        })
    </script>