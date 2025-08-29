<?php 
class Remons_Elementor_Text_List extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_text_list';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Text List', 'remons' );
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
		// wp_enqueue_script( 'remons-elementor-text-list', REMONS_URI.'/assets/js/elementor/text-list.js' );
		return [];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-text-list', REMONS_URI.'/assets/scss/elementor/text-list/text-list.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		//content section
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),

			]
		);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'title',
					[
						'label' 		=> esc_html__( 'Title', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::TEXT,
						'default' 		=> esc_html__( 'Patient-Centered Approach', 'remons' ),
						'placeholder' 	=> esc_html__( 'Type your title here', 'remons' ),
					]
				);

			$repeater->add_control(
		        'description',
		        [
		            'label' => esc_html__( 'Description', 'remons' ),
		            'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' 			=> 5,
		            'default' => esc_html__( 'We prioritize your comfort, concerns, and well-being, ensuring personalized care tailored to your unique health needs.', 'remons' ),
		        ]
		    );
				
			$this->add_control(
				'text-list',
				[
					'label'       => esc_html__( 'Text List', 'remons' ),
					'type'        => \Elementor\Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'title'       => esc_html__( 'Patient-Centered Approach', 'remons' ),
							'description' => esc_html__( 'We prioritize your comfort, concerns, and well-being, ensuring personalized care tailored to your unique health needs.', 'remons' ),
						],
						[
							'title'       => esc_html__( 'Quick & Convenient Appointments', 'remons' ),
							'description' => esc_html__( 'We offer flexible scheduling, same-day appointments, and minimal wait times to make healthcare access.', 'remons' ),
						],
					],
					'title_field' => '{{{ title }}}',
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
						'{{WRAPPER}} .Text-list .item' => 'gap: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .Text-list .item' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					  	'{{WRAPPER}} .Text-list .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
		  	);

		  	$this->add_responsive_control(
			  	'general_margin',
			  	[
				  	'label' 		=> esc_html__( 'Margin', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .Text-list .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
		  	);

	  	$this->end_controls_section();
	  	/* End General style */

		//title style control
		$this->start_controls_section(
		    'title_section',
		    [
		        'label' => esc_html__( 'Title', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'color_title',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .title' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_title',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .title' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_title',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_title',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .Text-list .item .content .title',
				]
			);

		$this->end_controls_section();

		//description style control
		$this->start_controls_section(
		    'description_section',
		    [
		        'label' => esc_html__( 'Description', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'color_description',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .description' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_description',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .description' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_description',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_description',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .Text-list .item .content .description',
				]
			);

		$this->end_controls_section();

		//price style control
		$this->start_controls_section(
		    'circle_section',
		    [
		        'label' => esc_html__( 'Circle', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);


			$this->add_control(
			    'circle_color',
			    [
			        'label' => esc_html__( 'Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .dot' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'circle_paddinge',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .dot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'circle_margin',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .Text-list .item .dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);


		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display(); 
		$text_list = $settings['text-list'];
	?>
		
		<div class="Text-list">
			<?php if ( !empty( $text_list ) ) : ?>
	          <?php foreach ( $text_list as $item ) : ?>
	             <div class="item">
			        <span class="dot"></span>
			        <div class="content">
			          <h3 class="title"><?php echo esc_html( $item['title'] ); ?></h3>
			          <p class="description"><?php echo esc_html( $item['description'] ); ?></p>
			        </div>
			      </div>
	          <?php endforeach; ?>
	        <?php endif; ?>
		</div>

	<?php }
}

$widgets_manager->register( new Remons_Elementor_Text_List() );