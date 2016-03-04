var index = {};
index.select = function(id) {
    $('li[data=listvideo]').removeClass('active');
    $('li[data-key=' + id + ']').addClass('active');
    $('#video').html('<iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + id + '" frameborder="0" allowfullscreen></iframe>');
}

index.app = function(id) {
    ajax({
        service: '/index/get',
        data: {id: id},
        loading: false,
        done: function(resp) {
            if (resp.success) {
                console.log(resp.data);
                var msg = '<div class="homenews-slider"><div id="hnslider" class="owl-carousel">';
                $.each(resp.data,function(){
                    msg+='<div class="hn-item"><div class="hn-thumb"><a href="'+ baseUrl+urlsUtils.newsBrowse(this.alias) +'"><img src="'+((typeof this.images[0]== "undefined")?this.images[0]:"") +'" alt="img" /></a></div> <div class="hn-row" style="height: 40px;"><a class="hn-title" href="'+ baseUrl+urlsUtils.newsBrowse(this.alias) +'"></a></div><div class="hn-row"><span class="hn-time"><span class="fa fa-clock-o"></span></span></div><div class="hn-row hn-desc">'+this.description+'</div><div class="hn-button"><span class="hn-view"><i class="fa fa-eye"></i></span><a class="btn btn-primary" href="'+ baseUrl+urlsUtils.newsBrowse(this.alias) +'">Xem tiếp</a></div></div>';
                });
                msg+= '</div></div>';
                $('div[data=app]').html(msg);
            } else {
                popup.msg(resp.message);
            }
        }
    });
}