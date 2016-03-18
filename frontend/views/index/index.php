<?php

use yii\helpers\Html;

?>
<div class="main_features_section">
    <div class="container">
        <div class="row">
            <div class="col s6 m6 l2">
                <div class="mega_menu">
                    <ul class="parent-menu">
                        <li class="parent-name">
                            <a class="waves-effect waves-light" href="">Sách kỹ năng</a>
                            <ul class="submenu">
                                <li><a class="waves-effect waves-light" href="">Nghệ thuật sống</a></li>
                                <li><a class="waves-effect waves-light" href="">Tư duy - Cảm xúc - Giao tiếp</a></li>
                                <li><a class="waves-effect waves-light" href="">Đời sống thường thức</a></li>
                                <li><a class="waves-effect waves-light" href="">Tủ sách tình yêu</a></li>
                            </ul>
                        </li>
                        <li class="parent-name">
                            <a class="waves-effect waves-light" href="">Sách cho thiếu nhi</a>
                            <ul class="submenu">
                                <li><a class="waves-effect waves-light" href="">Vừa học vừa chơi</a></li>
                                <li><a class="waves-effect waves-light" href="">Truyện kể cho bé</a></li>
                                <li><a class="waves-effect waves-light" href="">Truyện tranh thiếu nhi</a></li>
                                <li><a class="waves-effect waves-light" href="">Văn học thiếu nhi</a></li>
                            </ul>
                        </li>
                        <li><a class="waves-effect waves-light" href="">Sách cho gia đình</a></li>
                        <li><a class="waves-effect waves-light" href="">Sách cho tuổi mới lớn</a></li>
                        <li><a class="waves-effect waves-light" href="">Báo - Tạp chí</a></li>
                        <li><a class="waves-effect waves-light" href="">Kinh tế - Kinh doanh</a></li>
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
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <?=Html::img('@web/images/toi-tai-gioi-ban-cung-the-2--1-.jpg')?>
                            <span class="product-item-name">Tôi tài giỏi, bạn cũng thế</span>
                        </a>
                        <span class="product-item-price-sale">71.000đ</span>
                        <span class="product-item-price">56.000đ</span>
                        <a class="product-item-cart add_to_cart" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <?=Html::img('@web/images/nhat-ky-hoc-lam-banh--1-.jpg')?>
                            <span class="product-item-name">Nhật ký học làm bánh</span>
                        </a>
                        <span class="product-item-price-sale">80.000đ</span>
                        <span class="product-item-price">60.000đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <?=Html::img('@web/images/mat-ma-yeu-thuong-vi-yeu-2015--1-.jpg')?>
                            <span class="product-item-name">Mật mã yêu thương - Vị yêu</span>
                        </a>
                        <span class="product-item-price-sale">90.000đ</span>
                        <span class="product-item-price">72.000đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <a class="carousel-item" href="http://tintuctonghop.esy.es/an-voc-hoc-hay"><img src="images/108-bi-quyet-giao-duc-con-cua-cha-me-thong-thai--1-.jpg"></a>
                <a class="carousel-item" href="http://tintuctonghop.esy.es/an-voc-hoc-hay"><img src="images/cach-mang-y-tuong-nhung-sang-kien-chi-cho-thuc-hien--1-.jpg"></a>
            </div>
        </div>

        <div class="block">
            <div class="category-item-title">
                <h2 class="block-title">Sản phẩm giảm giá</h2>
            </div>
            <div class="carousel">
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <img src="images/toi-tai-gioi-ban-cung-the-2--1-.jpg">
                            <span class="product-item-name">Tôi tài giỏi, bạn cũng thế</span>
                        </a>
                        <span class="product-item-price-sale">71.000đ</span>
                        <span class="product-item-price">56.000đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <img src="images/nhat-ky-hoc-lam-banh--1-.jpg">
                            <span class="product-item-name">Nhật ký học làm bánh</span>
                        </a>
                        <span class="product-item-price-sale">80.000đ</span>
                        <span class="product-item-price">60.000đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="product-item">
                        <a href="#">
                            <img src="images/mat-ma-yeu-thuong-vi-yeu-2015--1-.jpg">
                            <span class="product-item-name">Mật mã yêu thương - Vị yêu</span>
                        </a>
                        <span class="product-item-price-sale">90.000đ</span>
                        <span class="product-item-price">72.000đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" href="#" ><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
                <a class="carousel-item" href="http://tintuctonghop.esy.es/an-voc-hoc-hay"><img src="images/108-bi-quyet-giao-duc-con-cua-cha-me-thong-thai--1-.jpg"></a>
                <a class="carousel-item" href="http://tintuctonghop.esy.es/an-voc-hoc-hay"><img src="images/cach-mang-y-tuong-nhung-sang-kien-chi-cho-thuc-hien--1-.jpg"></a>
            </div>
        </div>
    </div>
</div>