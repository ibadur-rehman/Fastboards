<?php if ( !defined( 'ABSPATH' ) ) exit();

$main_image_url = remons_get_meta_data( 'image', $args )[ 'url' ] ?? '';
$title          = remons_get_meta_data( 'title', $args );
$description    = remons_get_meta_data( 'description', $args );
$show_button    = remons_get_meta_data( 'show_button_read_more', $args );
$text_button    = remons_get_meta_data( 'text_button', $args );
$icon_service    = remons_get_meta_data( 'icon', $args )[ 'value' ] ?? '';
// Icon button
$icon_button 	= remons_get_meta_data( 'icon_button', $args )[ 'value' ] ?? '';
$link_data      = remons_get_meta_data( 'link', $args );
$link_url       = $link_data['url'] ?? '';
$link_target    = !empty( $link_data['is_external'] ) ? '_blank' : '_self';

?>

<div class="remons-service template1">

	<?php if ( $icon_service || $title ): ?>
		<div class="item-title">
			<?php if ( $icon_service ): ?>
				<i class="icon <?php echo esc_attr( $icon_service ); ?>"></i>
			<?php endif; ?>

			<?php if ( $title ): ?>
				<h3 class="title"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $main_image_url ): ?>
		<img class="image" src="<?php echo esc_url( $main_image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
	<?php endif; ?>

	<?php if ( $description ): ?>
		<p class="description"><?php echo wp_kses_post( $description ); ?></p>
	<?php endif; ?>

	<?php if ( $show_button ): ?>
		<?php if ( isset( $button_action_type ) && $button_action_type === 'popup' ): ?>
			<a class="button open-popup-btn" data-product-id="<?php echo esc_attr( $product_id ); ?>">
				<span class="text-button"><?php echo esc_html( $text_button ); ?></span>
				<?php if ( $icon_button ): ?>
					<i class="icon <?php echo esc_attr( $icon_button ); ?>"></i>
				<?php endif; ?>
				
				<span class="remons-loader">
					<i class="brwicon2-spinner-of-dots" aria-hidden="true"></i>
				</span>
			</a>
		<?php else: ?>
			<a class="button" href="<?php echo $product_id ? get_permalink( $product_id ) : esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<span class="text-button"><?php echo esc_html( $text_button ); ?></span>
				<?php if ( $icon_button ): ?>
					<i class="icon <?php echo esc_attr( $icon_button ); ?>"></i>
				<?php endif; ?>
			</a>
		<?php endif; ?>
	<?php endif; ?>
</div>
