(function($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_booking_button.default', function() {

            $('.ova-booking-button.open-popup-btn').on('click', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                const $btn = $(this);
                if ($btn.hasClass('disabled')) return;

                $btn.addClass('disabled loading');
                const productID = $btn.data('product-id'); 

                remonsOpenPopup(productID, $btn);
            });

            // Popup form
            function remonsOpenPopup(productID, $btn) {
                $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'remons_open_popup',
                        product_id: productID
                    },
                    success: function(response) {
                        if (response) {
                            try {
                                response = JSON.parse(response);
                            } catch (e) {
                                $btn.removeClass('disabled loading');
                                return;
                            }

                            let $popupWrap = $('.popup-booking');

                            if ($popupWrap.length === 0) {
                                $('body').append('<div class="popup-booking"></div>');
                                $popupWrap = $('.popup-booking');
                            }

                            $popupWrap.html(response.result).fadeIn(300).addClass('active');

                            if (window.BrwFrontendJS) {
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
                            var popupForm = $popupWrap.find('.remons-custom-popup');
                            if ( popupForm.length ) {
                                if ( popupForm.outerHeight() < 600 ) {
                                    popupForm.css('overflow-y', 'unset');
                                } else {
                                    popupForm.css('overflow-y', 'auto');
                                }
                            }

                            // Close popup form
                            const $btnClose = $popupWrap.find('.close-popup-btn');
                            const $overlay = $popupWrap.find('.popup-overlay');

                            $btnClose.css({
                                'pointer-events': 'none',
                                'cursor': 'not-allowed',
                                'opacity': 0,
                                'transition': 'opacity 0.2s ease'
                            });

                            $overlay.css({
                                'pointer-events': 'none',
                                'cursor': 'default'
                            });
                        }

                        $btn.removeClass('disabled loading');
                    },
                    error: function() {
                        $btn.removeClass('disabled loading');
                    }
                });
            }

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

            // ovabrwFrontend.afterLoaderDatePicker
            wp.hooks.addAction('ovabrwFrontend.afterLoaderDatePicker', 'ovabrw/enable-close-btn', function(response, currentForm) {
                const $popupWrap = $('.popup-booking');
                const $btnClose = $popupWrap.find('.close-popup-btn');
                const $overlay = $popupWrap.find('.popup-overlay');

                $btnClose.css({
                    'opacity': 1,
                    'pointer-events': 'auto',
                    'cursor': 'pointer'
                });

                $btnClose.off('click').on('click', function () {
                    $popupWrap.removeClass('active').fadeOut(300).empty();
                });

                $overlay.css({
                    'pointer-events': 'auto',
                    'cursor': 'default'
                }).off('click').on('click', function () {
                    $popupWrap.removeClass('active').fadeOut(300).empty();
                });
            }); //END

        });
    });

})(jQuery);
