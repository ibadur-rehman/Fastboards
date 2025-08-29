<?php if ( !defined( 'ABSPATH' ) ) exit();

// Show feature
if ( 'yes' != ovabrw_get_setting( 'template_show_feature', 'yes' ) ) return;

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Get features description
$features_desc = $product->get_meta_value( 'features_desc' );
if ( remons_array_exists( $features_desc ) ):
	// Get features label
	$features_label = $product->get_meta_value( 'features_label' );

	// Get features icons
	$features_icons = $product->get_meta_value( 'features_icons' );

	// Get features special
	$features_special = $product->get_meta_value( 'features_special' );
	if ( !in_array( 'yes', $features_special ) ) return;
?>
	<ul class="ovabrw-product-features">
		<?php foreach ( $features_desc as $i => $desc ):
			// Label
			$label = ovabrw_get_meta_data( $i, $features_label );

			// Icon
			$icon = ovabrw_get_meta_data( $i, $features_icons );
		?>
			<li class="item-feature">
				<?php if ( $icon ): // View icon ?>
					<div class="icon">
						<i aria-hidden="true" class="<?php echo esc_attr( $icon ); ?>"></i>
					</div>
				<?php endif; ?>
				<div class="label-and-desc">
					<?php if ( $label ): // View label ?>
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
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif;