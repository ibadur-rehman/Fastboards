<?php if ( ! defined( 'ABSPATH' ) ) exit();
	$settings = get_query_var( 'workflow_settings' );
?>

<div class="workflow-image template1 columns-<?php echo esc_attr( $settings[ 'columns_per_row' ] ); ?>">
	<?php foreach ( $settings[ 'timeline_items' ] as $item ) :
		$image_url = $item[ 'image' ][ 'url' ] ?? '';
		$title = $item[ 'title' ] ?? '';
		$description = $item[ 'description' ] ?? '';
		$show_description = $item[ 'show_description' ] ?? '';
		$show_timeline_step = $item[ 'show_timeline_step' ] ?? '';
		$timeline_step = $item[ 'timeline_step' ] ?? '';
	?>
		<div class="workflow-item">
			<div class="workflow-image-wrapper">
				<?php if ( $image_url ) : ?>
					<img class="workflow-image" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
				<?php endif; ?>

				<?php if ( $timeline_step && $show_timeline_step === 'yes' ) : ?>
					<div class="timeline-step">
						<span><?php echo esc_html( $timeline_step ); ?></span>
					    <div class="timeline-step-border"></div>
						<div class="timeline-step-bg"></div>
					</div>
				<?php endif; ?>
			</div>

			<div class="workflow-content">
				<?php if ( $title ) : ?>
					<h3 class="workflow-title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<?php if ( $show_description === 'yes' && $description ) : ?>
					<p class="workflow-description"><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
