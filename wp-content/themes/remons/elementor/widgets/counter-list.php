<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Counter_List
 */
class Remons_Elementor_Counter_List extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_counter_list';
	}
	
	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Counter List', 'remons' );
	}
	
	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
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
		wp_enqueue_script( 'appear', get_theme_file_uri( '/assets/libs/appear/appear.js' ), [ 'jquery' ], false, true );

		// Odometer for counter
		wp_enqueue_style( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.css' );
		wp_enqueue_script( 'odometer', get_template_directory_uri().'/assets/libs/odometer/odometer.min.js', [ 'jquery' ], false, true );

		return [ 'remons-elementor-counter-list' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-counter-list', REMONS_URI.'/assets/scss/elementor/counters/counter-list.css' );

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

			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__('Template 1', 'remons'),
						'template2' => esc_html__('Template 2', 'remons'),
					]
				]
			);

		    $this->add_control(
				'number_column',
				[
					'label' 	=> esc_html__( 'Number Column', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'two_column',
					'options' 	=> [
						'one_column' 	=> esc_html__( 'Single Column', 'remons' ),
						'two_column' 	=> esc_html__( '2 Columns', 'remons' ),
						'three_column' 	=> esc_html__( '3 Columns', 'remons' ),
						'four_column' 	=> esc_html__( '4 Columns', 'remons' ),
					]
				]
			);

			$this->add_control(
				'show_offsets_between_columns',
				[
					'label' 		=> esc_html__( 'Show Offsets Between Columns', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

		    $repeater = new \Elementor\Repeater();

		    	$repeater->add_control(
					'icon',
					[
						'label' 	=> esc_html__( 'Icon', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'flaticon2 flaticon2-review-1',
							'library' 	=> 'all',
						],
					]
				);

			    $repeater->add_control(
					'number',
					[
						'label' 	=> esc_html__( 'Number', 'remons' ),
						'type'    	=> \Elementor\Controls_Manager::NUMBER,
						'default' 	=> 5,
					]
				);

				$repeater->add_control(
					'suffix',
					[
						'label'  	=> esc_html__( 'Suffix', 'remons' ),
						'type'   	=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> 'k',
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' 	=> esc_html__( 'Title', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
						'rows'  	=> 4,
						'default' 	=> esc_html__( 'Total active pro users', 'remons' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label' => esc_html__( 'Description', 'remons' ),
						'type' 	=> \Elementor\Controls_Manager::WYSIWYG,
					]
				);

			$this->add_control(
				'items',
				[
					'label' 	=> esc_html__( 'Items', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[	
							'icon' => [
								'value' => 'flaticon2 flaticon2-customer',
							],
							'title'   => esc_html__( 'Total active pro users', 'remons' ),
							'number'  => 500,
						],
						[	
							'title'  	=> esc_html__( 'Awesome clients', 'remons' ),
							'number'  	=> 5,
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_responsive_control(
				'align_heading',
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
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list' => 'text-align: {{VALUE}}',
					],
				]
			);
			
		$this->end_controls_section(); // END content

		// Begin counter style
		$this->start_controls_section(
            'counter_style',
            [
               'label' 	=> esc_html__( 'Counter', 'remons' ),
               'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'counter_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> ['px', '%'],
					'range' 		=> [
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
						'{{WRAPPER}} .ova-counter-list-wrapper' => 'max-width: {{SIZE}}{{UNIT}}; margin: 0 auto',
					],
				]
			);

        	$this->add_control(
				'counter_gap',
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
						'{{WRAPPER}} .ova-counter-list-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'counter_bgcolor',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'counter_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'counter_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter-list-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		    $this->add_responsive_control(
	            'counter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'counter_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-counter-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'content_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-counter-list',
				]
			);

	        $this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-counter-list',
				]
			);

        $this->end_controls_section(); // End counter style
        
        // Begin icon style
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'icon_fontsize',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 90,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-counter-list .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .icon i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover .icon i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover .icon' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-counter-list .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section(); // End Style tab Icon

		// Begin number (odometer) style
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
					'selector' 	=> '{{WRAPPER}} .ova-counter-list .odometer',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .odometer' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover .odometer' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section(); // End number style

		// Begin suffix style
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
					'selector' 	=> '{{WRAPPER}} .ova-counter-list .suffix',
				]
			);

			$this->add_control(
				'suffix_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'suffix_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover .suffix' => 'color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-counter-list .suffix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section(); // End suffix style

		// Begin title style
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
					'selector' 	=> '{{WRAPPER}} .ova-counter-list .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list:hover .title' => 'color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-counter-list .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section(); // End title style

		// Begin description style
		$this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-counter-list .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-counter-list .description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
	            'description_p_margin',
	            [
	                'label' 		=> esc_html__( '<p> tag Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-counter-list .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-counter-list .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section(); // End description style
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Get items
        $items = remons_get_meta_data( 'items', $settings, [] );

        // Get number column
        $number_column = remons_get_meta_data( 'number_column', $settings );

        // Class offsets
        $class_offsets = '';
        if ( 'yes' === remons_get_meta_data( 'show_offsets_between_columns', $settings ) ) {
        	$class_offsets = 'columns-offsets';
        }

		?>

        <div class="ova-counter-list-wrapper list-wrapper-<?php echo esc_attr( $template ); ?> <?php echo esc_attr( $number_column ) ;?>">
        	<?php foreach ( $items as $item ):
        		// Class icon
	            $class_icon = isset( $item['icon']['value'] ) ? $item['icon']['value'] : '';

	            // Get number
				$number = remons_get_meta_data( 'number', $item, '100' );

				// Get suffix
				$suffix = remons_get_meta_data( 'suffix', $item );

				// Get title
				$title = remons_get_meta_data( 'title', $item );

				// Get description
				$description = remons_get_meta_data( 'description', $item );
		    ?>
	           <div class="ova-counter-list <?php echo esc_attr( $class_offsets ); ?>" data-count="<?php echo esc_attr( $number ); ?>">
		            <?php if ( $class_icon ): ?>
		            	<div class="icon-wrapper">
		            		<div class="icon">
								<i class="<?php echo esc_attr( $class_icon ); ?>"></i>
							</div>
		            	</div>
					<?php endif; ?>
		            <div class="counter-content">
		                <div class="odometer-wrapper">
							<span class="odometer">0</span>
							<span class="suffix">
								<?php echo esc_html( $suffix ); ?>
					        </span>
					    </div>
			      	    <?php if ( $title ): ?>
							<h4 class="title"><?php echo esc_html( $title ); ?></h4>
						<?php endif; ?>
					</div>
					 <?php if ( $description ): ?>
						<div class="description">
							<?php echo apply_filters( 'ovabrw_the_content', $description ); ?>
						</div>
					<?php endif;?>
	           </div>
           <?php endforeach; ?>
        </div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Counter_List() );