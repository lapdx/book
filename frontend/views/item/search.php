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
                    <a href="#" class="breadcrumb">Tìm kiếm</a>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col s12 m4 l3 sidebar">
                <div class="sb-block">
                    <div class="sb-block-title">
                        <h2>Danh mục sản phẩm</h2>
                    </div>
                    <div class="sb-block-content nav-category">
                        <ul>
                            <?php foreach($categories as $category):?>
                                <li>
                                    <a href="<?=Url::toRoute(['item/category', 'id' => $category->id])?>"><?=Html::encode($category->name)?></a>
                                    <?php if(!empty($category->subCategory)):foreach ($category->subCategory as $item):?>
                                        <a href="<?=Url::toRoute(['item/category', 'id' => $item->id])?>">&nbsp;&nbsp;» <?=Html::encode($item->name)?></a>
                                    <?php endforeach;endif?>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
                <div class="sb-block">
                    <a href="#">
                        <?=Html::img('@web/images/banner_category_sidebar.png',['class'=>'img-responsive'])?>
                    </a>
                </div>
                <?php if(!empty($selling)):?>
                    <div class="sb-block background-white">
                        <div class="sb-block-title">
                            <h2>Sản phẩm bán chạy</h2>
                        </div>
                        <div class="sb-block-content sb-products">
                            <ul>
                                <?php foreach($selling as $sell):
                                $item = $sell->book;?>
                                <li class="product-item-mini">
                                    <a href="<?=Url::toRoute(['item/detail', 'id' => $item->id])?>">
                                        <?= Html::img('@web/'.$item->getThumbnailImageUrl(),['class'=>'pim-image'])?>
                                        <h3 class="pim-name"><?=Html::encode($item->name)?></h3>
                                        <p class="pim-description"><?=substr(strip_tags($item->content),0,100)?></p>
                                        <?php if($item->sellPrice != $item->startPrice):?>
                                            <p class="pim-price"> <?=$item->sellPrice?>₫ <span> <?=$item->startPrice?>₫ </span></p>
                                        <?php else:?>
                                            <p class="pim-price"> <?=$item->sellPrice?>₫</p>
                                        <?php endif?>
                                    </a>
                                </li>
                            <?php endforeach?>
                        </ul>
                    </div>
                </div>
            <?php endif?>
        </div>
        <div class="col s12 m8 l9 content-category">
            <div class="search-title">Hiển thị <?=$count?> trên tổng số <?=$total_count?> sản phẩm được tìm thấy</div>
            <?php if(!empty($items)):$i=0;foreach($items as $item):
            if($item->active):
                if($i%3 == 0) echo '<div class="row">';?>
            <div class="col s12 m6 l4">
                <div class="product-item-category">
                    <div class="product-item">
                        <a href="<?=Url::toRoute(['item/detail', 'id' => $item->id])?>">
                            <?= Html::img('@web/'.$item->getThumbnailImageUrl())?>
                            <span class="product-item-name"><?=Html::encode($item->name)?></span>
                        </a>
                        <?php if($item->sellPrice != $item->startPrice):?>
                            <span class="product-item-price-sale"><?=number_format($item->startPrice,0,',','.')?>đ</span>
                        <?php endif?>
                        <span class="product-item-price"><?=number_format($item->sellPrice,0,',','.')?>đ</span>
                        <a class="product-item-cart add_to_cart waves-effect waves-light" id="add_to_cart" data-id="<?=$item->id?>"><i class="material-icons">shopping_cart</i> Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
            <?php $i++;if($i%3 == 0) echo '</div>';?>

        <?php endif;endforeach;?>
        <ul class="pagination right">
            <li <?php if($current == 1) echo 'class="disabled"'?>><a href="<?=Url::toRoute(['item/search','k'=>$keyword])?>">«</a></li>
            <?php 
            $start = floor($current/5)*5+1;
            if($total < $start+5) $end = $total;else $end = $start + 5; 
            for($i=$start;$i<=$end;$i++):
                if($i==$current):?>
            <li class="active"><a href="<?=Url::toRoute(['item/search','k'=>$keyword,'page'=>$i])?>"><?=$i?></a></li>
        <?php else:?>
            <li><a href="<?=Url::toRoute(['item/search','k'=>$keyword,'page'=>$i])?>"><?=$i?></a></li>
        <?php endif;endfor?>
        <li <?php if($current == $total) echo 'class="disabled"'?>><a href="<?=Url::toRoute(['item/search','k'=>$keyword,'page'=>$total])?>">»</a></li>
    </ul>
<?php else:?>
    <h2 class="cc-products-title">Không tìm thấy sản phẩm nào</h2>
<?php endif?>
</div>
</div>
</div>
</div>
<script>
    $(function(){
        $('a#add_to_cart').click(function(){
            $.ajax({
                url: '<?=Yii::$app->homeUrl?>item/add_to_cart',
                method: 'POST',
                data: {
                    id: $(this).data('id'),
                    quantity: 1,
                    type: 'add',
                }
            })
            .done(function(data) {
                data = JSON.parse(data);
                Materialize.toast('Bạn đã thêm sản phẩm vào giỏ hàng thành công!', 4000)
                $('.item_cart').text(data.total);
            })
            .fail(function() {
                console.log("error");
            });
        })
    })
</script>