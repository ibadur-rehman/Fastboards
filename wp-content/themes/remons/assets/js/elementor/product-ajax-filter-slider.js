(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_product_ajax_filter_slider.default', function(){

        	productSlider();

            $('.ovabrw-product-ajax-filter-slider .categories-filter .item-term').on( 'click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var ajaxFilter = $(this).closest('.ovabrw-product-ajax-filter-slider');

                ajaxFilter.find('.item-term').removeClass('active');
                $(this).addClass('active');

                ovabrwAjaxFilterSlider(ajaxFilter);
            });
            
            // Ajax Filter Slider
            function ovabrwAjaxFilterSlider( that = null ) {
                if ( that ) {
                    var loader = that.find('.ovabrw-loader');
                    loader.show();

                    var termID          = that.find('.categories-filter .item-term.active').data('term-id');
                    var inputData       = that.find('input[name="ovabrw-data-ajax-filter"]');
                    var template        = inputData.data('template');
                    var postsPerPage    = inputData.data('posts-per-page');
                    var orderby         = inputData.data('orderby');
                    var order           = inputData.data('order');

                    $.ajax({
                        url: ajax_object.ajax_url,
                        type: 'POST',
                        data: ({
                            action: 'product_ajax_filter_slider',
                            term_id: termID,
                            template: template,
                            posts_per_page: postsPerPage,
                            orderby: orderby,
                            order: order,
                        }),
                        success: function(response) {
                            if ( response ) {
                                response = JSON.parse( response );

                                that.find('.ovabrw-result .ovabrw-product-filter').empty();
                                that.find('.ovabrw-result .ovabrw-product-filter').append(response.result).fadeOut(300).fadeIn(500);

                                productSlider();

                                loader.hide();
                            }
                        }
                    });
                }
            }

            // Slider
            function productSlider() { 
            	$('.ovabrw-product-ajax-filter-slider .ovabrw-product-filter-slide').each( function() {
	                var that    = $(this);
	                var options = that.closest('.ovabrw-result').find('input[name="ovabrw-data-ajax-filter"]').data('options');

	                if ( $('body').hasClass('rtl') ) {
	                	options.rtl = true;
	                }

	                if ( options.rtl ) {
			        	options.nav_left  = "brwicon-right-1";
			        	options.nav_right = "brwicon-left";
			        }
	                
	                that.owlCarousel({
	                    margin: options.margin,
	                    items: options.items,
	                    loop: options.loop,
	                    autoplay: options.autoplay,
	                    autoplayTimeout: options.autoplayTimeout,
	                    center: options.center,
	                    lazyLoad: options.lazyLoad,
	                    nav: options.nav,
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
            }

        });
        
   });

})(jQuery);
