<?php 
class Remons_Elementor_Pricing extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_pricing';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Pricing', 'remons' );
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
		wp_enqueue_script( 'remons-elementor-pricing', REMONS_URI.'/assets/js/elementor/pricing.js' );
		return [];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-pricing', REMONS_URI.'/assets/scss/elementor/pricing/pricing.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {


			
    $this->start_controls_section(
        'section_content',
        [
            'label' => esc_html__( 'Packages', 'remons' ),
        ]
    );

	    $this->add_control(
	        'package_name',
	        [
	            'label' => esc_html__( 'Package Name', 'remons' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'default' => esc_html__( 'Basic Package', 'remons' ),
	        ]
	    );

	    $this->add_control(
	        'package_discount',
	        [
	            'label' => esc_html__( 'Package Discount', 'remons' ),
	            'type' => \Elementor\Controls_Manager::TEXT,
	            'default' => esc_html__( 'Save 10%', 'remons' ),

	        ]
	    );

	    $this->add_control(
	        'package_description',
	        [
	            'label' => esc_html__( 'Package Description', 'remons' ),
	            'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
	            'default' => esc_html__( 'Unlimited general consultations.', 'remons' ),
	        ]
	    );

	    $this->add_control(
		    'package_pricing',
		    [
		        'label' => esc_html__( 'Package Pricing', 'remons' ),
		        'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
		        'default' => __( '<span>$180</span>/per month', 'remons' ),
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
				'package_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Get Started Now', 'remons' ),
					'condition' => [
						'show_button_read_more' => 'yes',
					],
				],
			);

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
			            'show_button_read_more' => 'yes',
			        ],
			    ]
			);

	    $repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'text_service',
				[
					'label' => esc_html__( 'Text Service', 'remons' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Add list text service', 'remons' ),
				]
			);


			$this->add_control(
				'list_service_text',
				[
					'label' => esc_html__( 'List Text Service', 'remons' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[	
							'text_service'      => esc_html__( '1 general consultation per month', 'remons' ),
						],
						[	
							'text_service'      => esc_html__( 'Access to health screenings', 'remons' ), 
						],
						[	
							'text_service'      => esc_html__( 'Basic health advice and follow-up', 'remons' ),
						],
						[	
							'text_service'      => esc_html__( 'Telemedicine & consultations', 'remons' ),
						],
						[	
							'text_service'      => esc_html__( 'Priority scheduling for visits', 'remons' ),
						],
					],
					'title_field' => '{{{ text_service }}}',
				]
			);

    $this->end_controls_section();

	//content style control
	$this->start_controls_section(
	    'content_section',
	    [
	        'label' => esc_html__( 'Content', 'remons' ),
	        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	    ]
	);

		$this->add_control(
		    'padding_content',
		    [
		        'label' => esc_html__( 'Padding', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'margin_content',
		    [
		        'label' => esc_html__( 'Margin', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'border_radius_content',
		    [
		        'label' => esc_html__( 'Border Radius', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'background_color_content',
		    [
		        'label' => esc_html__( 'Background Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'label' => esc_html__( 'Border', 'remons' ),
		        'selector' => '{{WRAPPER}} .pricing-wrapper',
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'selector' 	=> '{{WRAPPER}} .pricing-wrapper .package-name',
			]
		);

		$this->add_control(
		    'color_title',
		    [
		        'label' => esc_html__( 'Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-name' => 'color: {{VALUE}};',
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
		            '{{WRAPPER}} .pricing-wrapper .package-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .pricing-wrapper .package-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);


	$this->end_controls_section();

	//discount style control
	$this->start_controls_section(
	    'discount_section',
	    [
	        'label' => esc_html__( 'Discount', 'remons' ),
	        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	    ]
	);

		$this->add_control(
		    'color_discount',
		    [
		        'label' => esc_html__( 'Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-discount' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'background_color_discount',
		    [
		        'label' => esc_html__( 'Background Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-discount' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'padding_discount',
		    [
		        'label' => esc_html__( 'Padding', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'margin_discount',
		    [
		        'label' => esc_html__( 'Margin', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography_discount',
				'selector' 	=> '{{WRAPPER}} .pricing-wrapper .package-discount',
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography_description',
				'selector' 	=> '{{WRAPPER}} .pricing-wrapper .package-description',
			]
		);

		$this->add_control(
		    'color_description',
		    [
		        'label' => esc_html__( 'Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-description' => 'color: {{VALUE}};',
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
		            '{{WRAPPER}} .pricing-wrapper .package-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .pricing-wrapper .package-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

	$this->end_controls_section();

	//pricing style control
	$this->start_controls_section(
	    'pricing_section',
	    [
	        'label' => esc_html__( 'Pricing', 'remons' ),
	        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	    ]
	);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography_pricing',
				'selector' 	=> '{{WRAPPER}} .pricing-wrapper .package-pricing',
			]
		);

		$this->add_control(
		    'color_pricing',
		    [
		        'label' => esc_html__( 'Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-pricing p' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'padding_pricing',
		    [
		        'label' => esc_html__( 'Padding', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'margin_pricing',
		    [
		        'label' => esc_html__( 'Margin', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

	$this->end_controls_section();

	//text service style control
	$this->start_controls_section(
	    'text_service_section',
	    [
	        'label' => esc_html__( 'Text Service', 'remons' ),
	        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	    ]
	);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography_text_service',
				'selector' 	=> '{{WRAPPER}} .pricing-wrapper .package-content li',
			]
		);
		
		$this->add_control(
		    'color_marker',
		    [
		        'label' => esc_html__( 'Color marker', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-content li::before' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'color_text_service',
		    [
		        'label' => esc_html__( 'Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-content li' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'padding_text_service',
		    [
		        'label' => esc_html__( 'Padding', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-content li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'margin_text_service',
		    [
		        'label' => esc_html__( 'Margin', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .package-content li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .pricing-wrapper .pakage-button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'background_color_normal',
		    [
		        'label' => esc_html__( 'Background Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .pakage-button' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .pricing-wrapper .pakage-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .pricing-wrapper .pakage-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    \Elementor\Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'label' => esc_html__( 'Border', 'remons' ),
		        'selector' => '{{WRAPPER}} .pricing-wrapper .pakage-button',
		    ]
		);

		$this->add_control(
		    'border_radius_button',
		    [
		        'label' => esc_html__( 'Border Radius', 'remons' ),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .pakage-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .pricing-wrapper .pakage-button:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'background_color_hover',
		    [
		        'label' => esc_html__( 'Background Color', 'remons' ),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pricing-wrapper .pakage-button:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

	$this->end_controls_section();

	}



	protected function render() {
		$settings = $this->get_settings_for_display(); 
		ovabrw_get_template( 'elementors/pricing.php', $settings );
	}

}



$widgets_manager->register( new Remons_Elementor_Pricing() );