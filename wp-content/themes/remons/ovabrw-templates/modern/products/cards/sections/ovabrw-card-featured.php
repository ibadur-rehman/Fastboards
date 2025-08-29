<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get card template
$card = ovabrw_get_meta_data( 'card_template', $args, ovabrw_get_card_template() );

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Get featured
$features_featured = $product->get_meta_value( 'features_featured' );

if ( $product && $product->is_featured() && 'yes' == ovabrw_get_option( 'glb_'.$card.'_featured' , 'yes' ) ): ?>
	<span class="ovabrw-featured-product">
		<?php esc_html_e( 'Featured', 'remons' ); ?>
	</span>
<?php endif;

if ( remons_array_exists( $features_featured ) && 'yes' == ovabrw_get_option( 'glb_'.$card.'_feature_featured' , 'yes' ) ):
	foreach ( $features_featured as $i => $val ):
		if ( 'yes' === $val ):
			$features_desc = $product->get_meta_value( 'features_desc' );

			// Description
			$desc = ovabrw_get_meta_data( $i, $features_desc );

			if ( !$desc ) continue;
		?>
			<span class="ovabrw-features-featured">
				<?php echo esc_html( $desc ); ?>
			</span>
		<?php break;
		endif;
	endforeach;
endif;