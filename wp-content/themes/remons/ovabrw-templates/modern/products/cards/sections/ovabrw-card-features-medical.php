<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get card template
$card = ovabrw_get_meta_data( 'card_template', $args, ovabrw_get_card_template() );

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

$features_desc     = $product->get_meta_value( 'features_desc' );
$features_label    = $product->get_meta_value( 'features_label' );
$features_icons    = $product->get_meta_value( 'features_icons' );
$features_special  = $product->get_meta_value( 'features_special' );

if ( !remons_array_exists( $features_desc ) ) return;

foreach ( $features_desc as $i => $desc ) {
	$label   = ovabrw_get_meta_data( $i, $features_label );
	$icon    = ovabrw_get_meta_data( $i, $features_icons );
	$special = ovabrw_get_meta_data( $i, $features_special );

	if ( $special === 'yes' && !empty( $icon ) && $desc && $label ) {
		?>
		<div class="custom-icon-box">
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
			<div class="custom-icon-text">
				<span><?php echo esc_html( $label ); ?></span>
				<strong>/<?php echo esc_html( $desc ); ?></strong>
			</div>
		</div>
		<?php
		break;
	}
}
?>
