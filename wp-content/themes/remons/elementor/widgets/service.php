<?php 
class Remons_Elementor_Service extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_service';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova service', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-icon-box';
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
		wp_enqueue_script( 'remons-elementor-service', REMONS_URI.'/assets/js/elementor/service.js' );
		return [];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-service', REMONS_URI.'/assets/scss/elementor/services/service.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		//content section
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
						'template3' => esc_html__( 'Template 3', 'remons' ),
						'template4' => esc_html__( 'Template 4', 'remons' ),
						'template5' => esc_html__( 'Template 5', 'remons' ),
					]
				]
			);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon4-injection',
						'library' 	=> 'ovaicon',
					],
					'condition' => [
						'template' => [ 'template1', 'template2','template3','template5' ],
					],
				]
			);

			$this->add_control(
				'image',
				[
					'label' => esc_html__( 'Image', 'remons' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'template' => [ 'template1', 'template3','template4' ],
					],
				]
			);


			$this->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Culture', 'remons' ),
					'placeholder' 	=> esc_html__( 'Type your title here', 'remons' ),
				]
			);
			
			$this->add_control(
				'discount_badge',
				[
					'label' 	=> esc_html__( 'Discount Badge', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( '18% OFF', 'remons' ),
					'condition' => [
						'template' => 'template5',
					],
				],
			);

			$this->add_control(
				'text_price',
				[
					'label' 	=> esc_html__( 'Text Price', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'row'		=> 2,
					'default' 	=> __( 'Regular Price: <span>$240</span>', 'remons' ),
					'condition' => [
						'template' => 'template5',
					],
				],
			);

			$this->add_control(
				'show_description',
				[
					'label' 		=> esc_html__( 'Show Description', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'description',
				[
					'label' 		=> esc_html__( 'Description', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
					'rows' 			=> 5,
					'default' 		=> esc_html__( 'Sed ut perspiciatis unde omnis totam rem aperia eaque', 'remons' ),
					'placeholder' 	=> esc_html__( 'Type your description here', 'remons' ),
					'condition' 	=> [
						'show_description' => 'yes',
					],
				]
			);


			$this->add_control(
				'show_button_read_more',
				[
					'label' 		=> esc_html__( 'Show Button Readmore', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Read More', 'remons' ),
					'condition' => [
						'show_button_read_more' => 'yes',
					],
				],
			);

			$this->add_control(
				'icon_button',
				[
					'label'     => esc_html__( 'Icon Button', 'remons' ),
					'type'      => \Elementor\Controls_Manager::ICONS,
					'default'   => [
						'value'     => 'fas fa-arrow-right',
						'library'   => 'all'
					],
					'condition' => [
						'show_button_read_more' => 'yes',
					],
				]
			);
	
			$this->add_control(
			    'button_action_type',
			    [
			        'label'   => esc_html__( 'Button Action', 'remons' ),
			        'type'    => \Elementor\Controls_Manager::CHOOSE,
			        'options' => [
			            'popup' => [
			                'title' => esc_html__( 'Popup booking form', 'remons' ),
			                'icon'  => 'eicon-editor-code',
			            ],
			            'product' => [
			                'title' => esc_html__( 'Product permalink', 'remons' ),
			                'icon'  => 'eicon-link',
			            ],
			            'custom' => [
			                'title' => esc_html__( 'Custom link', 'remons' ),
			                'icon'  => 'eicon-globe',
			            ],
			        ],
			        'default' => 'custom',
			        'toggle'  => true,
			        'condition' => [
						'show_button_read_more' => 'yes',
					],
			    ]
			);

			// init
			$product_ids = [];

			// Default product
			$default_product = '';

			// Get rental products
			$rental_products = OVABRW()->options->get_rental_product_ids();
			if ( ovabrw_array_exists( $rental_products ) ) {
				foreach ( $rental_products as $pid ) {
					$product_ids[$pid] = get_the_title( $pid );

					// Default product
					if ( !ovabrw_array_exists( $default_product ) ) $default_product = $pid;
				}
			} else {
				$product_ids[''] = esc_html__( 'There are no rental products', 'remons' );
			}

			$this->add_control(
				'product_id',
				[
					'label' 		=> esc_html__( 'Choose Product', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'options' 		=> $product_ids,
					'default' 		=> $default_product,
					'condition' => [
			            'button_action_type' 	=> [ 'product', 'popup' ],
						'show_button_read_more' => 'yes',
			        ],
				]
			);

			//link
			$this->add_control(
			    'link',
			    [
			        'label' => esc_html__( 'Custom URL', 'remons' ),
			        'type' => \Elementor\Controls_Manager::URL,
			        'placeholder' => 'https://your-link.com',
			        'options' 		=> [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' 			=> '#',
						'is_external' 	=> true,
						'nofollow' 		=> false,
					],
			        'dynamic' => [
						'active' => true
					],
			        'label_block' => true,
			        'condition' => [
			            'button_action_type' => 'custom',
			            'show_button_read_more' => 'yes',
			        ],
			    ]
			);

		$this->end_controls_section();	

		//button style control
		$this->start_controls_section(
		    'button_section',
		    [
		        'label' => esc_html__( 'Button', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

		    ]
		);

			$this->start_controls_tabs('style_tabs');

			// TAB NORMAL BUTTON
			$this->start_controls_tab(
			    'title_normal',
			    [
			        'label' => esc_html__( 'Normal', 'remons' ),
			    ]
			);

				$this->add_control(
				    'color_normal',
				    [
				        'label' => esc_html__( 'Text Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button span' => 'color: {{VALUE}};',
				            '{{WRAPPER}} .remons-service .button i' => 'color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_control(
					'icon_size',
					[
						'label' => esc_html__( 'Icon Size', 'remons' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', 'rem' ],
						'range' => [
							'px' => [
								'min' => 8,
								'max' => 100,
							],
							'em' => [
								'min' => 0.5,
								'max' => 5,
							],
							'rem' => [
								'min' => 0.5,
								'max' => 5,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .remons-service .button i' => 'font-size: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .remons-service .button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
				    'background_color_normal',
				    [
				        'label' => esc_html__( 'Background Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button' => 'background-color: {{VALUE}};',
				        ],
				        'condition' => [
				            'template' => ['template1', 'template3', 'template5'],
				        ],
				    ]
				);

				$this->add_control(
				    'padding_normal',
				    [
				        'label' => esc_html__( 'Padding', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%', 'em' ],
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_control(
				    'margin_normal',
				    [
				        'label' => esc_html__( 'Margin', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%', 'em' ],
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);
				$this->add_control(
				    'border_radius_button',
				    [
				        'label' => esc_html__( 'Border Radius', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

			$this->end_controls_tab();

			// TAB HOVER BUTTON
			$this->start_controls_tab(
			    'title_hover',
			    [
			        'label' => esc_html__( 'Hover', 'remons' ),
			    ]
			);

				$this->add_control(
				    'color_hover',
				    [
				        'label' => esc_html__( 'Text Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button:hover' => 'color: {{VALUE}};',
				            '{{WRAPPER}} .remons-service .button a' => 'color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_control(
				    'background_color_hover',
				    [
				        'label' => esc_html__( 'Background Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .remons-service .button:hover' => 'background-color: {{VALUE}};',
				        ],
				        'condition' => [
				            'template' => ['template1', 'template3', 'template5'],
				        ],
				    ]
				);


			$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		//dicount style control
		$this->start_controls_section(
		    'discount_section',
		    [
		        'label' => esc_html__( 'Discount Badge', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		        'condition' => [
				        'template' => ['template5'],
				],
		    ]
		);

			$this->add_control(
			    'color_discount_badge',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .discount-badge' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_discount_badge',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .discount-badge' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_discount_badge',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .discount-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_discount_badge',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .discount-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_discount_badge',
					'selector' 	=> '{{WRAPPER}} .remons-service .discount-badge',
				]
			);

		$this->end_controls_section();

		//title style control
		$this->start_controls_section(
		    'title_section',
		    [
		        'label' => esc_html__( 'Title', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'color_title',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .title' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_title',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .title' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_title',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_title',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .remons-service .title',
				]
			);

		$this->end_controls_section();

		//price style control
		$this->start_controls_section(
		    'price_section',
		    [
		        'label' => esc_html__( 'Price', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		        'condition' => [
				        'template' => ['template5'],
				],
		    ]
		);

			$this->add_control(
			    'color_price',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .price' => 'color: {{VALUE}};',
			            '{{WRAPPER}} .remons-service .price span' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_price',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .price' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_price',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_price',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_price',
					'selector' 	=> '{{WRAPPER}} .remons-service .price',
				]
			);

		$this->end_controls_section();

		//description style control
		$this->start_controls_section(
		    'description_section',
		    [
		        'label' => esc_html__( 'Description', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'color_description',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .description' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_description',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .description' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_description',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_description',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .remons-service .description',
				]
			);

		$this->end_controls_section();


		//image style control
		$this->start_controls_section(
		    'image_section',
		    [
		        'label' => esc_html__( 'Image', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		        'condition' => [
					'template' => [ 'template1', 'template3','template4' ],
				],
		    ]
		);

			$this->add_responsive_control(
			    'image_width',
			    [
			        'label' => esc_html__( 'Width', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SLIDER,
			        'size_units' => [ 'px', '%', 'vw' ],
			        'range' => [
			            'px' => [ 'min' => 0, 'max' => 1000 ],
			            '%' => [ 'min' => 0, 'max' => 100 ],
			            'vw' => [ 'min' => 0, 'max' => 100 ],
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'width: {{SIZE}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_responsive_control(
			    'image_height',
			    [
			        'label' => esc_html__( 'Height', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SLIDER,
			        'size_units' => [ 'px', '%', 'vh' ],
			        'range' => [
			            'px' => [ 'min' => 0, 'max' => 1000 ],
			            '%' => [ 'min' => 0, 'max' => 100 ],
			            'vh' => [ 'min' => 0, 'max' => 100 ],
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
			        ],
			    ]
			);

			$this->add_responsive_control(
			    'image_max_width',
			    [
			        'label' => esc_html__( 'Max Width', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SLIDER,
			        'size_units' => [ 'px', '%', 'vw' ],
			        'range' => [
			            'px' => [ 'min' => 0, 'max' => 1000 ],
			            '%' => [ 'min' => 0, 'max' => 100 ],
			            'vw' => [ 'min' => 0, 'max' => 100 ],
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'max-width: {{SIZE}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_responsive_control(
			    'image_max_height',
			    [
			        'label' => esc_html__( 'Max Height', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SLIDER,
			        'size_units' => [ 'px', '%', 'vh' ],
			        'range' => [
			            'px' => [ 'min' => 0, 'max' => 1000 ],
			            '%' => [ 'min' => 0, 'max' => 100 ],
			            'vh' => [ 'min' => 0, 'max' => 100 ],
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'max-height: {{SIZE}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_image',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_image',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'border_radius_image',
			    [
			        'label' => esc_html__( 'Border Radius', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();

		//icon style control
		$this->start_controls_section(
		    'icon_section',
		    [
		        'label' => esc_html__( 'Icon', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		        'condition' => [
					'template' => [ 'template1', 'template2','template3', 'template5' ],
				],
		    ]
		);

			$this->add_control(
			    'color_icon',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .icon' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_icon',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_icon',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'icon_font_size',
			    [
			        'label' => esc_html__( 'Font Size', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SLIDER,
			        'size_units' => [ 'px', 'em', 'rem' ],
			        'range' => [
			            'px' => [ 'min' => 10, 'max' => 100 ],
			            'em' => [ 'min' => 0.5, 'max' => 10 ],
			            'rem' => [ 'min' => 0.5, 'max' => 10 ],
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service .icon' => 'font-size: {{SIZE}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();

		//container style control
		$this->start_controls_section(
		    'container_section',
		    [
		        'label' => esc_html__( 'Container', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'background_color_container',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .remons-service' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'border_radius_container',
			    [
			        'label' => esc_html__( 'Border Radius', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_container',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_container',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .remons-service' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$templates = remons_get_meta_data( 'template', $settings );

		$product_id = $settings['product_id']; //return id product

		$button_action_type = $settings['button_action_type'];

		if('template1' === $templates){

			ovabrw_get_template( 'elementors/service1.php', $settings );

		} elseif ('template2' === $templates) {

			ovabrw_get_template( 'elementors/service2.php', $settings );

		} elseif('template3' === $templates){

			ovabrw_get_template( 'elementors/service3.php', $settings );

		} elseif('template4' === $templates){

			ovabrw_get_template( 'elementors/service4.php', $settings );

		} elseif('template5' === $templates){

			ovabrw_get_template( 'elementors/service5.php', $settings );

		}

	}

}


$widgets_manager->register( new Remons_Elementor_Service() );




