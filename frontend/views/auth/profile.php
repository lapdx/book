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
					<a href="<?=Url::current()?>" class="breadcrumb">Thông tin cá nhân</a>
				</div>
			</div>
		</nav>

		<div class="b__info">
			<div class="row">
				<div class="col s12 m3 l2">
					<div class="info__list">
						<ul>
							<li><a class="active" href="<?=Url::current()?>">Thông tin cá nhân</a></li>
							<li><a href="<?=Url::toRoute(['auth/change_password'])?>">Đổi mật khẩu</a></li>
						</ul>
					</div>
				</div>
				<div class="col s12 m9 l10">
					<div class="info__content b__profile_user">
						<h3>Sửa thông tin cá nhân</h3>
						<form method="POST" accept-charset="UTF-8">
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
									<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input id="no-space" name="email" type="text" value="<?=$user->email?>" required>
											<label class="active" for="address">Email</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input name="fullname" type="text" value="<?=$user->fullname?>" required>
											<label class="active" for="last_name">Họ và tên</label>
										</div>
									</div>
									<div class="form-group row">
										<div class="input-field col m12 l6">
											<input id="no-space" name="phone" type="number" value="<?=$user->phone?>" required>
											<label class="active" for="phone_number">Số điện thoại</label>
										</div>
									</div>
									<div class="form-group">
										<input class="btn b__btn_color" type="submit" value="Cập nhật">
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