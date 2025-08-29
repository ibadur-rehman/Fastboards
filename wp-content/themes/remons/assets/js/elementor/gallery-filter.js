(function($){
	"use strict";
	
	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_gallery_filter.default', function(){
	       
	        /* Add your code here */
	       $( document ).ready(function() {
			    $(".ova-gallery-filter").each(function(){

					var that 		= $(this);
					var layout_mode = that.data('layout_mode');
					var gutter  	= that.data('gutter');
					var gallery     = that.find('.gallery-column');
					var filter_btn  = that.find('.filter-btn-wrapper .filter-btn');

					gallery.find('.gallery-item').css('margin-bottom', gutter + 'px');

					that.imagesLoaded( function() {

		                gallery.isotope({ 
		             		itemSelector : '.gallery-item',
		                  	animationOptions: { 
		                      	duration: 750, 
		                      	easing: 'linear', 
		                      	queue: false, 
		                	},
		                	layoutMode: layout_mode,
		                    percentPosition: true,
		                    fitRows: {
	                            gutter: gutter
	                        },
		                    masonry: {
	                            columnWidth: '.gallery-item',
	                            gutter: gutter
	                        },
		                });  

		            });

					filter_btn.click(function(){
	          
			            $('.filter-btn-wrapper .filter-btn').removeClass("active-category");

			            $(this).addClass("active-category");      

			                var selector = $(this).attr('data-slug'); 

			                gallery.isotope({ 
		                     	filter: selector, 
		                      	animationOptions: { 
		                          	duration: 750, 
		                          	easing: 'linear', 
		                          	queue: false, 
		                    	},
		                    	layoutMode: layout_mode,
		                        percentPosition: true,
		                        fitRows: {
		                            gutter: gutter
		                        },
		                        masonry: {
		                            columnWidth: '.gallery-item',
		                            gutter: gutter
		                        },
			                });  

			            return false;

	        		}); 

	        		Fancybox.bind('[data-fancybox="gallery-filter"]', {
					   	Image: {
					    	zoom: false,
					  	},
					});

		    	});
			});
	    	
        });
        
   });

})(jQuery);
