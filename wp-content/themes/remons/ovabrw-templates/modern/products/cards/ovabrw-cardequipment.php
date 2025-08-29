<?php if ( !defined( 'ABSPATH' ) ) exit();

// Set card template
if ( !isset( $args ) ) $args = [];
$args['card_template'] = 'cardequipment';

// Wishlist
$wishlist = do_shortcode('[yith_wcwl_add_to_wishlist]');

?>

<div class="remons-card-template remons-ovabrw-cardequipment">
	<div class="card-header">
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-slide-image.php', $args); ?>
		<?php if ( '[yith_wcwl_add_to_wishlist]' != $wishlist ): ?>
			<div class="ova-product-wishlist">
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			</div>
	    <?php endif; ?>
	    <?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-button.php', $args ); ?>
	</div>
	
	<div class="card-content">
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-review.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-title.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-price.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-specifications-full.php', $args ); ?>
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-features-full.php', $args ); ?>
	</div>
</div>