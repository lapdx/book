var item = {};
item.filter = function() {
    $(document).ready(function() {
        $("input:checkbox").change(function() {
            var partnersId = [];
            $("input:checkbox[name=partnersId]:checked").each(function() {
                partnersId.push($(this).val());
            });
            var type = [];
            $("input:checkbox[name=type]:checked").each(function() {
                type.push($(this).val());
            });
            var power = [];
            $("input:checkbox[name=power]:checked").each(function() {
                power.push($(this).val());
            });
            var noise = [];
            $("input:checkbox[name=noise]:checked").each(function() {
                noise.push($(this).val());
            });
            var origin = [];
            $("input:checkbox[name=origin]:checked").each(function() {
                origin.push($(this).val());
            });
            var price = [];
            $("input:checkbox[name=price]:checked").each(function() {
                price.push($(this).val());
            });
            var categoryId = $('input[name=categoryId]').val();
            item.call(partnersId, type, power, price, origin, categoryId,noise);
        });
    });

}

item.call = function(partnersId, type, power, price, origin, categoryId,noise) {
    ajax({
        service: '/item/filter',
        data: {partnersId: partnersId, type: type, power: power, price: price, origin: origin, categoryId: categoryId,noise:noise},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                $('div.box-control').addClass('hide');
                $('span#display').html('Tìm thấy '+resp.data.length+' sản phẩm');
                $('ul#item').empty();
                $.each(resp.data, function() {
                    console.log();
                $('ul#item').append('<li> \
                                <div class="p-item">\
                                    <div class="p-thumb">\
                                            <span class="p-sale">-'+textUtils.percentFormat(this.startPrice,this.sellPrice)+'%</span>\
                                        <a href="'+baseUrl+urlsUtils.item(this.id,this.name)+'"><img src="'+((this.images.length>0)?this.images[0]:baseUrl+"no-image.jpg")+'" alt="'+this.name+'"/></a>\
                                    </div>\
                                    <div class="p-row">\
                                        <a class="p-title" href="'+baseUrl+urlsUtils.item(this.id,this.name)+'">'+this.name+'</a>\
                                    </div>\
                                    <div class="p-row">\
                                            <span class="p-oldprice">'+textUtils.startPrice(this.startPrice)+' đ</span>\
                                            <span class="p-price">'+textUtils.sellPrice(this.sellPrice)+' đ</span>\
                                    </div>\
                                    <div class="p-row">'+this.description+'</div>\
                                </div>\
                            </li>');    
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
}