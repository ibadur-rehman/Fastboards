(function($){
    "use strict";

    $(window).on('elementor/frontend/init', function () {
        
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_testimonial_4.default', function(){

            $(".ova-testimonial-4 .slide-testimonials-4").each(function(){
			    var slk = $(this);
			    var slk_ops = slk.data('options') || {};

			    if (!slk.length || !slk.children().length || slk.hasClass('slick-initialized')) return;

			    var isRTL = $('body').hasClass('rtl');
			    if (isRTL) {
			        slk.parent().attr('dir','rtl');
			    }

			    var margin = slk_ops.margin ?? 30;

			    slk.on('setPosition', function () {
			        slk.find('.slick-slide').css({ 'margin-right': margin + 'px' });
			    });

			    slk.slick({
			        dots: true,
			        autoplay: slk_ops.autoplay,
			        autoplaySpeed: slk_ops.autoplay_speed,
			        speed: slk_ops.smartSpeed,
			        slidesToShow: slk_ops.items ?? 2,
			        slidesToScroll: slk_ops.slideBy ?? 1,
			        infinite: slk_ops.loop,
			        arrows: false,
			        rtl: isRTL,
			        centerMode: false,
			        variableWidth: false,
			        responsive: [
			            {
			                breakpoint: 1351,
			                settings: {
			                    slidesToShow: 2,
			                    slidesToScroll: 1
			                }
			            },
			            {
			                breakpoint: 1135,
			                settings: {
			                    slidesToShow: 1,
			                    slidesToScroll: 1
			                }
			            }
			        ]
			    });
			    
			    slk.find(".slick-dots button").attr("title", "Dots");
			});
        });

    });

})(jQuery);
