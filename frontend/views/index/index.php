<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="main_features_section">
    <div class="container">
        <div class="row">
            <div class="col s6 m6 l2">
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
                                            <li><a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($item->name)?></a></li>
                                        <?php endforeach?>
                                    </ul>
                                </li>
                            <?php endif;endforeach?>
                        </ul>
                    </div>
                </div>
                <div class="col s6 m6 l9">
                    <div class="banner_home">
                        <div id="owl-slider" class="owl-carousel owl-theme">
                            <div class="item"> <a href="#"><?=Html::img('@web/images/1.jpg')?></a> </div>
                            <div class="item"> <a href="#"><?=Html::img('@web/images/2.jpg')?></a> </div>
                            <div class="item"> <a href="#"><?=Html::img('@web/images/3.jpg')?></div>
                        </div>
                    </div>
                </div>
                <div class="col s6 m6 l3">
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
                                <?php if(empty($item->images)) echo Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg');
                                else echo Html::img('@web/'.$item->images[0]->imageId)?>
                                <?= Html::a(Html::encode($item->name), ['item/detail', 'id' => $item->id], ['class' => 'product-item-name']) ?>
                                <?php if($item->sellPrice != $item->startPrice):?>
                                    <span class="product-item-price-sale"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                                <?php endif?>
                                <span class="product-item-price"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                                <a class="product-item-cart add_to_cart" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
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
                                <?php if(empty($item->images)) echo Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg');
                                else echo Html::img('@web/'.$item->images[0]->imageId)?>
                                <?= Html::a(Html::encode($item->name), ['item/detail', 'id' => $item->id], ['class' => 'product-item-name']) ?>
                                <?php if($item->sellPrice != $item->startPrice):?>
                                    <span class="product-item-price-sale"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                                <?php endif?>
                                <span class="product-item-price"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                                <a class="product-item-cart add_to_cart" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>