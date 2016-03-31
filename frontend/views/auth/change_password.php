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
					<a href="<?=Url::current()?>" class="breadcrumb">Đổi mật khẩu</a>
				</div>
			</div>
		</nav>

		<div class="b__info">
			<div class="row">
				<div class="col s12 m3 l2">
					<div class="info__list">
						<ul>
							<li><a href="<?=Url::toRoute(['auth/profile'])?>">Thông tin cá nhân</a></li>
							<li><a class="active" href="<?=Url::current()?>">Đổi mật khẩu</a></li>
						</ul>
					</div>
				</div>
				<div class="col s12 m9 l10">
					<div class="info__content b__profile_user">
						<h3>Đổi mật khẩu</h3>

						<form method="POST" accept-charset="UTF-8">
							<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
							<?php
							if(Yii::$app->session->hasFlash('danger'))
								echo Alert::widget([
									'options' => ['class' => 'alert-danger'],
									'body' => Yii::$app->session->getFlash('danger'),
									]);
							if(Yii::$app->session->hasFlash('success'))
								echo Alert::widget([
									'options' => ['class' => 'alert-success'],
									'body' => Yii::$app->session->getFlash('success'),
									]);
									?>

									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input pattern=".{6,}" required title="Mật khẩu hiện tại phải có ít nhất 6 ký tự" name="old_pwd" id="no-space" type="password" class="validate">
											<label class="active" name="currentpassword" for="current_password">Mật khẩu hiện tại</label>
										</div>
									</div>

									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input pattern=".{6,}" required title="Mật khẩu mới phải có ít nhất 6 ký tự" name="new_pwd" id="no-space" type="password" class="validate">
											<label class="active" for="new_password">Mật khẩu mới</label>
										</div>
									</div>

									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input pattern=".{6,}" required title="Mật khẩu xác nhận phải có ít nhất 6 ký tự" name="cf_new_pwd" id="no-space" type="password" class="validate">
											<label class="active" name="password_confirmation" for="confirm_password">Xác nhận mật khẩu mới</label>
										</div>
									</div>

									<div class="form-group">
										<input class="btn b__btn_color" type="submit" value="Đổi mật khẩu">
									</div>
								</form>
							</div>
						</div>
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