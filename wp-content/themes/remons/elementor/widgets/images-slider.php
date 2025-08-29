<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Images_Slider
 */
class Remons_Elementor_Images_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_images_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Images Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slides';
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
		return [ 'remons-elementor-images-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-images-slider', REMONS_URI.'/assets/scss/elementor/images/images-slider.css' );
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
					'label'		=> esc_html__( 'Template', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::SELECT,
					'default'	=> 'template1',
					'options'	=> [
						'template1'  => esc_html__( 'Template 1', 'remons' ),
						'template2'	 => esc_html__( 'Template 2', 'remons' ),
					],
				]
			);

			// Template1
			$this->add_control(
				'list_image',
				[
					'label' 	=> esc_html__( 'Add Images', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::GALLERY,
					'default' 	=> [],
					'condition'		=> [
						'template'	=> 'template1'
					],
				]
			);

			$this->add_control(
				'show_caption',
				[
					'label' 		=> esc_html__( 'Show Caption', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'condition'		=> [
						'template'	=> 'template1'
					],
				]
			);

			// Template2
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'image',
					[
						'label'		=> esc_html__( 'Image', 'remons' ),
						'type'		=> \Elementor\Controls_Manager::MEDIA,
						'default' 	=> [
							'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'title',
					[
						'label'		=> esc_html__( 'Title', 'remons' ),
						'type'		=> \Elementor\Controls_Manager::TEXTAREA,
						'default'	=> esc_html__( 'Doctor Consultations', 'remons' ),
					]
				);

				$repeater->add_control(
					'sub_title',
					[
						'label'		=> esc_html__( 'Sub-Title', 'remons' ),
						'type'		=> \Elementor\Controls_Manager::TEXTAREA,
						'default'	=> esc_html__( 'Medical Clinic', 'remons' ),
					]
				);

				$repeater->add_control(
					'link_button',
					[
						'label' 		=> esc_html__( 'Link Button', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
						'options' 		=> [ 'url', 'is_external', 'nofollow' ],
						'default' 		=> [
							'url'			=> '#',
							'is_external' 	=> false,
							'nofollow' 		=> false,
						],
						'label_block' 	=> true,
					]
				);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Item Images Slider', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::REPEATER,
					'fields'	=> $repeater->get_controls(),
					'default'	=> [
						[
							'title'		=> esc_html__( 'Doctor Consultations', 'remons' ),
							'sub_title' => esc_html__( 'Medical Clinic', 'remons' ),
						]
					],
					'condition'		=> [
							'template'	=> 'template2'
						],
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' 		=> esc_html__( 'Show Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'condition'		=> [
						'template'	=> 'template2'
					],
				]
			);

			$this->add_control(
				'show_sub_title',
				[
					'label' 		=> esc_html__( 'Show Sub-Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'condition'		=> [
						'template'	=> 'template2'
					],
				]
			);

			$this->add_control(
				'show_button',
				[
					'label' 		=> esc_html__( 'Show Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'condition'		=> [
						'template'	=> 'template2'
					],
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
						'show_button' => 'yes', 
						'template'	=> 'template2',
					],
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-diagonal-arrow',
						'library' 	=> 'all',	
					],
					'condition' => [
					  	'show_button' 	=> 'yes', 
					  	'show_icon' 	=> 'yes',
					  	'template'	=> 'template2',
					],
				]
			);



		$this->end_controls_section();

		// Additinal options carousel
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
					'default'     => 5,
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
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
					'condition'		=> [
						'template'	=> 'template1'
					],
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
					'condition'		=> [
						'template'	=> 'template1'
					],
				]
			);

			$this->add_control(
				'rtl',
				[
					'label'   => esc_html__( 'Right to Left', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
					'condition'		=> [
						'template'	=> 'template1'
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 600,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'max-width:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 600,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 20,
							'max' 	=> 100,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'width:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 600,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'height:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'general_image_opacity',
				[
					'label' => esc_html__( 'Opacity', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' 	=> [
							'max' 	=> 1,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->add_control(
				'general_image__hover_opacity',
				[
					'label' => esc_html__( 'Hover Opacity', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' 	=> [
							'max' 	=> 1,
							'step' 	=> 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-item:hover img' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->add_control(
				'image_object_fit',
				[
					'label' 	=> esc_html__( 'Object Fit', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'contain',
					'options' 	=> [
						'contain' 	=> esc_html__( 'Contain', 'remons' ),
						'cover'  	=> esc_html__( 'Cover', 'remons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'object-fit:{{VALUE}};',
					],
				]
			);

			$this->add_control(
				'image_color',
				[
					'label' 	=> esc_html__( ' Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'brightness(1)',
					'options' 	=> [
						'brightness(0) invert(1)' 	=> esc_html__( 'White', 'remons' ),
						'brightness(1)'  			=> esc_html__( 'Normal', 'remons' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img' => 'filter:{{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-item .item-images-slider' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-item .item-images-slider:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel img, {{WRAPPER}} .ova-images-slider .item-images-slider .caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .item-images-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_dot',
			[
				'label' 	=> esc_html__( 'Dots', 'remons' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'dot_control' => 'yes',
					'template'	=> 'template1',
				]
			]
		);

			$this->add_control(
				'dot_color',
				[
					'label'     => esc_html__( 'Dot Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-dots button' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dot_active_color',
				[
					'label'     => esc_html__( 'Dot Active Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-dots button.active' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dot_width',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-dots button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dots_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-dots button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_nav',
			[
				'label' 	=> esc_html__( 'Nav', 'remons' ),
				'tab'   	=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav_control' => 'yes',
					'template'	=> 'template1'
				]
			]
		);

			$this->add_responsive_control(
				'align_nav',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'flex-end' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav' => 'justify-content: {{VALUE}}',
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav:before, {{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav:after' => 'content: none',
					],
				]
			);

			$this->add_responsive_control(
				'nav_top',
				[
					'label' => esc_html__( 'Top', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -300,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'nav_width',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'icon_size_nav',
				[
					'label' 		=> esc_html__( 'Icon Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);	

			$this->add_control(
				'line__bg_color_',
				[
					'label'     => esc_html__( 'Line Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav:before, {{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav:after' => 'background-color : {{VALUE}};',
					],
				]
			);
			
			$this->add_control(
				'nav__bg_color_',
				[
					'label'     => esc_html__( 'Background', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button' => 'background-color : {{VALUE}};',
					],
				]
			);	

			$this->add_control(
				'nav__bg_color_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_icon_color',
				[
					'label'     => esc_html__( 'Icon', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button i' => 'color : {{VALUE}};',
					],
				]
			);			

			$this->add_control(
				'nav__bg_icon_color_hover',
				[
					'label'     => esc_html__( 'Icon Hover', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button:hover i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'nav__border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-images-slider.owl-carousel .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Get list image template 1
		$list_image = remons_get_meta_data( 'list_image', $settings, [] );

		// Get tab item template 2
		$tab_item = remons_get_meta_data( 'tab_item', $settings );

		// Carousel options
		$data_options = [
			'items' 				=> remons_get_meta_data( 'item_number', $settings, 6 ),
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_items', $settings, 0 ),
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings, '3000' ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartspeed', $settings, '500' ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'dots' 					=> 'yes' === remons_get_meta_data( 'dot_control', $settings ) ? true : false,
			'nav' 					=> 'yes' === remons_get_meta_data( 'nav_control', $settings ) ? true : false,
			'rtl' 					=> 'yes' === remons_get_meta_data( 'rtl', $settings ) ? true : false,
		];

		// Show caption Template 1
		$show_caption = remons_get_meta_data( 'show_caption', $settings );

		// Show caption Template 2
		$show_sub_title = remons_get_meta_data( 'show_sub_title', $settings );

		// Show title
		$show_title = remons_get_meta_data( 'show_title', $settings );

		// Show button
		$show_button = remons_get_meta_data( 'show_button', $settings );

		// Show icon
		$show_icon = remons_get_meta_data( 'show_icon', $settings );

		// Icon button
		$icon_button = remons_get_meta_data( 'icon_button', $settings );

		?>

		<div class="ova-images-slider owl-carousel owl-theme <?php echo esc_attr( $template ) ?>" data-options="<?php echo esc_attr(json_encode( $data_options ) ); ?>">
			<?php if ( $template === 'template1' && remons_array_exists( $list_image ) ): ?>
				<?php foreach ( $list_image as $item ):
					// Thumbnail ID
					$thumbnail_id = remons_get_meta_data( 'id', $item );
					if ( !$thumbnail_id ) continue;

					// Get url
					$url = remons_get_meta_data( 'url', $item );

					// Get alt
					$alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

					// Caption
					$caption = wp_get_attachment_caption( $thumbnail_id );
					if ( !$caption ) $caption = $alt; ?>
				    <div class="item-images-slider">
				    	<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
				    	<?php if ( $caption && 'yes' === $show_caption ): ?>
				    		<div class="caption">
				    			<?php echo esc_html( $caption ); ?>
				    		</div>
				    	<?php endif; ?>
				    </div>
				<?php endforeach; ?>
	
			<?php elseif ( $template === 'template2' && remons_array_exists( $tab_item ) ): ?>
				<?php foreach ( $tab_item as $item ):
					$thumbnail_id = remons_get_meta_data( 'image', $item );
					if ( ! $thumbnail_id ) continue;

					$image_url = remons_get_meta_data( 'url', $thumbnail_id );

					$link = remons_get_meta_data( 'link_button', $item );
					$button_url = remons_get_meta_data( 'url', $link ) ?: '';

					$rel = remons_get_meta_data( 'nofollow', $link ) ? 'nofollow' : '';
					$target = remons_get_meta_data( 'is_external', $link ) ? '_blank' : '_self';

					$alt = remons_get_meta_data( 'title', $item, esc_html__( 'Image', 'remons' ) );
				?>
					<div class="item-images-slider">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">

						<div class="text-wrapper">
							<?php if ( remons_get_meta_data( 'title', $item ) && 'yes' === $show_title ): ?>
								<div class="title"><?php echo esc_html( $item['title'] ); ?></div>
							<?php endif; ?>

							<?php if ( remons_get_meta_data( 'sub_title', $item ) && 'yes' === $show_sub_title ): ?>
								<div class="caption"><?php echo esc_html( $item['sub_title'] ); ?></div>
							<?php endif; ?>
						</div>

						<?php if ( 'yes' === $show_button && $button_url ): ?>	
							<a href="<?php echo esc_attr( $button_url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" >
								<div class="button">
									<span class="icon">
										<?php if ( 'yes' === $show_icon ) {
											\Elementor\Icons_Manager::render_icon( $icon_button, ['aria-hidden' => 'true'] );
										} ?>
									</span>
								</div>
							</a>
						<?php endif; ?>

					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Images_Slider() );