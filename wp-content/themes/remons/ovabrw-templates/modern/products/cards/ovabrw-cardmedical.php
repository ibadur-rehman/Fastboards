<?php if ( ! defined('ABSPATH') ) exit();

// Set card template
if ( !isset( $args ) ) $args = [];
$args['card_template'] = 'cardmedical';

// Get product
$product = wc_get_product( get_the_ID() );

// Get product rating
$rating = $product ? $product->get_average_rating() : '';

// Get product address
$address = get_post_meta( get_the_ID(), OVABRW_PREFIX.'address', true ); 

// Get category
$terms = get_the_terms( get_the_ID(), 'product_cat' );
$first_category = ( is_array( $terms ) && count( $terms ) > 0 ) ? $terms[0]->name : '';
?>

 <div class="ovabrw-card-template ovabrw-card-medical">
	<div class="ovabrw-card-content">
		<div class="ovabrw-card-info">
			<div class="ovabrw-card-content-head">
				<?php if ( $first_category ): ?>
					<div class="ovabrw-featured-product">
						<?php echo esc_html( $first_category ); ?>
					</div>
				<?php endif; ?>
				 
				<?php if ( isset( $rating ) && floatval( $rating ) > 0 ): ?>
				    <div class="ovabrw-rating-stars">
				        <?php
				            $full_stars = floor( $rating );
				            $half_star = ( $rating - $full_stars ) >= 0.5;
				            $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

				            // Full stars
				            for ( $i = 0; $i < $full_stars; $i++ ) {
				                echo '<i class="fas fa-star"></i>';
				            }

				            // Half star
				            if ( $half_star ) {
				                echo '<i class="fas fa-star-half-alt"></i>';
				            }

				            // Empty stars
				            for ( $i = 0; $i < $empty_stars; $i++ ) {
				                echo '<i class="far fa-star"></i>';
				            }
				        ?>
				        <span class="rating-number">(<?php echo number_format( $rating, 1 ); ?>)</span>
				    </div>
				<?php endif; ?>
			</div>
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-title.php', $args ); ?>
			<?php if ( $address ): ?>
				<div class="address">
					<i class="ovaicon ovaicon-pin"></i>
					<?php echo esc_html( $address ); ?>
				</div>
			<?php endif; ?>
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-custom-taxonomy.php', $args ); ?>
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-attribute.php', $args ); ?>
		</div>

		<div class="divider"></div>
		
		<div class="ovabrw-card-btn">
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-features-medical.php', $args ); ?>
			<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-button.php', $args ); ?>
		</div>
	</div>

	<div class="ovabrw-card-header">
		<?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-slide-image.php', $args ); ?>
	</div>
</div>