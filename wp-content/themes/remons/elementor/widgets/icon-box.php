<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Icon_Box
 */
class Remons_Elementor_Icon_Box extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_icon_box';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Icon Box', 'remons' );
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
		return [ '' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-icon-box', REMONS_URI.'/assets/scss/elementor/icons/icon-box.css' );
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

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-buy',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_control(
				'link',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
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
				]
			);

			$this->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
					'default' 		=> esc_html__( 'Culture', 'remons' ),
					'placeholder' 	=> esc_html__( 'Type your title here', 'remons' ),
					'rows' 			=> 3,
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
					'condition' 	=> [
						'template' 	=> 'template1',
					],
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Read More', 'remons' ),
					'condition' => [
						'template' 				=> 'template1',
						'show_button_read_more' => 'yes',
					],
				],
			);

			$this->add_control(
				'icon_button',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-next-4',
						'library' 	=> 'ovaicon',
					],
					'condition' => [
						'template' 				=> 'template1',
						'show_button_read_more' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'General', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'general_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box .iconbox ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'general_border',
					'selector' 	=> '{{WRAPPER}} .ova-icon-box .iconbox',
				]
			);

			$this->start_controls_tabs(
				'general_style_tabs'
			);

			$this->start_controls_tab(
				'general_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'remons' ),
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' 		=> 'general_box_shadow',
						'selector' 	=> '{{WRAPPER}} .ova-icon-box .iconbox',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'background_color',
						'types' 	=> [ 'classic', 'gradient' ],
						'selector' 	=> '{{WRAPPER}} .ova-icon-box .iconbox',
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'general_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'remons' ),
				]
			);
				
				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' 		=> 'general_box_shadow_hover',
						'label' 	=> esc_html__( 'Box Shadow ', 'remons' ),
						'selector' 	=> '{{WRAPPER}} .ova-icon-box:hover .iconbox',
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'background_color_hover',
						'types' 	=> [ 'classic', 'gradient' ],
						'selector' 	=> '{{WRAPPER}} .ova-icon-box:hover .iconbox',
					]
				);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'general_alignment',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
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
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'template' => 'template1',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_section',
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
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 200,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-icon-box .iconbox .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_background_size',
				[
					'label' 		=> esc_html__( 'Background Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 400,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'template' => 'template1',
					],
				]
			);

			$this->add_responsive_control(
				'icon_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box .iconbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'background_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'template' => 'template1',
					],
				]
			);

			$this->start_controls_tabs(
				'style_tabs'
			);

			$this->start_controls_tab(
				'icon_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'remons' ),
				]
			);

				$this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box .iconbox .icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box .iconbox .icon svg' => 'fill: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box .iconbox .icon svg path' => 'fill: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_background_color',
					[
						'label' 	=> esc_html__( 'Background Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box .iconbox .icon' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'template' => 'template1',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' 		=> 'icon_box_shadow',
						'selector' 	=> '{{WRAPPER}} .ova-icon-box .iconbox .icon',
						'condition' => [
							'template' => 'template1',
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'icon_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'remons' ),
				]
			);

				$this->add_control(
					'icon_hover_color',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon svg' => 'fill: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon svg path' => 'fill: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_background_hover_color',
					[
						'label' 	=> esc_html__( 'Background Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box:hover .iconbox .icon' => 'background-color: {{VALUE}}',
						],
						'condition' => [
							'template' => 'template1',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' 		=> 'icon_box_shadow_hover',
						'label' 	=> esc_html__( 'Box Shadow ', 'remons' ),
						'selector' 	=> '{{WRAPPER}} .ova-icon-box:hover .iconbox .icon',
						'condition' => [
							'template' => 'template1',
						],
					]
				);

			$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'content_title',
			[
				'label' => esc_html__( 'Title', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .title' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'title_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .title' => 'background-color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-icon-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'content_description',
			[
				'label' => esc_html__( 'Description', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-box .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box .description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'description_hover_color',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-box:hover .description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'description_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);	

		$this->end_controls_section();

		$this->start_controls_section(
			'button_readmore_section',
				[
					'label' 	=> esc_html__( 'Button Readmore', 'remons' ),
					'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
						'template' => 'template1',
					],
				]
			);

				$this->add_responsive_control(
					'button_readmore_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-icon-box .button-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'text_button_heading',
					[
						'label' 	=> esc_html__( 'Text', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'text_button_typography',
						'selector' 	=> '{{WRAPPER}} .ova-icon-box .button-readmore .text-button',
					]
				);

				$this->add_control(
					'text_button_color',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box .button-readmore .text-button' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'text_button_color_hover',
					[
						'label' 	=> esc_html__( 'Color Hover', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box:hover .button-readmore .text-button' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'text_button_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-icon-box .button-readmore .text-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'icon_button_heading',
					[
						'label' 	=> esc_html__( 'Icon', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);

				$this->add_responsive_control(
					'icon_button_size',
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
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box .button-readmore .icon-button i' => 'font-size: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .ova-icon-box .button-readmore .icon-button svg' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'icon_button_color',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box .button-readmore .icon-button i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box .button-readmore .icon-button svg' => 'fill: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_button_color_hover',
					[
						'label' 	=> esc_html__( 'Color Hover', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-icon-box:hover .button-readmore .icon-button i' => 'color: {{VALUE}}',
							'{{WRAPPER}} .ova-icon-box:hover .button-readmore .icon-button svg' => 'fill: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'icon_button_background_color',
						'types' 	=> [ 'classic', 'gradient' ],
						'selector' 	=> '{{WRAPPER}} .ova-icon-box .button-readmore',
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

		// Get icon
		$icon = remons_get_meta_data( 'icon', $settings );

		// Get templates
		$templates = remons_get_meta_data( 'template', $settings );

		// Get title
		$title = remons_get_meta_data( 'title', $settings );

		// Description
		$description = remons_get_meta_data( 'description', $settings );

		// Get url
		$url = isset( $settings['link']['url'] ) ? $settings['link']['url'] : '';

		// Show button read more
		$show_button_read_more = remons_get_meta_data( 'show_button_read_more', $settings );

		// Button text
		$text_button = remons_get_meta_data( 'text_button', $settings );

		// Button icon
		$icon_button = remons_get_meta_data( 'icon_button', $settings );

		// Target
		$target = isset( $settings['link']['is_external'] ) ? '_blank' : '_self';

		?>

		<div class="ova-icon-box <?php echo esc_attr( $templates ); ?>"> 
			<?php if ( 'template2' === $templates ): ?>
				<?php if ( $url ): ?>	
					<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php endif;
					if ( $title ): ?>
						<h3 class="title"><?php echo esc_html( $title ); ?></h3>
	                <?php endif; ?>
                <?php if ( $url ): ?>	
					</a>
				<?php endif;
			endif; ?>
		
			<div class="iconbox">
				<?php if ( 'template1' === $templates ): ?>
					<?php if ( $url ):  ?>	
						<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
					<?php endif;
						if ( $title ): ?>
							<h3 class="title"><?php echo esc_html( $title ); ?></h3>
		                <?php endif;
		            if ( $url ): ?>	
						</a>
					<?php endif;
				endif; ?>

                <?php if ( $description && 'template1' === $templates ): ?>
					<p class="description"><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>

				<?php if ( $url ):  ?>	
					<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php endif; ?>
				<span class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
				</span>
				<?php if ( $url ):  ?>	
					</a>
				<?php endif; ?>
			</div>

			<?php if ( $description && 'template2' == $templates ): ?>
				<p class="description"><?php echo wp_kses_post( $description ); ?></p>
			<?php endif;

			if ( 'template1' === $templates && 'yes' === $show_button_read_more ):
				if ( $url ): ?>
					<a class="wrap-button" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php endif; ?>
					<div class="button-readmore">
						<span class="text-button"><?php echo esc_html( $text_button ); ?></span>
						<span class="icon-button"><?php \Elementor\Icons_Manager::render_icon( $icon_button , [ 'aria-hidden' => 'true' ] ); ?></span> 
					</div> 
				<?php if ( $url ): ?>	
					</a>
				<?php endif;
			endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Icon_Box() );