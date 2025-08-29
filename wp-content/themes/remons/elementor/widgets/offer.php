<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Offer
 */
class Remons_Elementor_Offer extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_offer';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Offer Service', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slider-album';
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
		return [ 'remons-elementor-offer' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-offer', REMONS_URI.'/assets/scss/elementor/offer/offer.css' );

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
					]
				]
			);
			
			// Add Class control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'link',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'show_label' 	=> true,
					'default' 		=> [
						'url' => '',
					],
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Choose Image', 'remons' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-right-arrow',
						'library' 	=> 'all',
					],
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Private chef', 'remons' ),
				]
			);

			$repeater->add_control(
				'description',
				[
					'label' 	=> esc_html__( 'Description', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Lorem ipsum dolor sit amet consectur adipiscing elit sed eius mod ex tempor incididunt labore dolore magna aliquaenim.', 'remons' ),
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Tabs', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' => esc_html__( 'Private chef', 'remons' ),
						],
						[
							'title' => esc_html__( 'Quality Gym', 'remons' ),
						],
						[
							'title' => esc_html__( 'Spa & Wellness', 'remons' ),
						],
						[
							'title' => esc_html__( 'Housekeeping', 'remons' ),
						],
						[
							'title' => esc_html__( 'Swimming', 'remons' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		// Additional Options
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
				'stagePadding',
				[
					'label'   => esc_html__( 'stagePadding', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'remons' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'remons' ),
					'default'     => 4,
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
					'frontend_available' => false,
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
        
        $this->start_controls_section(
			'section_offer',
			[
				'label' => esc_html__( 'Offer', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'offer_height',
				[
					'label' 	=> esc_html__( 'Height', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 300,
							'max' => 600,
						],
					],
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-offer .offer-img img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'offer_bgcolor',
				[
					'label'     => esc_html__( 'Background Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info' => 'background-color : {{VALUE}};',
					],
				]
			);
            
            $this->add_group_control(
	            \Elementor\Group_Control_Border::get_type(), 
	            [
	                'name' 		=> 'offer_border',
	                'selector' 	=> '{{WRAPPER}}  .ova-offer .offer-img .info',
	            ]
	        );

            $this->add_responsive_control(
				'offer_image_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-offer .offer-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-offer .offer-img .info .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info .title' => 'color : {{VALUE}};',
					],
				]
			);
            
            $this->add_responsive_control(
				'title_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-offer .offer-img .info .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
					],
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-offer .offer-img .info svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info i' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-offer .offer-img .info svg' => 'fill : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor',
				[
					'label'     => esc_html__( 'Background Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor_hover',
				[
					'label'     => esc_html__( 'Background Color Hover', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info .icon:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_description',
			[
				'label' => esc_html__( 'Description', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'description_typography',
					'selector' => '{{WRAPPER}} .ova-offer .offer-img .info .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-offer .offer-img .info .description' => 'color : {{VALUE}};',
					],
				]
			);
            
            $this->add_responsive_control(
				'description_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-offer .offer-img .info .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

        /* Begin Dots Style */
		$this->start_controls_section(
            'dots_style',
            [
                'label' 	=> esc_html__( 'Dots', 'remons' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'dot_control' => 'yes',
				]
            ]
        );

            $this->add_responsive_control(
				'dots_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-offer .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_dots_style' );
				
				$this->start_controls_tab(
		            'tab_dots_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

		            $this->add_control(
						'dot_color',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot span' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'dots_width',
						[
							'label' 	=> esc_html__( 'Width', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::SLIDER,
							'range' 	=> [
								'px' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'dots_height',
						[
							'label' 	=> esc_html__( 'Height', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot span' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
			            'dots_border_radius',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
			                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-offer .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_dots_active',
		            [
		                'label' => esc_html__( 'Active', 'remons' ),
		            ]
		        );

		             $this->add_control(
						'dot_color_active',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'dots_width_active',
						[
							'label' 	=> esc_html__( 'Width', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'dots_height_active',
						[
							'label' 	=> esc_html__( 'Height', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-offer .owl-dots .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
			            'dots_border_radius_active',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
			                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-offer .owl-dots .owl-dot.active span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();
        $this->end_controls_section(); /* End Dots Style */
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Get tab item
		$tab_item = remons_get_meta_data( 'tab_item', $settings, [] );

		// Carousel options
		$data_options = [
			'items' 				=> remons_get_meta_data( 'item_number', $settings ),
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_items', $settings ),
			'stagePadding' 			=> remons_get_meta_data( 'stagePadding', $settings ),
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartspeed', $settings ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'dots' 					=> 'yes' === remons_get_meta_data( 'dot_control', $settings ) ? true : false,
			'rtl' 					=> is_rtl() ? true: false
		];

		?>
		
	 	<div class="ova-offer <?php echo esc_attr( $template ); ?>">
			<div class="offer-carousel owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode( $data_options ) ); ?>">
				<?php if ( remons_array_exists( $tab_item ) ):
					foreach ( $tab_item as $items ):
						// Get image url
						$img_url = isset( $items['image']['url'] ) ? $items['image']['url'] : '';

						// Get image atl
						$img_alt = isset( $items['image']['alt'] ) ? $items['image']['alt'] : esc_html__( 'Offer', 'remons' );

						// Get title
						$title = remons_get_meta_data( 'title', $items );

						// Get description
						$description = remons_get_meta_data( 'description', $items );

						// Get icon
						$icon = remons_get_meta_data( 'icon', $items );

						// Get icon value
						$icon_value = remons_get_meta_data( 'value', $icon );

						// Get link
						$link = remons_get_meta_data( 'link', $items );

						// Get url
						$url = remons_get_meta_data( 'url', $items );

						// Target
						$target = remons_get_meta_data( 'is_external', $link ) ? '_blank' : '_self';

						// Get rel
						$rel = remons_get_meta_data( 'nofollow', $link ) ? 'nofollow' : '';
					?>
						<div class="item">
							<div class="offer-img">
		                        <?php if ( $url ): ?>	
									<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
							    <?php endif; ?>
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
								<?php if ( $url ): ?>
							        </a>
						        <?php endif; ?>

								<div class="info">
									<?php if ( $title || $icon_value ): ?>
									<div class="top-info">
										<?php if ( $title ): ?>
											<?php if ( $url ): ?>	
												<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
										    <?php endif; ?>
												<h3 class="title">
													<?php echo esc_html( $title ); ?>
												</h3>
											<?php if ( $url ): ?>
										        </a>
									        <?php endif;
									    endif;

									    // Icon
									    if ( $icon_value ): ?>
											<?php if ( $url ): ?>	
												<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
										    <?php endif; ?>
												<div class="icon">
													<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
												</div>
											<?php if ( $url ): ?>
										        </a>
									        <?php endif;
									    endif; ?>
									</div>
									<?php endif; ?>
								</div>
								<div class="info info-hidden">
									<?php if ( $title || $icon_value ): ?>
									<div class="top-info">
										<?php if ( $title ): ?>
											<?php if ( $url ) : ?>	
												<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
										    <?php endif; ?>
											<h3 class="title">
												<?php echo esc_html( $title ); ?>
											</h3>
											<?php if ( $url ): ?>
										        </a>
									        <?php endif; ?>
										<?php endif;

										// Icon
										if ( $icon_value ): ?>
											<?php if ( $url ): ?>	
												<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
										    <?php endif; ?>
												<div class="icon">
													<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
												</div>
											<?php if ( $url ): ?>
										        </a>
									        <?php endif;
									    endif; ?>
									</div>
									<?php endif;

									// Description
									if ( $description ): ?>
										<p class="description">
											<?php echo esc_html( $description ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach;
				endif; ?>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Offer() );