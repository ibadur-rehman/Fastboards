<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Counter
 */
class Remons_Elementor_Counter extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_counter';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Counter', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-counter';
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
		// Appear js
		wp_enqueue_script( 'appear', get_theme_file_uri('/assets/libs/appear/appear.js'), [ 'jquery' ], false, true );

		// Odometer for counter
		wp_enqueue_style( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.css' );
		wp_enqueue_script( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.js', [ 'jquery' ], false, true );

		return [ 'remons-elementor-counter' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-counter', REMONS_URI.'/assets/scss/elementor/counters/counter.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Ova Counter', 'remons' ),
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
						'template3' => esc_html__( 'Template 3', 'remons' ),
						'template4' => esc_html__( 'Template 4', 'remons' ),
						'template5' => esc_html__( 'Template 5', 'remons' ),
						'template6' => esc_html__( 'Template 6', 'remons' ),
						'template7'	=> esc_html__( 'Template 7', 'remons' ),
					]
				]
			);

			$this->add_control(
				'show_mask_image',
				[
					'label' 		=> esc_html__( 'Show Mask', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'condition' 	=> [
						'template' 	=> 'template2'
					]
				]
			);

		    $this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-sports-car',
						'library' 	=> 'all',
					],
					'condition' => [
	                	'template!' => 'template7'
	                ], 
				]
			);

		    $this->add_control(
				'number',
				[
					'label' 	=> esc_html__( 'Number', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> esc_html__( '990', 'remons' ),
				]
			);

			$this->add_control(
				'suffix',
				[
					'label'  		=> esc_html__( 'Suffix', 'remons' ),
					'type'   		=> \Elementor\Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Plus', 'remons' ),
					'default'		=> esc_html__( '+', 'remons' )
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Cars Rentouts', 'remons' ),
				]
			);

			$this->add_control(
				'introduce',
				[
					'label'		=> esc_html__( 'Introduce', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::TEXTAREA,
					'default'	=> esc_html__( 'Our team of experienced doctors and dedicated', 'remons' ),
					'condition' => [
						'template' => 'template7',
					]
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' 	=> esc_html__( 'Left', 'remons' ),
							'icon' 		=> 'eicon-text-align-left',
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
					'selectors' => [
						'{{WRAPPER}} .ova-counter, {{WRAPPER}} .ova-counter .counter-content' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} .ova-counter.ova-counter-template5' => 'align-items: {{VALUE}};',
						'{{WRAPPER}} .ova-counter.ova-counter-template6' => 'align-items: {{VALUE}};',
						'{{WRAPPER}} .ova-counter.ova-counter-template7' => 'align-items: {{VALUE}};',
					],
					'condition' => [
						'template!' => 'template2'
					],
				]
			);

			$this->add_responsive_control(
				'text_align',
				[
					'label' 	=> esc_html__( 'Text Align', 'remons' ),
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
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'template!' => ['template2','template4']
					],
				]
			);

			$this->add_responsive_control(
				'align_template2',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'0 auto 0 0' => [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'0 auto' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'0 0 0 auto' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'margin: {{VALUE}};',
					],
					'condition' => [
						'template' => 'template2'
					],
				]
			);
			
		$this->end_controls_section();

		/* Begin Counter Style */
		$this->start_controls_section(
            'counter_style',
            [
               'label' 	=> esc_html__( 'Ova Counter', 'remons' ),
               'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'counter_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> ['px', '%'],
					'range' => [
						'px' => [
							'min' 	=> 140,
							'max' 	=> 900,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 20,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_control(
				'counter_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'counter_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover' => 'background-color: {{VALUE}};',
					],
				]
			); 

			$this->add_control(
				'counter_shape_bgcolor',
				[
					'label' 	=> esc_html__( 'Shape Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-template3::before' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'template' => 'template3'
					]
				]
			);

			$this->add_control(
				'reversed_shape',
				[
					'label' 		=> esc_html__( 'Reversed shape', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'condition' 	=> [
						'template' => 'template3'
					]
				]
			);

		    $this->add_responsive_control(
	            'counter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'counter_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_control(
				'border_heading',
				[
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

		        $this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' 		=> 'content_border',
						'label' 	=> esc_html__( 'Border', 'remons' ),
						'selector' 	=> '{{WRAPPER}} .ova-counter',
					]
				);

			$this->add_control(
				'border_hover_heading',
				[
					'label' 	=> esc_html__( 'Border Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' 		=> 'content_border_hover',
						'label' 	=> esc_html__( 'Border Hover', 'remons' ),
						'selector' 	=> '{{WRAPPER}} .ova-counter:hover',
					]
				);

        $this->end_controls_section();
		/* End counter style */

		/* Begin icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' 	=> esc_html__( 'Icon', 'remons' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	'template!' => 'template7'
                ], 
            ]
        );
            
			$this->add_responsive_control(
				'size_icon',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-counter .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-counter .icon svg path' => 'fill : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-counter:hover .icon svg path' => 'fill : {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-counter .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );
		
        $this->end_controls_section();
		/* End icon style */

		/* Begin title Style */
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
					'selector' 	=> '{{WRAPPER}} .ova-counter .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'title_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-counter .title',
				]
			);

        $this->end_controls_section();
		/* End title style */

				/* Begin Introduce Style */
		$this->start_controls_section(
            'introduce_style',
            [
                'label' 	=> esc_html__( 'Introduce', 'remons' ),
                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                	'template'	=> 'template7'
                ],
            ]
        );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'introduce_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .introduce',
				]
			);

			$this->add_control(
				'introduce_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .introduce' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'introduce_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .introduce' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'introduce_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .introduce' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'introduce_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-counter .introduce',
				]
			);

        $this->end_controls_section();
		/* End Introduce style */

		/* Begin number (odometer) Style */
		$this->start_controls_section(
            'number_style',
            [
                'label' => esc_html__( 'Number', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

			 $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'number_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .odometer',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .odometer' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .odometer' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End number style */

		/* Begin suffix Style */
		$this->start_controls_section(
            'suffix_style',
            [
                'label' => esc_html__( 'Suffix', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'suffix_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter .suffix',
				]
			);

			$this->add_control(
				'suffix_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'suffix_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter:hover .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'suffix_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter .suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section(); /* End suffix style */
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
        $template = remons_get_meta_data( 'template', $settings );

        // Get icon
        $icon = remons_get_meta_data( 'icon', $settings );

        // Get number
		$number = remons_get_meta_data( 'number', $settings, '100' );

		// Get suffix
		$suffix = remons_get_meta_data( 'suffix', $settings );

		// Get title
		$title = remons_get_meta_data( 'title', $settings );

		// Get introduce
		$introduce = remons_get_meta_data( 'introduce', $settings );

		// Template 2
		$show_mask_image = remons_get_meta_data( 'show_mask_image', $settings );
		if ( 'template2' === $template && 'yes' === $show_mask_image ) {
			$template = 'template2 has-mask-image';
		}

		// Template 3
		$reversed_shape = remons_get_meta_data( 'reversed_shape', $settings );
		if ( 'template3' === $template && 'yes' === $reversed_shape ) {
			$template = 'template3 reversed_shape';
		}

		?>

		<div class="ova-counter ova-counter-<?php echo esc_attr( $template ); ?>" 
		    data-count="<?php echo esc_attr( $number ); ?>">
		    <?php if ( remons_get_meta_data( 'value', $icon ) ): ?>
		    	<div class="icon">
		    	    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
		    	</div>
		    <?php endif;

		    // Template 1
		    if ( 'template1' === $template ): ?>
		    	<div class="divider"></div>
		    <?php endif; ?>

		    <div class="counter-content">
				<div class="counter-wrap">
					<span class="odometer">0</span><span class="suffix">
						<?php echo esc_html( $suffix ); ?>
					</span>
				</div>				
		  	    <?php if ( $title ): ?>
					<h4 class="title">
						<?php echo esc_html( $title ); ?>
					</h4>
				<?php endif; ?>

				<?php if( 'template7' === $template && $introduce ) :?>
					<p class="introduce">
						<?php echo esc_html( $introduce ) ?>
					</p>
				<?php endif; ?>
		    </div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Counter() );