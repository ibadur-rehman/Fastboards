<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Product ID
$product_id = $product->get_id();

// Get features
$features_featured = $product->get_meta_value( 'features_featured' );

// Gallery
$gallery_data = [];

// Get img
$img_url 	= $img_alt = '';
$img_id 	= $product->get_image_id();
if ( $img_id ) {
	$img_url = wp_get_attachment_url( $img_id );
	$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );

	if ( !$img_alt ) $img_alt = get_the_title( $img_id );
}

// Gallery ids
$gallery_ids = $product->get_gallery_image_ids();

// Video url
$video_url = get_post_meta( $product_id, 'ova_met_embed_media', true );

// Carousel option
$carousel_options = apply_filters( OVABRW_PREFIX.'glb_carousel_options', [
	'items' 				=> 3,
	'items_tablet' 			=> 2,
	'items_mobile' 			=> 2,
	'slideBy' 				=> 1,
	'margin' 				=> 25,
	'autoWidth'				=> false,
	'autoplayHoverPause' 	=> true,
	'loop' 					=> true,
	'autoplay' 				=> true,
	'autoplayTimeout' 		=> 3000,
	'smartSpeed' 			=> 500,
	'nav' 					=> false,
	'rtl' 					=> is_rtl() ? true: false
]);

if ( $img_url ): 
	array_push( $gallery_data , [
		'src' 		=> $img_url,
		'caption' 	=> $img_alt,
		'thumb' 	=> $img_url
	]);
?>
	<div class="ovabrw-product-images">
		<div class="featured-img">
			<?php if ( $video_url ) : ?>
	            <div class="ovabrw-product-video-link" data-src="<?php echo esc_attr( $video_url ); ?>">
	                <i aria-hidden="true" class="fas fa-play"></i>
	            </div>
	        <?php endif; ?>
			<a class="gallery-fancybox" data-index='0' href="javascript:;">
				<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
			</a>
		</div>
		<?php if ( remons_array_exists( $gallery_ids ) ): ?>
		<div class="gallery">
			<div class="product-gallery owl-carousel owl-theme" 
				data-options="<?php echo esc_attr( json_encode( $carousel_options ) ); ?>">
				<?php foreach ( $gallery_ids as $k => $gallery_id ): 
					$gallery_url = wp_get_attachment_url( $gallery_id );
					$gallery_alt = get_post_meta( $gallery_id, '_wp_attachment_image_alt', true );

					if ( !$gallery_alt ) $gallery_alt = get_the_title( $gallery_id );

					// Add gallery
					array_push( $gallery_data, [
						'src' 		=> $gallery_url,
						'caption' 	=> $gallery_alt,
						'thumb' 	=> $gallery_url
					]);
				?>
					<div class="gallery-item">
						<a class="gallery-fancybox" data-index="<?php echo esc_attr( $k+1 ); ?>" href="javascript:;">
		  					<img src="<?php echo esc_url( $gallery_url ); ?>" alt="<?php echo esc_attr( $gallery_alt ); ?>">
		  				</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="data-gallery" data-gallery="<?php echo esc_attr( json_encode( $gallery_data ) ); ?>"></div>
		<?php ovabrw_modern_product_is_featured(); ?>
	</div>
	<?php if ( $video_url ): // Video ?>
	    <div class="product-video-modal-container">
	        <div class="modal">
	            <div class="modal-close">
	                <i class="ovaicon-cancel"></i>
	            </div>
	            <iframe class="modal-video" allow="autoplay" allowFullScreen="allowFullScreen" frameBorder="0"></iframe>
	        </div>
	    </div>
	<?php endif;
endif;