<?php

use common\util\TextUtils;
use common\util\UrlUtils;
use frontend\assets\AppAsset;
use frontend\assets\LibAsset;
use frontend\assets\WebAsset;
use yii\helpers\Html;

AppAsset::register($this);
LibAsset::register($this);
WebAsset::register($this);

$categories = isset($this->context->var["categories"]) ? $this->context->var["categories"] : '';
$newscategories = isset($this->context->var["newscategories"]) ? $this->context->var["newscategories"] : '';
$news = isset($this->context->var["news"]) && !empty($this->context->var["news"]) ? $this->context->var["news"] : null;
$footer = isset($this->context->var["footer"]) ? $this->context->var["footer"] : '';
$home = isset($this->context->var["home"]) ? $this->context->var["home"] : '';
$partners = isset($this->context->var["partners"]) ? $this->context->var["partners"] : '';
$center = isset($this->context->var["center"]) ? $this->context->var["center"] : '';
$left = isset($this->context->var["left"]) ? $this->context->var["left"] : '';
$hotitem = isset($this->context->var["hotitem"]) ? $this->context->var["hotitem"] : '';
$right = isset($this->context->var["right"]) ? $this->context->var["right"] : '';
$menus = isset($this->context->var["menu"]) ? $this->context->var["menu"] : '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="content-language" content="vi" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Hoa Lửa" />
        <meta name='COPYRIGHT' content='&copy; Hoa Lửa' />
        <meta name="robots" content="noodp,index,follow" />

        <link rel="shortcut icon" href="<?= $this->context->baseUrl ?>images/favicon.ico" />

        <?= Html::csrfMetaTags() ?>
        <title data-rel="title" ><?= Html::encode($this->title == null || $this->title == "" ? $this->context->title : $this->title) ?></title>
        <meta name="keywords" content= "<?= $this->context->keywrod ?>" />
        <meta name="description" content="<?= $this->context->description ?>" />
        <meta property="og:title" content="<?= $this->context->og['title'] ?>" />
        <meta property="og:site_name" content="<?= $this->context->og['site_name'] ?>"/>
        <meta property="og:url" content="<?= $this->context->og['url'] ?>"/>
        <meta property="og:image" content="<?= $this->context->og['image'] ?>"/>
        <meta property="og:description"  content="<?= $this->context->og['description'] ?>" />
        <link rel="canonical" href="<?= $this->context->canonical ?>" />
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="container">
            <div class="navigator">
                <div class="menu-top">
                    <ul>
                        <li><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
                        <li><a href="<?= $this->context->baseUrl . UrlUtils::news('gioi-thieu') ?>">Giới thiệu</a></li>
                        <li><a href="<?= $this->context->baseUrl . UrlUtils::news() ?>">Tin tức</a></li>
                        <li><a href="<?= $this->context->baseUrl . UrlUtils::contact() ?>">Liên hệ</a></li>
                    </ul>
                </div><!-- menu-top -->
                <div class="box-admin">
                    <ul>
                        <?php if ((Yii::$app->getSession()->get("customer") == null)) { ?>
                            <li><a href="<?= $this->context->baseUrl ?>auth">Đăng nhập</a></li>
                        <?php } else { ?>
                            <li><a href="<?= $this->context->baseUrl ?>auth/logout">Đăng xuất</a></li>
                        <?php } ?>
                    </ul>
                </div><!-- box-admin -->
            </div><!-- navigator -->
            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= $this->context->baseUrl ?>"><img src="<?= !empty($home) && !empty($home->logo) ? $home->logo[0] : $this->context->baseUrl . 'images/logo.png' ?>" alt="logo" /></a>
                    <div class="box-search">
                        <form action="<?= $this->context->baseUrl ?>search.html">
                            <div class="bs-inner">
                                <div class="bs-text">
                                    <input name="keyword" type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." />
                                </div>
                                <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div><!-- box-search -->
                    <div class="header-commit">
                        <div class="hc-item">
                            <i class="fa fa-clock-o"></i>
                            <div class="hc-text">
                                <p>Giờ bán hàng</p>
                                <p class="text-danger"><?= !empty($home) ? $home->time : '' ?></p>
                            </div>
                        </div>
                        <div class="hc-item">
                            <i class="fa fa-phone"></i>
                            <div class="hc-text">
                                <p>Tư vấn Online</p>
                                <p class="text-danger"><a href="<?= !empty($home) ? 'Skype:' . $home->skype . '?chat' : '' ?>"><i class="fa fa-skype"></i></a><?= !empty($home) ? $home->phoneconsult : '' ?></p>
                            </div>
                        </div>
                    </div><!-- header-commit -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hoalua-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="box-cart" href="<?= $this->context->baseUrl . UrlUtils::checkout() ?>" style="background:#fa8600" >
                        <i class="fa fa-shopping-cart"></i>
                        <span class="bc-price"><?= $this->context->var['total'] ?> VNĐ</span>
                    </a><!-- box-cart -->
                </div><!-- navbar-header -->
                <div class="collapse navbar-collapse" id="hoalua-navbar">
                    <ul class="nav navbar-nav">
                        <li class="<?= $this->context->var['index'] == 1 ? 'active' : '' ?>"><a href="<?= $this->context->baseUrl ?>">Trang chủ</a></li>
                        <li><a href="<?= $this->context->baseUrl . UrlUtils::newsBrowse('ve-chung-toi') ?>">Về chúng tôi</a></li>
                        <li class="<?= $this->context->var['item'] == 1 ? 'active' : '' ?>"><a href="<?= $this->context->baseUrl . UrlUtils::browse() ?>">Sản phẩm</a></li>
                        <?php if (!empty($menus)) { ?>
                            <?php foreach ($menus as $menu) { ?>
                                <li><a href="<?= $this->context->baseUrl . UrlUtils::newsBrowse($menu->alias) ?>"><?= $menu->name ?></a></li>
                            <?php } ?>
                        <?php } ?>
                        <li class="<?= $this->context->var['contact'] == 1 ? 'active' : '' ?>"><a href="<?= $this->context->baseUrl . UrlUtils::contact() ?>">Liên hệ</a></li>
                    </ul>
                    <div class="header-social"><a href="<?= !empty($home) ? $home->facebook : '' ?>"><i class="fa fa-facebook"></i></a><a href="<?= !empty($home) ? $home->google : '' ?>"><i class="fa fa-google-plus"></i></a></div>
                </div><!-- /.navbar-collapse -->
            </div><!-- navbar -->
            <div class="box-commit">
                <div class="row sm-reset-all">
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-phone"></i>
                            <div class="bc-text">Tư vấn miễn phí</div>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-thumbs-o-up"></i>
                            <div class="bc-text">Miễn phí lắp đặt</div>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-shield"></i>
                            <div class="bc-text">Bảo hành kép</div>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-money"></i>
                            <div class="bc-text">Thanh toán linh hoạt</div>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-usd"></i>
                            <div class="bc-text">Giá tốt nhất</div>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4 col-md-2 reset-padding-all">
                        <div class="bc-item">
                            <i class="fa fa-star-o"></i>
                            <div class="bc-text">Dịch vụ chất lượng</div>
                        </div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- box-commit -->
            <div class="bground">
                <?= $content ?>
                <?php if ($this->context->var['checkout'] != 1) { ?>
                    <div class="sidebar" >
                        <?php if ($this->context->var['flag'] == 0) { ?>
                        <div class="winget">
                            <div class="winget-title"><div class="lb-name">Danh mục sản phẩm</div></div>
                            <div class="winget-content">
                                <div class="menuleft">
                                    <ul>
                                        <?php if (!empty($categories)) { ?>
                                            <?php foreach ($categories as $c) { ?>
                                                <?php if ($c->parentId == 0) { ?>
                                                    <li>
                                                        <a href="<?= $this->context->baseUrl . UrlUtils::browse($c->alias) ?>"><i class="fa fa-home"></i><?= $c->name ?><i class="fa fa-caret-right"></i></a>
                                                        <div class="menuleft-submenu">
                                                            <ul>
                                                                <?php foreach ($categories as $c2) { ?>
                                                                    <?php if ($c2->parentId == $c->id) { ?>
                                                                        <li><a href="<?= $this->context->baseUrl . UrlUtils::browse($c2->alias) ?>"><i class="fa fa-long-arrow-right"></i><?= $c2->name ?></a></li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div><!-- menuleft -->
                            </div><!-- winget-content -->
                        </div><!-- winget -->
                        <?php } ?>
                        <?php if ($this->context->var['browse'] == 1) { ?>
                            <div class="box box-gray">
                                <div class="box-title"><div class="lb-name">Hãng sản xuất</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <?php if (!empty($partners)) { ?>
                                                <?php foreach ($partners as $p) { ?>
                                                    <li><div class="checkbox"><label><input name="partnersId" type="checkbox" value="<?= $p->id ?>" /> <?= $p->name ?></label></div></li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                                <div class="box-title"><div class="lb-name">Số lượng bếp (dành cho sp là bếp)</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <li><div class="checkbox"><label><input name="type" type="checkbox" value="1" /> 1 bếp</label></div></li>
                                            <li><div class="checkbox"><label><input name="type" type="checkbox" value="2" /> 2 bếp</label></div></li>
                                            <li><div class="checkbox"><label><input name="type" type="checkbox" value="3" /> 3 bếp</label></div></li>
                                            <li><div class="checkbox"><label><input name="type" type="checkbox" value="4" /> 4 bếp</label></div></li>
                                            <li><div class="checkbox"><label><input name="type" type="checkbox" value="5" /> Khác</label></div></li>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                                <div class="box-title"><div class="lb-name">Độ ồn (máy hút mùi)</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <li><div class="checkbox"><label><input name="noise" type="checkbox" value="1" /> 40 - 45db</label></div></li>
                                            <li><div class="checkbox"><label><input name="noise" type="checkbox" value="2" /> 45 - 50db</label></div></li>
                                            <li><div class="checkbox"><label><input name="noise" type="checkbox" value="3" /> 50 - 55db</label></div></li>
                                            <li><div class="checkbox"><label><input name="noise" type="checkbox" value="4" /> 55 -60db</label></div></li>
                                            <li><div class="checkbox"><label><input name="noise" type="checkbox" value="5" /> >60</label></div></li>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                                <div class="box-title"><div class="lb-name">Công suất</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <li><div class="checkbox"><label><input name="power" type="checkbox" value="1" /> 1500 - 3000 W</label></div></li>
                                            <li><div class="checkbox"><label><input name="power" type="checkbox" value="2" /> 3000 - 5000 W</label></div></li>
                                            <li><div class="checkbox"><label><input name="power" type="checkbox" value="3" /> 4500 - 6000 W</label></div></li>
                                            <li><div class="checkbox"><label><input name="power" type="checkbox" value="4" /> 6000 - 7500 W</label></div></li>
                                            <li><div class="checkbox"><label><input name="power" type="checkbox" value="5" /> >7500</label></div></li>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                                <div class="box-title"><div class="lb-name">Xuất xứ</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Đức" /> Thương hiệu Đức</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Pháp" /> Pháp - France</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Malaysia" /> Malaysia</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Nhật Bản" /> Nhật Bản</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Ý" /> Ý</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Tây Ban Nha" /> Tây Ban Nha</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Việt Nam" /> Việt Nam</label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="Indonexia" /> Indonexia </label></div></li>
                                            <li><div class="checkbox"><label><input name="origin" type="checkbox" value="" /> Khác</label></div></li>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                                <div class="box-title"><div class="lb-name">Khoảng giá</div></div>
                                <div class="box-content">
                                    <div class="box-filter">
                                        <ul>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="1" /> 1 - 3 triệu</label></div></li>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="2" /> 3 - 5 triệu</label></div></li>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="3" /> 5 - 10 triệu</label></div></li>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="4" /> 10 - 15 triệu</label></div></li>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="5" /> 15 - 20 triệu</label></div></li>
                                            <li><div class="checkbox"><label><input name="price" type="checkbox" value="6" /> Trên 20 triệu</label></div></li>
                                        </ul>
                                    </div><!-- box-filter -->
                                </div><!-- box-content -->
                            </div><!-- box -->
                        <?php } ?>
                        <?php if ($this->context->var['flag'] == 0) { ?>
                            <div class="winget">
                                <div class="winget-title"><div class="lb-name">Tin tức cập nhật</div></div>
                                <div class="winget-content">
                                    <div class="featured-news">
                                        <?php if (!empty($news)) { ?>
                                            <?php foreach ($news as $new) { ?>
                                                <div class="grid">
                                                    <div class="img"><a href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>"><img src="<?= !empty($new->images) ? $new->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $new->name ?>" /></a></div>
                                                    <div class="g-content">
                                                        <div class="g-row"><a class="g-title" href="<?= $this->context->baseUrl . UrlUtils::news($new->alias) ?>"><?= $new->name ?></a></div>
                                                        <div class="g-row"><?= TextUtils::convertTime($new->createTime) ?></div>
                                                    </div>
                                                </div><!-- grid -->
                                            <?php } ?>
                                        <?php } ?>
                                    </div><!-- featured-news -->
                                </div><!-- winget-content -->
                            </div><!-- winget -->
                        <?php } else { ?>
                             <div class="winget">
                            <div class="winget-title"><div class="lb-name">Danh mục tin tức</div></div>
                            <div class="winget-content">
                                <div class="menuleft">
                                    <ul>
                                        <?php if (!empty($newscategories)) { ?>
                                            <?php foreach ($newscategories as $c) { ?>
                                                <?php if ($c->parentId == 0) { ?>
                                                    <li>
                                                        <a href="<?= $this->context->baseUrl . UrlUtils::newsBrowse($c->alias) ?>"><i class="fa fa-home"></i><?= $c->name ?><i class="fa fa-caret-right"></i></a>
                                                        <div class="menuleft-submenu">
                                                            <ul>
                                                                <?php foreach ($newscategories as $c2) { ?>
                                                                    <?php if ($c2->parentId == $c->id) { ?>
                                                                <li><a href="<?= $this->context->baseUrl . UrlUtils::newsBrowse($c2->alias) ?>"><i class="fa fa-long-arrow-right"></i><?= $c2->name ?></a></li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div><!-- menuleft -->
                            </div><!-- winget-content -->
                        </div><!-- winget -->
                            <div class="winget">
                                <div class="winget-title"><div class="lb-name">Sản phẩm mới</div></div>
                                <div class="winget-content">
                                    <div class="featured-news">
                                        <?php if (!empty($hotitem)) { ?>
                                            <?php foreach ($hotitem as $item) { ?>
                                                <div class="grid">
                                                    <div class="img"><a href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><img src="<?= !empty($item->images) ? $item->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $item->name ?>" /></a></div>
                                                    <div class="g-content">
                                                        <div class="g-row"><a class="g-title" href="<?= $this->context->baseUrl . UrlUtils::item($item->name, $item->id) ?>"><?= $item->name ?></a></div>
                                                        <div class="g-row"><?= TextUtils::convertTime($item->createTime) ?></div>
                                                    </div>
                                                </div><!-- grid -->
                                            <?php } ?>
                                        <?php } ?>
                                    </div><!-- featured-news -->
                                </div><!-- winget-content -->
                            </div><!-- winget -->
                        <?php } ?>
                        <div class="box-banner">
                            <?php if (!empty($center)) { ?>
                                <?php foreach ($center as $b) { ?>
                                    <div class="bb-item">
                                        <a href="<?= $b->link ?>" target="_blank"><img src="<?= !empty($b->images) ? $b->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $b->name ?>" /></a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div><!-- box-banner -->
                    </div><!-- sidebar -->
                <?php } ?>
                <div class="clearfix"></div>
            </div><!-- bground -->
            <div class="footer-slider">
                <div id="fslider" class="owl-carousel">
                    <?php if (!empty($partners)) { ?>
                        <?php foreach ($partners as $p) { ?>
                            <div class="logo-item"><a href="<?= $this->context->baseUrl.UrlUtils::browse() ?>"><img src="<?= !empty($p->images) ? $p->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $p->name ?>" /></a></div>
                        <?php } ?>
                    <?php } ?>
                </div><!-- owl-carousel -->
            </div><!-- footer-slider -->
            <div class="footer-top">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="box-social">
                            <a href="<?= !empty($home) ? $home->google : '' ?>"><i class="fa fa-google-plus"></i></a>
                            <a href="<?= !empty($home) ? $home->twitter : '' ?>"><i class="fa fa-twitter"></i></a>
                            <a href="<?= !empty($home) ? $home->youtube : '' ?>"><i class="fa fa-youtube"></i></a>
                            <a href="<?= !empty($home) ? $home->facebook : '' ?>"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div><!-- col -->
                    <div class="col-sm-4">
                        <div class="email-text">
                            <i class="fa fa-envelope"></i>
                            <div class="et-content">
                                <h4>ĐĂNG KÝ NHẬN BẢN TIN</h4>
                                <p>Cập nhật tin tức, sản phẩm, khuyến mại</p>
                            </div>
                        </div><!-- email-text -->
                    </div><!-- col -->
                    <div class="col-sm-4">
                        <form id="form-contact">
                            <div class="email-input">
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email của bạn..." />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" onclick="contact.add()" type="button">Đăng ký</button>
                                    </span>
                                </div>
                            </div><!-- email-input -->
                        </form>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- footer-top -->
            <div class="footer-commit">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="fc-title">Tổng đài hỗ trợ</div>
                        <div class="fc-content">
                            <div class="grid">
                                <div class="img"><i class="fa fa-phone"></i></div>
                                <div class="g-content">
                                    <div class="g-row">Tư vấn trực tiếp</div>
                                    <div class="g-row">
                                        Skype: <a href="<?= !empty($home) ? 'Skype:' . $home->skype . '?chat' : '' ?>"><i class="fa fa-skype"></i></a>
                                        Tel: <span class="text-danger"><?= !empty($home) ? $home->phoneconsult : '' ?></span>
                                    </div>
                                </div>
                            </div><!-- grid -->
                            <div class="grid">
                                <div class="img"><i class="fa fa-mobile"></i></div>
                                <div class="g-content">
                                    <div class="g-row">Chăm sóc & Bảo hành</div>
                                    <div class="g-row"><span class="text-danger"><?= !empty($home) ? $home->phonecare : '' ?></span></div>
                                </div>
                            </div><!-- grid -->
                            <p class="fc-247">Phục vụ 24/7(cả ngày lễ và chủ nhật)</p>
                        </div><!-- fc-content -->
                    </div><!-- col -->
                    <div class="col-sm-8">
                        <div class="fc-border">
                            <div class="fc-title">Cam kết bán hàng!</div>
                            <ul>
                                <?php if (!empty($footer)) { ?>
                                    <?php foreach ($footer as $n) { ?>
                                        <li><i class="fa fa-star"></i><a href="<?= $this->context->baseUrl . UrlUtils::news($n->alias) ?>" style="cursor: pointer;color: #333"><?= $n->name ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div><!-- fc-border -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- footer-commit -->
            <div class="footer-text">
                <h1>Hoa lửa chuyên cung cấp các loại thiết bị nhà bếp nhập khẩu</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="ft-title">Chi nhánh Hà Nội 1</div>
                        <div class="ft-content">
                            <div class="grid">
                                <div class="img"><i class="fa fa-map-marker"></i></div>
                                <div class="g-content">
                                    <div class="g-row">Địa chỉ: <?= !empty($home) ? $home->address1 : '' ?>
                                        <br />Tel: <?= !empty($home) ? $home->tel1 : '' ?></div>
                                </div>
                                <div class="g-row"><?= !empty($home) ? $home->description1 : '' ?></div>
                            </div><!-- grid -->
                        </div><!-- ft-content -->
                    </div><!-- col -->
                    <div class="col-sm-4">
                        <div class="ft-title">Chi nhánh Hà Nội 2</div>
                        <div class="ft-content">
                            <div class="grid">
                                <div class="img"><i class="fa fa-map-marker"></i></div>
                                <div class="g-content">
                                    <div class="g-row">Địa chỉ: <?= !empty($home) ? $home->address2 : '' ?>
                                        <br />Tel : <?= !empty($home) ? $home->tel2 : '' ?></div>
                                </div>
                                <div class="g-row"><?= !empty($home) ? $home->description2 : '' ?></div>
                            </div><!-- grid -->
                        </div><!-- ft-content -->
                    </div><!-- col -->
                    <div class="col-sm-4">
                        <div class="ft-title">Chi nhánh TP. Hồ Chí Minh</div>
                        <div class="ft-content">
                            <div class="grid">
                                <div class="img"><i class="fa fa-map-marker"></i></div>
                                <div class="g-content">
                                    <div class="g-row">Địa chỉ 3: <?= !empty($home) ? $home->address3 : '' ?>
                                        <br />Tel : <?= !empty($home) ? $home->tel3 : '' ?></div>
                                </div>
                                <div class="g-row"><?= !empty($home) ? $home->description3 : '' ?></div>
                            </div><!-- grid -->
                        </div><!-- ft-content -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- footer-text -->
            <div class="copyright">
                <div class="c-left">© 2015 Bản quyền thuộc về HOA LỬA</div>
                <div class="c-right">HOA LỬA trên <a href="<?= !empty($home) ? $home->google : '' ?>">Google Plus</a></div>
            </div><!-- copyright -->
            <div class="banner-left">
                <?php if (!empty($left)) { ?>
                    <?php foreach ($left as $b) { ?>
                        <div class="banner-fixed">
                            <a href="<?= $b->link ?>"><img src="<?= !empty($b->images) ? $b->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $b->name ?>" /></a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div><!-- banner-left -->
            <div class="banner-right">
                <?php if (!empty($right)) { ?>
                    <?php foreach ($right as $b) { ?>
                        <div class="banner-fixed">
                            <a target="_blank" href="<?= $b->link ?>"><img src="<?= !empty($b->images) ? $b->images[0] : $this->context->baseUrl . 'images/no_avatar.png' ?>" alt="<?= $b->name ?>" /></a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div><!-- banner-right -->
        </div><!-- container -->
        <div class="smart-support">
            <div class="ss-title"><i class="fa fa-comments"></i>Hỗ trợ trực tuyến<i class="ss-status fa fa-plus"></i></div>
            <div class="ss-content">
                <div class="grid">
                    <div class="img"><i class="fa fa-mobile"></i></div>
                    <div class="g-content">
                        <div class="g-row"><a class="g-title" href="#"><?= !empty($home) ? $home->phonecare : '' ?></a></div>
                    </div>
                </div><!-- grid -->
                <div class="grid">
                    <div class="img"><i class="fa fa-skype"></i></div>
                    <div class="g-content">
                        <div class="g-row"><a class="g-title" href="<?= !empty($home) ? 'Skype:' . $home->skype . '?chat' : '' ?>">Skype Chat</a></div>
                    </div>
                </div><!-- grid -->
                <div class="grid">
                    <div class="img"><i class="fa fa-envelope"></i></div>
                    <div class="g-content">
                        <div class="g-row"><a class="g-title" href="mailto:<?= !empty($home) ? $home->email : '' ?>"><?= !empty($home) ? $home->email : '' ?></a></div>
                    </div>
                </div><!-- grid -->
            </div><!-- ss-content -->
        </div><!-- smart-support -->
        <?php $this->endBody() ?>
        <script type="text/javascript" >
            var account = '<?= Yii::$app->user->getId() ?>';
            var baseUrl = '<?= $this->context->baseUrl; ?>';
<?= $this->context->staticClient; ?>
            item.filter();
        </script>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=721254621281061";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <script src="https://apis.google.com/js/platform.js" async defer>
            {
                lang: 'vi'
            }
        </script>
    </body>
</html>
<?php $this->endPage() ?>
