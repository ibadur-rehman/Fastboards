<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Testimonial_3
 */
class Remons_Elementor_Testimonial_3 extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_testimonial_3';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Testimonial 3', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-testimonial';
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
		return [ 'remons-elementor-testimonial-3' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-testimonial-3', REMONS_URI.'/assets/scss/elementor/testimonials/testimonial-3.css' );
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
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
						'template3' => esc_html__( 'Template 3', 'remons' ),
					]
				]
			);

			$repeater = new \Elementor\Repeater();
                
                $repeater->add_control(
					'testimonial',
					[
						'label'   => esc_html__( 'Testimonial', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'I was very impresed by the remons service lorem ipsum is simply free text used by copy typing refreshing. Neque porro est qui dolorem ipsum quia.', 'remons' ),
					]
				);

				$repeater->add_control(
					'image_author',
					[
						'label'   => esc_html__( 'Author Image', 'remons' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'name_author',
					[
						'label'   => esc_html__( 'Author Name', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__('Jessica Brown', 'remons'),
					]
				);

				$repeater->add_control(
					'job',
					[
						'label'   => esc_html__( 'Job', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Customer', 'remons'),
					]
				);


			$this->add_control(
				'tab_item',
				[
					'label'       => esc_html__( 'Items Testimonial', 'remons' ),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default' => [
						[
							'name_author' => esc_html__( 'Jessica Brown', 'remons' ),
						],
						[
							'name_author' => esc_html__( 'Kenvin Martin', 'remons' ),
						],
						[
							'name_author' => esc_html__( 'Mike hardson', 'remons' ),
						],
					],
					'title_field' => '{{{ name_author }}}',
				]
			);

		$this->add_control(
			'show_icon_quote',
			[
				'label'   => esc_html__( 'Show Icon Quote', 'remons' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'remons' ),
					'no'  => esc_html__( 'No', 'remons' ),
				],
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'   => esc_html__( 'Show Rating', 'remons' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'remons' ),
					'no'  => esc_html__( 'No', 'remons' ),
				],
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
					'default' => 500,
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

		/*************  SECTION NAME JOB. *******************/
		$this->start_controls_section(
			'section_general',
			[
				'label' => esc_html__( 'General', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);  

            $this->add_responsive_control(
				'content_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 380,
							'max' 	=> 1000,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 50,
							'max' 	=> 100,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info' => 'max-width: {{SIZE}}{{UNIT}};',
					],	
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' 		=> 'background_item',
					'types' 	=> [ 'classic', 'gradient' ],
					'selector' 	=> '{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info',
				]
			);

		    $this->add_responsive_control(
				'background_item_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'background_item_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		/*************  SECTION  avatar. *******************/
		$this->start_controls_section(
			'section_avatar',
			[
				'label' => esc_html__( 'Avatar', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'avatar_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 30,
							'max' 	=> 120,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .top_info .client img' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
					],	
				]
			);

			$this->add_responsive_control(
				'avatar_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .top_info .client' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		/*************  SECTION NAME AUTHOR. *******************/
		$this->start_controls_section(
			'section_author_name',
			[
				'label' => esc_html__( 'Author Name', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'author_name_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .name',
				]
			);

			$this->add_control(
				'author_name_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .name' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'author_name_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'author_name_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		###############  end section author  ###############

		/*************  SECTION NAME JOB. *******************/
		$this->start_controls_section(
			'section_job',
			[
				'label' => esc_html__( 'Job', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .job' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'job_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'job_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .info .name-job .job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		###############  end section job  ###############

		/*************  SECTION content testimonial  *******************/
		$this->start_controls_section(
			'section_content_testimonial',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'content_testimonial_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info p.evaluate',
				]
			);

			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info p.evaluate' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info p.evaluate' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info p.evaluate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		###############  stars style section  ###############
		$this->start_controls_section(
			'section_stars_style',
			[
				'label' 	=> esc_html__( 'Rating Stars', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating' => 'yes'
				]
			]
		);

			$this->add_responsive_control(
				'icon_space',
				[
					'label' => esc_html__( 'Spacing', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 20,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .rating-icon i' => 'margin-right: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'stars_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .client_info .rating-icon i' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		// STYLE DOT CONTROL
		$this->start_controls_section(
			'section_dot_control',
			[
				'label' 	=> esc_html__( 'Dot Control', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'dot_control' => 'yes',
				],
			]
		);

			$this->add_control(
				'dot_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .owl-dots .owl-dot span' => 'background-color : {{VALUE}};',
					],
					
				]
			);

			$this->add_control(
				'dot_color_active',
				[
					'label'     => esc_html__( 'Color Active', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .owl-dots .owl-dot.active span' => 'background-color : {{VALUE}};',
					],
					
				]
			);

			$this->add_responsive_control(
				'dot_control_size',
				[
					'label' => esc_html__( 'Size', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'dot_control_active_size',
				[
					'label' 		=> esc_html__( 'Active Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					
					'selectors' 	=> [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
					],
					
				]
			);

			$this->add_responsive_control(
				'dot_control_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-3 .slide-testimonials-3 .owl-dots .owl-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Get tab items
		$tab_item = remons_get_meta_data( 'tab_item', $settings );
		
		// Show icon quote
		$show_icon_quote = remons_get_meta_data( 'show_icon_quote', $settings );

		// Show rating
		$show_rating = remons_get_meta_data( 'show_rating', $settings );

		// Carousel options
		$data_options = [
			'items' 				=> remons_get_meta_data( 'item_number', $settings ),
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_items', $settings ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartspeed', $settings ),
			'dots' 					=> 'yes' === remons_get_meta_data( 'dot_control', $settings ) ? true : false,
			'rtl' 					=> is_rtl() ? true: false
		];

	?>
		<section class="ova-testimonial-3 ova-testimonial-3-<?php echo esc_attr( $template ); ?>">
			<div class="slide-testimonials-3 owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
				<?php if ( remons_array_exists( $tab_item ) ):
					foreach ( $tab_item as $item ):
						// Get image author
						$image_author = remons_get_meta_data( 'image_author', $item );

						// Get url
						$url = remons_get_meta_data( 'url', $image_author );

						// Get alt
						$alt = remons_get_meta_data( 'name_author', $item, esc_html__( 'testimonial', 'remons' ) );
				?>
					<div class="item">
						<div class="client_info">
							<div class="top_info">
								<?php if ( 'template2' != $template ): ?>
									<div class="client">
										<?php if ( $image_author ): ?>
											<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
										<?php endif;

										if ( 'yes' === $show_icon_quote ): ?>
											<div class="icon">
												<i aria-hidden="true" class="flaticon flaticon-quote"></i>
											</div>
										<?php endif; ?>
									</div>
								<?php endif;

								if ( 'template2' === $template ): ?>
									<!-- Template2 -->
									<div class="wrap-author">
										<div class="client">
											<?php if ( $image_author ): ?>
												<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" >
											<?php endif;

											if ( 'yes' === $show_icon_quote ): ?>
												<div class="icon">
													<i aria-hidden="true" class="flaticon flaticon-quote"></i>
												</div>
											<?php endif; ?>
										</div>
										<div class="info">
											<div class="name-job">
												<?php if ( '' != remons_get_meta_data( 'name_author', $item ) ): ?>
													<h4 class="name second_font">
														<?php echo esc_html( $item['name_author'] ); ?>
													</h4>
												<?php endif;

												if ( '' != remons_get_meta_data( 'job', $item ) ): ?>
													<p class="job">
														<?php echo esc_html( $item['job'] ); ?>
													</p>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<?php if ( 'yes' === $show_rating ): ?>
										<div class="rating-icon">
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
										</div>
									<?php endif; ?>
								<!-- Close Template2 -->
								<?php endif; ?>
							</div>
							<?php if ( 'template3' == $template && 'yes' === $show_rating ): ?>
								<div class="rating-icon">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
								</div>
							<?php endif; ?>

							<?php if ( '' != remons_get_meta_data( 'testimonial', $item ) ): ?>
								<p class="evaluate">
									<?php echo esc_html( $item['testimonial'] ); ?>
								</p>
							<?php endif; ?>

							<?php if ( 'template2' != $template ): ?>
								<?php if ( 'yes' == $show_rating && 'template3' != $template ): ?>
									<div class="rating-icon">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
									</div>
								<?php endif; ?>
								<div class="info">
									<div class="name-job">
										<?php if ( '' != remons_get_meta_data( 'name_author', $item ) ): ?>
											<h4 class="name second_font">
												<?php echo esc_html( $item['name_author'] ); ?>
											</h4>
										<?php endif;

										if ( '' != remons_get_meta_data( 'job', $item ) ): ?>
											<p class="job">
												<?php echo esc_html( $item['job'] ); ?>
											</p>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
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
$widgets_manager->register( new Remons_Elementor_Testimonial_3() );