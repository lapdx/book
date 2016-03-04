var image = {};

image.grid = function () {
    layout.title("Image Grid");
    layout.breadcrumb([
        ["Dashboad", "#image/grid"],
        ["System Images", "#image/grid"],
        ["Image grid"]
    ]);

    var search = textUtils.hashParam();
    if (typeof search.page == 'undefined' || eval(search.page) <= 0) {
        search.page = 1;
    }
    if (typeof search.pageSize == 'undefined' || eval(search.page) <= 0) {
        search.pageSize = 120;
    }

    search.w_thum = 140;
    search.h_thum = 130;

    ajax({
        service: '/image/grid',
        data: search,
        loading: false,
        done: function (resp) {
            if (resp.success) {
                layout.container(Fly.template("/image/grid.tpl", resp));
                setTimeout(function () {
                    $("img.lazy").lazyload({
                        effect: "fadeIn",
                    });
                }, 100);
            } else {
                popup.msg(resp.message);
            }
        }
    });

};

image.changeType = function (obj, IdShow, IdNone) {
    if ($(obj).is(":checked")) {
        $("#" + IdShow).css({'display': 'block'});
        $("#" + IdNone).css({'display': 'none'});
    }
};

image.change = function () {
    $('#photoCover').val($('input[data-rel=imageFile]').val());
};


image.upload = function (_type) {
    image.change();
    var url = $("form#image-add-module input[name=urladd]").val();
    var type = $('form#image-add-module [name=type]').val();
    var target = ($('form#image-add-module input[name=target]').val() === '') ? '0' : $('form#image-add-module input[name=target]').val();
    if (_type === 'url') {
        ajax({
            service: '/image/add?type=' + type + '&target=' + target,
            data: {url: url},
            contentType: 'json',
            type: 'post',
            done: function (resp) {
                if (resp.success) {
                    popup.close('popup-image-add');
                    image.addImage(target, type);
                } else {
                    popup.msg(resp.message);
                }
            }
        });
    } else {
        ajaxUpload({
            service: '/image/add?type=' + type + '&target=' + target,
            id: 'image-add-module',
            contentType: 'json',
            done: function (resp) {
                if (resp.success) {
                    popup.close('popup-image-add');
                    image.addImage(target, type);
                } else
                    popup.msg(resp.message);
            }
        });
    }
};

image.addImage = function (_targetId, _type) {
    ajax({
        service: '/image/getbytarget',
        data: {type: _type, target: _targetId},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                resp.targetId = _targetId;
                resp.type = _type;

                var dl = resp.data[resp.data.length - 1];

                if (typeof dl !== 'undefined') {
                    $("span[data-image=" + _targetId + "]").html('<img src="' + dl.uri + '" style="max-width:100px;margin:auto;padding:4px;border-radius:4px; border:1px solid #ddd" class="thumbnail"/>');
                    $("span[data-img=" + _targetId + "]").html('<img src="' + dl.uri + '" style="max-width:100px;margin:auto;padding:4px;border-radius:4px; border:1px solid #ddd" class="thumbnail" />');
                }

                popup.open("popup-image-add", "Image Infomation", Fly.template('/image/view.tpl', resp), [
                    {
                        title: 'Close',
                        style: 'btn-default',
                        fn: function () {
                            popup.close('popup-image-add');
                        }
                    }
                ]);
                $('#lefile').change(function () {
                    $('#photoCover').val($(this).val());
                });
            } else {
                popup.msg(resp.message);
            }
        }
    });
};

image.deleteImage = function (_id, _index) {
    ajax({
        service: '/image/remove',
        data: {id: _id},
        loading: false,
        done: function (resp) {
            if (resp.success) {
                $("li[for=" + _index + "]").remove();
                if ($("div[forGridImagetpl=" + _index + "]").length > 0)
                    $("div[forGridImagetpl=" + _index + "]").remove();
            } else {
                popup.msg(resp.message);
            }
        }
    });
};