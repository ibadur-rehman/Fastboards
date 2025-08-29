<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Vertical_Slider
 */
class Remons_Elementor_Vertical_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_vertical_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Vertical Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slider-vertical';
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
		wp_enqueue_style( 'animate', REMONS_URI.'/assets/libs/animate.min.css');
		return [ 'remons-elementor-vertical-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-vertical-slider', REMONS_URI.'/assets/scss/elementor/vertical-slider/vertical-slider.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {
		
		// Content
		$this->start_controls_section(
				'section_content',
				[
					'label' => esc_html__( 'Content', 'remons' ),
				]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'image',
					[
						'label'   => esc_html__( 'Image', 'remons' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' 	=> esc_html__( 'Title', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'James N. Johnson', 'remons' ),
					]
				);

				$repeater->add_control(
					'subtitle',
					[
						'label' 		=> esc_html__( 'Subtitle', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::TEXT,
						'default' 		=> esc_html__( 'CEO & Founder', 'remons' ),
						'label_block' 	=> true,
					]
				);

				$repeater->add_control(
					'description',
					[
						'label'   	=> esc_html__( 'Description ', 'remons' ),
						'type'    	=> \Elementor\Controls_Manager::TEXTAREA,
						'rows' 		=> 10,
						'default' 	=> esc_html__( '"In the midst of winter, I found there was, within me, an invincible summer. And that makes me happy. For it says that no matter how hard the world pushes against me, within me, there’s something stronger something better, pushing right back."', 'remons' ),
					]
				);

				$this->add_control(
					'tab_item',
					[
						'label' 	=> esc_html__( 'Items description', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::REPEATER,
						'fields' 	=> $repeater->get_controls(),
						'default' 	=> [
							[
								'title' => esc_html__( 'James N. Johnson', 'remons' ),
							],
							[
								'title' => esc_html__( 'Mike Hardson', 'remons' ),
							],
							[
								'title' => esc_html__( 'Alisa Brown', 'remons' ),
							],
						],
						'title_field' => '{{{ title }}}',
					]
				);

		$this->end_controls_section();

		/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'remons' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'remons' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'remons' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'remons' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'remons' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'remons' ),
					'type'      => \Elementor\Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 1000,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/
		/* Items */
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__( 'Items', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'items_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 600,
							'max' 	=> 1290,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 50,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'items_border',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-stage-outer',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'items_box_shadow',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-stage-outer',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' 		=> 'items_background',
					'types' 	=> [ 'classic', 'gradient', 'video' ],
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .card',
				]
			);

		$this->end_controls_section();

		/* Description */
		$this->start_controls_section(
				'desc_style_section',
				[
					'label' => esc_html__( 'Description', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'desc_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .description',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .description' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Title */
		$this->start_controls_section(
				'title_style_section',
				[
					'label' => esc_html__( 'Title', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .title' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Subtitle */
		$this->start_controls_section(
				'subtitle_style_section',
				[
					'label' => esc_html__( 'Subtitle', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'subtitle_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'subtitle_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'subtitle_border',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .subtitle',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'subtitle_typography',
					'selector' 	=> '{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .subtitle',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-vertical-slider .vertical-slider .card .wrapper .subtitle' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
		
		/* Dots */
		$this->start_controls_section(
				'dots_section_styles',
				[
					'label' => esc_html__( 'Dots', 'remons' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
		
			$this->start_controls_tabs(
					'dots_style_tabs'
				);

				$this->start_controls_tab(
						'dots_style_normal_tab',
						[
							'label' => esc_html__( 'Normal', 'remons' ),
						]
					);

				$this->add_control(
					'dot_color',
					[
						'label'     => esc_html__( 'Color', 'remons' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-dots .owl-dot span' => 'background : {{VALUE}};',
							'{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-dots .owl-dot' => 'border-color : {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
						'dots_style_active_tab',
						[
							'label' => esc_html__( 'Active', 'remons' ),
						]
					);

				$this->add_control(
					'dot_active_color',
					[
						'label'     => esc_html__( 'Color', 'remons' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-dots .owl-dot.active span' => 'background : {{VALUE}};',
							'{{WRAPPER}} .ova-vertical-slider .vertical-slider .owl-dots .owl-dot.active' => 'border-color : {{VALUE}};',
						],
					]
				);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get tab item
		$tab_item = remons_get_meta_data( 'tab_item', $settings );

		// Carousel options
		$data_options = [
			'items' 				=> remons_get_meta_data( 'item_number', $settings ),
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_items', $settings ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'dots' 					=> 'yes' === remons_get_meta_data( 'dot_control', $settings ) ? true : false,
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartspeed', $settings ),
			'rtl' 					=> is_rtl() ? true: false
		];

		?>
		<section class="ova-vertical-slider">
			<div class="vertical-slider owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode( $data_options ) ); ?>">
				<?php if ( remons_array_exists( $tab_item ) ):
					foreach ( $tab_item as $key => $item ):
						// Get title
						$title = remons_get_meta_data( 'title', $item );

						// Get subtitle
						$subtitle = remons_get_meta_data( 'subtitle', $item );

						// Get description
						$description = remons_get_meta_data( 'description', $item );

						// Get image url
						$image_url = isset( $item['image']['url'] ) ? $item['image']['url'] : '';

						// Get image alt
						$image_alt = $title;

						// Get image id
						$image_id = isset( $item['image']['id'] ) ? $item['image']['id'] : '';
						if ( $image_id ) {
							$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
							if ( !$image_alt ) $image_alt = get_the_title( $image_id );
						}
				?>
					<div class="item">
						<div class="card">
							<div class="wrapper">
								<div class="content">
									<?php if ( $description ): ?>
										<p class="description">
											<?php echo wp_kses_post( $description ); ?>
										</p>
									<?php endif; ?>
									<div class="info-quote">
										<div class="info">
											<?php if ( $image_url ): ?>
												<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
											<?php endif; ?>
											<div class="right">
												<?php if ( $title ): ?>
													<h3 class="title">
														<?php echo esc_html( $title ); ?>
													</h3>
												<?php endif;

												if ( $subtitle ): ?>
													<span class="subtitle">
														<?php echo esc_html( $subtitle ); ?>
													</span>
												<?php endif; ?>
											</div>
										</div>
										<div class="icon icon-quote">
											<i aria-hidden="true" class="ovaicon ovaicon-quote"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach;
				endif; ?>
			</div>
		</section>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Vertical_Slider() );