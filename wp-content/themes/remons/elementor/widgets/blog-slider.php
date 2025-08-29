<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Blog_Slider
 */
class Remons_Elementor_Blog_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_blog_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Blog Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
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
		return [ 'remons-elementor-blog-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-blog', REMONS_URI.'/assets/scss/elementor/blogs/blog.css' );
		wp_enqueue_style( 'remons-elementor-blog-slider', REMONS_URI.'/assets/scss/elementor/blogs/blog-slider.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {
		// Categories
		$categories = [
			'all' => esc_html__( 'All', 'remons' )
		];
  		
  		// Get categories
		$post_categories = get_categories([
			'orderby' 	=> 'name',
			'order' 	=> 'ASC'
		]);

		// Loop
		if ( remons_array_exists( $post_categories ) ) {
			foreach ( $post_categories as $cat ) {
				$categories[$cat->slug] = $cat->cat_name;
			}
		} // END loop

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

			$this->add_control(
				'template_style',
				[
					'label' 	=> esc_html__( 'Template Style', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template_style1',
					'options' 	=> [
						'template_style1' => esc_html__( 'Style 1', 'remons' ),
						'template_style2' => esc_html__( 'Style 2', 'remons' ),
					],
				]
			);
  
			$this->add_control(
				'category',
				[
					'label' 	=> esc_html__( 'Category', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'all',
					'options' 	=> $categories
				]
			);
  
			$this->add_control(
				'total_count',
				[
					'label' 	=> esc_html__( 'Post Total', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 5,
				]
			);
  
			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'desc',
					'options' 	=> [
						'asc' 	=> esc_html__( 'Ascending', 'remons' ),
						'desc' 	=> esc_html__( 'Descending', 'remons' ),
					]
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' 	=> esc_html__( 'Order By', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ID',
					'options' 	=> [
						'none' 		=> esc_html__( 'None', 'remons' ),
						'ID' 		=> esc_html__( 'ID', 'remons' ),
						'title' 	=> esc_html__( 'Title', 'remons' ),
						'date' 		=> esc_html__( 'Date', 'remons' ),
						'modified' 	=> esc_html__( 'Modified', 'remons' ),
						'rand' 		=> esc_html__( 'Rand', 'remons' )
					]
				]
			);
  
			$this->add_control(
				'text_readmore',
				[
					'label' 	=> esc_html__( 'Text Read More', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'More', 'remons' ),
					'condition' => [
					  	'show_read_more' => 'yes'
					],
				]
			);
  
			$this->add_control(
				'show_short_desc',
				[
					'label' 		=> esc_html__( 'Show Short Description', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'order_text',
				[
					'label' 	=> esc_html__( 'Description Words Total', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 12,
					'condition' => [
					  	'show_short_desc' => 'yes'
					],
				]
			);
  
			$this->add_control(
				'show_comment',
				[
					'label' 		=> esc_html__( 'Show Comment', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);
  
			$this->add_control(
				'show_date',
				[
					'label' 		=> esc_html__( 'Show Date', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				 ]
			);

			$this->add_control(
				'show_category',
				[
					'label' 		=> esc_html__( 'Show Category', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				 ]
			);
  
			$this->add_control(
				'show_author',
				[
					'label' 		=> esc_html__( 'Show Author', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);
  
			$this->add_control(
				'show_read_more',
				[
					'label' 		=> esc_html__( 'Show Read More', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'show_icon',
				[
					'label' 		=> esc_html__( 'Show Icon', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'condition' 	=> [
					  	'show_read_more' => 'yes', 
					],
				]
			);

			$this->add_control(
				'icon_readmore',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-next-4',
						'library' 	=> 'all',	
					],
					'condition' => [
					  	'show_read_more' 	=> 'yes', 
					  	'show_icon' 		=> 'yes'
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
					'default'     => 3,
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
		/****************************  END SECTION ADDITIONAL *********************/

		/* Begin General Style */
	   	$this->start_controls_section(
		'general',
		  	[
			 	'label' => esc_html__( 'General', 'remons' ),
			  	'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
		  	]
	  	);

			$this->add_control(
			    'general_bg_color',
			    [
				    'label' 	=> esc_html__( 'Background Color', 'remons' ),
				    'type' 		=> \Elementor\Controls_Manager::COLOR,
				    'selectors' => [
					    '{{WRAPPER}} .ova-blog-slider .item .content' => 'background-color : {{VALUE}};',
				    ],
			    ]
			);

			$this->add_responsive_control(
			  	'general_border_radius',
			  	[
				  	'label' 		=> esc_html__( 'Border Radius', 'remons' ),
				 	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			 	 ]
			);

		  	$this->add_responsive_control(
			  	'general_padding',
			  	[
				  	'label' 		=> esc_html__( 'Padding', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .ova-blog-slider .item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
		  	);

	  	$this->end_controls_section();
	  	/* End General style */

	  	// BEGIN BLOG IMAGE STYLE
		$this->start_controls_section(
		    'section_blog_image',
		    [
			    'label' => esc_html__( 'Blog Image', 'remons' ),
			    'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_responsive_control(
				'blog_image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 200,
							'max' 	=> 500,
							'step' 	=> 2,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .media .box-img img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
			  	'blog_image_border_radius',
			  	[
				  	'label' 		=> esc_html__( 'Border Radius', 'remons' ),
				 	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .media .box-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			 	 ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'blog_image_border',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .media .box-img img',
				]
			);

	  	$this->end_controls_section();

	  	// BEGIN META STYLE
		$this->start_controls_section(
		    'section_meta',
		    [
			    'label' => esc_html__( 'Meta', 'remons' ),
			    'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

		    $this->add_responsive_control(
			  	'margin_meta',
			  	[
				  	'label' 		=> esc_html__( 'Margin', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .ova-blog-slider .item .content .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
			);

			$this->add_group_control(
			    \Elementor\Group_Control_Typography::get_type(),
			    [
				    'name' 		=> 'link_meta_typography',
				    'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .content .item-meta .right',
			    ]
			);

			$this->add_control(
			    'link_color_meta',
			    [
				    'label' 	=> esc_html__( 'Color', 'remons' ),
				    'type' 		=> \Elementor\Controls_Manager::COLOR,
				    'selectors' => [
				    	'{{WRAPPER}} .ova-blog-slider .item .content .item-meta .right' => 'color : {{VALUE}};',
					    '{{WRAPPER}} .ova-blog-slider .item .content .item-meta .right a' => 'color : {{VALUE}};',
				    ],
			    ]
			);

			$this->add_control(
			    'link_color_meta_hover',
			    [
				    'label' 	=> esc_html__( 'Color Hover', 'remons' ),
				    'type' 		=> \Elementor\Controls_Manager::COLOR,
				    'selectors' => [
					    '{{WRAPPER}} .ova-blog-slider .item .content .item-meta .right a:hover' => 'color : {{VALUE}};',
				    ],
			    ]
			);

			$this->add_control(
			  	'icon_color_meta',
			  	[
				  	'label' 	=> esc_html__( 'Icon Color', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::COLOR,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-blog-slider .item .content .item-meta .left' => 'color : {{VALUE}};',
				  	],
			  	]
			);

			$this->add_responsive_control(
				'icon_size_meta',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 70,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .content .item-meta .left i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

	  	$this->end_controls_section();

	  	// SECTION TAB STYLE TITLE
	  	$this->start_controls_section(
		  	'section_title',
		  	[
			  	'label' => esc_html__( 'Title', 'remons' ),
			  	'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
		  	]
	  	);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .content .post-title',  
				]
			);

			$this->add_control(
				  'color_title',
				  [
					  'label' 		=> esc_html__( 'Color', 'remons' ),
					  'type' 		=> \Elementor\Controls_Manager::COLOR,
					  'selectors' 	=> [
						  '{{WRAPPER}} .ova-blog-slider .item .content .post-title a' => 'color : {{VALUE}};',
					  ],
				  ]
			);
	  
			$this->add_control(
				  'color_title_hover',
				  [
					  'label' 		=> esc_html__( 'Color Hover', 'remons' ),
					  'type' 		=> \Elementor\Controls_Manager::COLOR,
					  'selectors' 	=> [
						  '{{WRAPPER}} .ova-blog-slider .item:hover .content .post-title a' => 'color : {{VALUE}};',
					  ],
				  ]
			);
	  
			$this->add_responsive_control(
				  'margin_title',
				  [
					  'label' 		=> esc_html__( 'Margin', 'remons' ),
					  'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
					  'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					  'selectors' 	=> [
						  '{{WRAPPER}} .ova-blog-slider .item .content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					  ],
				  ]
			);
	  
			$this->add_responsive_control(
				'padding_title',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

	    $this->end_controls_section();
	    // END SECTION TAB STYLE TITLE

		// SHORT DESC STYLE
		$this->start_controls_section(
			'section_short_desc',
			[
				'label' 	=> esc_html__( 'Short Description', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
				  	'show_short_desc' => 'yes'
				],
			]
		);
  
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'short_descypography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .content .short_desc p',
				]
			);
	  
			$this->add_control(
				'color_short_desc',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						  '{{WRAPPER}} .ova-blog-slider .short_desc p' => 'color : {{VALUE}};',
					],
				]
			);
	  
			$this->add_responsive_control(
				'margin_short_desc',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content .short_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	  
			$this->add_responsive_control(
				'padding_short_desc',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content .short_desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);  
  
		$this->end_controls_section(); // END SECTION TAB STYLE TITLE
		
	  	// DATE TAB
	  	$this->start_controls_section(
		  'date_section',
		  	[
			  	'label' 	=> esc_html__( 'Date', 'remons' ),
			  	'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			  	'condition' => [
				  	'show_date' => 'yes',
				  	'template!' => 'template2',
				],
		  	]
	  	);

	  		$this->add_control(
				'date_position',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .media .post-date' => ' right:unset ; {{VALUE}} : 20px',
					],
				]
			);

		  	$this->add_group_control(
			  	\Elementor\Group_Control_Typography::get_type(),
			  	[
				  	'name' 		=> 'date_top_typography',
				  	'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .post-date', 
			  	]
		  	);
		  
  
		  	$this->add_control(
			  	'date_color',
			  	[
				  	'label' 	=> esc_html__( 'Color', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::COLOR,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-blog-slider .item .media .post-date' => 'color : {{VALUE}};',
				  	],
			  	]
		  	);
  
		  	$this->add_control(
			  	'date_color_hover',
			  	[
				  	'label' 	=> esc_html__( 'Color Hover', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::COLOR,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-blog-slider .item:hover .media .post-date' => 'color : {{VALUE}};',
				  	],
			  	]
		  	);

			$this->add_control(
			  	'bg_date_color',
			  	[
				  	'label' 	=> esc_html__( 'Background', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::COLOR,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-blog-slider .item .post-date' => 'background-color : {{VALUE}};',
				  	],
			  	]
		 	);
  
			$this->add_control(
			  	'bg_date_color_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item:hover .post-date' => 'background-color : {{VALUE}};',
					],
				]
			);
	  
		$this->end_controls_section(); 

		// SECTION TAB CATEGORY
	  	$this->start_controls_section(
		  	'section_post_category_style',
		  	[
			  	'label' 	=> esc_html__( 'Post Category', 'remons' ),
			  	'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			  	'condition' => [
			  		'show_category' => 'yes',
			  		'template!' 	=> 'template2',
			  	]
		  	]
	  	);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'category_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .media .post-category',  
				]
			);

			$this->add_control(
				'color_category',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .media .post-category' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_category',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .media .post-category' => 'background-color : {{VALUE}};',
					],
				]
			);
	  
			$this->add_responsive_control(
				'padding_category',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .media .post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

	    $this->end_controls_section();

	    // DATE TAB TEMPLATE 2
	    $this->start_controls_section(
		  'date2_section',
		  	[
			  	'label' 	=> esc_html__( 'Date', 'remons' ),
			  	'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			  	'condition' => [
				  	'show_date' => 'yes',
				  	'template' 	=> 'template2',
				],
		  	]
	    );

			$this->add_group_control(
			  	\Elementor\Group_Control_Typography::get_type(),
			  	[
				  	'name' 		=> 'date2_typography',
				  	'selector' 	=> '{{WRAPPER}} .ova-blog .item .content .post-date', 
			  	]
		  	);
		  
  
		  	$this->add_control(
			  	'date2_color',
			  	[
				  	'label' 	=> esc_html__( 'Color', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::COLOR,
				  	'selectors' => [
					  	'{{WRAPPER}} .ova-blog .item .content .post-date' => 'color : {{VALUE}};',
				  	],
			  	]
		  	);
	  
		$this->end_controls_section(); 

		//SECTION TAB CATEGORY TEMPLATE 2
	  	$this->start_controls_section(
		  	'section_post_category2_style',
		  	[
			  	'label' 	=> esc_html__( 'Post Category', 'remons' ),
			  	'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			  	'condition' => [
			  		'show_category' => 'yes',
			  		'template' 		=> 'template2',
			  	]
		  	]
	  	);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'category2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog .item .content .post-category',  
				]
			);

			$this->add_control(
				'color_category2',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog .item .content .post-category' => 'color : {{VALUE}};',
					],
				]
			);

	    $this->end_controls_section();
  
	    //SECTION TAB STYLE READMORE
	    $this->start_controls_section(
		    'section_readmore',
		    [
			    'label' => esc_html__( 'Read More Button', 'remons' ),
			    'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
		    ]
	    );

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
				  	'name' 		=> 'readmore_typography',
				  	'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .content .read-more',
				]
			);

			$this->add_responsive_control(
				'read_more_icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' 	=> [
						'px' 	=> [
							'min' 	=> 0,
							'max' 	=> 40,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slider .item .content .read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-blog-slider .item .content .read-more svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
			  	'padding_read_more',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
  
		  	$this->add_responsive_control(
			  	'margin_read_more',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slider .item .content .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		  	$this->start_controls_tabs(
				'read_more_tabs'
			);

				$this->start_controls_tab(
					'style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'color_link_read_more',
						[
							'label' 	=> esc_html__( 'Link Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_icon_read_more',
						[
							'label' 	=> esc_html__( 'Icon Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more svg' => 'fill : {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' 		=> 'background_button_read_more',
							'types' 	=> [ 'classic', 'gradient'],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slider .item .content .read-more',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'color_link_read_more_hover',
						[
							'label' 	=> esc_html__( 'Link Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more:hover' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_icon_read_more_hover',
						[
							'label' 	=> esc_html__( 'Icon Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more:hover i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-blog-slider .item .content .read-more:hover svg' => 'fill : {{VALUE}};',
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
		
		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Template style
		$template_style = remons_get_meta_data( 'template_style', $settings );

		// Category
		$category = remons_get_meta_data( 'category', $settings );

		// Total count
		$total_count = remons_get_meta_data( 'total_count', $settings );

		// Order
		$order = remons_get_meta_data( 'order', $settings );

		// Orderby
		$order_by = remons_get_meta_data( 'order_by', $settings );

		// Order text
		$order_text = remons_get_meta_data( 'order_text', $settings, '12' );

		// Show date
		$show_date = remons_get_meta_data( 'show_date', $settings );

		// Show category
		$show_category = remons_get_meta_data( 'show_category', $settings );

		// Show author
		$show_author = remons_get_meta_data( 'show_author', $settings );

		// Show short description
		$show_short_desc = remons_get_meta_data( 'show_short_desc', $settings );

		// Show comment
		$show_comment = remons_get_meta_data( 'show_comment', $settings );

		// Show read more
		$show_read_more = remons_get_meta_data( 'show_read_more', $settings );

		// Text read more
		$text_readmore = remons_get_meta_data( 'text_readmore', $settings );

		// Show icon
		$show_icon = remons_get_meta_data( 'show_icon', $settings );

		// Icon read more
		$icon_readmore = remons_get_meta_data( 'icon_readmore', $settings );

		// Arguments query
		$args = [];
		
		if ( 'all' == $category ) {
		  	$args = [
			  	'post_type' 		=> 'post',
			  	'post_status'       => 'publish',
			  	'posts_per_page' 	=> $total_count,
			  	'order' 			=> $order,
			  	'orderby' 			=> $order_by,
			  	'fields'			=> 	'ids'
		  	];
		} else {
		  	$args = [
			  	'post_type' 		=> 'post',
			  	'post_status'       => 'publish',
			  	'category_name'		=>	$category,
			  	'posts_per_page' 	=> 	$total_count,
			  	'order' 			=> 	$order,
			  	'orderby' 			=>  $order_by,
			  	'fields'			=> 	'ids'
		  	];
		}

		// Get blog IDs
		$blog_ids = get_posts( $args );

		// Carousel options
		$data_options = [
			'items' 				=> remons_get_meta_data( 'item_number', $settings ),
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_items', $settings ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'dots' 					=> 'yes' === remons_get_meta_data( 'dot_control', $settings ) ? true : false,
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings, '3000' ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartSpeed', $settings, '500' ),
			'rtl' 					=> is_rtl() ? true: false
		];

		?>

		<div class="ova-blog-slider ova-blog blog-<?php echo esc_attr( $template );?> <?php echo esc_attr( $template_style ); ?> blog-slider owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
			<?php if ( remons_array_exists( $blog_ids ) ):
				foreach ( $blog_ids as $blog_id ):
					// Blog title
					$blog_title = get_the_title( $blog_id );

					// Blog link detail
					$blog_link = get_the_permalink( $blog_id );

					// Thumbnail
					$thumbnail_id 	= get_post_thumbnail_id( $blog_id );
					$thumbnail_url 	= wp_get_attachment_image_url( $thumbnail_id, 'remons_thumbnail' );
					$thumbnail_alt 	= get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

					if ( !$thumbnail_url ) $thumbnail_url = \Elementor\Utils::get_placeholder_image_src();
					if ( !$thumbnail_alt ) $thumbnail_alt = get_the_title( $blog_id );

					// Get categories
				  	$categories = get_the_category( $blog_id );
			?>
				<div class="item">
					<div class="media">
						<div class="box-img">
					  		<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
							  	<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
						  	</a>
					  	</div>
					  	<?php if ( 'template2' != $template ):
					  		if ( 'yes' === $show_date ): ?>
								<div class="post-date">
									<span class="date-j">
										<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
									</span>
									<span class="date-MY">
										<?php echo esc_html( get_the_time( 'M' , $blog_id ) ); ?>
									</span>
								</div>
							<?php endif;

							if ( 'yes' === $show_category && remons_array_exists( $categories ) ): ?>
							  	<div class="post-category">
								  	<span class="category">
								  		<?php echo esc_html( $categories[0]->name ); ?>
								  	</span>           
							  	</div>
						  	<?php endif;
						endif; ?>
					</div>
					<div class="content">
					  	<ul class="post-meta">
						  	<?php if ( 'yes' === $show_author ):
						  		$author_id = get_post_field( 'post_author', $blog_id );
						  	?>
							  	<li class="item-meta wp-author">
								  	<span class="left author">
									   	<?php echo wp_kses_post( get_avatar( $author_id ) ); ?>
								  	</span>
								  	<span class="right post-author">
								  		<span class="by">
								  			<?php esc_html_e( 'by', 'remons' ); ?>
								  		</span>
									  	<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
										  	<?php echo wp_kses_post( get_the_author_meta( 'display_name', $author_id ) ); ?>
									  	</a>
								  	</span>
							  	</li>
					  		<?php endif; ?>

					  		<?php if ( 'yes' === $show_comment && 'template1' === $template && 'template_style2' === $template_style ) : ?>
							  	<li class="item-meta post-comment">
								  	<span class="left comment">
									  	<i class="fas fa-comments"></i>
								  	</span>
								  	<span class="right comment">
									  	<?php echo wp_kses_post( get_comments_number_text( false, false, false, $blog_id ) ) ; ?> 
								  	</span>            
							  	</li>
						    <?php endif; ?>
					  	</ul>

					  	<?php if ( 'template2' === $template && 'template_style2' === $template_style ):
					  		if ( 'yes' === $show_date ): ?>
								<div class="post-date">
									<span class="left">
									  	<i class="flaticon flaticon-calendar"></i>
								  	</span>
									<span class="date-j">
										<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
									</span>
									<span class="date-MY">
										<?php echo esc_html( get_the_time( 'F,', $blog_id ) ); ?>
									</span>
									<span class="date-MY">
										<?php echo esc_html( get_the_time( 'Y', $blog_id ) ); ?>
									</span>
								</div>
							<?php endif;

							// Categories
							if ( 'yes' === $show_category && remons_array_exists( $categories ) ) : ?>
							  	<div class="post-category">
							  		<span class="left">
									  	<i class="ovaicon ovaicon-folder-1"></i>
								  	</span>
								  	<span class="category">
								  		<?php echo esc_html( $categories[0]->name ); ?>
								  	</span>           
							  	</div>
						  	<?php endif;
						endif; ?>
					
					  	<h2 class="post-title">
						  	<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
								<?php echo wp_kses_post( $blog_title ); ?>
						  	</a>
					  	</h2>

					  	<?php if ( 'yes' === $show_short_desc ): ?> 
						  	<div class="short_desc">
							  	<p>
							  		<?php echo wp_kses_post( remons_custom_text( get_the_excerpt(), $order_text ) ); ?>
							  	</p>
						  	</div>
					  	<?php endif;

					  	if ( 'template2' === $template && 'template_style1' === $template_style ):
					  		if ( 'yes' === $show_date ): ?>
								<div class="post-date">
									<span class="date-j">
										<?php echo esc_html( get_the_time( 'j' , $blog_id ) ); ?>
									</span>
									<span class="date-MY">
										<?php echo esc_html( get_the_time( 'F' , $blog_id ) ); ?>
									</span>
								</div>
							<?php endif;

							// Category
							if ( 'yes' === $show_category && remons_array_exists( $categories ) ) : ?>
							  	<div class="post-category">
								  	<span class="category">
								  		<?php echo esc_html( $categories[0]->name ); ?>
								  	</span>           
							  	</div>
						  	<?php endif;
						endif;

						// Comment
						if ( 'yes' === $show_comment || 'yes' === $show_read_more ): ?>
						  	<div class="divider"></div>
					  		<div class="bottom-content">
					  			<?php if ( 'yes' === $show_comment ): ?>
								    <ul class="post-meta">
									  	<li class="item-meta post-comment">
										  	<span class="left comment">
											  	<i class="fas fa-comments"></i>
										  	</span>
										  	<span class="right comment">
											  	<?php echo wp_kses_post( get_comments_number_text( false, false, false, $blog_id ) ) ; ?> 
										  	</span>            
									  	</li>
								  	</ul>
							    <?php endif;

							    // Read more button
							    if ( 'yes' === $show_read_more ): ?>
							  		<a class="read-more" href="<?php echo esc_url( $blog_link ); ?>">	
								  		<?php if ( 'yes' === $show_icon ) {
								  			\Elementor\Icons_Manager::render_icon( $icon_readmore, [ 'aria-hidden' => 'true' ] ); 
								  		} ?>
								  		<span class="text-button">
										  	<?php echo wp_kses_post( $text_readmore ); ?>
								  		</span>
									</a>
							  	<?php endif; ?>
							</div>	
					    <?php endif; ?>
					</div>
				</div>
			<?php endforeach;
			endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Blog_Slider() );