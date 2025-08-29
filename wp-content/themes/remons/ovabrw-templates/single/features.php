<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Features description
$features_desc = $product->get_meta_value( 'features_desc' );
if ( remons_array_exists( $features_desc ) ):
	$features_icons = $product->get_meta_value( 'features_icons' );
	$features_label = $product->get_meta_value( 'features_label' );
?>
	<ul class="ovabrw_woo_features">
		<?php foreach ( $features_desc as $i => $desc ):
			$icon 	= ovabrw_get_meta_data( $i, $features_icons );
			$label 	= ovabrw_get_meta_data( $i, $features_label );
		?>
			<li>
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