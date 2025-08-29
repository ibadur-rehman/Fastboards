<?php 
class Remons_Elementor_Workflow_Image extends \Elementor\Widget_Base {
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_workflow_image';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Workflow Image', 'remons' );
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
		wp_enqueue_script( 'remons-elementor-workflow-image', REMONS_URI.'/assets/js/elementor/workflow-image.js' );
		return [];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-workflow-image', REMONS_URI.'/assets/scss/elementor/workflow-image/workflow-image.css' );
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
			    'columns_per_row',
			    [
			        'label' => esc_html__( 'Columns per Row', 'remons' ),
			        'type' => \Elementor\Controls_Manager::SELECT,
			        'default' => '3',
			        'options' => [
			            '1' => '1 Column',
			            '2' => '2 Columns',
			            '3' => '3 Columns',
			            '4' => '4 Columns',
			        ],
			        'condition' => [ 'template' =>'template1' ],
			    ]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
				    'image',
				    [
				        'label' => esc_html__( 'Image', 'remons' ),
				        'type' => \Elementor\Controls_Manager::MEDIA,
				        'default' => [
				            'url' => \Elementor\Utils::get_placeholder_image_src(),
				        ],
				        
				    ]
				);

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
				                'description' => esc_html__( 'Patients visit the clinic for a consultation, where doctors assess their medical', 'remons' ),
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

			$this->start_controls_tabs( 'style_tabs' );

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
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .timeline-step' => 'color: {{VALUE}};',
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step' => 'color: {{VALUE}};',
					        ],
					    ]
					);

					$this->add_control(
					    'timeline_step_background_color_normal',
					    [
					        'label' => esc_html__( 'Background Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .timeline-step' => 'background-color: {{VALUE}};',
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step .timeline-step-bg' => 'background-color: {{VALUE}};',
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
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .timeline-step' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step .timeline-step-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .timeline-step' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .timeline-step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step .timeline-step-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step' => 'color: {{VALUE}};',
					            '{{WRAPPER}} .remons-service .button a' => 'color: {{VALUE}};',
					        ],
					    ]
					);

					$this->add_control(
					    'background_color_hover',
					    [
					        'label' => esc_html__( 'Background Color', 'remons' ),
					        'type' => \Elementor\Controls_Manager::COLOR,
					        'selectors' => [
					            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .timeline-step .timeline-step-bg' => 'background-color: {{VALUE}};',
					        ],
					    ]
					);

			$this->end_controls_tab();

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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-title' => 'color: {{VALUE}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-title' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_title',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-title' => 'background-color: {{VALUE}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-title' => 'background-color: {{VALUE}};',
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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-title',
					'selector' 	=> '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-title',

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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-description' => 'color: {{VALUE}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-description' => 'color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'background_color_description',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-description' => 'background-color: {{VALUE}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-description' => 'background-color: {{VALUE}};',
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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-left-item .workflow-content .workflow-description',
					'selector' 	=> '{{WRAPPER}} .workflow-image .workflow-item .workflow-content .workflow-description',
				]
			);

		$this->end_controls_section();

		//image style control
		$this->start_controls_section(
		    'image_section',
		    [
		        'label' => esc_html__( 'Image', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'padding_image',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-right-item .workflow-image-wrapper img.workflow-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .workflow-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_image',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-right-item .workflow-image-wrapper img.workflow-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .workflow-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'border_radius_image',
			    [
			        'label' => esc_html__( 'Border Radius', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-content-wrapper .workflow-right-item .workflow-image-wrapper img.workflow-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .workflow-image .workflow-item .workflow-image-wrapper .workflow-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();

		//container style control
		$this->start_controls_section(
		    'container_section',
		    [
		        'label' => esc_html__( 'Container', 'remons' ),
		        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'background_color_container',
			    [
			        'label' => esc_html__( 'Background Color', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item ' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_control(
			    'border_radius_container',
			    [
			        'label' => esc_html__( 'Border Radius', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'padding_container',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
			    'margin_container',
			    [
			        'label' => esc_html__( 'Margin', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .workflow-image .workflow-item ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		set_query_var( 'workflow_settings', $settings );

		$templates = remons_get_meta_data( 'template', $settings );

		if('template1' === $templates){
			ovabrw_get_template( 'elementors/workflow-image1.php', $settings );

		} elseif ('template2' === $templates) {

			ovabrw_get_template( 'elementors/workflow-image2.php', $settings );

		}
	}

}

$widgets_manager->register( new Remons_Elementor_Workflow_Image() );
