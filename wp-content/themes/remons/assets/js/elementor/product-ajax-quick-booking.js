(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_product_ajax_quick_booking.default', function() {
	        $(".ovabrw-product-ajax-quick-booking").each( function() {
        		Fancybox.bind('[data-fancybox="paqb-gallery"]', {
				   	Image: {
				    	zoom: false,
				  	},
				});

		    });

		    $('.ovabrw-product-ajax-quick-booking .products-filter .item').on( 'click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var ajaxFilter = $(this).closest('.ovabrw-product-ajax-quick-booking');
                var productID  = ajaxFilter.find('.products-filter .item.active').data('product-id');

                ajaxFilter.find('.item').removeClass('active');
                $(this).addClass('active');

                ovabrwAjaxQuickBooking(ajaxFilter,productID);
            });

            $('.ovabrw-product-ajax-quick-booking .products-select-filter').on('change', function(e) {
            	e.preventDefault();
                e.stopImmediatePropagation();

                var ajaxFilter = $(this).closest('.ovabrw-product-ajax-quick-booking');
			    var productID  = $(this).find(":selected").val();

                ovabrwAjaxQuickBooking(ajaxFilter,productID);
			});

            // Ajax Quick Booking
            function ovabrwAjaxQuickBooking( that = null, productID = '' ) {
                if ( that ) {
                    var loader = that.find('.ovabrw-loader');
                    loader.show();

                    if ( that.find('.products-filter .item.active').data('product-id') ) {
                    	productID = that.find('.products-filter .item.active').data('product-id');
                    }
                    var inputData       = that.find('input[name="data-ajax-quick-booking"]');
                    var show_gallery    = inputData.data('show_gallery');
                    var show_short_desc = inputData.data('show_short_desc');
                    var show_button     = inputData.data('show_button');
                    var text_button     = inputData.data('text_button');

                    $.ajax({
                        url: ajax_object.ajax_url,
                        type: 'POST',
                        data: ({
                            action: 'product_ajax_quick_booking',
                            product_id: productID,
                            show_gallery: show_gallery,
                            show_short_desc: show_short_desc,
                            show_button: show_button,
                            text_button: text_button
                        }),
                        success: function(response) {
                            if ( response ) {
                                response = JSON.parse( response );

                                that.find('.quick-booking-wrap .wrap-ajax-quick-booking-result').empty();
                                that.find('.quick-booking-wrap .wrap-ajax-quick-booking-result').append(response.result).fadeOut(300).fadeIn(500);

                                // Tabs
                                window.BrwFrontendJS.modernTemplate();

                                // Datetimepicker
                                window.BrwFrontendJS.datepicker();
                                window.BrwFrontendJS.datetimepicker();

                                // Locations
                                window.BrwFrontendJS.locationFields();

                                // Quantity
                                window.BrwFrontendJS.quantityFields();

                                // Guests
                                window.BrwFrontendJS.guestsPicker();

                                // Taxi locations
                                window.BrwFrontendJS.taxiLocations();

                                // Calculate total
                                window.BrwFrontendJS.calculateTotal();

                                // Booking form
                                window.BrwFrontendJS.bookingForm();

                                // Submit form
                                window.BrwFrontendJS.submitForm();

                                loader.hide();
                            }
                        }
                    });
                }
            }
        });
   });

})(jQuery);
