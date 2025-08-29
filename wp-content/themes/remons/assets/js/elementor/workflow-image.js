(function ($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_workflow_image.default', function ($scope) {

            const $items = $scope.find('.template2 .workflow-item');
            const $firstItem = $items.eq(0);

            if ($items.length === 0) return;

            $firstItem.addClass('active');

            $items.on('mouseenter', function () {
                $items.removeClass('active');
                $(this).addClass('active');
            });

            $items.on('mouseleave', function () {
                $items.removeClass('active');
                $firstItem.addClass('active');
            });
        });
    });

})(jQuery);
