<?php if ( !defined( 'ABSPATH' ) ) exit();

/**
 * Class Remons_Ajax
 */
if ( !class_exists( 'Remons_Ajax' ) ) {

	class Remons_Ajax {

		/**
		 * Constructor
		 */
		public function __construct() {
			// Filter Slider
			add_action( 'wp_ajax_product_ajax_filter_slider', [ $this, 'product_ajax_filter_slider' ] );
			add_action( 'wp_ajax_nopriv_product_ajax_filter_slider', [ $this, 'product_ajax_filter_slider' ] );

			// Quick Booking
			add_action( 'wp_ajax_product_ajax_quick_booking', [ $this, 'product_ajax_quick_booking' ] );
			add_action( 'wp_ajax_nopriv_product_ajax_quick_booking', [ $this, 'product_ajax_quick_booking' ] );

			// open popup
			add_action( 'wp_ajax_remons_open_popup', [ $this, 'remons_open_popup' ] );
			add_action( 'wp_ajax_nopriv_remons_open_popup', [ $this, 'remons_open_popup' ] );

			// Handle AJAX request for getting more blog posts
			add_action( 'wp_ajax_remons_load_more_posts', [ $this, 'blog_ajax_load_posts' ] );
        	add_action( 'wp_ajax_nopriv_remons_load_more_posts', [ $this, 'blog_ajax_load_posts' ] );
		}
		
		/**
		 * Ajax filter product slide
		 */
		public function product_ajax_filter_slider() {
			// Get term id
			$term_id = ovabrw_get_meta_data( 'term_id', $_POST );

			// Get card template
			$template = ovabrw_get_meta_data( 'template', $_POST, 'card1' );

			// Get posts per page
			$posts_per_page = (int)ovabrw_get_meta_data( 'posts_per_page', $_POST, 6 );

			// Get orderby
			$orderby = ovabrw_get_meta_data( 'orderby', $_POST, 'date' );

			// Get order
			$order = ovabrw_get_meta_data( 'order', $_POST, 'DESC' );

			// Query get products
			$products = OVABRW()->options->get_product_from_search([
				'paged' 			=> 1,
				'posts_per_page' 	=> $posts_per_page,
				'orderby' 			=> $orderby,
				'order' 			=> $order,
				'term_id' 			=> $term_id
			]);

			ob_start();

			?>

			<div class="ovabrw-product-filter-slide owl-carousel owl-theme">
				<?php if ( $products->have_posts() ) : while ( $products->have_posts() ): $products->the_post(); ?>
					<div class="item">
						<?php ovabrw_get_template( 'modern/products/cards/ovabrw-'.$template.'.php', [ 'thumbnail_type' => 'image' ] ); ?>
					</div>
				<?php endwhile; else : ?>
					<div class="not-found">
						<?php esc_html_e( 'No products found!', 'remons' ); ?>
					</div>
				<?php endif; wp_reset_postdata(); ?>
			</div>

			<?php 

			// Get HTML
			$html = ob_get_contents();
			ob_end_clean();

			echo json_encode([
				'result' => $html
			]);

			wp_die();
		}

		/**
		 * Ajax product quick booking
		 */
		public function product_ajax_quick_booking() {
			// Get product id
			$product_id = ovabrw_get_meta_data( 'product_id', $_POST );

			// Show gallery
			$show_gallery = ovabrw_get_meta_data( 'show_gallery', $_POST, 'yes' );

			// Show short description
			$show_short_desc = ovabrw_get_meta_data( 'show_short_desc', $_POST, 'yes' );

			// Show button
			$show_button = ovabrw_get_meta_data( 'show_button', $_POST);

			// Text button
			$text_button = ovabrw_get_meta_data( 'text_button', $_POST, esc_html__( 'Read More', 'remons' ) );

			ob_start();

			// Before single product
			do_action( 'woocommerce_before_single_product' );

			// Get product
			$product = wc_get_product( $product_id );
			if ( !$product ) wp_die();

			// Get gallery ids
			$gallery_ids = $product->get_gallery_image_ids(); 

			// Get image id
			$img_id = $product->get_image_id();
			
			// Get image URL
			$img_url = wp_get_attachment_url( $img_id );

			// Get image alt
			$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			if ( !$img_alt ) $img_alt = get_the_title( $img_id );

			?>

			<div class="ajax-quick-booking-result">
				<div class="ovabrw-modern-product">
					<?php ovabrw_get_template( 'modern/single/detail/ovabrw-product-form-tabs.php', [
						'product_id' => $product_id
					]); ?>
				</div>

				<div class="content-product">
				   	<?php if ( 'yes' === $show_gallery ):
				   		if ( ovabrw_array_exists( $gallery_ids ) ): ?>
							<div class="gallery">
								<div class="product-gallery" >
									<div class="gallery-item">
										<a class="gallery-fancybox" data-fancybox="paqb-gallery" data-src="<?php echo esc_url( $img_url ); ?>">
						  					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
						  				</a>
									</div>
									<?php foreach( $gallery_ids as $k => $gallery_id ): 
										$gallery_url = wp_get_attachment_url( $gallery_id );
										$gallery_alt = get_post_meta( $gallery_id, '_wp_attachment_image_alt', true );

										if ( !$gallery_alt ) {
											$gallery_alt = get_the_title( $gallery_id );
										}
									?>
										<div class="gallery-item">
											<a class="gallery-fancybox" data-fancybox="paqb-gallery" data-src="<?php echo esc_url( $gallery_url ); ?>">
							  					<img src="<?php echo esc_url( $gallery_url ); ?>" alt="<?php echo esc_attr( $gallery_alt ); ?>">
							  				</a>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif;
					endif;

					// Show short description
					if ( 'yes' === $show_short_desc ) {
						ovabrw_get_template( 'modern/single/detail/ovabrw-product-short-description.php', [
							'product_id' => $product_id
						]);
					} // END

					// Show button
					if ( 'yes' === $show_button ): ?>
						<a class="details-button" href="<?php echo esc_url( $product->get_permalink() ); ?>">
							<span><?php echo esc_html( $text_button ); ?></span>
							<i aria-hidden="true" class="ovaicon ovaicon-next"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
			
			<?php do_action( 'woocommerce_after_single_product' ); 

			// Get html
			$html = ob_get_contents();
			ob_end_clean();

			echo json_encode([
				'result' => $html
			]);

			wp_die();
		}

		public function remons_open_popup() {
			$product_id = ovabrw_get_meta_data( 'product_id', $_POST );
			$product_name = get_the_title( $product_id );

			ob_start();
			?>
				<div class="remons-custom-popup">
					<div class="close-popup-btn">x</div>
					<h2 class="product-title"><?php echo esc_html( $product_name ); ?></h2>
					<div class="scroll-area">
						<div class="ovabrw-modern-product">
							<?php ovabrw_get_template( 'modern/single/detail/ovabrw-product-form-tabs.php', [
								'product_id' => $product_id
							]); ?>
						</div>
					</div>
				</div>

				<div class="popup-overlay"></div>
			<?php
			$html = ob_get_contents();
				ob_end_clean();

				echo json_encode([
					'result' => $html
				]);

				wp_die();
		}

		/**
		 * Ajax blog pagination
		 */
		public function blog_ajax_load_posts() {

			// Check nonce to secure AJAX request, avoid CSRF
		    check_ajax_referer( 'ovabrw-security-ajax', 'nonce' );

		    // Get the current page sent from AJAX, if not then default is 1
		  	$paged = isset( $_POST[ 'paged' ] ) ? intval( $_POST[ 'paged' ] ) : 1;

		  	// Get the settings sent from the client, if none then it is an empty array
			$settings = isset( $_POST[ 'settings' ] ) ? ( array ) $_POST[ 'settings' ] : [];

			$template_id = isset( $_POST [ 'template_id' ] ) ? sanitize_text_field( $_POST[ 'template_id' ] ) : '';

				$default_settings = [
					'posts_per_page'		 => 3,	
				    'template'      	 	 => 'template1',
				    'template_style'     	 => 'template_style1',
				    'total_count'        	 => 3,
				    'number_column'      	 => 'column_3',
				    'order'        	     	 => 'desc',
				    'order_by'         		 => 'date',
				    'order_text'           	 => 'no',
				    'show_date'       		 => 'no',
				    'show_category'          => 'no',
				    'show_author'        	 => 'no',
				    'show_short_desc' 		 => 'no',
				    'show_comment'     		 => 'no',
				    'show_pagination'        => 'no',
				    'show_read_more'         => 'no',
				    'show_icon'				 => 'no',
				    'icon_readmore'       	 => 'no',
			    ];

			    // Merge upload settings with default settings (upload settings will override default)
			    $settings = wp_parse_args( $settings, $default_settings );

			    // Get variables from the $settings array (eg: $posts_per_page, $order_by, ...)
	    		extract( $settings );

				// Get blog IDs
				$blog_ids = remons_get_blog_ids( $settings );

				// Total page
				$total_count = count( $blog_ids );

				if ( $template_id === 'blog' ) {
				    $posts_per_page = (int)remons_get_meta_data( 'total_count', $settings, 3 );
				} else {
					$posts_per_page = (int)remons_get_meta_data( 'posts_per_page', $settings, 3 );
				}

				// $posts_per_page = ( int ) remons_get_meta_data( 'total_count', $settings,
				//     remons_get_meta_data('posts_per_page', $settings )
				// );

				$total_pages = ceil( $total_count / $posts_per_page );

				// cut blog ids on page
				$offset = ( $paged - 1 ) * $posts_per_page;
				$blog_ids = array_slice( $blog_ids, $offset, $posts_per_page );

			    ob_start();

			    if ( remons_array_exists( $blog_ids ) ):
					foreach ( $blog_ids as $blog_id ):
						// Blog title
						$blog_title = get_the_title( $blog_id );

						// Blog link detail
						$blog_link = get_the_permalink( $blog_id );

						// Thumbnail
						$thumbnail_id 	= get_post_thumbnail_id( $blog_id );
						$thumbnail_url 	= wp_get_attachment_image_url( $thumbnail_id, 'remons_thumbnail' );
						$thumbnail_alt 	= get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

						// If there is no thumbnail, use default image (placeholder)
						if ( !$thumbnail_url ) $thumbnail_url = \Elementor\Utils::get_placeholder_image_src();

						// If there is no alt for the image, use the post title
						if ( !$thumbnail_alt ) $thumbnail_alt = get_the_title( $blog_id );

						// Get categories
					  	$categories = get_the_category( $blog_id );?>

					  	<!-- Blog -->
					  	<?php if ( $template_id === 'blog' ): ?>
					  		<div class="item">
							  	<div class="media">
								  	<div class="box-img">
								  		<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
										  	<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
									  	</a>
								  	</div>
								  	<?php if ( 'template2' != $template ):
								  		if ( 'yes' === $show_date ): ?>
											<div class="post-date">
												<span class="date-j">
													<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'M' , $blog_id ) ); ?>
												</span>
											</div>
										<?php endif;

										// Category
										if ( 'yes' === $show_category && remons_array_exists( $categories ) ) : ?>
										  	<div class="post-category">
											  	<span class="category">
											  		<?php echo esc_html( $categories[0]->name ); ?>
											  	</span>           
										  	</div>
									  	<?php endif;
									endif; ?>
							  	</div>
					  		   	<div class="content">
								  	<ul class="post-meta">
									  	<?php if ( 'yes' === $show_author ):
									  		$author_id = get_post_field( 'post_author', $blog_id );
									  	?>
										  	<li class="item-meta wp-author">
											  	<span class="left author">
													<?php echo wp_kses_post( get_avatar( $author_id ) ); ?>
											  	</span>
											  	<span class="right post-author">
											  		<span class="by">
											  			<?php esc_html_e( 'by', 'remons' ); ?>
											  		</span>
												  	<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
													  	<?php echo wp_kses_post( get_the_author_meta( 'display_name', $author_id ) ); ?>
												  	</a>
											  	</span>
										  	</li>
								  		<?php endif;

								  		// Comment
								  		if ( 'yes' === $show_comment && 'template1' === $template && 'template_style2' === $template_style ): ?>
										  	<li class="item-meta post-comment">
											  	<span class="left comment">
												  	<i class="fas fa-comments"></i>
											  	</span>
											  	<span class="right comment">
												  	<?php echo wp_kses_post( get_comments_number_text( false, false, false, $blog_id ) ) ; ?>
											  	</span>            
										  	</li>
									    <?php endif; ?>
								  	</ul>

								  	<?php if ( 'template2' === $template && 'template_style2' === $template_style ):
								  		if ( 'yes' === $show_date ): ?>
											<div class="post-date">
												<span class="left">
												  	<i class="flaticon flaticon-calendar"></i>
											  	</span>
												<span class="date-j">
													<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'F' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'Y' , $blog_id ) ); ?>
												</span>
											</div>
										<?php endif;

										// Categories
										if ( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
										  	<div class="post-category">
										  		<span class="left">
												  	<i class="ovaicon ovaicon-folder-1"></i>
											  	</span>
											  	<span class="category">
											  		<?php echo esc_html( $categories[0]->name ); ?>
											  	</span>           
										  	</div>
									  	<?php endif;
									endif; ?>
								
								  	<h2 class="post-title">
									  	<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<?php echo wp_kses_post( $blog_title ); ?>
									  	</a>
								  	</h2>

								  	<?php if ( 'yes' === $show_short_desc ): ?> 
									  	<div class="short_desc">
										  	<p>
										  		<?php echo wp_kses_post( remons_custom_text( get_the_excerpt($blog_id), $order_text ) ); ?>
										  	</p>
									  	</div>
								  	<?php endif;

								  	// Template 2
								  	if ( 'template2' === $template && 'template_style1' === $template_style ):
								  		if ( 'yes' === $show_date ): ?>
											<div class="post-date">
												<span class="date-j">
													<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'F' , $blog_id ) ); ?>
												</span>
											</div>
										<?php endif;

										if ( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
										  	<div class="post-category">
											  	<span class="category">
											  		<?php echo esc_html( $categories[0]->name ); ?>
											  	</span>           
										  	</div>
									  	<?php endif;
									endif;

									// Comment
									if ( 'yes' === $show_comment || 'yes' === $show_read_more ): ?>
									  	<div class="divider"></div>
								  		<div class="bottom-content">
								  			<?php if ( 'yes' === $show_comment ): ?>
											    <ul class="post-meta">
												  	<li class="item-meta post-comment">
													  	<span class="left comment">
														  	<i class="fas fa-comments"></i>
													  	</span>
													  	<span class="right comment">
														  	<?php echo wp_kses_post( get_comments_number_text( false, false, false, $blog_id ) ) ; ?> 
													  	</span>            
												  	</li>
											  	</ul>
										    <?php endif;

										    // Read more
										    if ( 'yes' === $show_read_more ): ?>
										  		<a class="read-more" href="<?php echo esc_url( $blog_link); ?>">	
											  		<?php if ( 'yes' === $show_icon ) {
											  			\Elementor\Icons_Manager::render_icon( $icon_readmore, [ 'aria-hidden' => 'true' ] ); 
											  		} ?>
											  		<span class="text-button">
													  	<?php echo esc_html( $text_readmore ); ?>
											  		</span>
												</a>
										  	<?php endif; ?>
										</div>	
								    <?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

					  	<!-- Blog-2 -->
					  	<?php if( $template_id === 'blog-2' ): ?>
						  	<div class="item">
								<!-- Media -->
								<div class="media">
									<div class="box-img">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
										</a>
										  <!-- Date -->
										<?php if ( 'yes' === $show_date ): ?>
											<div class="post-date">
												<span class="date-j">
													<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'M' , $blog_id ) ); ?>
												</span>
											</div>
										<?php endif; ?>
									</div>

									<div class="post-meta">
										<?php 
										// Category
										if( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
											<div class="post-category">
												<span class="category">
													<?php echo esc_html( $categories[0]->name ); ?>
												</span>
											</div>
										<?php endif;

										// Separator Icon
										if ( 'yes' === $show_category && 'yes' === $show_comment && remons_array_exists( $categories ) ): ?>
											<span class="separator-icon">
												<i class="fa fa-circle"></i>
											</span>
										<?php endif;

										// Comment count
										if( 'yes' === $show_comment ) : ?>
											<div class="post-comment">
												<span class="comment-count">
													Comments ( <?php echo get_comments_number( $blog_id ) ?> )
												</span>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<!-- Content -->
								<div class="content">
									<h2 class="post-title">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<?php echo wp_kses_post( $blog_title ); ?>
										</a>
									</h2>

									<?php if ( 'yes' === $show_short_desc ): ?> 
										<div class="short_desc">
											<p>
											  	<?php echo wp_kses_post( remons_custom_text( get_the_excerpt( $blog_id ), $order_text ) ); ?>
											</p>
										</div>
									<?php endif;?>

									<?php if ( 'yes' === $show_read_more ): ?>
										<a class="read-more" href="<?php echo esc_url( $blog_link ); ?>">
											<span class="text-button">
												<?php echo esc_html( $text_readmore ); ?>
											</span>
											<span class="icon">
												<?php if ( 'yes' === $show_icon ) {
													\Elementor\Icons_Manager::render_icon( $icon_readmore, ['aria-hidden' => 'true'] );
												} ?>
											</span>
										</a>
									<?php endif ?>
								</div>
							</div>
						<?php endif; ?>

					  	<!-- Blog-3 -->
					  	<?php if($template_id === 'blog-3'): ?>
						  	<div class="divider"></div>
							<div class="item">
								<!-- Media -->
								<div class="media">
									<div class="box-img">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
										</a>

										  <!-- Date -->
										<?php 
											if ( 'yes' === $show_date ): ?>
													<div class="post-date">
														<span class="date-j">
															<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
														</span>
														<span class="date-MY">
															<?php echo esc_html( get_the_time( 'M' , $blog_id ) ); ?>
														</span>
													</div>
											<?php endif;
										 ?>
									</div>
								</div>

								<!-- Content -->
								<div class="content">
									<div class="post-meta">
										<?php 
										// Category
										if( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
											<div class="post-category">
												<span class="category">
													<?php echo esc_html( $categories[0]->name ); ?>
												</span>
											</div>
										<?php endif;

										// Separator Icon
										if ( 'yes' === $show_category && 'yes' === $show_comment && remons_array_exists( $categories ) ): ?>
											<span class="separator-icon">
												<i class="fa fa-circle"></i>
											</span>
										<?php endif;

										// Comment count
										if( 'yes' === $show_comment ) : ?>
											<div class="post-comment">
												<span class="comment-count">
													Comments ( <?php echo get_comments_number( $blog_id ) ?> )
												</span>
											</div>
										<?php endif; ?>
									</div>

									<h2 class="post-title">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<?php echo wp_kses_post( $blog_title ); ?>
										</a>
									</h2>

									<?php if ( 'yes' === $show_short_desc ): ?> 
									  	<div class="short_desc">
										  	<p>
										  		<?php echo wp_kses_post( remons_custom_text( get_the_excerpt($blog_id), $order_text )); ?>
											</p>
										 </div>
									<?php endif;?>

									<?php if ( 'yes' === $show_read_more ): ?>
										<a class="read-more" href="<?php echo esc_url( $blog_link ); ?>">
											<span class="text-button">
												<?php echo esc_html( $text_readmore ); ?>
											</span>
											<span class="icon">
												<?php if( 'yes' === $show_icon ){
												\Elementor\Icons_Manager::render_icon( $icon_readmore, ['aria-hidden' => 'true'] ); } ?>
											</span>
										</a>
									<?php endif ?>
								</div>
							</div>
						<?php endif; ?>

						<!-- Blog-4 -->
						<?php if( $template_id === 'blog-4' ): ?>
							<div class="item">
								<!-- Media -->
								<div class="media">
									<div class="box-img">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
										</a>
										  <!-- Date -->
										<?php if ( 'yes' === $show_date ): ?>
											<div class="post-date">
												<span class="date-j">
													<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
												</span>
												<span class="date-MY">
													<?php echo esc_html( get_the_time( 'M' , $blog_id ) ); ?>
												</span>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<!-- Content -->
								<div class="content">
									<div class="post-meta">
										<?php 
										// Category
										if( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
											<div class="post-category">
												<span class="category">
													<?php echo esc_html( $categories[0]->name ); ?>
												</span>
											</div>
										<?php endif;

										// Separator Icon
										if ( 'yes' === $show_category && 'yes' === $show_comment && remons_array_exists( $categories ) ): ?>
											<span class="separator-icon">
												<i class="fa fa-circle"></i>
											</span>
										<?php endif;

										// Comment count
										if( 'yes' === $show_comment ) : ?>
											<div class="post-comment">
												<span class="comment-count">
													Comments ( <?php echo get_comments_number( $blog_id ) ?> )
												</span>
											</div>
										<?php endif; ?>
									</div>
									
									<h2 class="post-title">
										<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
											<?php echo wp_kses_post( $blog_title ); ?>
										</a>
									</h2>
								</div>
							</div>
						<?php endif; ?>

					<?php endforeach ?>
				<?php endif; ?>

				<?php

				// Get the HTML content just created
			    $posts_html = ob_get_clean();

			    ob_start();
			    $current_page = $paged;

			    // pagination
				echo remons_render_pagination($total_pages, $current_page, $settings);
			    // end pagination

			    $pagination_html = ob_get_clean();

			    wp_reset_postdata();

			    // Return JSON data successfully with fields
			    wp_send_json_success([
			        'posts_html'      => $posts_html,
			        'pagination_html' => $pagination_html,
			        'total_pages'     => $total_pages,
			        'current_page'    => $current_page,
			    ]);
			}
	}

	new Remons_Ajax();
}