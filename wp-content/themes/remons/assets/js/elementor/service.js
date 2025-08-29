(function($){
  "use strict";

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_service.default', function() {

            $('.remons-service .open-popup-btn').on('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                const that = $(this);

                // Add disabled
                if ( that.hasClass('disabled') ) return;
                that.addClass('disabled loading');

                // Get product ID
                const productID = that.data('product-id'); 

                // Remove open popup before
                remonsOpenPopup(that, productID);
            });

            // Popup form
            function remonsOpenPopup( that = null, productID ) {
                if ( that && that.length > 0 && productID ) {
                    $.ajax({
                        url: ajax_object.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'remons_open_popup',
                            product_id: productID
                        },
                        success: function(response) {
                            if ( response ) {
                                try {
                                    response = JSON.parse(response);
                                } catch (e) {
                                    that.removeClass('disabled loading');
                                    return;
                                }

                                var popupWrap = $('.popup-booking');

                                if ( popupWrap.length === 0) {
                                    $('body').append('<div class="popup-booking"></div>');
                                    popupWrap = $('.popup-booking');
                                }

                                popupWrap.html(response.result).fadeIn(300).addClass('active');

                                if ( window.BrwFrontendJS ) {
                                    BrwFrontendJS.modernTemplate?.();
                                    BrwFrontendJS.datepicker?.();
                                    BrwFrontendJS.datetimepicker?.();
                                    BrwFrontendJS.locationFields?.();
                                    BrwFrontendJS.quantityFields?.();
                                    BrwFrontendJS.guestsPicker?.();
                                    BrwFrontendJS.taxiLocations?.();
                                    BrwFrontendJS.calculateTotal?.();
                                    BrwFrontendJS.bookingForm?.();
                                    BrwFrontendJS.submitForm?.();
                                }

                                // Get popup form
                                var popupForm = popupWrap.find('.remons-custom-popup');
                                if ( popupForm.length ) {
                                    if ( popupForm.outerHeight() < 600 ) {
                                        popupForm.css('overflow-y', 'unset');
                                    } else {
                                        popupForm.css('overflow-y', 'auto');
                                    }
                                }

                                // Popup overplay
                                popupWrap.find('.popup-overlay').css({
                                    'pointer-events': 'none',
                                    'cursor': 'default'
                                });
                            }

                            // Close popup
                            popupWrap.find('.close-popup-btn').on( 'click', function() {
                                popupWrap.removeClass('active').fadeOut(300).empty();
                            });

                            // Remove disabled & loading icon
                            that.removeClass('disabled loading');
                        },
                        error: function() {
                            that.removeClass('disabled loading');
                        }
                    });
                } // END if
            } // END

            // ovabrwFrontend.afterLoaderDatePicker
            wp.hooks.addAction('ovabrwFrontend.afterLoaderDatePicker', 'ovabrw/enable-close-btn', function(response, currentForm) {
                currentForm.closest('.remons-custom-popup').find('.close-popup-btn').show();
            }); //END

            // ovabrwFrontend.afterLoaderDatePicker
            wp.hooks.addAction('ovabrwFrontend.afterLoaderDateTimePicker', 'ovabrw/enable-close-btn', function(response, currentForm) {
                currentForm.closest('.remons-custom-popup').find('.close-popup-btn').show();
            }); //END

            // ovabrwFrontend.afterCalculateTotal
            wp.hooks.addAction( 'ovabrwFrontend.afterCalculateTotal', 'ovabrw/popup-booking', function( response, currentForm ) {
                var popupForm = currentForm.closest('.remons-custom-popup');
                if ( popupForm.length ) {
                    if ( popupForm.outerHeight() < 600 ) {
                        popupForm.css('overflow-y', 'unset');
                    } else {
                        popupForm.css('overflow-y', 'auto');
                    }
                }
            }); // END
        });
    });

})(jQuery);