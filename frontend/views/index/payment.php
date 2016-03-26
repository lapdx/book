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
					<a href="<?=Url::toRoute(['index/payment'])?>" class="breadcrumb">Thanh toán</a>
				</div>
			</div>
		</nav>
		<?php if(Yii::$app->session->hasFlash('success')):
		echo Alert::widget([
			'options' => ['class' => 'alert-success'],
			'body' => Yii::$app->session->getFlash('success'),
			]);?>
			<a class="comment-submit" href="<?=Url::home()?>">Tiếp tục mua sắm</a>
		<?php else: 
		if(Yii::$app->session->hasFlash('danger'))
			echo Alert::widget([
				'options' => ['class' => 'alert-danger'],
				'body' => Yii::$app->session->getFlash('danger'),
				])?>
				<form id="b-payment" method="post" action="">
					<div context="checkout" class="margin-bottom-20">
						<div class="main">
							<div class="wrap clearfix">
								<div class="row">
									<div class="col s12 m6 l6">						
										<div class="payment-col">
											<div class="form-group m0">
												<h2>
													<label class="control-label">THÔNG TIN MUA HÀNG</label>
												</h2>
											</div>
											<div class="form-group">
												<input type="text" name="email" class="form-control txtEmail" value="" placeholder="Email" required>
											</div>

											<div class="form-group">
												<input type="text" name="name" class="form-control txtName" value="" placeholder="Họ và tên">
											</div>
											<div class="form-group">
												<input type="number" name="phone" class="form-control txtPhone" value="" placeholder="Số điện thoại">
											</div>
											<div class="form-group">
												<input type="text" name="address" class="form-control" value="" placeholder="Địa chỉ">
											</div>
											<div class="form-group">
												<select name="method">
													<option value="cod">Thanh toán tại nhà</option>
													<option value="atm">Thanh toán qua ATM</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col s12 m6 l6">			
										<div class="payment-col">
											<div class="order-summary order-summary--custom-background-color ">
												<div class="order-summary-header">
													<h2>
														<label class="control-label">ĐƠN HÀNG</label>
													</h2>
												</div>
												<div class="summary-body  summary-section">
													<div class="summary-product-list">
														<?php if(empty($cart['item'])):?>
															<h3 class="cc-products-title">Không có sản phẩm nào</h2>
															<?php else:?>
																<ul class="product-list">
																	<?php foreach($cart['item'] as $item):?>
																	<li class="product product-has-image clearfix" style="overflow: hidden; margin-bottom:5px;">
																		<?=Html::img('@web/'.$item['item']->getThumbnailImageUrl(),['width'=>50,'class'=>'left product-image'])?>
																		<!-- <img src="" class="left product-image" width="30" style="margin-right:5px;"> -->
																		<div class="product-info left"> 
																			<span class="product-info-name"> 
																				<span style="font-size:12px"><?=Html::encode($item['item']->name)?></span>  <span style="color:#C00; padding:0px 5px;"> X </span> 
																			</span><?=$item['quantity']?>
																		</div>
																		<span class="product-price right"> 
																			<?=number_format($item['quantity']*$item['item']->sellPrice,0,',','.')?>đ
																		</span>
																	</li>
																<?php endforeach?>
																</ul>
																<ul>
																	<li class="product product-has-image clearfix">
																		<strong style="font-size: 18px">Tổng cộng:</strong> 
																		<strong class="product-price right" style="color:#3C0"> 
																			<?=number_format($cart['bill'],0,',','.')?>đ
																		</strong> 
																	</li>
																</ul>
															<?php endif?>
														</div>
													</div>
													<div class="form-group clearfix">
														<?php if(empty($cart['item'])):?>
															<div class="text-center">
																<a class="comment-submit" href="<?=Url::home()?>">Tiếp tục mua sắm</a>
															</div>
														<?php else:?>
															<button class="btn btn-primary col-md-12 order-send waves-effect waves-light" name="sendcartok" type="submit" style="cursor: pointer;">ĐẶT HÀNG</button>
														<?php endif?>
													</div>
													<div class="form-group has-error">
														<div class="help-block ">
															<ul class="list-unstyled">
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				<?php endif?>
			</div>
		</div>