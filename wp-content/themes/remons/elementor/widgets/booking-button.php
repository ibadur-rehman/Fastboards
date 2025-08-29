<?php if( !defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

/**
  * Class Remons_Elementor_Booking_Button
  */ 
class Remons_Elementor_Booking_Button extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_booking_button';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Booking Button', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-button';
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
		wp_enqueue_script( 'remons_elementor_booking_button', REMONS_URI.'/assets/js/elementor/booking-button.js' );
		return [ '' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style ( 'remons_elementor_booking_button', REMONS_URI.'/assets/scss/elementor/buttons/booking-button.css' );
		return [];
	}

	/**
	 * Register control
	 */
	protected function register_controls() {
		// Section content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' )
			]
		);

			$this->add_control(
				'text_button',
				[
					'label'     => esc_html__( 'Text Button', 'remons' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'default'   => esc_html__( 'Schedule Now', 'remons' ),
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label'     => esc_html__( 'Icon Button', 'remons' ),
					'type'      => \Elementor\Controls_Manager::ICONS,
					'default'   => [
						'value'     => 'fas fa-arrow-right',
						'library'   => 'all'
					]
				]
			);

			$this->add_control(
			    'icon_align',
			    [
			        'label' => esc_html__( 'Icon Position', 'remons' ),
			        'type' => \Elementor\Controls_Manager::CHOOSE,
			        'options' => [
			            'row-reverse' => [
			                'title' => esc_html__( 'Before', 'remons' ),
			                'icon' => 'eicon-arrow-left',
			            ],
			            'row' => [
			                'title' => esc_html__( 'After', 'remons' ),
			                'icon' => 'eicon-arrow-right',
			            ],
			        ],
			        'default' => 'row',
			        'toggle' => false,
			        'condition' => [
			            'icon_button[value]!' => '',
			        ],
			        'selectors' => [
			            '{{WRAPPER}} .ova-booking-button' => 'flex-direction: {{VALUE}}'
			        ]
			    ]
			);

			$this->add_control(
				'action_type_button',
				[
					'label'     => esc_html__( 'Action Button', 'remons' ),
					'type'      => \Elementor\Controls_Manager::CHOOSE,
					'options'   => [
						'popup'     => [
							'title'     => esc_html__( 'Popup booking form', 'remons' ),
							'icon'      => 'eicon-editor-code',
						],
						'product'   => [
							'title'     => esc_html__( 'Permalink', 'remons' ),
							'icon'      => 'eicon-link',
						],
						'custom'    => [
							'title'     => esc_html__( 'Custom Link', 'remons' ),
							'icon'      => 'eicon-globe',
						],
					],
					'default'	=> 'custom',
					'toggle'    => true,
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
					$product_ids[ $pid ] = get_the_title( $pid );

					// Default product
					if ( !ovabrw_array_exists( $default_product ) ) $default_product = $pid;
				}
			} else {
				$product_ids[ '' ] = esc_html__( 'There are no renral producs', 'remons' );
			}

			$this->add_control(
				'product_id',
				[
					'label'         => esc_html__( 'Choose Product', 'remons' ),
					'type'          => \Elementor\Controls_Manager::SELECT2,
					'label_block'   => true,
					'options'       => $product_ids,
					'default'       => $default_product,
					'condition'     => [
						'action_type_button'    => [ 'popup', 'product' ],
					]
				]
			);

			$this->add_control(
				'link',
				[
					'label'         => esc_html__( 'Custom URL', 'remons' ),
					'type'          => \Elementor\Controls_Manager::URL,
					'placeholder'   => 'https://your-link.com',
					'options'       => [ 'url', 'is_external', 'nofollow' ],
					'default'       => [
						'url'               => '#',
						'is_external'       => true,
						'nofollow'          => false,
					],
					'dynamic'       => [
						'active'            => true,
					],
					'label_block'   => true,
					'condition'     => [
						'action_type_button' => [ 'custom' ],
					]
				]
			);

		$this->end_controls_section();

		// Tab styles
		$this->start_controls_section(
			'button',
			[
				'label' => esc_html__( 'Button', 'remons' ),
				'tab'  => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
			    'button_display',
			    [
			        'label' => esc_html__( 'Display', 'remons' ),
			        'type' => \Elementor\Controls_Manager::CHOOSE,
			        'options' => [
			            'flex' => [
			                'title' => esc_html__( 'Flex', 'remons' ),
			                'icon' => 'eicon-h-align-left',
			            ],
			            'inline-flex' => [
			                'title' => esc_html__( 'Inline Flex', 'remons' ),
			                'icon' => 'eicon-h-align-center',
			            ],
			        ],
			        'default' => 'inline-flex',
			        'selectors' => [
			            '{{WRAPPER}} .ova-booking-button' => 'display: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'btn_typography',
					'selector' 	=> '{{WRAPPER}} .ova-booking-button span', 
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
						'{{WRAPPER}} .ova-booking-button i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-booking-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding',
				[
					'label'         => esc_html__( 'Padding', 'remons' ),
					'type'          => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .ova-booking-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin',
				[
					'label'			=> esc_html__( 'Margin', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .ova-booking-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius',
				[
					'label'			=> esc_html__( 'Border Radius', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .ova-booking-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'gap',
				[
					'label'			=> esc_html__( 'Gap', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::SLIDER,
					'size_units'	=> [ 'px' ],
					'range'			=> [
						'min'			=> 0,
						'max'			=> 100,
						'step'			=> 1,
					],
					'selectors'		=> [
						'{{WRAPPER}} .ova-booking-button' => 'gap: {{SIZE}}{{UNIT}}',
					]
				]
			);

			$this->start_controls_tabs(
				'btn_tab'
			);

				$this->start_controls_tab(
					'btn_normal_tab',
					[
						'label'	=> esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'color',
						[
							'label'			=> esc_html__( 'Color', 'remons' ),
							'type'			=> \Elementor\Controls_Manager::COLOR,
							'selectors'		=> [
								'{{WRAPPER}} .ova-booking-button' => 'color:{{VALUE}}',
								'{{WRAPPER}} .ova-booking-button svg' => 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bg_color',
						[
							'label'			=> esc_html__( 'Background Color', 'remons' ),
							'type'			=> \Elementor\Controls_Manager::COLOR,
							'selectors'		=> [
								'{{WRAPPER}} .ova-booking-button' => 'background-color:{{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'		=> 'button_border',
							'selector' 	=> '{{WRAPPER}} .ova-booking-button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'btn_hover_tab',
					[
						'label'	=> esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'color_hover',
						[
							'label'			=> esc_html__( 'Color', 'remons' ),
							'type'			=> \Elementor\Controls_Manager::COLOR,
							'selectors'		=> [
								'{{WRAPPER}} .ova-booking-button:hover' => 'color:{{VALUE}}',
								'{{WRAPPER}} .ova-booking-button:hover svg' => 'fill: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bg_color_hover',
						[
							'label'			=> esc_html__( 'Background Color', 'remons' ),
							'type'			=> \Elementor\Controls_Manager::COLOR,
							'selectors'		=> [
								'{{WRAPPER}} .ova-booking-button:hover' => 'background-color:{{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name'		=> 'button_border_hover',
							'selector' 	=> '{{WRAPPER}} .ova-booking-button:hover',
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

	}

	/**
	 * Render HTMLs
	 */
	protected function render() {
		// Get Setting
		$settings = $this->get_settings_for_display();

		// Text button
		$text_button = remons_get_meta_data( 'text_button', $settings );

		// Icon button
		$icon_button = remons_get_meta_data( 'icon_button', $settings );

		// Product
		$product_id = remons_get_meta_data( 'product_id', $settings );

		// Action type button
		$action_type_button = remons_get_meta_data( 'action_type_button', $settings );

		$link_data    = remons_get_meta_data( 'link', $settings );
		$link_url     = $link_data['url'] ?? '';
		$link_target  = !empty( $link_data['is_external'] ) ? '_blank' : '_self';

		if ( $action_type_button === 'popup' ) {
			?>
			<a class="ova-booking-button open-popup-btn" data-product-id="<?php echo esc_attr( $product_id ); ?>">
				<span class="text-button"><?php echo esc_html( $text_button ); ?></span>
				<?php \Elementor\Icons_Manager::render_icon( $icon_button, [ 'aria-hidden' => 'true' ] ); ?>

				<span class="remons-loader">
					<i class="brwicon2-spinner-of-dots" aria-hidden="true"></i>
				</span>
			</a>
			<?php
		} else {
			$url = $product_id ? get_permalink( $product_id ) : esc_url( $link_url );
			?>
			<a class="ova-booking-button" href="<?php echo $url; ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<span class="text-button"><?php echo esc_html( $text_button ); ?></span>
				<?php \Elementor\Icons_Manager::render_icon( $icon_button, [ 'aria-hidden' => 'true' ] ); ?>
			</a>
			<?php
		}
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Booking_Button() );