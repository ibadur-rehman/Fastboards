(function($) {
    "use strict";

    $(window).on('elementor/frontend/init', function () {

        // Ajax call handler function to load article when changing page
        function ajaxLoadPosts($widget, paged, postsSelector, paginationSelector, settingsStr) {
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'remons_load_more_posts',
                    paged: paged,
                    settings: settingsStr,
                    nonce: ajax_object.security,
                    template_id: $widget.data('template_id')
                },
                beforeSend: function () {
                    $widget.find(postsSelector).fadeTo(200, 0.5);
                    $widget.find(paginationSelector).fadeTo(200, 0.5);
                },
                success: function (response) {
                    if (response.success) {
                        $widget.find(postsSelector).html(response.data.posts_html).fadeTo(200, 1);
                        $widget.find(paginationSelector).html(response.data.pagination_html).fadeTo(200, 1);
                    }
                },
                complete: function () {
                    $widget.removeClass('loading-posts');
                }
            });
        }

        // Attach pagination event to each blog widget
        function bindWidgetPagination(widgetSelector, postClass) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetSelector + '.default', function($scope) {
                // console.log(widgetSelector);
                const postsSelector = '.' + postClass;
                const paginationSelector = '.pagination-wrapper';

                $scope.find(paginationSelector).on('click', '.page-numbers:not(.disabled)', function (e) {
                    e.preventDefault();
                    const $clicked = $(this);
                    const $widget = $clicked.closest('.blog-container');

                    if ($widget.hasClass('loading-posts')) return;

                    $widget.addClass('loading-posts');
                    const paged = $clicked.data('paged');
                    const settingsStr = $widget.data('widget-settings');

                    ajaxLoadPosts($widget, paged, postsSelector, paginationSelector, settingsStr);
                });
            });
        }

        bindWidgetPagination('remons_elementor_blog', 'ova-blog');
        bindWidgetPagination('remons_elementor_blog_2', 'ova-blog-2');
        bindWidgetPagination('remons_elementor_blog_3', 'ova-blog-3');
        bindWidgetPagination('remons_elementor_blog_4', 'ova-blog-4');

    });

})(jQuery);
