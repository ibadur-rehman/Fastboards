(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		/* Product Search Ajax */
		elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_product_search_ajax.default', function( $scope ){
			if ( $scope.data('modelCid') ) {
				// Search Ajax
            	window.BrwFrontendJS.searchAjax();
            }
		});
   });

})(jQuery);