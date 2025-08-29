(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        
		elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_testimonial.default', function(){

			$(".ova-testimonial .slide-testimonials").each(function(){

		        var owlsl 		= $(this);
		        var owlsl_ops 	= owlsl.data('options') ? owlsl.data('options') : {};
		        var navCon 		= '#ova-testimonial-slider-control';

		        var icon_back = "ovaicon ovaicon-back-2";
		        var icon_next = "ovaicon ovaicon-next-4";

		        var isRTL = $('body').hasClass('rtl');

		        if ( isRTL ) {
		        	icon_back = "ovaicon ovaicon-next-4";
		        	icon_next = "ovaicon ovaicon-back-2";
		        }

		        var responsive_value = {
		            0:{
		              	items:1,
		              	dots: true,
		            },
		            767:{
		              	items:1
		            },
		            1024:{
		              	items:owlsl_ops.items
		            }
		        };

		        if ( owlsl_ops.items >= 2 ) {
		        	responsive_value = {
			            0:{
			              	items:1,
			              	dots: true,
			            },
			            767:{
			              	items: owlsl_ops.items - 1
			            },
			            1024:{
			              	items:owlsl_ops.items
			            },
			        };
		        }
		        
		        owlsl.owlCarousel({
		          	autoWidth: owlsl_ops.autoWidth,
		          	margin: owlsl_ops.margin,
		          	items: owlsl_ops.items,
		          	loop: owlsl_ops.loop,
		          	autoplay: owlsl_ops.autoplay,
		          	autoplayTimeout: owlsl_ops.autoplayTimeout,
		          	center: false,
		          	nav: true,
		          	navContainer: navCon,
		          	dots: owlsl_ops.dots,
		          	thumbs: owlsl_ops.thumbs,
		          	autoplayHoverPause: owlsl_ops.autoplayHoverPause,
		          	slideBy: owlsl_ops.slideBy,
		          	smartSpeed: owlsl_ops.smartSpeed,
		          	rtl: isRTL,
		          	navText:[
		          		'<i aria-hidden="true" class="' + icon_back + '"></i>',
		          		'<i aria-hidden="true" class="' + icon_next + '"></i>'
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