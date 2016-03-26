<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\db\Category;

$session = Yii::$app->session;
//Setup cart
if(!isset($session['cart'])) {
  $session['cart'] = array();
  $session['total'] = 0;
}
$categories = Category::findAll(['parentId'=>0]);
?>

<!DOCTYPE html>
<html>
<head>

  <!-- head -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SuperTrung Bookstore</title>

  <meta name="description" content="Tesst" />
  <meta name="keywords" content="" />
  <meta property="og:title" content="" />
  <meta property="og:description" content="" />
  <meta property="og:image" content="" />
  <link rel="canonical" href="" />

  <!-- Stylesheets -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic' rel='stylesheet' type='text/css'>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <?= Html::csrfMetaTags() ?>
  <?php $this->head() ?>
</head>

<body>
  <div class="bg-black head__bar">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-2">
          <div id="user_do_login">
            <div class="user-actions">
              <a href="<?=Url::toRoute(['auth/signup'])?>">Đăng ký</a>
              <a href="<?=Url::toRoute(['auth/'])?>">Đăng nhập</a>
            </div>
            <div class="logged"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="header">
    <div class="top-wrap">
      <!-- Header (logo and header ad) -->
      <div class="header__main container">
        <div class="row">
          <div class="col s12 m4 l2">
            <div class="logo">
              <a href="<?=Url::home()?>">
                <?=Html::img('@web/images/logo-white.png', ['class'=>'logo-responsive'])?>
              </a>
            </div>
          </div>
          <div class="col s6 m6 l6">
            <!--  -->  
            <nav>
             <div class="nav-wrapper">
              <form method="GET" action="./search/">
                <div class="input-field">
                  <input id="search" name="q" type="search" required="" placeholder="Tìm kiếm">
                  <label for="search" class="active"><i class="material-icons">search</i></label>
                </div>
              </form>
            </div>
          </nav>
        </div>
        <div class="col s6 m2 l4">
          <div class="cart-mini right">
            <div class="cart-mini-button">
            <a class="waves-effect waves-light" href="<?=Url::toRoute(['index/cart'])?>"><i class="material-icons">shopping_cart</i><span class="item_cart"><?=$session['total']?></span> sản phẩm</a> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Header -->
  </div>

  <nav>
    <div class="container">
      <div class="nav-wrapper">
        <!-- <a href="#" class="brand-logo">Logo</a> -->
        <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="segment_mega_menu hide-on-med-and-down">
          <li class="segment_mega_menu__toggle"><a href="" style="padding-bottom: 1px;"><i class="material-icons">menu</i> Tất cả sản phẩm</a>
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
            </li>
            <li class="waves-effect waves-light"><a href="<?=Url::toRoute(['index/intro'])?>">Giới thiệu</a></li>
            <li class="waves-effect waves-light"><a href="<?=Url::toRoute(['index/contact'])?>">Liên hệ</a></li>
            <span class="hotline right"><i class="material-icons">call</i><a href="tel:01688912317">Hỗ trợ: 01688912317 (24/7)</a></span>
          </ul>
          <ul class="side-nav" id="mobile-menu">
            <li class="waves-effect waves-light"><a href=""><i class="material-icons">menu</i> Tất cả sản phẩm</a>
              <ul class="mobile__parent-menu">
                <?php foreach($categories as $category):?>
                  <?php if(empty($category->subCategory)):?>
                    <li><a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a></li>
                  <?php else:?>
                    <li class="mobile__parent-name">
                      <a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a>
                      <ul class="mobile__submenu">
                        <?php foreach($category->subCategory as $item):?>
                          <li><a class="waves-effect waves-light" href="<?=Url::toRoute(['item/category', 'id' => $item->id])?>"><?=Html::encode($item->name)?></a></li>
                        <?php endforeach?>
                      </ul>
                    </li>
                  <?php endif;endforeach?>
                </ul>
              </li>
              <li class="waves-effect waves-light"><a href="#">Giới thiệu</a></li>
              <li class="waves-effect waves-light"><a href="#">Liên hệ</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

