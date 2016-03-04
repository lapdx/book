<td valign="top" style="padding:10px 10px 10px 25px; background:#fff;">
            	<div style="padding-top:5px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Kính gửi <?= $order->name ?>
                    </font>
                </div>
                <div style="padding-top:10px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Cảm ơn bạn đã đặt hàng tại hoalua.com.vn.
                    </font>
                </div>
                <div style="padding-top:10px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#333;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse;text-align:center">
                        <tbody>
                            <tr style="background:#f1f1f1">
                                <th width="60%" height="30px">Tên sản phẩm</th>
                                <th width="15%" height="30px">Đơn giá</th>
                                <th width="10%" height="30px">Số lượng</th>
                                <th width="15%" height="30px">Thành tiền</th>
                            </tr>
                            <?php $total = 0; foreach($order->items as $item) {?>
                            <tr>
                                <td height="30px"><?= $item->name ?></td>
                                <td height="30px"><?= \common\util\TextUtils::sellPrice($item->sellPrice) ?> VND</td>
                                <td height="30px"><?= $item->quantity ?></td>
                                <td height="30px"><?= \common\util\TextUtils::sellPrice($item->quantity*$item->sellPrice) ?> VND</td>
                            </tr>
                            <?php $total += $item->quantity*$item->sellPrice; } ?>
                        </tbody>
                    </table>
                </div>
                <div style="padding-top:10px;">
                	<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                        <b>Tổng tiền:</b> <?= \common\util\TextUtils::sellPrice($item->quantity*$item->sellPrice) ?> VND
                    </font>
                </div>
				<div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#074246;">
                    	 Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất
                    </font>
                </div>
                <div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Thân ái!
                    </font>
                </div>
                <div style="padding-top:10px;">
               		<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;display:block; color:#333;">
                    	Trung Tâm Hỗ Trợ Khách Hàng hoalua.com.vn
                    </font>
                </div>
            </td>