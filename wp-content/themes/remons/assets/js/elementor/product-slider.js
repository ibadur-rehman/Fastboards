(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_product_slider.default', function(){
	       
	        $('.ovabrw-product-slider').each( function() {
                var that    = $(this);
                var options = that.data('options') ? that.data('options') : {};

                var navCon  = '#ova-product-slider-control';

                if ( $('body').hasClass('rtl') ) {
                	options.rtl = true;
                }

                if ( options.rtl ) {
		        	options.nav_left  = "ovaicon-next";
		        	options.nav_right = "ovaicon-back";
		        }
                
                that.owlCarousel({
                    autoWidth: options.autoWidth,
                    margin: options.margin,
                    items: options.items,
                    loop: options.loop,
                    autoplay: options.autoplay,
                    autoplayTimeout: options.autoplayTimeout,
                    center: options.center,
                    lazyLoad: options.lazyLoad,
                    nav: options.nav,
                    navContainer: navCon,
                    dots: options.dots,
                    autoplayHoverPause: options.autoplayHoverPause,
                    slideBy: options.slideBy,
                    smartSpeed: options.smartSpeed,
                    rtl: options.rtl,
                    navText:[
                        '<i aria-hidden="true" class="'+ options.nav_left +'"></i>',
                        '<i aria-hidden="true" class="'+ options.nav_right +'"></i>'
                    ],
                    responsive: options.responsive,
                });
            });
	    	
        });
        
   });

})(jQuery);
