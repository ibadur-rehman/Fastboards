(function($){
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/Remons_Elementor_Toggle_2.default', function(){

            const $items = $('.ova-toggle-2 .item');

            $items.find('.question').off('click').on('click', function(e) {
                e.preventDefault();

                const $currentItem = $(this).closest('.item');
                const isActive = $currentItem.hasClass('active');

                // Close all other items and hide their answer
                $items.not($currentItem).removeClass('active')
                    .find('.answer').stop(true, true).slideUp(300);

                // If the current item is not active then open it
                if (!isActive) {
                    $currentItem.addClass('active');
                    $currentItem.find('.answer').stop(true, true).slideDown(300);
                } else {
                    // If active then close it
                    $currentItem.removeClass('active');
                    $currentItem.find('.answer').stop(true, true).slideUp(300);
                }
            });

            $items.each(function() {
                const $currentItem = $(this);
                if ($currentItem.hasClass('initial-active')) {
                    $currentItem.addClass('active');
                    $currentItem.find('.answer').show();
                } else {
                    $currentItem.removeClass('active');
                    $currentItem.find('.answer').hide();
                }
            });
        });
    });
})(jQuery);