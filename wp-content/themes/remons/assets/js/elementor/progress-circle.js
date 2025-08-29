(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        
		elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_progress_circle.default', function(){

			$(".ova-progress-circle").appear(function() {
				var circle = $(this);

				var start_angle = circle.data('start_angle');
				var size     	= parseInt( circle.data('size') );
				var value    	= circle.data('value');
				var color    	= circle.data('color');
				var empty_color = circle.data('empty_color');
				var linecap  	= circle.data('linecap');
				var thickness  	= parseInt( circle.data('thickness') );

				// Size & Thickness
				if ( !size || isNaN( size ) ) size = 80;
				if ( !thickness || isNaN( thickness ) ) thickness = 5;
				if ( thickness >= size ) thickness = size - 1;

                var progressBarOptions = {
                	startAngle: start_angle,
                	size: size,
				    value: value,
				    fill: {
				        color: color 
				    },
				    emptyFill: empty_color,
				    lineCap: linecap,
				    thickness: thickness
				};

				circle.circleProgress(progressBarOptions).on('circle-animation-progress', function(event, progress, stepValue) {
					$(this).find('strong').text(String((stepValue*100).toFixed(0)));
				});

		    });

		});


   });

})(jQuery);
