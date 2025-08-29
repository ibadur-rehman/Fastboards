<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get card template
$card = ovabrw_get_meta_data( 'card_template', $args, ovabrw_get_card_template() );

// Show features
if ( 'yes' != ovabrw_get_option( 'glb_'.$card.'_features' , 'yes' ) ) return;

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Get features description
$features_desc = $product->get_meta_value( 'features_desc' );
if ( remons_array_exists( $features_desc ) ) :
	// Get label
	$features_label = $product->get_meta_value( 'features_label' );

	// Get icons
	$features_icons = $product->get_meta_value( 'features_icons' );

	// Get special
	$features_special = $product->get_meta_value( 'features_special' );
	if ( !in_array( 'yes', $features_special ) ) return;
?>
	<ul class="ovabrw-features">
		<?php foreach ( $features_desc as $i => $desc ):
			// Label
			$label = ovabrw_get_meta_data( $i, $features_label );

			// Icon class
			$icon = ovabrw_get_meta_data( $i, $features_icons );

			// Special
			$special = ovabrw_get_meta_data( $i, $features_special );
			if ( !$special || 'yes' != $special ) continue;
		?>
			<li class="item-feature">
				<?php if ( $icon ): // View icon ?>
					<i aria-hidden="true" class="<?php echo esc_attr( $icon ); ?>"></i>
				<?php endif;

				// View label
				if ( $label ): ?>
					<label>
						<?php echo esc_html( $label ); ?>
					</label>
				<?php endif;

				// View description
				if ( $desc ): ?>
					<span>
						<?php echo esc_html( $desc ); ?>
					</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif;