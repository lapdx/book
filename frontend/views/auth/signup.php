<?php
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="product_content">
	<div class="container">
		<nav class="b-breadcrumb">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=Url::home()?>" class="breadcrumb">Trang chủ</a>
					<a href="<?=Url::current()?>" class="breadcrumb">Đăng ký</a>
				</div>
			</div>
		</nav>

		<div class="row">
			<div class="register-b-content col s6 m6 l6">
				<h3 class="b-register-title text-center">Đăng ký tài khoản của bạn</h3>
				<form class="b-registerForm" name="registerForm" method="POST">
					<?php
					if(Yii::$app->session->hasFlash('danger'))
						echo Alert::widget([
							'options' => ['class' => 'alert-danger'],
							'body' => Yii::$app->session->getFlash('danger'),
							])
							?>
							<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
							<div class="form-group">
								<div class="b-input-group">
									<input id="no-space" pattern=".{6,}" required title="Username phải có ít nhất 6 ký tự" name="username" type="text" class="form-control" placeholder="Tên đăng nhập" value="<?=$data['username']?>">
								</div>
							</div>
							<div class="form-group">
								<div class="b-input-group">
									<input id="no-space" required name="email" type="email" class="form-control" placeholder="Địa chỉ email" value="<?=$data['email']?>">
								</div>
							</div>
							<div class="form-group">
								<div class="b-input-group">
									<input required name="fullname" type="text" class="form-control" placeholder="Họ và tên" value="<?=$data['fullname']?>">
								</div>
							</div>
							<div class="form-group">
								<div class="b-input-group">
									<input required name="phone" type="number" class="form-control" placeholder="Số điện thoại" value="<?=$data['phone']?>">
								</div>
							</div>
							<div class="form-group">
								<div class="b-input-group">
									<input id="no-space" pattern=".{6,}" required title="Mật khẩu phải có ít nhất 6 ký tự" name="pwd" type="password" class="form-control" placeholder="Mật khẩu">
								</div>
							</div>
							<div class="form-group">
								<div class="b-input-group">
									<input id="no-space" pattern=".{6,}" required title="Mật khẩu phải có ít nhất 6 ký tự" name="pwd2" type="password" class="form-control" placeholder="Xác nhận mật khẩu">
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn-register b-register-login waves-effect waves-light">
									Tạo tài khoản BookStore
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(function(){
				$('input#no-space').keyup(function() {
					str = $(this).val();
					str = str.replace(/\s/g,'');
					$(this).val(str);
				});
			})

		</script>