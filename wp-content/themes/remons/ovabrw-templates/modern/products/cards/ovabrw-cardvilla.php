<?php if ( ! defined( 'ABSPATH' ) ) exit();

// Set card template
if ( !isset( $args ) ) $args = [];
$args['card_template'] = 'cardvilla';

// Get product
$product = wc_get_product( get_the_ID() );

// Get product rating
$rating = $product ? $product->get_average_rating() : '';

// Get product address
$address = get_post_meta( get_the_ID(), OVABRW_PREFIX.'address', true ); 

?>

<div class="remons-card-template remons-ovabrw-cardvilla">
	<div class="card-header">
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-slide-image.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-featured.php', $args ); ?>
		<div class="price-rating-wrap">
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-price.php', $args ); ?>
			<?php if ( $rating && '0' != $rating ): ?>
				<div class="review-average">
					<i aria-hidden="true" class="brwicon-star-2"></i>
					<?php echo esc_html( number_format( $rating, 1, '.', ',' ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="card-content">
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-specifications.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-features.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-title.php', $args ); ?>
		<?php if ( $address ): ?>
			<div class="address">
				<?php echo esc_html( $address ); ?>
			</div>
		<?php endif; ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-custom-taxonomy.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-attribute.php', $args ); ?>
	</div>
</div>