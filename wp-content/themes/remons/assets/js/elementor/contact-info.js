(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        
		elementorFrontend.hooks.addAction('frontend/element_ready/remons_elementor_contact_info.default', function(){

			$('.ova-contact-info').each( function(){
				var that    = $(this);
				var select 	= that.find('.select-format .input-for-select');
				var item    = that.find('.select-format .info .item');

				if ( select.length > 0 ) {

					select.on( 'click', function(e){	
						e.preventDefault();	
						e.stopPropagation();
    					e.stopImmediatePropagation();
						var info = $(this).closest('.select-format').find('.info');
						info.toggleClass('visible');

						$(this).toggleClass( 'active' );
			        	// change icon
			        	if ( $(this).hasClass('active') ) {
			        		$(this).find('i').css({'transform':'rotate(180deg)'});
			        	} else {
			        		$(this).find('i').css({'transform':'rotate(0deg)'});
			        	}
					});

					item.on( 'click', function(e){
						e.preventDefault();	

						var info = $(this).parent();
						info.removeClass('visible');

						if ( $(this).has('a').length > 0 ) {
							var link   = $(this).find('a').attr('href');
							var target = $(this).find('a').attr('target');
							var value  = $(this).find('a').text();
							select.val(value);
							window.location.href = link;
						} else {
							var value = $(this).find('span').text();;
							select.val(value);
						}

					});

				}
			
			});
			
		});


   });

})(jQuery);