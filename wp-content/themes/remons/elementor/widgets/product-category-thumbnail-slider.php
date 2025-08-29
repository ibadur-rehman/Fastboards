<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Category_Slider
 */
class Remons_Elementor_Product_Category_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {		
		return 'remons_elementor_product_category_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Category Thumbnail Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slider-push';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons-product' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		return [ 'remons-elementor-product-category-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-category-thumbnail-slider', REMONS_URI.'/assets/scss/elementor/products/product-category-slider.css' );
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);	

			$this->add_control(
				'total_categories',
				[
					'label' 	=> esc_html__( 'Total Categories', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=>  6,
				]
			);

			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Select Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
						'template3' => esc_html__( 'Template 3', 'remons' ),
					],
				]
			);

			$this->add_control(
				'link_to',
				[
					'label' 	=> esc_html__( 'Link to', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'category',
					'options' 	=> [
						'category'  => esc_html__( 'Category', 'remons' ),
						'new_page' 	=> esc_html__( 'New Page', 'remons' ),
					],
				]
			);

			$this->add_control(
				'custom_link',
				[
					'label' 		=> esc_html__( 'Custom Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'dynamic' 		=> [
						'active' => true,
					],
					'default' => [
						'url' 			=> '#',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'condition' => [
						'link_to' => 'new_page',
					],
				]
			);

			$this->add_control(
				'show_count',
				[
					'label' 		=> esc_html__( 'Show Category Count', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'text_count',
				[
					'label' 		=> esc_html__( 'Text Count', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=>  esc_html__( 'Product', 'remons' ),
					'condition'     => [
						'show_count' => 'yes'
					]
				]
			);

			$this->add_control(
				'text_count_many',
				[
					'label' 		=> esc_html__( 'Text Count *Many', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=>  esc_html__( 'Products', 'remons' ),
					'condition'     => [
						'show_count' => 'yes'
					]
				]
			);

			$this->add_control(
				'show_review',
				[
					'label' 		=> esc_html__( 'Show Category Review', 'remons' ),
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
					'label' 		=> esc_html__( 'Text Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=>  esc_html__( 'Discover', 'remons' ),
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label' => esc_html__( 'Icon Button', 'remons' ),
					'type' => \Elementor\Controls_Manager::ICONS,
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
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'remons' ),
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
		// END Additional Options

		$this->start_controls_section(
			'content_section_style',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'content_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 160,
							'max' 	=> 420,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .item-category-slider' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'overlay_bgcolor',
				[
					'label' 	=> esc_html__( 'Overlay Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .background-overlay' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'content_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .item-category-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_object_fit',
				[
					'label' 	=> esc_html__( 'Image Object Fit', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'options' 	=> [
						'' 			=> esc_html__( 'Default', 'remons' ),
						'none' 		=> esc_html__( 'None', 'remons' ),
						'fill' 		=> esc_html__( 'Fill', 'remons' ),
						'cover' 	=> esc_html__( 'Cover', 'remons' ),
						'contain' 	=> esc_html__( 'Contain', 'remons' ),
					],
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .item-category-slider img' => 'object-fit: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'name',
			[
				'label' => esc_html__( 'Name', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'name_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-slider .name',
				]
			);

			$this->add_control(
				'name_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .name' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'name_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'count',
			[
				'label' => esc_html__( 'Count', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'count_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-slider .count',
				]
			);

			$this->add_control(
				'count_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .count' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'count_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'review',
			[
				'label' => esc_html__( 'Review', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'review_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-slider .review-average .average',
				]
			);

			$this->add_control(
				'star_color',
				[
					'label' 	=> esc_html__( 'Star Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .review-average i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'review_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .review-average .average' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'review_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .review-average' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			[
				'label' => esc_html__( 'Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_button_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-slider .view-category',
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
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
						'{{WRAPPER}} .ova-product-category-slider .item-category-slider .view-category i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-product-category-slider .item-category-slider .view-category svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'text_button_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .view-category' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-product-category-slider .view-category svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'text_button_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .view-category:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-product-category-slider .view-category:hover svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .view-category' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider .view-category:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .view-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider .view-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// Nav
		$this->start_controls_section(
			'section_nav',
			[
				'label' 	=> esc_html__( 'Nav', 'remons' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav_control' => 'yes',
				]
			]
		);

			$this->add_responsive_control(
				'nav_left_postition',
				[
					'label' => esc_html__( 'Position - Left Arrow', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -300,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'nav_right_postition',
				[
					'label' => esc_html__( 'Position - Right Arrow', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -300,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'nav_width',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'icon_size_nav',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'nav__bg_color_',
				[
					'label'     => esc_html__( 'Background', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button' => 'background-color : {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'nav__bg_color_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_icon_color',
				[
					'label'     => esc_html__( 'Icon', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button i' => 'color : {{VALUE}};',
					],
				]
			);			

			$this->add_control(
				'nav__bg_icon_color_hover',
				[
					'label'     => esc_html__( 'Icon Hover', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-slider.owl-carousel .owl-nav button:hover i' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section(); // END Nav
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();
		
		// Get template
		$template = ovabrw_get_meta_data( 'template', $settings );

		// Text button
		$text_button = ovabrw_get_meta_data( 'text_button', $settings );

		// Icon button
		$icon_button = ovabrw_get_meta_data( 'icon_button', $settings );

		// Show count
		$show_count = ovabrw_get_meta_data( 'show_count', $settings );

		// Text count
		$text_count = ovabrw_get_meta_data( 'text_count', $settings );

		// Text count many
		$text_count_many = ovabrw_get_meta_data( 'text_count_many', $settings );

		// Show review
		$show_review = ovabrw_get_meta_data( 'show_review', $settings );

		// Number of total catogories
		$total_categories = (int)ovabrw_get_meta_data( 'total_categories', $settings );

		// custom link
		$new_url = '';
		if ( 'new_page' === ovabrw_get_meta_data( 'link_to', $settings ) && isset( $settings['custom_link']['url'] ) ) {
			$new_url = $settings['custom_link']['url'];
		}

		// Get categories
	  	$categories = get_categories([
	  		'taxonomy' 	 => 'product_cat',
			'number'     => $total_categories
	  	]);

	  	// Data options
	  	$data_options = [
	  		'items' 				=> ovabrw_get_meta_data( 'item_number', $settings ),
	  		'slideBy' 				=> ovabrw_get_meta_data( 'slides_to_scroll', $settings ),
	  		'margin' 				=> ovabrw_get_meta_data( 'margin_items', $settings ),
	  		'autoplayHoverPause' 	=> 'yes' === ovabrw_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
	  		'loop' 					=> 'yes' === ovabrw_get_meta_data( 'autoplay', $settings ) ? true : false,
	  		'autoplay' 				=> 'yes' === ovabrw_get_meta_data( 'autoplay', $settings ) ? true : false,
	  		'autoplayTimeout' 		=> ovabrw_get_meta_data( 'autoplayTimeout', $settings, '3000' ),
	  		'smartSpeed' 			=> ovabrw_get_meta_data( 'smartSpeed', $settings, '500' ),
	  		'dots' 					=> 'yes' === ovabrw_get_meta_data( 'dot_control', $settings ) ? true : false,
	  		'nav' 					=> 'yes' === ovabrw_get_meta_data( 'nav_control', $settings ) ? true : false,
	  		'rtl' 					=> is_rtl() ? true: false
	  	];

		if ( ovabrw_array_exists( $categories ) ): ?>
			<div class="ova-product-category-slider <?php echo esc_attr( $template ); ?> owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
				<?php foreach ( $categories as $category ):
					$term_id 		= $category->term_id;
					$thumbnail_id 	= get_term_meta( $term_id, 'thumbnail_id', true );
					$thumbnail_url 	= '';
					$thumbnail_alt 	= '';

					if ( $thumbnail_id ) {
						$thumbnail_url 	= wp_get_attachment_image_url( $thumbnail_id , 'large' );
						$thumbnail_alt 	= get_post_meta( $thumbnail_id , '_wp_attachment_image_alt', true );
					}
					if ( !$thumbnail_url ) $thumbnail_url = \Elementor\Utils::get_placeholder_image_src();

					$term_obj 	 = get_term( $term_id, 'product_cat' );
					$term_link 	 = get_term_link( $term_id );

					if ( is_object( $term_link ) && isset( $term_link->errors ) ) {
						$term_link = '#';
					}
					if ( $new_url != '' ) {
						$term_link = $new_url.'?cat='.$category->slug;
					}
				?>
					<div class="item-category-slider">
						<a href="<?php echo esc_url( $term_link ); ?>">
							<div class="background-overlay"></div>
							<div class="image-wrap">
								<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
							</div>
							<div class="info">
								<?php if ( $term_obj && ( ( 'yes' === $show_count ) || $term_obj->name ) ): ?>
									<div class="top">
										<?php if ( 'yes' === $show_count ): ?>
											<?php if ( 1 === $term_obj->count || 0 === $term_obj->count ): ?>
												<span class="count">
													<?php printf( esc_html( '%s'.' '.$text_count ), $term_obj->count ); ?>
												</span>
											<?php else: ?>
												<span class="count">
													<?php printf( esc_html( '%s'.' '.$text_count_many ), $term_obj->count ); ?>
												</span>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( 'yes' === $show_review ):
											$review_average = OVABRW()->options->get_average_product_review_by_cagegory( $term_id );
										?>
											<span class="review-average">
												<i aria-hidden="true" class="brwicon-star-2"></i>
												<span class="average">
													<?php echo esc_html( $review_average ); ?>
												</span>
											</span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( $term_obj->name ): ?>
									<h3 class="name">
										<?php echo esc_html( $term_obj->name ); ?>
									</h3>
								<?php endif; ?>
							</div>
						</a>	
						<?php if ( $text_button || ovabrw_get_meta_data( 'value', $icon_button ) ): ?>
							<a class="view-category" href="<?php echo esc_url( $term_link ); ?>">	
								<?php echo esc_html( $text_button ); ?>
								<?php if ( ovabrw_get_meta_data( 'value', $icon_button ) ) {
								 	\Elementor\Icons_Manager::render_icon( $icon_button, [ 'aria-hidden' => 'true' ] ); 
								} ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Category_Slider() );