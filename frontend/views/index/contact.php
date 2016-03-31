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
					<a href="<?=Url::current()?>" class="breadcrumb">Liên hệ</a>
				</div>
			</div>
		</nav>

		<div class="b__info">
			<div class="row">
				<div class="col s12 m6 l2">
					<div class="info__list">
						<ul>
							<li><a href="<?=Url::toRoute(['index/intro'])?>">Giới thiệu</a></li>
							<li><a class="active" href="<?=Url::toRoute(['index/contact'])?>">Liên hệ</a></li>
						</ul>
					</div>
				</div>
				<div class="col s12 m6 l10">
					<div class="info__content b__contact">
						<h1>BookStore - Thư viện sách lớn nhất Việt Nam</h1>
						<p>
							<strong>Địa chỉ: </strong>455 Vũ Tông Phan, Hà Nội
						</p>
						<p>
							<strong>Email: </strong>trunglbict@gmail.com
						</p>
						<p>
							<strong>Số điện thoại: </strong>01688912317
						</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>