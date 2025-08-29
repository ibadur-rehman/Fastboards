(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_vertical_slider.default', function(){
	       
	        /* Add your code here */
	    	$(".ova-vertical-slider .vertical-slider").each(function(){
		        var owlsl 		= $(this) ;
		        var owlsl_ops 	= owlsl.data('options') ? owlsl.data('options') : {};

		        if ( $('body').hasClass('rtl') ) {
                	owlsl_ops.rtl = true;
                }

		        var responsive_value = {
		            0:{
		              items:1,
		              nav:false
		            },
		            576:{
		              items:1
		            },
		            992:{
		              items:1,
		              dots: false,
		            },
		            1170:{
		              items:owlsl_ops.items
		            }
		        };
		        
		        owlsl.owlCarousel({
		          	margin: owlsl_ops.margin,
		          	items: owlsl_ops.items,
		          	loop: owlsl_ops.loop,
		          	autoplay: owlsl_ops.autoplay,
					autoplayTimeout: owlsl_ops.autoplayTimeout,
					center: owlsl_ops.center,
					nav: owlsl_ops.nav,
					dots: owlsl_ops.dots,
					thumbs: owlsl_ops.thumbs,
					autoplayHoverPause: owlsl_ops.autoplayHoverPause,
					animateOut: "slideOutDown",
    				animateIn: "slideInDown",
					slideBy: owlsl_ops.slideBy,
					smartSpeed: owlsl_ops.smartSpeed,
					rtl: owlsl_ops.rtl,
					navText:[
					'<i class="fa fa-angle-left" ></i>',
					'<i class="fa fa-angle-right" ></i>'
					],
					responsive: responsive_value,
		        });

		      	/* Fixed WCAG */
				owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
				owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
				owlsl.find(".owl-dots button").attr("title", "Dots");
		    });
        });
        
   });

})(jQuery);
