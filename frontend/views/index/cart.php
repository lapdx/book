<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="product_content">
	<div class="container margin-bottom-20">	
		<nav class="b-breadcrumb">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="<?=Url::home()?>" class="breadcrumb">Trang chủ</a>
					<a href="<?=Url::toRoute(['index/cart'])?>" class="breadcrumb">Giỏ hàng</a>
				</div>
			</div>
		</nav>
		<div class="text-center">
			<?php if(empty($cart)):?>
				<h2 class="cc-products-title">Không có sản phẩm nào</h2>
				<a class="comment-submit" href="#">Tiếp tục mua sắm</a>
			<?php else:?>
				<div class="cart-table">
					<div class="table-responsive">
						<table class="table table-bordered cart">
							<thead>
								<tr>
									<th class="text-center">Hình ảnh</th>
									<th>Tên sản phẩm</th>
									<th>Giá</th>
									<th>Số lượng</th>
									<th>Thành tiền</th>
									<th>Xóa</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($cart['item'] as $item):?>
									<tr>
										<td class="text-center">
											<?=Html::img('@web/'.$item['item']->getThumbnailImageUrl(),['width'=>40])?>
										</td>
										<td>
											<a href="<?=Url::toRoute(['item/detail', 'id' => $item['item']->id])?>"><?=Html::encode($item['item']->name)?></a>
										</td>
										<td><?=number_format($item['item']->sellPrice,0,',','.')?>đ</td>
										<td><input type="number" class="item_cart" value="<?=$item['quantity']?>" id="quantity" data-id="<?=$item['item']->id?>"></td>
										<td>
											<?=number_format($item['quantity']*$item['item']->sellPrice,0,',','.')?>đ
										</td>
										<td><a href=""><i class="material-icons">delete</i></a></td>
									</tr>
								<?php endforeach?>
								<tr>
									<td colspan="6">
										<div class="right">
											Tổng tiền: <span class="tong_cart"><?=number_format($cart['bill'],0,',','.')?>đ</span>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="left">
											<a class="comment-submit" href="#">Tiếp tục mua sắm</a>
										</div>
										<div class="right">
											<a class="comment-submit" href="#">Hủy giỏ hàng</a>
											<a class="comment-submit" href="#">Thanh toán</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			<?php endif?>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('input#quantity').change(function(){
			if($(this).val() == '') $(this).val(0);
			$.ajax({
				url: '<?=Yii::$app->homeUrl?>item/add_to_cart',
				method: 'POST',
				data: {
					id: $(this).data('id'),
					quantity: $(this).val(),
					type: 'update',
				}
			})
			.done(function(data) {
				data = JSON.parse(data);
				console.log(data);
				Materialize.toast('Bạn đã cập nhật giỏ hàng thành công!', 4000)
				$('.item_cart').text(data.total);
				$('.tong_cart').text(data.bill+'đ');
			})
			.fail(function() {
				console.log("error");
			});  
		})
	})
</script>