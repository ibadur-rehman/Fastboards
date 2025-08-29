(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_gallery_service.default', function(){
	       
	        /* Add your code here */
        	$(".ova-gallery-service").each( function(e){

        		Fancybox.bind('[data-fancybox="gallery-service"]', {
				  	// Your custom options
				});

        	} );
	    	
        });
        
   });

})(jQuery);