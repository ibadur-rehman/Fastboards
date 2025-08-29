<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get card template
$card = ovabrw_get_meta_data( 'card_template', $args, ovabrw_get_card_template() );

// View short description
if ( 'yes' != ovabrw_get_option( 'glb_'.$card.'_short_description' , 'yes' ) ) return;

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Product short description
$short_description = $product->get_short_description();

// Word limit
$short_limit = apply_filters( OVABRW_PREFIX.'product_card_short_desc_limit', 22 );

// Strip tags
$short_description = wp_strip_all_tags( $short_description );

if ( $short_description ): ?>
	<p class="ovabrw-short-description">
		<?php echo wp_trim_words( $short_description, $short_limit, '...' ); ?>
	</p>
<?php endif;