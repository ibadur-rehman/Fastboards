(function($){
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_icon_slider.default', function(){

            $(".ova-icon-slider .icon-slider").each(function(){
                var $slider = $(this);
                var options = $slider.data('options') || {};

                $slider.owlCarousel({
                    rtl: $('body').hasClass('rtl'),
                    loop: options.loop ?? true,
                    autoplay: options.autoplay ?? true,
                    autoplayTimeout: options.autoplay_speed ?? 3000,
                    smartSpeed: options.smartSpeed ?? 500,
                    margin: options.margin ?? 30,
                    items: options.items ?? 2,
                    slideBy: options.slideBy ?? 1,
                    // autoWidth: true,
                    nav: false,
                    dots: false,
                    responsive: options.responsive ?? {
                        0: {
                            items: 1,
                            slideBy: 1
                        },
                        768: {
                            items: options.items ?? 2,
                            slideBy: options.slideBy ?? 1
                        }
                    }
                });
            });

        });

    });

})(jQuery);
