<?php 
class Remons_Elementor_Workflow extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_workflow';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Workflow', 'remons' );
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
		// wp_enqueue_script( 'remons-elementor-workflow', REMONS_URI.'/assets/js/elementor/workflow.js' );
		return [];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-workflow', REMONS_URI.'/assets/scss/elementor/workflow/workflow.css' );
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
				        'label' => esc_html__( 'Title', 'remons' ),
				        'type' => \Elementor\Controls_Manager::TEXT,
				        'default' => esc_html__( 'Culture', 'remons' ),
				        'placeholder' => esc_html__( 'Type your title here', 'remons' ),
				    ]
				);

				$repeater->add_control(
				    'show_description',
				    [
				        'label' => esc_html__( 'Show Description', 'remons' ),
				        'type' => \Elementor\Controls_Manager::SWITCHER,
				        'label_on' => esc_html__( 'Show', 'remons' ),
				        'label_off' => esc_html__( 'Hide', 'remons' ),
				        'return_value' => 'yes',
				        'default' => 'yes',
				    ]
				);

				$repeater->add_control(
				    'description',
				    [
				        'label' => esc_html__( 'Description', 'remons' ),
				        'type' => \Elementor\Controls_Manager::TEXTAREA,
				        'rows' => 5,
				        'default' => esc_html__( 'Sed ut perspiciatis unde omnis totam rem aperia eaque', 'remons' ),
				        'placeholder' => esc_html__( 'Type your description here', 'remons' ),
				        'condition' => [
				            'show_description' => 'yes',
				        ],
				    ]
				);

				$repeater->add_control(
				    'show_timeline_step',
				    [
				        'label' => esc_html__( 'Show Timeline Step', 'remons' ),
				        'type' => \Elementor\Controls_Manager::SWITCHER,
				        'label_on' => esc_html__( 'Show', 'remons' ),
				        'label_off' => esc_html__( 'Hide', 'remons' ),
				        'return_value' => 'yes',
				        'default' => 'yes',
				    ]
				);

				$repeater->add_control(
				    'timeline_step',
				    [
				        'label' => esc_html__( 'Text Timeline Step', 'remons' ),
				        'type' => \Elementor\Controls_Manager::TEXT,
				        'default' => esc_html__( 'Step 01', 'remons' ),
				        'condition' => [
				            'show_timeline_step' => 'yes',
				        ],
				    ]
				);

				// main control of repeater
				$this->add_control(
				    'timeline_items',
				    [
				        'label' => esc_html__( 'Timeline Items', 'remons' ),
				        'type' => \Elementor\Controls_Manager::REPEATER,
				        'fields' => $repeater->get_controls(),
				        'default' => [
				            [
				                'timeline_step' => esc_html__( 'Step 01', 'remons' ),
				                'title' => esc_html__( 'Blood Pressure Check', 'remons' ),
				                'description' => esc_html__( 'Accurate blood pressure measurement is vital for diagnosing and managing hypertension and cardiovascular.', 'remons' ),
				            ],
				            [
				                'timeline_step' => esc_html__( 'Step 02', 'remons' ),
				                'title' => esc_html__( 'Service implementation', 'remons' ),
				                'description' => esc_html__( 'Implementing effective medical services requires strategic planning and adherence to best practices to ensure.', 'remons' ),
				            ],
				            [
				                'timeline_step' => esc_html__( 'Step 03', 'remons' ),
				                'title' => esc_html__( 'Monitoring before going home', 'remons'),
				                'description' => esc_html__( 'Ensuring patient safety and reducing hospital readmissions necessitate comprehensive monitoring strategies.', 'remons' ),
				            ],
				        ],
				        'title_field' => '{{{ title }}}',
				    ]
				);

		$this->end_controls_section();

		//Timeline step style control
		$this->start_controls_section(
		    'timeline_step_section',
		    [
		        'label' => esc_html__( 'Timeline Step', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

		    ]
		);

			$this->start_controls_tabs('style_tabs');

				// TAB NORMAL TIMELINE STEP
				$this->start_controls_tab(
				    'title_normal',
				    [
				        'label' => esc_html__( 'Normal', 'remons' ),
				    ]
				);

					$this->add_control(
					    'color_normal',
					    [
					        'label' => esc_html__( 'Text Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step' => 'color: {{VALUE}};',
					        ],
					    ]
					);

					$this->add_control(
					    'timeline_step_background_color_normal',
					    [
					        'label' => esc_html__( 'Background Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step' => 'background-color: {{VALUE}};',
					        ],
					    ]
					);

					$this->add_control(
					    'padding_normal',
					    [
					        'label' => esc_html__( 'Padding', 'remons' ),
					        'type' => \Elementor\Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%', 'em' ],
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step .timeline-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					        ],
					    ]
					);

					$this->add_control(
					    'margin_normal',
					    [
					        'label' => esc_html__( 'Margin', 'remons' ),
					        'type' => \Elementor\Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%', 'em' ],
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					        ],
					    ]
					);
					$this->add_control(
					    'border_radius_button',
					    [
					        'label' => esc_html__( 'Border Radius', 'remons' ),
					        'type' => \Elementor\Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step .timeline-border .timeline-bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					        ],
					    ]
					);

				$this->end_controls_tab();

				// TAB HOVER TIMELINE STEP
				$this->start_controls_tab(
				    'title_hover',
				    [
				        'label' => esc_html__( 'Hover', 'remons' ),
				    ]
				);

					$this->add_control(
					    'color_hover',
					    [
					        'label' => esc_html__( 'Text Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step:hover' => 'color: {{VALUE}};',
					        ],
					    ]
					);

					$this->add_control(
					    'background_color_hover',
					    [
					        'label' => esc_html__( 'Background Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow .item .timeline-step:hover' => 'background-color: {{VALUE}};',
					        ],
					    ]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();


		$this->end_controls_section();

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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-title' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_title',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-title' => 'background-color: {{VALUE}};',
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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'workflow_title_typography',
					'selector' 	=> '{{WRAPPER}} .workflow .item .workflow-content .workflow-title',

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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-description' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_description',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-description' => 'background-color: {{VALUE}};',
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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			            '{{WRAPPER}} .workflow .item .workflow-content .workflow-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'workflow_description_typography',
					'selector' 	=> '{{WRAPPER}} .workflow .item .workflow-content .workflow-description',
				]
			);

		$this->end_controls_section();
		
		//container style control
		$this->start_controls_section(
		    'content_container_section',
		    [
		        'label' => esc_html__( 'Container', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->start_controls_tabs( 'content_container_style_tabs' );

				$this->start_controls_tab(
				    'content_container_normal',
				    [
				        'label' => esc_html__( 'Normal', 'remons' ),
				    ]
				);

				$this->add_control(
				    'background_color_content_container',
				    [
				        'label' => esc_html__( 'Background Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content' => 'background-color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_control(
				    'border_radius_content_container',
				    [
				        'label' => esc_html__( 'Border Radius', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_control(
				    'padding_content_container',
				    [
				        'label' => esc_html__( 'Padding', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%', 'em' ],
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_control(
				    'margin_content_container',
				    [
				        'label' => esc_html__( 'Margin', 'remons' ),
				        'type' => \Elementor\Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%', 'em' ],
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

			$this->end_controls_tab();

				$this->start_controls_tab(
				    'content_container_hover',
				    [
				        'label' => esc_html__( 'Hover', 'remons' ),
				    ]
				);

				$this->add_control(
				    'content_container_color_hover',
				    [
				        'label' => esc_html__( 'Text Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content:hover .workflow-title' => 'color: {{VALUE}};',
				            '{{WRAPPER}} .workflow .item .workflow-content:hover .workflow-description' => 'color: {{VALUE}};',
				        ],
				    ]
				);

				$this->add_control(
				    'content_container_background_color_hover',
				    [
				        'label' => esc_html__( 'Background Color', 'remons' ),
				        'type' => \Elementor\Controls_Manager::COLOR,
				        'selectors' => [
				            '{{WRAPPER}} .workflow .item .workflow-content:hover' => 'background-color: {{VALUE}};',
				        ],
				    ]
				);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();





		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		set_query_var( 'workflow_settings', $settings );

		$templates = remons_get_meta_data( 'template', $settings );

		ovabrw_get_template( 'elementors/workflow.php', $settings );

	}

}

$widgets_manager->register( new Remons_Elementor_Workflow() );
