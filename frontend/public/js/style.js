$(document).ready(function(){

	//heartslider
	$('#heartslider').owlCarousel({
		items:1,
		loop:true,
		margin:0,
		responsiveClass:false,
		nav:true,
		dots:true,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:4000,
		autoplayHoverPause:false,
	});
	
	//saleslider
	$('#saleslider').owlCarousel({
		loop:false,
		margin:0,
		responsiveClass:true,
		nav:true,
		dots:false,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1
			},
			481:{
				items:2
			},
			641:{
				items:3
			}
		}
	});
	
	//footer slider
	$('#fslider').owlCarousel({
		loop:false,
		margin:0,
		responsiveClass:true,
		nav:true,
		dots:false,
		autoplay:true,
		autoHeight:false,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1
			},
			361:{
				items:3
			},
			534:{
				items:3
			},
			992:{
				items:5
			}
		}
	});
	
	//Image slider
	$('#imageslider').owlCarousel({
		margin:0,
		responsiveClass:true,
		nav:true,
		dots:false,
		autoplay:false,
		autoHeight:false,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
		responsive:{
			0:{
				items:1
			},
			768:{
				items:3
			}
		}
	});
	
	//image detail click
    $('.pi-item a').click(function() {
		var parent = $(this).parent();
		var grand = $(this).parent().parent().parent();
		var x = $(this).attr('href');
		$('.pi-item',$(grand)).removeClass("active");
		$(parent).addClass("active");
        return false;
    });
	
	//support click
    $('.ss-title').click(function() {
		var parent = $(this).parent();
        if ($(parent).hasClass("active")) {
			$(parent).removeClass("active")
			$('.ss-status',$(this)).removeClass("fa-minus").addClass("fa-plus");
			$('.ss-content').slideUp();
        } else {
            $(parent).addClass("active");
			$('.ss-status',$(this)).removeClass("fa-plus").addClass("fa-minus");
			$('.ss-content').slideDown();
        }
        return true;
    });
	
	//CloudZoom
	CloudZoom.quickStart();

});