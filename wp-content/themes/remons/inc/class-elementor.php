<?php

class Remons_Elementor {
	
	public function __construct() {
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', [ $this, 'remons_add_category' ] );

	    // After register styles
	    add_action( 'elementor/frontend/after_register_styles', [ $this, 'remons_enqueue_styles' ] );

	    // After register scripts
	    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'remons_enqueue_scripts' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'remons_include_widgets' ] );
		
		// Additional animations
		add_filter( 'elementor/controls/animations/additional_animations', [ $this, 'remons_add_animations' ], 10, 0 );

		// Footer scripts
		add_action( 'wp_print_footer_scripts', [ $this, 'remons_enqueue_footer_scripts' ] );

		// Load icons
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'remons_icons_filters_new' ], 9999999, 1 );

		// Add icons social custom
		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', [ $this, 'remons_social_icons_custom' ], 10, 2 );

		// Add text editor custom control style
		add_action( 'elementor/element/text-editor/section_style/after_section_end', [ $this, 'remons_text_editor_custom' ], 10, 2 );

		// Add accordion custom control style
		add_action( 'elementor/element/accordion/section_toggle_style_content/after_section_end', [ $this, 'remons_accordion_custom' ], 10, 2 );

		// Add customize icon box 
		add_action( 'elementor/element/icon-box/section_style_content/after_section_end', [ $this, 'remons_icon_box_custom' ], 10, 2 );

		// Add customize image box 
		add_action( 'elementor/element/image-box/section_style_content/after_section_end', [ $this, 'remons_image_box_custom' ], 10, 2 );

		// Add customize image
		add_action( 'elementor/element/image/section_style_caption/after_section_end', [ $this, 'remons_image_custom' ], 10, 2 );

		// Add button custom control style
		add_action( 'elementor/element/button/section_button/after_section_end', [ $this, 'remons_button_custom' ], 10, 2 );

		// Add customize image gallery (basic gallery)
		add_action( 'elementor/element/image-gallery/section_caption/after_section_end', [ $this, 'remons_image_gallery_custom' ], 10, 2 );

		// Remove animations style from Elementor
		add_action( 'wp_enqueue_scripts', [ $this, 'remons_remove_animations_styles' ] );
	}

	/**
	 * Add category
	 * @return [type] [description]
	 */
	public function remons_add_category(  ) {
	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => esc_html__( 'Header Footer', 'remons' ),
	            'icon' 	=> 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'remons',
	        [
	            'title' => esc_html__( 'Remons', 'remons' ),
	            'icon' 	=> 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'remons-product',
	        [
	            'title' => esc_html__( 'Remons Product', 'remons' ),
	            'icon' 	=> 'fa fa-plug',
	        ]
	    );
	}

	/**
	 * Widget social icons style
	 */
	public function remons_enqueue_styles() {
		// Widget social icons
        if ( defined( 'ELEMENTOR_ASSETS_PATH' ) && defined( 'ELEMENTOR_ASSETS_URL' ) ) {
        	if ( file_exists( ELEMENTOR_ASSETS_PATH . 'css/widget-social-icons.min.css' ) ) {
                wp_enqueue_style( 'widget-social-icons', ELEMENTOR_ASSETS_URL . 'css/widget-social-icons.min.css', [], ELEMENTOR_VERSION );
            }
        }
	}

	/**
	 * Enqueue scripts
	 */
	public function remons_enqueue_scripts() {
        $files = glob( get_theme_file_path( '/assets/js/elementor/*.js' ) );
        
        foreach ( $files as $file ) {
            $file_name = wp_basename( $file );
            $handle    = str_replace( ".js", '', $file_name );
            $src       = get_theme_file_uri( '/assets/js/elementor/' . $file_name );

            if ( file_exists( $file ) ) {
                wp_register_script( 'remons-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }
	}

	/**
	 * Include widgets
	 */
	public function remons_include_widgets( $widgets_manager ) {
        $files = glob( get_theme_file_path( 'elementor/widgets/*.php' ) );

        foreach ( $files as $file ) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename( $file ) );

            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }
    }

    /**
     * Add animations
     */
    public function remons_add_animations() {
    	$animations = [
    		'Remons' => [
            	'ova-move-up' 		=> esc_html__( 'Move Up', 'remons' ),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'remons' ),
                'ova-move-left'     => esc_html__( 'Move Left', 'remons' ),
                'ova-move-right'    => esc_html__( 'Move Right', 'remons' ),
                'ova-scale-up'      => esc_html__( 'Scale Up', 'remons' ),
                'ova-flip'          => esc_html__( 'Flip', 'remons' ),
                'ova-helix'         => esc_html__( 'Helix', 'remons' ),
                'ova-popup'			=> esc_html__( 'PopUp','remons' )
            ]
    	];

        return $animations;
    }

    /**
     * Enqueue footer scripts
     */
	public function remons_enqueue_footer_scripts() {
		// Font Icon
	    wp_enqueue_style( 'ovaicon', REMONS_URI.'/assets/libs/ovaicon/font/ovaicon.css', [], null );

	    // Flaticon Remons
	    wp_enqueue_style( 'flaticon', REMONS_URI.'/assets/libs/flaticon/font/flaticon_remons.css', [], null );

	    // Flaticon Remons 2
	    wp_enqueue_style('flaticon2', REMONS_URI.'/assets/libs/flaticon2/font/flaticon_remons2.css', [], null );

	    // Flaticon Remons 3
	    wp_enqueue_style( 'flaticon3', REMONS_URI.'/assets/libs/flaticon3/font/flaticon_remons3.css', array(), null );

	    // Medical
	    wp_enqueue_style( 'remons_medical', REMONS_URI.'/assets/libs/medical/font/flaticon_remon_medical.css', [], null );
	}
	
	/**
	 * Add new icons
	 */
	public function remons_icons_filters_new( $tabs = [] ) {
		$newicons 				= [];
		$font_data['json_url'] 	= REMONS_URI.'/assets/libs/ovaicon/ovaicon.json';
		$font_data['name'] 		= 'ovaicon';

		$newicons[ $font_data['name'] ] = [
			'name'          => $font_data['name'],
			'label'         => esc_html__( 'Default', 'remons' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'ovaicon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $font_data['json_url']
		];

		// Flaticon Remons
		$flaticon_remons 					= [];
		$flaticon_remons_data['json_url'] 	= REMONS_URI.'/assets/libs/flaticon/flaticon_remons.json';
		$flaticon_remons_data['name'] 		= 'flaticon';

		$newicons[ $flaticon_remons_data['name'] ] = [
			'name'          => $flaticon_remons_data['name'],
			'label'         => esc_html__( 'Flaticon Remons', 'remons' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $flaticon_remons_data['json_url']
		];

		// Flaticon Remons 2
		$flaticon_remons2 					= [];
		$flaticon_remons2_data['json_url'] 	= REMONS_URI.'/assets/libs/flaticon2/flaticon_remons2.json';
		$flaticon_remons2_data['name'] 		= 'flaticon2';

		$newicons[ $flaticon_remons2_data['name'] ] = [
			'name'          => $flaticon_remons2_data['name'],
			'label'         => esc_html__( 'Flaticon Remons 2', 'remons' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon2-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $flaticon_remons2_data['json_url']
		];

		// Flaticon Remons 3
		$flaticon_remons3 					= [];
		$flaticon_remons3_data['json_url'] 	= REMONS_URI.'/assets/libs/flaticon3/flaticon_remons3.json';
		$flaticon_remons3_data['name'] 		= 'flaticon3';

		$newicons[ $flaticon_remons3_data['name'] ] = [
			'name'          => $flaticon_remons3_data['name'],
			'label'         => esc_html__( 'Flaticon Remons 3', 'remons' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon3-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => $flaticon_remons3_data['json_url']
		];

		// Medical
		$newicons['medical'] = [
			'name'          => 'medical',
			'label'         => esc_html__( 'Medical', 'remons' ),
			'url'           => '',
			'enqueue'       => '',
			'prefix'        => 'flaticon4-',
			'displayPrefix' => '',
			'ver'           => '1.0',
			'fetchJson'     => REMONS_URI.'/assets/libs/medical/medical.json'
		];

		return array_merge( $tabs, $newicons );
	}

	/**
	 * Social icon widget
	 */
	public function remons_social_icons_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_social_icons',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Social Icon', 'remons' ),
			]
		);

			$element->add_responsive_control(
	            'ova_social_icons_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' => [
	                        'title' => esc_html__( 'Block', 'remons' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'inline-flex' => [
	                        'title' => esc_html__( 'Flex', 'remons' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-icon.elementor-social-icon' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}

	/**
	 * Text editor widget
	 */
    public function remons_text_editor_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Text Editor', 'remons' ),
			]
		);

			$element->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'link_typography',
					'selector' => '{{WRAPPER}} a',
				]
			);

	        $element->add_control(
	            'link_color_hover',
	            [
	                'label' 	=> esc_html__( 'Link Color Hover', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$element->add_responsive_control(
				'text_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
					'{{WRAPPER}}  p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
		        'text_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'remons' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}}  p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

		$element->end_controls_section();
	} 

	/**
	 * Accordion widget
	 */
	public function remons_accordion_custom( $element, $args ) {
    	/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_accordion',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Accordion', 'remons' ),
			]
		);

			// Accordion item options
	        $element->add_control(
				'accordion_item_options',
				[
					'label' 	=> esc_html__( 'Item Options', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

		        $element->add_responsive_control(
		            'accordion_item_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		    // Active
	        $element->add_control(
				'accordion_item_options_active',
				[
					'label' 	=> esc_html__( 'Item Options Active', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

		        $element->add_responsive_control(
		            'accordion_item_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-accordion-item:has(.elementor-active)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'accordion_item_border_active',
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item:has(.elementor-active)',
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'accordion_item_border_active',
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item:has(.elementor-active)',
					]
				);

			// Title options
			$element->add_control(
				'title_options',
				[
					'label' 	=> esc_html__( 'Title Options', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_control(
		            'title_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_border',
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-title',
					]
				);

			// Title options active
			$element->add_control(
				'title_options_active',
				[
					'label' 	=> esc_html__( 'Title Options Active', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				 $element->add_control(
					'bb_color_title_active',
					[
						'label' => esc_html__( 'Background Color', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}}',
						],
					]
				);

				$element->add_responsive_control(
		            'title_active_padding',
		            [
		                'label' 		=> esc_html__( 'Padding', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );
		        
				$element->add_responsive_control(
		            'title_active_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		         $element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_border-active',
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active',
					]
				);


		    // Icon options
	        $element->add_control(
				'icon_heading',
				[
					'label' => esc_html__( 'Icon', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_responsive_control(
					'icon_size',
					[
						'label' => esc_html__( 'Size', 'remons' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
						  '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$element->add_responsive_control(
					'icon_bgsize',
					[
						'label' => esc_html__( 'Background Size', 'remons' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
						  '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'display: inline-flex; align-items: center; justify-content: center; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
					'icon_bgcolor',
					[
						'label' => esc_html__( 'Background Color', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'background-color: {{VALUE}}',
						],
					]
				);

				$element->add_control(
					'icon_bgcolor_active',
					[
						'label' => esc_html__( 'Background Color Active', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon' => 'background-color: {{VALUE}}',
						],
					]
				);

				$element->add_responsive_control(
					'icon_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'remons' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_responsive_control(
					'icon_margin',
					[
						'label' => esc_html__( 'Margin', 'remons' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'selectors' => [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$element->end_controls_section();
	} 

	/**
	 * Icon Box widget
	 */
	public function remons_icon_box_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_icon_box_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Icon Box', 'remons' ),
			]
		);

			$element->add_control(
				'icon_box_general_heading',
				[
					'label' => esc_html__( 'General', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$element->add_control(
				'icon_box_background_color',
				[
					'label' => esc_html__( 'Background Color', 'remons' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-wrapper' => 'background-color: {{VALUE}}',
					],
				]
			);

			$element->add_responsive_control(
				'icon_box_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_control(
				'icon_heading',
				[
					'label' => esc_html__( 'Icon', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$element->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_box_shadow',
					'selector' => '{{WRAPPER}} .elementor-icon',
				]
			);

			$element->add_control(
				'icon_bgcolor',
				[
					'label'			=> esc_html__( 'Background Color', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::COLOR,
					'selectors'		=> [
						'{{WRAPPER}} .elementor-icon-box-icon' => 'background-color: {{VALUE}}'
					],
				]
			);

			$element->add_responsive_control(
				'ova_icon_padding',
				[
					'label'			=> esc_html__( 'Padding', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em' ],
					'selectors'		=> [
						'{{WRAPPER}} .elementor-icon-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}' 
					],
				]
			);

			$element->add_control(
				'ova_icon_border_radius',
				[
					'label'			=> esc_html__( 'Border Radius', 'remons' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_control(
				'title_heading',
				[
					'label' => esc_html__( 'Title', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_responsive_control(
					'title_padding',
					[
						'label' 		=> esc_html__( 'Padding', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em' ],
						'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_responsive_control(
					'title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em' ],
						'selectors' 	=> [
						'{{WRAPPER}} .elementor-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_border',
						'selector' => '{{WRAPPER}} .elementor-icon-box-title',
					]
				);

	        $element->add_control(
				'title_hover_heading',
				[
					'label' => esc_html__( 'Title Hover', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_control(
					'title_color_hover',
					[
						'label' => esc_html__( 'Color Hover', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-title' => 'color: {{VALUE}}',
						],
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_border_hover',
						'selector' => '{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-title',
					]
				);

			$element->add_control(
				'desc_heading',
				[
					'label' => esc_html__( 'Description', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_control(
					'description_color_hover',
					[
						'label' => esc_html__( 'Description Color Hover', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-widget-container:hover .elementor-icon-box-description' => 'color: {{VALUE}}',
						],
					]
				);

		$element->end_controls_section();
	}

	/**
	 * Image Box widget
	 */
	public function remons_image_box_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_image_box_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Image Box', 'remons' ),
			]
		);

			$element->add_control(
				'box_heading',
				[
					'label' => esc_html__( 'Box', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::HEADING,
				]
			);

				$element->add_control(
					'box_background_color',
					[
						'label' 	=> esc_html__( 'Background Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-image-box-wrapper' => 'background-color: {{VALUE}}',
						],
					]
				);

				$element->add_control(
		            'box_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-image-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		                ],
		            ]
		        );

		        $element->add_control(
		            'box_content_padding',
		            [
		                'label' 		=> esc_html__( 'Padding', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		                ],
		            ]
		        );

		    $element->add_control(
				'title_heading',
				[
					'label' => esc_html__( 'Title', 'remons' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

		        $element->add_control(
		            'box_title_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-content .elementor-image-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		                ],
		            ]
		        );

		    $element->add_control(
				'image_heading',
				[
					'label' 	=> esc_html__( 'Image', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before'
				]
			);

				$element->add_responsive_control(
					'image_box_height',
					[
						'label' => esc_html__( 'Height', 'remons' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%', 'em', 'rem' ],
						'range' => [
							'px' => [
								'min' => 20,
								'max' => 100,
								'step' => 1,
							],
							'%' => [
								'min' => 20,
								'max' => 100,
							],
						],
						'selectors' => [
						  '{{WRAPPER}} .elementor-image-box-wrapper .elementor-image-box-img img' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$element->add_responsive_control(
					'image_box_object_fit',
					[
						'label' => esc_html__( 'Object Fit', 'remons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'condition' => [
							'image_box_height[size]!' => '',
						],
						'options' => [
							'' => esc_html__( 'Default', 'remons' ),
							'fill' => esc_html__( 'Fill', 'remons' ),
							'cover' => esc_html__( 'Cover', 'remons' ),
							'contain' => esc_html__( 'Contain', 'remons' ),
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
						],
					]
				);

		$element->end_controls_section();
	}

	/**
	 * Image widget
	 */
	public function remons_image_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_image_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Image Box', 'remons' ),
			]
		);

			$element->add_responsive_control(
				'rtl_align_heading',
				[
					'label' 	=> esc_html__( 'RTL Alignment ( RTL Language )', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'.rtl {{WRAPPER}}' => 'text-align: {{VALUE}}',
					],
				]
			);

		$element->end_controls_section();
	}

	/**
	 * Button widget
	 */
	public function remons_button_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_buton',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Button', 'remons' ),
			]
		);

		    $element->add_responsive_control(
	            'button_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'block' => [
	                        'title' => esc_html__( 'Block', 'remons' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'flex' => [
	                        'title' => esc_html__( 'Flex', 'remons' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-button-wrapper .elementor-button' => 'display: {{VALUE}}; justify-content:center',
	                ],
	            ]
	        );

			$element->add_responsive_control(
				'max_width',
				[
					'label' => esc_html__( 'Max Width', 'remons' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 90,
							'max' => 600,
							'step' => 1,
						],
						'%' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
					  '{{WRAPPER}} .elementor-button-wrapper .elementor-button' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$element->add_control(
				'icon_button_heading',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
				]
			);

				$element->add_responsive_control(
					'icon_button_size',
					[
						'label' => esc_html__( 'Size', 'remons' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 40,
								'step' => 1,
							],
						],
						'selectors' => [
						  '{{WRAPPER}} .elementor-button-wrapper .elementor-button .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$element->add_control(
					'icon_button_color',
					[
						'label' => esc_html__( 'Color', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-button-wrapper .elementor-button .elementor-button-icon i' => 'color: {{VALUE}}',
						],
					]
				);

				$element->add_control(
					'icon_button_bgcolor',
					[
						'label' => esc_html__( 'Background Color', 'remons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-button-wrapper .elementor-button .elementor-button-icon i' => 'background-color: {{VALUE}}',
						],
					]
				);

				 $element->add_control(
		            'icon_button_padding',
		            [
		                'label' 		=> esc_html__( 'Padding', 'remons' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-button-wrapper .elementor-button .elementor-button-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		                ],
		            ]
		        );

		$element->end_controls_section();
	}

	/**
	 * Image galery custom 
	 */
	public function remons_image_gallery_custom( $element, $args ) {
		$element->start_controls_section(
			'ova_image_gallery_customize',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Basic Gallery', 'remons' ),
			]
		);

			$element->add_responsive_control(
				'image_gallery_height',
				[
					'label' => esc_html__( 'Height', 'remons' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 30,
							'max' => 300,
							'step' => 1,
						],
						'%' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'selectors' => [
					  '{{WRAPPER}} .elementor-image-gallery .gallery img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$element->add_control(
	            'image_gallery_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-image-gallery .gallery .gallery-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
	                ],
	            ]
	        );

			$element->add_responsive_control(
	            'image_gallery_border',
	            [
	                'label' 	=> esc_html__( 'Border', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'none' => [
	                        'title' => esc_html__( 'None', 'remons' ),
	                        'icon' 	=> 'eicon-close',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-image-gallery .gallery img' => 'border: {{VALUE}}!important;',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}
    
	/**
	 * Remove animations style from Elementor
	 */
	public function remons_remove_animations_styles() {
		// Deregister the stylesheet by handle
	    foreach ( $this->remons_add_animations() as $animations ) {
	    	if ( !empty( $animations ) && is_array( $animations ) ) {
	    		foreach ( array_keys( $animations ) as $animation ) {
	    			wp_deregister_style( 'e-animation-'.$animation );
	    			wp_enqueue_style( 'e-animation-'.$animation, REMONS_URI.'/assets/scss/none.css', array(), null);
	    		}
	    	}
	    }
	}
}

return new Remons_Elementor();