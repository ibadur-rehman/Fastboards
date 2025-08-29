(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        
		elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_testimonial_3.default', function(){

			$(".ova-testimonial-3 .slide-testimonials-3").each(function(){

		        var owlsl 		= $(this);
		        var owlsl_ops 	= owlsl.data('options') ? owlsl.data('options') : {};
		        var navCon 		= '#ova-testimonial-slider-3-control';

		        var icon_back = "ovaicon ovaicon-upload";
		        var icon_next = "ovaicon ovaicon-download";

		        var isRTL = $('body').hasClass('rtl');

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
		          	responsive: responsive_value,
		          	navText:[
		          		'<i aria-hidden="true" class="' + icon_back + '"></i>',
		          		'<i aria-hidden="true" class="' + icon_next + '"></i>'
		          	],
		        });

		      	/* Fixed WCAG */
				owlsl.find(".owl-nav button.owl-prev").attr("title", "Previous");
				owlsl.find(".owl-nav button.owl-next").attr("title", "Next");
				owlsl.find(".owl-dots button").attr("title", "Dots");

		    });

		});

   });

})(jQuery);