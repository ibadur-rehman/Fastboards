<?php if ( !defined('ABSPATH') ) exit; // Exit if accesed directly

/**
 * Class Remons_Elementor_Toggle-2
 * */
class Remons_Elementor_Toggle_2 extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 * */
	public function get_name() {
		return 'Remons_Elementor_Toggle_2';
	}

	/**
	 * Get widget title
	 * */
	public function get_title() {
		return esc_html__( 'Toggle 2', 'remons' );
	}

	/**
	 * Get widget icon
	 * */
	public function get_icon() {
		return 'eicon-toggle';
	}

	/**
	 * Get widget category
	 * */
	public function get_categories() {
		return [ 'remons' ];
	}

	/**
	 * Get script depends
	 * */
	public function get_script_depends() {
		wp_enqueue_script( 'Remons_Elementor_Toggle_2', REMONS_URI.'/assets/js/elementor/toggle-2.js', ['jquery'], '1.0', true );
		return [];
	}

	/**
	 * Get style depends
	 * */
	public function get_style_depends() {
		wp_enqueue_style( 'Remons_Elementor_Toggle_2', REMONS_URI.'/assets/scss/elementor/toggle/toggle-2.css' );
		return [];
	}

	/**
	 * Register control
	 * */
	protected function register_controls() {
		// Content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'active',
				[
					'label'			=> esc_html__( 'Active', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on'		=> esc_html__( 'Yes', 'remons' ),
					'label_off'		=> esc_html__( 'No', 'remons' ),
					'return_value'	=> 'yes',
					'default'		=> 'no'
				]
			);

			$repeater->add_control(
				'question',
				[
					'label' => esc_html__( 'Question', 'remons' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'label_block' => true,
					'default' => esc_html__( 'What is your question?', 'remons' ),
				]
			);

			$repeater->add_control(
				'answer',
				[
					'label' => esc_html__( 'Answer', 'remons' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => esc_html__( 'Here is the answer to your question.', 'remons' ),
					'show_label' => false,
				]
			);

			$this->add_control(
				'faq_items',
				[
					'label' => esc_html__( 'FAQ Items', 'remons' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'question' => esc_html__( 'What services do you offer? ', 'remons' ),
							'answer' => esc_html__( 'Our clinic is open insert hours For emergencies, we recommend  visiting our emergency department or calling emergency contact number.', 'remons' ),
						],
						[
							'question' => esc_html__( 'What are your hours of operation?', 'remons' ),
							'answer' => esc_html__( 'Our clinic is open insert hours For emergencies, we recommend  visiting our emergency department or calling emergency contact number.', 'remons' ),
						],
						[
							'question' => esc_html__( 'Do I need an appointment, or do you accept walk-ins?', 'remons' ),
							'answer' => esc_html__( 'Our clinic is open insert hours For emergencies, we recommend  visiting our emergency department or calling emergency contact number.', 'remons' ),
						],
						[
							'question' => esc_html__( 'How do I schedule an appointment?', 'remons' ),
							'answer' => esc_html__( 'Our clinic is open insert hours For emergencies, we recommend  visiting our emergency department or calling emergency contact number.', 'remons' ),
						],
						[
							'question' => esc_html__( 'What should I bring to my appointment?', 'remons' ),
							'answer' => esc_html__( 'Our clinic is open insert hours For emergencies, we recommend  visiting our emergency department or calling emergency contact number.', 'remons' ),
						],
					],
					'title_field' => '{{{ question }}}',
				]
			);

			$this->add_control(
				'show_read_more',
				[
					'label' 		=> esc_html__( 'Show Icon', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
			    'icon_open',
			    [
			        'label' => esc_html__( 'Open Icon', 'remons' ),
			        'type' => \Elementor\Controls_Manager::ICONS,
			        'default' => [
			            'value' => 'flaticon flaticon-plus',
			            'library' => 'all',
			        ],
			        'condition' => [
			            'show_read_more' => 'yes',
			        ],
			    ]
			);

			$this->add_control(
			    'icon_close',
			    [
			        'label' => esc_html__( 'Close Icon', 'remons' ),
			        'type' => \Elementor\Controls_Manager::ICONS,
			        'default' => [
			            'value' => 'ovaicon ovaicon-cancel',
			            'library' => 'all',
			        ],
			        'condition' => [
			            'show_read_more' => 'yes',
			        ],
			    ]
			);

		$this->end_controls_section();

			/* Begin General Style */
		   	$this->start_controls_section(
			'general',
			  	[
				 	'label' => esc_html__( 'General', 'remons' ),
				  	'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			  	]
		  	);

			  	$this->add_responsive_control(
					'general_gap',
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
							'{{WRAPPER}} .ova-toggle-2' => 'gap: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'general_top_position',
					[
						'label' 		=> esc_html__( 'Top', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px' ],
						'range' 		=> [
							'px' => [
								'min' 	=> -200,
								'max' 	=> 30,
								'step' 	=> 5,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .ova-toggle-2 .item' => 'margin-top: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
				    'general_bg_color',
				    [
					    'label' 	=> esc_html__( 'Background Color', 'remons' ),
					    'type' 		=> \Elementor\Controls_Manager::COLOR,
					    'selectors' => [
						    '{{WRAPPER}} .ova-toggle-2 .item' => 'background-color : {{VALUE}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						  	'{{WRAPPER}} .ova-toggle-2 .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'selector' 	=> '{{WRAPPER}} .ova-toggle-2 .item .question .post-title h2',  
					]
				);
		  
				$this->add_responsive_control(
					  'margin_title',
					  [
						  'label' 		=> esc_html__( 'Margin', 'remons' ),
						  'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
						  'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
						  'selectors' 	=> [
							  '{{WRAPPER}} .ova-toggle-2 .item .question .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item .question .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->start_controls_tabs(
					'pagination_tabs'
				);

					$this->start_controls_tab(
								'title_normal_tab',
								[
									'label' => esc_html__( 'Normal', 'remons' ),
								]
							);

						$this->add_control(
							'color_title',
							[
								'label' 		=> esc_html__( 'Color', 'remons' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' 	=> [
							    '{{WRAPPER}} .ova-toggle-2 .item .question .post-title h2' => 'color : {{VALUE}};',
								],
							]
						);

					$this->end_controls_tab();

					$this->start_controls_tab(
								'title_hover_tab',
								[
									'label' => esc_html__( 'Hover', 'remons' ),
								]
							);

						$this->add_control(
						  	'color_title_hover',
						  	[
							   'label' 		=> esc_html__( 'Color', 'remons' ),
							   'type' 		=> \Elementor\Controls_Manager::COLOR,
							   'selectors' 	=> [
								  '{{WRAPPER}} .ova-toggle-2 .item:hover .question .post-title h2' => 'color : {{VALUE}};',
							  	],
						  	]
						);
					$this->end_controls_tab();

					$this->start_controls_tab(
								'title_active_tab',
								[
									'label' => esc_html__( 'Active', 'remons' ),
								]
							);

						$this->add_control(
						  	'color_title_active',
						  	[
							   'label' 		=> esc_html__( 'Color', 'remons' ),
							   'type' 		=> \Elementor\Controls_Manager::COLOR,
							   'selectors' 	=> [
								  '{{WRAPPER}} .ova-toggle-2 .item.active .question .post-title h2' => 'color : {{VALUE}};',
							  	],
						  	]
						);
					$this->end_controls_tab();

				$this->end_controls_tabs();

		    $this->end_controls_section();
		    //END SECTION TAB STYLE TITLE

		    //START SECTION TAB SHORT DESC STYLE
			$this->start_controls_section(
				'section_short_desc',
				[
					'label' 	=> esc_html__( 'Excerpt', 'remons' ),
					'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
					'condition' => [
					  	'show_short_desc' => 'yes'
					],
				]
			);
	  
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'short_desc_typography',
						'selector' 	=> '{{WRAPPER}} .ova-toggle-2 .item .answer p',
					]
				);
		  
				$this->add_control(
					'color_short_desc',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							  '{{WRAPPER}} .ova-toggle-2 .item .answer p' => 'color : {{VALUE}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item .answer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item .answer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);  
	  
			$this->end_controls_section();
			//END SECTION TAB SHORT DESC STYLE

			//START SECTION TAB STYLE READMORE
		    $this->start_controls_section(
			    'section_readmore',
			    [
				    'label' => esc_html__( 'Read More Button', 'remons' ),
				    'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			    ]
		    );

				$this->add_control(
					'read_more_icon_size',
					[
						'label' 		=> esc_html__( 'Icon Size', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', '%' ],
						'range' 		=> [
							'px' => [
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
							'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn svg' => 'width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'color_icon_read_more',
							[
								'label' 	=> esc_html__( 'Icon Color', 'remons' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn .icon-open i' => 'color : {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'bg_color_icon_read_more',
							[
								'label' 	=> esc_html__( 'Background Color', 'remons' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-toggle-2 .item .question .toggle-btn' => 'background-color : {{VALUE}};',
								],
							]
						);

					$this->end_controls_tab();

					$this->start_controls_tab(
							'read_more_active_tab',
							[
								'label' => esc_html__( 'Active', 'remons' ),
							]
						);

						$this->add_control(
							'read_more_color_icon_active',
							[
								'label' 	=> esc_html__( 'Icon Color', 'remons' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-toggle-2 .item.active .question .toggle-btn .icon-close i' => 'color : {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'bg_read_more_color_active',
							[
								'label' 	=> esc_html__( 'Background Active', 'remons' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-toggle-2 .item.active .question .toggle-btn' => 'background-color : {{VALUE}};',
								],
							]
						);

					$this->end_controls_tab();

				$this->end_controls_tabs();
  
		 	$this->end_controls_section();
	}

	protected function render() {
		// Get setting
		$settings = $this->get_settings_for_display();

		// Icon open
		$icon_open = remons_get_meta_data( 'icon_open', $settings );

		// Icon close
		$icon_close	= remons_get_meta_data( 'icon_close', $settings );

		// Show readmore
		$show_read_more = remons_get_meta_data( 'show_read_more', $settings );

		// FAQ item
		$faq_items = remons_get_meta_data( 'faq_items', $settings );

		?>
		<div class="ova-toggle-2">
			<?php
			$index = 1;
			if ( ! empty( $faq_items ) ) :
				foreach ( $faq_items as $item ) :
					$item_class = ( isset( $item['active'] ) && 'yes' === $item['active'] ) ? 'item initial-active' : 'item';
					?>
					<div class="<?php echo esc_attr( $item_class ); ?>">
						<div class="question">
							<div class="post-title">
								<h2><?php echo $index . '. ' . esc_html( $item['question'] ); ?></h2>
							</div>

							<?php if ( 'yes' === $show_read_more ) : ?>
								<div class="toggle-btn">
									<span class="icon icon-open">
										<?php \Elementor\Icons_Manager::render_icon( $icon_open, ['aria-hidden' => 'true'] ); ?>
									</span>
									<span class="icon icon-close">
										<?php \Elementor\Icons_Manager::render_icon( $icon_close, ['aria-hidden' => 'true'] ); ?>
									</span>
								</div>
							<?php endif; ?>
						</div>

						<div class="answer">
							<p><?php echo wp_kses_post( $item['answer'] ); ?></p>
						</div>
					</div>
					<?php
					$index++;
				endforeach;
			endif;
			?>
		</div>
		<?php
	}
}

$widgets_manager->register( new Remons_Elementor_Toggle_2() );