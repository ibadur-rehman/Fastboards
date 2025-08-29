<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Contact_Info
 */
class Remons_Elementor_Contact_Info extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_contact_info';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Contact Info', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-email-field';
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
		return [ 'remons-elementor-contact-info' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		
		// Content Tab
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				
			]
		);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Class Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon-facebook-logo',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_control(
				'label',
				[
					'label' 	=> esc_html__( 'Label', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__('Label', 'remons'),
				]
			);

			// Repeater
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'type',
					[
						'label' 	=> esc_html__( 'Type', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::SELECT,
						'default' 	=> 'email',
						'options' 	=> [
							'email' => esc_html__( 'Email', 'remons' ),
							'phone' => esc_html__( 'Phone', 'remons' ),
							'link' 	=> esc_html__( 'Link', 'remons' ),
							'text' 	=> esc_html__( 'Text', 'remons' ),
						]
					]
				);

				$repeater->add_control(
					'email_label',
					[
						'label'   		=> esc_html__( 'Email Label', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( 'email@company.com', 'remons' ),
						'default' 		=> esc_html__( 'email@company.com', 'remons' ),
						'condition' 	=> [
							'type' => 'email',
						]

					]
				);

				$repeater->add_control(
					'email_address',
					[
						'label'   		=> esc_html__( 'Email Adress', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( 'email@company.com', 'remons' ),
						'default' 		=> esc_html__( 'email@company.com', 'remons' ),
						'condition' 	=> [
							'type' => 'email',
						]

					]
				);


				$repeater->add_control(
					'phone_label',
					[
						'label'   		=> esc_html__( 'Phone Label', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( '+012 (345) 678', 'remons' ),
						'default' 		=> esc_html__( '+012 (345) 678', 'remons' ),
						'condition' 	=> [
							'type' => 'phone',
						]

					]
				);

				$repeater->add_control(
					'phone_address',
					[
						'label'   		=> esc_html__( 'Phone Adress', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( '+012345678', 'remons' ),
						'default' 		=> esc_html__( '+012345678', 'remons' ),
						'condition' 	=> [
							'type' => 'phone',
						]

					]
				);

				$repeater->add_control(
					'link_label',
					[
						'label'   		=> esc_html__( 'Link Label', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( 'https://your-domain.com', 'remons' ),
						'default' 		=> esc_html__( 'https://your-domain.com', 'remons' ),
						'condition' 	=> [
							'type' => 'link',
						]

					]
				);

				$repeater->add_control(
					'link_address',
					[
						'label'   		=> esc_html__( 'Link Adress', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::URL,
						'description' 	=> esc_html__( 'https://your-domain.com', 'remons' ),
						'default' 		=> esc_html__( 'https://your-domain.com', 'remons' ),
						'condition' 	=> [
							'type' => 'link',
						],
						'show_external' => false,
						'default' 		=> [
							'url' 			=> '#',
							'is_external' 	=> false,
							'nofollow' 		=> false,
						],

					]
				);

				$repeater->add_control(
					'text',
					[
						'label'   		=> esc_html__( 'Text', 'remons' ),
						'type'    		=> \Elementor\Controls_Manager::TEXT,
						'description' 	=> esc_html__( 'Your text', 'remons' ),
						'default' 		=> esc_html__( 'Your text', 'remons' ),
						'condition' 	=> [
							'type' => 'text',
						]

					]
				);

				$this->add_control(
					'items_info',
					[
						'label' 	=> esc_html__( 'Items Info', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::REPEATER,
						'fields' 	=> $repeater->get_controls(),
						'default' 	=> [
							[
								'type' 			=> 'email',
								'email_label' 	=> esc_html__('email@company.com', 'remons'),
								'email_address' => esc_html__('email@company.com', 'remons'),
							],
							
						],
						'title_field' => '{{{ type }}}',
					]
				);

			$this->add_control(
				'enable_select',
				[
					'label' 		=> esc_html__( 'Enable Select', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'separator' 	=> 'before'
				]
			);

			$this->add_control(
				'select_default',
				[
					'label' 	=> esc_html__( 'Default Value', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Choose Service', 'remons' ),
					'condition' => [
						'enable_select' => 'yes'
					]
				]
			);

		$this->end_controls_section(); // End Content Tab

		// Icon Style Tab
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'icon_fontsize',
				[
					'label' 		=> esc_html__( 'Font Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-contact-info .icon svg' => 'width: {{SIZE}}{{UNIT}};',
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
							'min' 	=> 1,
							'max' 	=> 300,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'gap',
				[
					'label' 		=> esc_html__( 'Gap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 60,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'icon_position',
				[
					'label' 	=> esc_html__( 'Icon Position', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'top' => [
							'title' => esc_html__( 'Top', 'remons' ),
							'icon' 	=> 'eicon-v-align-top',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .icon i' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-contact-info .icon svg, {{WRAPPER}} .ova-contact-info .icon svg path' => 'fill : {{VALUE}};'
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info:hover .icon i' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-contact-info:hover .icon svg, {{WRAPPER}} .ova-contact-info:hover .icon svg path' => 'fill : {{VALUE}};'
					],
				]
			);

			$this->add_control(
				'icon_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info:hover .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'icon_box_shadow',
					'selector' 	=> '{{WRAPPER}} .ova-contact-info .icon',
				]
			);

			$this->add_responsive_control(
				'icon_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-contact-info .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section(); // End Icon Style Tab

		// Label Style Tab
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => esc_html__( 'Label', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'label_typography',
					'selector' 	=> '{{WRAPPER}} .ova-contact-info .contact .label',
				]
			);
			
			$this->add_control(
				'label_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .contact .label' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'label_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-contact-info .contact .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// Info Style Tab
		$this->start_controls_section(
			'section_info_style',
			[
				'label' => esc_html__( 'Info', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'info_typography',
					'selector' 	=> '{{WRAPPER}} .ova-contact-info .contact .info .item, {{WRAPPER}} .ova-contact-info .contact .info .item a',
				]
			);

			$this->add_control(
				'info_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .contact .info .item' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-contact-info .contact .info .item a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'info_color_hover',
				[
					'label' 	=> esc_html__( 'Link Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .contact .info .item a:hover' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'info_underline_color_hover',
				[
					'label' 	=> esc_html__( 'Underline Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .contact .info .item a:before' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'info_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-contact-info .contact .info .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
                'info_alignment',
                [
                    'label' 	=> esc_html__( 'Alignment', 'remons' ),
                    'type' 		=> \Elementor\Controls_Manager::CHOOSE,
                    'options' 	=> [
                        'flex-start' => [
                            'title' 	=> esc_html__( 'Flex start', 'remons' ),
                            'icon' 		=> 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'remons' ),
                            'icon' 	=> 'eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'End', 'remons' ),
                            'icon' 	=> 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ova-contact-info' => 'align-items: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'info_h_alignment',
                [
                    'label' 	=> esc_html__( 'H Alignment', 'remons' ),
                    'type' 		=> \Elementor\Controls_Manager::CHOOSE,
                    'options' 	=> [
                        'left' 	=> [
                            'title' => esc_html__( 'Flex start', 'remons' ),
                            'icon' 	=> 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'remons' ),
                            'icon' 	=> 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'End', 'remons' ),
                            'icon' 	=> 'eicon-h-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ova-contact-info' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};',
                    ],
                ]
            );

		$this->end_controls_section();

		// Select Style Tab
		$this->start_controls_section(
			'section_select_style',
			[
				'label' 	=> esc_html__( 'Select', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_select' => 'yes'
				]
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'select_typography',
					'selector' 	=> '{{WRAPPER}} .ova-contact-info .contact .select-format input[type=text]',
				]
			);
			
			$this->add_control(
				'select_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-contact-info .contact .select-format input[type=text], {{WRAPPER}} .ova-contact-info .contact .select-format .input-for-select i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'select_input_border',
					'selector' 	=> '{{WRAPPER}} .ova-contact-info .contact .select-format input[type=text]',
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

		// Get label
		$label = remons_get_meta_data( 'label', $settings );

		// Items info
		$items_info = remons_get_meta_data( 'items_info', $settings, [] );

		// Icon position
		$icon_position = remons_get_meta_data( 'icon_position', $settings );

		// Enable select
		$enable_select = remons_get_meta_data( 'enable_select', $settings );

		// Default select
		$select_default = remons_get_meta_data( 'select_default', $settings );
		
		?>

		<div class="ova-contact-info <?php echo esc_attr( $icon_position ); ?>">
			<?php if ( remons_get_meta_data( 'value', $icon ) ): ?>
				<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
				</div>	
			<?php endif; ?>
			<div class="contact">
				<?php if ( $label ): ?>
					<div class="label">
						<?php echo esc_html( $label ); ?>
					</div>
				<?php endif;

				if ( 'yes' === $enable_select ): ?>
					<div class="select-format">
						<div class="input-for-select">
							<input
								type="text"
								name="select-field"
								value="<?php echo esc_attr( $select_default ); ?>"
								readonly
							/>
							<i aria-hidden="true" class="flaticon flaticon-down-arrow"></i>
						</div>
				<?php endif; ?>
					<ul class="info">
						<?php foreach ( $items_info as $item ):
							$type = remons_get_meta_data( 'type', $item );
						?>
							<li class="item">
								<?php switch ( $type ) {
									case 'email':
										// Get email address
										$email_address = remons_get_meta_data( 'email_address', $item );

										// Get email label
										$email_label = remons_get_meta_data( 'email_label', $item );

										if ( $email_address && $email_label ): ?>
											<a href="mailto:<?php echo esc_attr( $email_address ); ?>">
												<?php echo wp_kses_post( $email_label ); ?>
											</a>
										<?php endif;
										break;
									case 'phone':
										// Phone number
										$phone_address = remons_get_meta_data( 'phone_address', $item );

										// Phone label
										$phone_label = remons_get_meta_data( 'phone_label', $item );

										if ( $phone_address && $phone_label ): ?>
											<a href="tel:<?php echo esc_attr( $phone_address ); ?>">
												<?php echo wp_kses_post( $phone_label ); ?>
											</a>
										<?php endif;
										break;
									case 'link':
										$this->add_render_attribute( 'title' );

										// Get URl
										$link_address = isset( $item['link_address']['url'] ) ? $item['link_address']['url'] : '';

										// Target
										$link_target = isset( $item['link_address']['is_external'] ) && $item['link_address']['is_external'] ? '_blank' : '_self';

										// Label
										$link_label = remons_get_meta_data( 'link_label', $item );

										if ( $link_address ): ?>
											<a href="<?php echo esc_url( $link_address ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
												<?php echo wp_kses_post( $link_label ); ?>
											</a>
										<?php else: ?>
											<span><?php echo wp_kses_post( $link_label );?></span>
										<?php endif;
										break;
									case 'text':
										$text = remons_get_meta_data( 'text', $item );
										?>
											<span><?php echo wp_kses_post( $text ); ?></span>
										<?php
										break;
									default:
										break;
								} // End switch ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php if ( 'yes' === $enable_select ): ?>
					</div>
				<?php endif; ?>	
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Contact_Info() );