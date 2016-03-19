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
                    <?php if(!empty($main_category->parentCategory)):?>
                        <a href="<?=Url::toRoute(['item/category', 'id' => $main_category->parentCategory->id])?>" class="breadcrumb"><?=Html::encode($main_category->parentCategory->name)?></a>
                    <?php endif;?>
                    <a href="<?=Url::toRoute(['item/category', 'id' => $main_category->id])?>" class="breadcrumb"><?=Html::encode($main_category->name)?></a>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col s12 m6 l3 sidebar">
                <div class="sb-block">
                    <div class="sb-block-title">
                        <h2>Danh mục sản phẩm</h2>
                    </div>
                    <div class="sb-block-content nav-category">
                        <ul>
                            <?php foreach($categories as $category):?>
                                <li>
                                    <a <?php if($category->id == $main_category->id) echo 'class="active"'?> href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a>
                                    <?php if(!empty($category->subCategory)):foreach ($category->subCategory as $item):?> 
                                        <a <?php if($item->id == $main_category->id) echo 'class="active"'?> href="<?=Url::toRoute(['item/category', 'id' => $item->id])?>">&nbsp;&nbsp;» <?=Html::encode($item->name)?></a>
                                    <?php endforeach;endif?>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
                <div class="sb-block"> 
                    <a href="#">
                        <?=Html::img('@web/images/banner_category_sidebar.png',['class'=>'img-responsive'])?>
                    </a> 
                </div>
                <div class="sb-block">
                    <div class="sb-block-title">
                        <h2>Sản phẩm bán chạy</h2>
                    </div>
                    <div class="sb-block-content sb-products">
                        <ul>
                            <li class="product-item-mini"> 
                                <a href="#"> 
                                    <img class="pim-image" src="img/nhat-ky-hoc-lam-banh--1-.jpg">
                                    <h3 class="pim-name">Nếu gặp người ấy</h3>
                                    <p class="pim-description"> Cả hai im lặng một lúc, tôi...</p>
                                    <p class="pim-price"> 65.000₫ <span> 86.000₫ </span> </p>
                                </a> 
                            </li>
                            <li class="product-item-mini"> 
                                <a href="#"> 
                                    <img class="pim-image" src="img/nhat-ky-hoc-lam-banh--1-.jpg">
                                    <h3 class="pim-name">Nếu gặp người ấy</h3>
                                    <p class="pim-description"> Cả hai im lặng một lúc, tôi...</p>
                                    <p class="pim-price"> 65.000₫ <span> 86.000₫ </span> </p>
                                </a> 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l9 content-category">
            <?php if(!empty($main_category->getAllItem())):foreach($main_category->getAllItem() as $item):?>
                    <div class="col s12 m6 l4">
                        <div class="product-item">
                            <a href="<?=Url::toRoute(['item/detail', 'id' => $item->id])?>">
                                <?= Html::img('@web/'.$item->getThumbnailImageUrl())?>
                                <span class="product-item-name"><?=Html::encode($item->name)?></span>
                            </a>
                            <?php if($item->sellPrice != $item->startPrice):?>
                                <span class="product-item-price-sale"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                            <?php endif?> 
                            <span class="product-item-price"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                            <a class="product-item-cart add_to_cart waves-effect waves-light" href="#"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>         
                        </div>
                    </div>
                <?php endforeach;endif?>
            </div>
        </div>
    </div>
</div>