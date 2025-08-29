<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Testimonial_2
 */
class Remons_Elementor_Testimonial_2 extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_testimonial_2';
	}
	
	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Testimonial 2', 'remons' );
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
		// Carousel
		wp_enqueue_style( 'slick-carousel', get_template_directory_uri().'/assets/libs/slick/slick.css' );
		wp_enqueue_style( 'slick-carousel-theme', get_template_directory_uri().'/assets/libs/slick/slick-theme.css' );
		wp_enqueue_script( 'slick-carousel', get_template_directory_uri().'/assets/libs/slick/slick.min.js', array('jquery'), false, true );

		return ['remons-elementor-testimonial-2'];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-testimonial-2', REMONS_URI.'/assets/scss/elementor/testimonials/testimonial-2.css' );
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

			// Add Class control
			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
					]
				]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'name_author',
					[
						'label'   => esc_html__( 'Author Name', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Christine Eve', 'remons' ),
					]
				);

				$repeater->add_control(
					'job',
					[
						'label'   => esc_html__( 'Job', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Our Customer', 'remons' ),

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
					'testimonial',
					[
						'label'   => esc_html__( 'Testimonial', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch.', 'remons' ),
					]
				);

				$this->add_control(
					'tab_item',
					[
						'label' 	=> esc_html__( 'Items Testimonial', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::REPEATER,
						'fields' 	=> $repeater->get_controls(),
						'default' 	=> [
							[
								'name_author' => esc_html__( 'Shirley Smith', 'remons' ),
							],
							[
								'name_author' => esc_html__( 'Aleesha Smith', 'remons' ),
							],
							[
								'name_author' => esc_html__( 'Mike Hardson', 'remons' ),
							],
						],
						'title_field' => '{{{ name_author }}}',
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
					'default' => 300,
				]
			);

		$this->end_controls_section();
		/****************************  END SECTION ADDITIONAL *********************/

		/*************  SECTION NAME JOB AUTHOR. *******************/
		$this->start_controls_section(
			'section_author_name_job',
			[
				'label' => esc_html__( 'Author Name - Job', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_responsive_control(
				'name_job_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		    $this->add_control(
				'author_name_heading',
				[
					'label'     => esc_html__( 'Author Name', 'remons' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'author_name_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .name',
				]
			);

			$this->add_control(
				'author_name_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .name' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'job_heading',
				[
					'label'     => esc_html__( 'Job', 'remons' ),
					'type'      => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'
						{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info .info .name-job .job' => 'color : {{VALUE}};',
					],
				]
			);


		$this->end_controls_section();
		###############  end section name job author  ###############


		/*************  SECTION content testimonial  *******************/
		$this->start_controls_section(
			'section_content_testimonial',
			[
				'label' => esc_html__( 'Content Testimonial', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'content_testimonial_typography',
					'selector' => '{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate',
				]
			);

			$this->add_control(
				'content_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .client-info p.ova-evaluate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();
		###############  end section content testimonial  ###############

		/* Begin Nav Arrow Style */
		$this->start_controls_section(
            'nav_style',
            [
                'label' => esc_html__( 'Arrows Control', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
				'size_nav_icon',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 30,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'arrow_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'arrow_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_nav_style' );
				
				$this->start_controls_tab(
		            'tab_nav_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

		            $this->add_control(
						'color_nav_icon',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:before' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_nav_border',
						[
							'label' 	=> esc_html__( 'Color Border', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev' => 'border-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'remons' ),
		            ]
		        );

		            $this->add_control(
						'color_nav_icon_hover',
						[
							'label' 	=> esc_html__( 'Color Hover', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:hover:before, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:hover:before' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_nav_border_hover',
						[
							'label' 	=> esc_html__( 'Color Border Hover', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-next:hover, {{WRAPPER}} .ova-testimonial-2 .slide-testimonials-2 .slick-prev:hover' => 'border-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		    $this->end_controls_tabs();

        $this->end_controls_section(); /* End Nav Arrow Style */
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Tab item
		$tab_item = remons_get_meta_data( 'tab_item', $settings );
		
		// Carousel data option
		$data_options = [
			'loop' 				=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 			=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'autoplay_speed' 	=> remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 		=> remons_get_meta_data( 'smartspeed', $settings ),
			'rtl' 				=> is_rtl() ? true: false
		];

		?>
         
        <div class="ova-testimonial-2 <?php echo esc_attr( $template ); ?>">
			<div class="slide-testimonials-2" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
				<?php if ( remons_array_exists( $tab_item ) ):
					foreach ( $tab_item as $item ):
						// Get image author
						$image_author = remons_get_meta_data( 'image_author', $item );

						// Get url
						$url = remons_get_meta_data( 'url', $image_author );

						// Get alt
						$alt = remons_get_meta_data( 'name_author', $item, esc_html__( 'Testimonial Image', 'remons' ) );
				?>
					<div class="item">
						<div class="client-info">
							<div class="client">
								<?php if ( $image_author ): ?>
									<div class="image">
										<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" >
										<?php if ( 'template2' === $template ): ?>
											<div class="icon icon-quote">
												<i aria-hidden="true" class="ovaicon ovaicon-left-quote-1"></i>						
											</div>
											<div class="rating-icon">
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<i class="fas fa-star"></i>
												<span class="line"></span>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="info">
								<?php if ( remons_get_meta_data( 'testimonial', $item ) ): ?>
									<p class="ova-evaluate">
										<?php echo esc_html( $item['testimonial'] ); ?>
									</p>
								<?php endif; ?>
								<div class="name-job">
									<?php if ( remons_get_meta_data( 'name_author', $item ) ): ?>
										<p class="name second_font">
											<?php echo esc_html( $item['name_author'] ); ?>
										</p>
									<?php endif; ?>
									<div class="separator">
										<?php echo esc_html__( '.', 'remons' ); ?>
									</div>
									<?php if ( remons_get_meta_data( 'job', $item ) ): ?>
										<p class="job">
											<?php echo esc_html( $item['job'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div><!-- end info -->
						</div>
					</div>
					<?php endforeach;
				endif; ?>
			</div>
			<div class="slide-for">
            	<?php if ( remons_array_exists( $tab_item ) ):
            		foreach ( $tab_item as $k => $item ):
            			if ( $k >= 3 ) break;

						// Get url
						$url = isset( $item['image_author']['url'] ) ? $item['image_author']['url'] : '';

            			// Get alt
						$alt = remons_get_meta_data( 'name_author', $item, esc_html__( 'testimonial', 'remons' ) );
            	?>
	         	    <div class="small-img">
						<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
					</div>	
					<?php endforeach;
				endif; ?>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Testimonial_2() );