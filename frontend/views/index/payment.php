<div class="product_content">
	<div class="container">	
		<nav class="b-breadcrumb">
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="#!" class="breadcrumb">Trang chủ</a>
					<a href="#!" class="breadcrumb">Giỏ hàng</a>
				</div>
			</div>
		</nav>

		<form id="b-payment" method="post" action="">
			<div context="checkout" class="container">
				<div class="main">
					<div class="wrap clearfix">
						<div class="row">
							<div class="col s6 m6 l4">
								<div class="form-group m0">
									<h2>
										<label class="control-label">THÔNG TIN MUA HÀNG</label>
									</h2>
								</div>
								<div class="form-group"> <a href="dang-ky.html">Đăng ký tài khoản mua hàng</a> | <a href="dang-nhap.html">Đăng nhập </a> </div>
								
								<div class="form-group">
									<input name="txtEmail" class="form-control txtEmail" value="" placeholder="Vui lòng nhập Email">
									<div class="help-block with-errors"></div>
								</div>
								<div class="billing">
									<div bind-show="billing_expand">
										<div class="form-group">
											<input name="txtName" class="form-control txtName" value="" placeholder="Họ và tên">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<input name="txtPhone" class="form-control txtPhone" value="" placeholder="Số điện thoại">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<input name="txtAddress" class="form-control" value="" placeholder="Địa chỉ">
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
								<div bind-show="otherAddress" class="shipping hide">
									<div class="form-group"> <a class="underline-none" href="javascript:void(0)">Thông tin nhận hàng<span class="hide"></span> </a> </div>
								</div>
							</div>
							<div class="col s6 m6 l4">
								<div class="shipping-method">
									<div class="form-group">
										<h2>
											<label class="control-label">VẬN CHUYỂN</label>
										</h2>
									</div>
									<div class="form-group">
										<select name="value_order" class="form-control">
											<option value="40000">Giao hàng tận nơi - Miễn phí KV TP.HCM</option>
											<option value="40000">Giao hàng tận nơi - Miễn phí KV TP.HÀ NỘI</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col s6 m6 l4">
								<div class="order-summary order-summary--custom-background-color ">
									<div class="order-summary-header">
										<h2>
											<label class="control-label">ĐƠN HÀNG</label>
										</h2>
									</div>
									<div class="summary-body  summary-section">
										<div class="summary-product-list">
											<ul class="product-list">
												<input type="hidden" name="total_qty" value="1">
												<input type="hidden" name="idproduct" value="22">
												<input type="hidden" name="sl" value="1">
												<input type="hidden" name="gia_sp" value="56000">
												<input type="hidden" name="tong_gia_sp" value="56000">
												<li class="product product-has-image clearfix" style="margin-bottom:5px;">
													<img src="img/nhat-ky-hoc-lam-banh--1-.jpg" class="left product-image" width="30" style="margin-right:5px;">
													<div class="product-info left"> 
														<span class="product-info-name"> 
															<span style="font-size:10px">NHẬT KÝ HỌC LÀM BÁNH</span>  <span style="color:#C00; padding:0px 5px;"> X </span> 1
														</span>
													</div>
													<span class="product-price right"> 
														<input type="hidden" name="total_price" value="56000">
														56.000đ
													</span>
												</li>
												<hr>
											</ul>
											<ul>
												<li class="product product-has-image clearfix" style="margin-bottom:10px;">
													Tổng cộng: 
													<strong class="product-price right" style="color:#3C0"> 
														56.000đ
													</strong> 
												</li>
											</ul>
										</div>
									</div>
									<div class="form-group clearfix">
										<button class="btn btn-primary col-md-12 order-send waves-effect waves-light" name="sendcartok" type="submit" style="cursor: pointer;">ĐẶT HÀNG</button>
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
		</form>

		
	</div>
</div>