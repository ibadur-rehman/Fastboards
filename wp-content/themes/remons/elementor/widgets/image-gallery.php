<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Ova_Image_Gallery
 */
class Remons_Elementor_Ova_Image_Gallery extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_ova_image_gallery';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Image Gallery', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		return [ 'remons-elementor-ova-image-gallery' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-image-gallery', REMONS_URI.'/assets/scss/elementor/images/image-gallery.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
			]
		);
			
			$this->add_control(
				'column',
				[
					'label' 	=> esc_html__( 'Column', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'three_column',
					'options' 	=> [
						'two_column' 	=> esc_html__( '2 Columns', 'remons' ),
						'three_column' 	=> esc_html__( '3 Columns', 'remons' ),
						'four_column' 	=> esc_html__( '4 Columns', 'remons' ),
					],
				]
			);

			$this->add_control(
				'ova_image_gallery',
				[
					'label' 	=> esc_html__( 'Add Images', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::GALLERY,
					'default' 	=> [],
				]
			);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'fab fa-instagram',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'medium', // Usage: `{name}_size` and `{name}_custom_dimension`
					'exclude' 	=> [ 'custom' ],
					'default' 	=> 'medium',
					'separator' => 'none',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'ova_image_gallery_style',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Gallery', 'remons' ),
			]
		);

			$this->add_responsive_control(
				'gap',
				[
					'label' 		=> esc_html__( 'Gap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_size',
				[
					'label' 		=> esc_html__( 'Image Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 60,
							'max' 	=> 300,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft .item-fancybox-ft img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'overlay_opacity',
				[
					'label' 	=> esc_html__( 'Overlay Hover Opacity', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 	=> 0.84,
					],
					'range' 	=> [
						'px' => [
							'max' 	=> 1,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft .item-fancybox-ft:hover .overlay' => 'opacity: {{SIZE}};',
					],
				]
			);

	        $this->add_control(
				'overlay_color',
				[
					'label' 	=> esc_html__( 'Overlay Hover Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery-ft .item-fancybox-ft .overlay' => 'background-color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_styles',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 200,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_bgcolor',
				[
					'label'				=> esc_html__( 'Background Color', 'remons' ),
					'type'				=> \Elementor\Controls_Manager::COLOR,
					'selectors'			=> [
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_padding',
				[
					'label'				=> esc_html__( 'Padding', 'remons' ),
					'type'				=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'		=> [ 'px', '%', 'em' ],
					'selectors'			=> [
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_border_radius',
				[
					'label'			=> esc_html__( 'Border Radius', 'remons' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery .ova-image-gallery-ft .item-fancybox-ft .overlay .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get column
		$column = remons_get_meta_data( 'column', $settings );

		// Get list image
		$list_image = remons_get_meta_data( 'ova_image_gallery', $settings );

		// Get icon
		$icon = remons_get_meta_data( 'icon', $settings );

		// Thumbnail size
		$thumbnail_size = remons_get_meta_data( 'medium_size', $settings );

		?>

		<div class="ova-image-gallery">
            <?php if ( remons_array_exists( $list_image ) ): ?>
				<div class="ova-image-gallery-ft <?php echo esc_attr( $column ); ?>">
					<?php foreach ( $list_image as $item ):
						// Get image id
						$image_id = remons_get_meta_data( 'id', $item );

						// Get URL 
						$url = remons_get_meta_data( 'url', $item );

						// Get thumbnail URL
	                    $image_src 		= wp_get_attachment_image_src( $image_id, $thumbnail_size );
	                    $thumbnail_url 	= remons_get_meta_data( 0, $image_src );

	                    // Get alt
	                    $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : esc_html__( 'Gallery Image','remons' );  
	                    $caption = wp_get_attachment_caption( $image_id );
	                    if ( $caption == '') {
	                    	$caption = $alt;
	                    }
					?>
						<a href="#" data-src="<?php echo esc_url( $url ); ?>" class="item-fancybox-ft" data-fancybox="image-gallery-ft" data-caption="<?php echo esc_attr( $caption ); ?>">
							<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
							<div class="overlay">
								<?php if ( $icon ): ?>
									<div class="icon">
										<?php 
									        \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
									    ?>
									</div>	
								<?php endif; ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div> 
			<?php endif; ?>
		</div>	
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Ova_Image_Gallery() );