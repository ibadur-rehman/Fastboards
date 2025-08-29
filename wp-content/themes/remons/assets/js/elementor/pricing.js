(function ($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_pricing.default', function () {

            // Toggle switch change
            $('.billing-toggle input#billingToggle').on('change', function () {
                const isYearly = $(this).is(':checked');

                // Toggle class active on labels
                $('.billing-option').removeClass('active');
                if (isYearly) {
                    $('.billing-option.yearly').addClass('active');
                } else {
                    $('.billing-option.monthly').addClass('active');
                }

                // Show/Hide pricing
                $('.pricing-wrapper .item-card').each(function () {
                    const $card = $(this);
                    if (isYearly) {
                        $card.find('.price-monthly').hide();
                        $card.find('.price-yearly').show();
                    } else {
                        $card.find('.price-yearly').hide();
                        $card.find('.price-monthly').show();
                    }
                });
            });


        });
    });

})(jQuery);
