<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Gallery_Filter
 */
class Remons_Elementor_Gallery_Filter extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_gallery_filter';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Gallery Filter', 'remons' );
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
		wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/libs/isotope/isotope.pkgd.min.js', [ 'jquery' ], false, true );

		return [ 'remons-elementor-gallery-filter' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-gallery-filter', REMONS_URI.'/assets/scss/elementor/galleries/gallery-filter.css' );
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
				'show_category_filter',
				[
					'label' 		=> esc_html__( 'Show Category Filter', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'cateAll',
				[
					'label' 	=> esc_html__( 'Text All', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'All', 'remons' ),
					'condition' => [
						'show_category_filter' => 'yes'
					]
				]
			);

			$this->add_control(
				'number_column',
				[
					'label' 	=> esc_html__( 'Number Column', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'three_column',
					'options' 	=> [
						'no_column' 	=> esc_html__( 'No Columns', 'remons' ),
						'three_column' 	=> esc_html__( '3 Columns', 'remons' ),
						'four_column' 	=> esc_html__( '4 Columns', 'remons' ),
						'five_column' 	=> esc_html__( '5 Columns', 'remons' ),
						'six_column'  	=> esc_html__( '6 Columns', 'remons' ),
					],
				]
			);

			$this->add_control(
				'layout_mode',
				[
					'label' 	=> esc_html__( 'Layout Mode', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'fitRows',
					'options' 	=> [
						'fitRows'  => esc_html__( 'fitRows', 'remons' ),
						'masonry'  => esc_html__( 'Masonry', 'remons' ),
					],
				]
			);

			$this->add_control(
				'thumbnail_size',
				[
					'label' 	=> esc_html__( 'Thumbnail Size', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'remons_thumbnail',
					'options' 	=> [
						'remons_thumbnail' 	=> esc_html__( 'Remons Thumbnail', 'remons' ),
						'large' 			=> esc_html__( 'Large', 'remons' ),
						'full'  			=> esc_html__( 'Full', 'remons' ),
					],
				]
			);

			$this->add_control(
				'gutter',
				[
					'label' 	=> esc_html__( 'Spacing', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 0,
					'max' 		=> 30,
					'step' 		=> 5,
					'default' 	=> 30,
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'link',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'options' 		=> [ 'url', 'is_external', 'nofollow' ],
					'default' 		=> [
						'url' 			=> '',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'description' 	=> esc_html__('Redirect to the link instead of Fancybox popup','remons'),
					'dynamic' 		=> [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'video_link',
				[
					'label' 		=> esc_html__( 'Embed Video Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'options' 		=> [ 'url', 'is_external', 'nofollow' ],
					'default' 		=> [
						'url' 			=> '',
						'is_external' 	=> false,
						'nofollow' 	=> false,
					],
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-plus',
						'library' 	=> 'all',
					],
				]
			);

			$repeater->add_control(
				'category',
				[
					'label'   => esc_html__( 'Category', 'remons' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Church', 'remons' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label'   	=> esc_html__( 'Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'rows' 		=> 3,
					'default' 	=>  esc_html__( '', 'remons' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Image Gallery', 'remons' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label'   => esc_html__( 'Popup Image', 'remons' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
				]
			);

			$repeater->add_control(
				'always_show_overlay',
				[
					'label' 		=> esc_html__( 'Always Show Overlay', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'separator' 	=> 'before',
				]
			);

			$repeater->add_control(
				'is_large_column',
				[
					'label' 		=> esc_html__( 'Is Large Column', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

			$repeater->add_responsive_control(
				'icon_position_bottom',
				[
					'label' 		=> esc_html__( 'Icon Position - Bottom', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> ['px', '%'],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 300,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 2,
						],
					],
					'separator' => 'before',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .gallery-img .icon-box .icon' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'category' => esc_html__( 'Sedan', 'remons' ),
						],
						[
							'category' => esc_html__( 'SUV', 'remons' ),
						],
						[
							'category' => esc_html__( 'Taxi', 'remons' ),
						],
						[
							'category' => esc_html__( 'Service', 'remons' ),
						],
						[
							'category' => esc_html__( 'Sedan', 'remons' ),
						],
						[
							'category' => esc_html__( 'Service', 'remons' ),
						],
						[
							'category' => esc_html__( 'Taxi', 'remons' ),
						],
						[
							'category' => esc_html__( 'SUV', 'remons' ),
						],
						[
							'category' => esc_html__( 'Service', 'remons' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* BEGIN WRAP CATEGORY STYLE */
		$this->start_controls_section(
            'wrap_category_style',
            [
                'label' 	=> esc_html__( 'Wrap Category', 'remons' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'show_category_filter' => 'yes'
				]
            ]
        );

        	$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'wrap_category_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper',
				]
			);

			$this->add_responsive_control(
	            'wrap_category_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'wrap_category_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* END WRAP CATEGORY STYLE */

		/* BEGIN CATEGORY FILTER STYLE */
		$this->start_controls_section(
            'filter_style',
            [
                'label' 	=> esc_html__( 'Filter', 'remons' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'show_category_filter' => 'yes'
				]
            ]
        );

        	$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'filter_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn',	
				]
			);

			$this->add_control(
	            'filter_color_normal',
	            [
	                'label' 	=> esc_html__( 'Color', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_control(
	            'filter_color_active',
	            [
	                'label' 	=> esc_html__( 'Color Active', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn.active-category' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'border_filter',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn',
				]
			);

			$this->add_control(
	            'filter_border_color_active',
	            [
	                'label' 	=> esc_html__( 'Border Color Active', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn.active-category' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'filter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'filter_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* END CATEGORY FILTER STYLE */

		/* BEGIN IMAGE STYLE */
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
	            'overlay_bgcolor',
	            [
	                'label' 	=> esc_html__( 'Overlay Color', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .mask' => 'background-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'overlay_second_bgcolor',
	            [
	                'label' 	=> esc_html__( 'Overlay Color 2', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .mask-second' => 'background-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'image_size',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 450,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img img' => 'height: {{SIZE}}{{UNIT}};min-height: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_responsive_control(
				'image_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		/* END IMAGE STYLE */

		/* BEGIN ICON STYLE */
		$this->start_controls_section(
			'section_icon_style',
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
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 40,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'icon_bgsize',
				[
					'label' 		=> esc_html__( 'Background Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 48,
							'max' 	=> 130,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_rotate',
				[
					'label' 		=> esc_html__( 'Rotate', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
					'default' 		=> [
						'unit' => 'deg',
					],
					'tablet_default' => [
						'unit' => 'deg',
					],
					'mobile_default' => [
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_responsive_control(
				'icon_rotate_hover',
				[
					'label' 		=> esc_html__( 'Rotate Hover', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
					'default' 		=> [
						'unit' => 'deg',
					],
					'tablet_default' => [
						'unit' => 'deg',
					],
					'mobile_default' => [
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_responsive_control(
				'bg_border_radius_icon',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icons_style' );
				
				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

		            $this->add_control(
						'color_icon',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bgcolor_icon',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'background-color : {{VALUE}};',
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
						'color_icon_hover',
						[
							'label' 	=> esc_html__( 'Color Hover', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover i' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bgcolor_icon_hover',
						[
							'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		     $this->end_controls_tabs();

        $this->end_controls_section();
        /* END ICON STYLE */

		/* BEGIN TITLE STYLE */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .gallery-item .title',	
				]
			);

			$this->add_control(
	            'title_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .title' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
	}

	/**
	 * Slugify
	 */
	protected function slugify( $text, string $divider = '-' ) {
	  	// replace non letter or digits by divider
	  	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	  	// remove unwanted characters
	  	$text = preg_replace('~[^-\w]+~', '', $text);

	  	// trim
	  	$text = trim($text, $divider);

	  	// remove duplicate divider
	  	$text = preg_replace('~-+~', $divider, $text);

	  	// lowercase
	  	$text = strtolower($text);

	  	if ( empty( $text ) ) {
	    	return '';
	  	}

	  	return $text;
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Show category filter
		$show_category_filer = remons_get_meta_data( 'show_category_filter', $settings );

		// Category all
		$cate_all = remons_get_meta_data( 'cateAll', $settings, esc_html__( 'All', 'remons' ) );

		// Get number column
		$number_column = remons_get_meta_data( 'number_column', $settings );

		// Get thumbnail size
		$thumbnail_size = remons_get_meta_data( 'thumbnail_size', $settings );

		// Get layout mode
		$layout_mode = remons_get_meta_data( 'layout_mode', $settings );

		// Get gutter
		$gutter 		= remons_get_meta_data( 'gutter', $settings );
		$gutter_class 	= 'gap' . $gutter;

		// Get tabs
		$tabs = remons_get_meta_data( 'tab_item', $settings, [] );

		// Categories
		$cate_array = [];

		if ( remons_array_exists( $tabs ) ): ?>
			<div class="ova-gallery-filter" data-layout_mode="<?php echo esc_attr( $layout_mode ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>">
				<?php if ( 'yes' === $show_category_filer ):
					foreach ( $tabs as $key => $items ) {
						if ( remons_get_meta_data( 'category', $items ) ) {
							array_push( $cate_array, $items['category'] );
						}
		            	
		            	// Remove duplicate
		            	$cate_array = array_unique( $cate_array );
					}
				?>
		            <ul class="filter-btn-wrapper">
		                <li class="filter-btn active-category" data-filter="*">
		                    <?php echo esc_html( $cate_all ); ?>
		                </li>
		                <?php if ( remons_array_exists( $cate_array ) ):
		                	foreach ( $cate_array as $cate ):
		                		$slug = $this->slugify( $cate );

			                	if ( '' != $cate ): ?>
				                	<li class="filter-btn" data-slug=".<?php echo esc_attr( $slug ); ?>">
					                    <?php echo esc_html( $cate ); ?>
					                </li>
					            <?php endif;
					        endforeach;
			        	endif; ?>
		            </ul>
	            <?php endif; ?> 

	            <div class="gallery-row">
	            	<div class="gallery-column <?php echo esc_attr( $number_column ); ?> <?php echo esc_attr( $gutter_class ); ?>">
	            		<?php foreach ( $tabs as $key => $items ):
	            			$item_id = 'elementor-repeater-item-' . esc_attr( $items['_id'] );

	            			if ( 'yes' === remons_get_meta_data( 'is_large_column', $items ) ) {
	            				$is_large_column = 'is_large_column';
	            			} else {
	            				$is_large_column = '';
	            			}

	            			if ( 'yes' === remons_get_meta_data( 'always_show_overlay', $items ) ) {
	            				$always_show_overlay = 'always_show_overlay';
	            			} else {
	            				$always_show_overlay = '';
	            			}
	                        
	                        // Get category
	                        $category2 = remons_get_meta_data( 'category', $items );

	                        // Get slugs
	                        $slug2 = $this->slugify( $category2 );

	                        // Get title
		  					$title = remons_get_meta_data( 'title', $items );

		  					// Get image id
		  					$img_id = isset( $items['image']['id'] ) ? $items['image']['id'] : '';

		  					// Get image URL
	                        $img_url = isset( $items['image']['url'] ) ? $items['image']['url'] : '';

	                        // Get image popup
	                        $img_popup = isset( $items['image_popup']['url'] ) ? $items['image_popup']['url'] : '';
	                        if ( '' == $img_popup ) $img_popup = $img_url;

	                        $thumbnail_url  = isset( wp_get_attachment_image_src( $img_id, $thumbnail_size )[0] ) ? wp_get_attachment_image_src( $img_id, $thumbnail_size )[0] : $img_url;
	                        
	                        // alt and caption image
		  					$img_alt 		= ( isset( $items['image']['alt'] ) && $items['image']['alt'] != '' ) ? $items['image']['alt'] : $title;
		  					$caption        = wp_get_attachment_caption( $img_id );

		  					if ( $img_alt == '' ) {
		  						$img_alt = esc_html__('Gallery Filter','remons');
		  					}

		  					if ( $caption == '' ) {
		  						$caption = $img_alt;
		  					}

		  					// Get video link
		  					$video_link = isset( $items['video_link']['url'] ) ? $items['video_link']['url'] : '';

		  					// Get link url
	                        $link = isset( $items['link']['url'] ) ? $items['link']['url'] : '';

	                        // Target
							$target = isset( $items['link']['is_external'] ) && $items['link']['is_external'] ? '_blank' : '_self';
		  				?>

			            	<div class="gallery-item <?php echo esc_attr( $slug2.' '.$item_id.' '.$is_large_column.' '.$always_show_overlay ); ?>">
	                            <?php if ( $video_link ): ?>
	                            	<a class="gallery-fancybox" data-src="<?php echo esc_url( $video_link ); ?>" 
	                            		href="<?php echo esc_url( $video_link ); ?>"
		  								data-fancybox="gallery-filter" 
		  								data-caption="<?php echo esc_attr( $caption ); ?>">
		  						<?php elseif ( $link ): ?>
		  							<a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	                            <?php else: ?>
	                            	<a href="#" class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup ); ?>" 
		  								data-fancybox="gallery-filter" 
		  								data-caption="<?php echo esc_attr( $caption ); ?>">
	                            <?php endif; ?>
									<div class="gallery-img">
								    	<img src="<?php echo esc_url( $thumbnail_url ) ?>" alt="<?php echo esc_attr($img_alt); ?>">
								    	<div class="icon-box">
								    		<?php if ( !empty( $items['icon']['value'] ) ): ?>
									    		<div class="icon">
									    			<?php \Elementor\Icons_Manager::render_icon( $items['icon'], [ 'aria-hidden' => 'true' ] ); ?>
									    		</div>
									    	<?php endif;

									    	if ( $title ): ?>
									    		<h3 class="title">
									    			<?php echo esc_html( $title ); ?>	
									    		</h3>
									    	<?php endif; ?>
										</div>
										<div class="mask"></div>
										<div class="mask-second"></div>
									</div>
								</a>
							</div>
		                <?php endforeach; ?>
		            </div>
	            </div>
	        </div>
        <?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Gallery_Filter() );