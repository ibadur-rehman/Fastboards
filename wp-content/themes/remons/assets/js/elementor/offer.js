(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_offer.default', function(){
	    	
	    	$(".ova-offer .offer-carousel").each(function(){
		        var owlsl = $(this) ;
		        var owlsl_ops = owlsl.data('options') ? owlsl.data('options') : {};

		        if ( $('body').hasClass('rtl') ) {
                	owlsl_ops.rtl = true;
                }

		        var responsive_value = {
		            0:{
		                items:1,
		                stagePadding:0,
		            },
		            767:{
		            	items:2,
		            },
		            1024:{
		            	items:owlsl_ops.items - 1,
		            },
		            1300:{
		                items:owlsl_ops.items,
		            }
		        };
		        
		        owlsl.owlCarousel({
		          	stagePadding: owlsl_ops.stagePadding,
		          	margin: owlsl_ops.margin,
		          	items: owlsl_ops.items,
		          	loop: owlsl_ops.loop,
		          	autoplay: owlsl_ops.autoplay,
		         	autoplayTimeout: owlsl_ops.autoplayTimeout,
		          	dots: owlsl_ops.dots,
		          	nav: false,
		          	thumbs: owlsl_ops.thumbs,
		          	autoplayHoverPause: owlsl_ops.autoplayHoverPause,
		          	slideBy: owlsl_ops.slideBy,
		          	smartSpeed: owlsl_ops.smartSpeed,
		          	rtl: owlsl_ops.rtl,
		          	responsive: responsive_value,
		        });

		    }); 

        });


   });

})(jQuery);