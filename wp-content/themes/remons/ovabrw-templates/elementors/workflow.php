<?php if ( ! defined( 'ABSPATH' ) ) exit();
$settings = get_query_var( 'workflow_settings' );
?>

<div class="workflow">
	<div class="timeline-line"></div>

	<?php if ( !empty( $settings[ 'timeline_items' ] ) && is_array( $settings[ 'timeline_items' ] ) ) : ?>
		<?php foreach ( $settings['timeline_items'] as $item ) : 
			$image_url          = $item['image']['url'] ?? '';
			$title              = $item['title'] ?? '';
			$description        = $item['description'] ?? '';
			$show_description   = $item['show_description'] ?? '';
			$show_timeline_step = $item['show_timeline_step'] ?? '';
			$timeline_step      = $item['timeline_step'] ?? '';
		?>
			<div class="item">
				<div class="timeline-step">
					<div class="timeline-bg"></div>
					<div class="timeline-border"></div>
					<?php if ( $timeline_step && $show_timeline_step === 'yes' ) : ?>
						<span><?php echo esc_html( $timeline_step ); ?></span>
					<?php endif; ?>
				</div>

				<?php if ( $title || ( $show_description === 'yes' && !empty( $description ) ) ) : ?>
					<div class="workflow-content">
						<?php if ( $title ) : ?>
							<h3 class="workflow-title"><?php echo esc_html( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $show_description === 'yes' && !empty( $description ) ) : ?>
							<p class="workflow-description"><?php echo wp_kses_post( $description ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
