<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Progress_Circle
 */
class Remons_Elementor_Progress_Circle extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_progress_circle';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Progress Circle', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-spinner';
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
		wp_enqueue_script( 'progress-circle', get_template_directory_uri().'/assets/libs/circle-progress/circle-progress.min.js', array('jquery'), false, true );
		return [ 'remons-elementor-progress-circle' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-progress-circle', REMONS_URI.'/assets/scss/elementor/progress/progress-circle.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Progress Circle', 'remons' ),
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
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'rows' 		=> 3,
					'default' 	=> esc_html__( 'Intelligent Dispatch System', 'remons' ),
				]
			);

			$this->add_control(
				'percent',
				[
					'label' 		=> esc_html__( 'Percent', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'default' 		=> [
						'size' => 93,
					],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
				]
			);

			$this->add_control(
				'unit',
				[
					'label' 	=> esc_html__( 'Unit', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( '%', 'remons' ),
				]
			);

			$this->add_control(
				'circle_heading',
				[
					'label' 	=> esc_html__( 'Circle', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			    $this->add_control(
					'linecap',
					[
						'label' 	=> esc_html__( 'LineCap', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::SELECT,
						'default' 	=> 'butt',
						'options' 	=> [
							'butt' 		=> esc_html__( 'Default', 'remons' ),
							'square' 	=> esc_html__( 'Square', 'remons' ),
							'round'   	=> esc_html__( 'Round', 'remons' )
						]
					]
				);

				$this->add_control(
					'start_angle',
					[
						'label' 		=> esc_html__( 'Start Angel', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
						'default' 		=> [
							'size' => -1.55,
						],
						'range' 		=> [
							'px' => [
								'min' 	=> -3,
								'max' 	=> 3,
								'step' 	=> 0.1,
							],
						],
					]
				);

				$this->add_control(
					'circle_size',
					[
						'label' 		=> esc_html__( 'Size (px)', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
						'default' 		=> [
							'size' => 80,
						],
						'range' 		=> [
							'px' => [
								'min' 	=> 80,
								'max' 	=> 200,
								'step' 	=> 1,
							],
						],
					]
				);

				$this->add_control(
					'circle_thickness',
					[
						'label' 	=> esc_html__( 'Thickness', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::NUMBER,
						'min' 		=> 1,
						'step' 		=> 1,
						'default' 	=> 5		
					]
				);

				$this->add_control(
					'color_circle',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'default' 	=> '#FF3726'
					]
				);

				$this->add_control(
					'empty_color_circle',
					[
						'label' 	=> esc_html__( 'Empty Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'default' 	=> '#E0E9F3'
					]
				);

				$this->add_responsive_control(
					'align',
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
						'default' 	=> 'center',
						'selectors' => [
							'{{WRAPPER}} .ova-progress-circle-wrapper' => 'text-align: {{VALUE}};',
						],
					]
			   );

		$this->end_controls_section();

		/* Begin percent Style */
		$this->start_controls_section(
            'percent_style',
            [
                'label' => esc_html__( 'Percent', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'percent_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress-circle-wrapper .ova-progress-circle .percent',
				]
			);

			$this->add_control(
				'percent_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress-circle-wrapper .ova-progress-circle .percent' => 'color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
		/* End percent style */

		/* Begin title Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
				'title_align',
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
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .ova-progress-circle-wrapper .title' => 'text-align: {{VALUE}};',
					],
				]
			);

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress-circle-wrapper .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress-circle-wrapper .title' => 'color: {{VALUE}};',
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
						'{{WRAPPER}} .ova-progress-circle-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section(); // End title style
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Template
		$template = remons_get_meta_data( 'template', $settings );

		// Title
		$title = remons_get_meta_data( 'title', $settings );

		// Unit
		$unit = remons_get_meta_data( 'unit', $settings );

		// Percent
		$percent 	= is_numeric( $settings['percent']['size'] ) ? $settings['percent']['size'] : 0;
		$percentage = $percent / 100;

		// Start angle
		$start_angle = is_numeric( $settings['start_angle']['size'] ) ? $settings['start_angle']['size'] : '-1.55';

		// Size
		$size = is_numeric( $settings['circle_size']['size'] ) ? $settings['circle_size']['size'] : '144';

		// Color
		$color = ( isset( $settings['color_circle'] ) && $settings['color_circle'] !== '' ) ?  $settings['color_circle'] : '#5f2dee' ;

		// Color empty
		$empty_color = ( isset( $settings['empty_color_circle'] ) && $settings['empty_color_circle'] !== '' ) ?  $settings['empty_color_circle'] : '#fff' ;

		// Circle thickness
		$thickness = remons_get_meta_data( 'circle_thickness', $settings );

		// Linecap
	    $linecap = remons_get_meta_data( 'linecap', $settings );

	    // Replace % to %% avoid printf error
		if ( strpos( $title, '%' ) !== false ) {
		    $title = str_replace( '%', '%%', $title );
		}

		?>

        <div class="ova-progress-circle-wrapper <?php echo esc_attr( $template ); ?>">
    	    <div class="ova-progress-circle"  
                data-thickness="<?php echo esc_attr( $thickness ); ?>" 
                data-start_angle="<?php echo esc_attr( $start_angle ); ?>"
                data-size="<?php echo esc_attr( $size ); ?>"
                data-value="<?php echo esc_attr( $percentage ); ?>"
                data-color="<?php echo esc_attr( $color ); ?>"
                data-empty_color="<?php echo esc_attr( $empty_color ); ?>"
                data-linecap="<?php echo esc_attr( $linecap ); ?>"
            >
                <div class="percent">
                	<strong></strong>
            	    <i><?php echo esc_html( $unit ) ; ?></i>
                </div>
            </div>

            <?php if ( $title ): ?>
        	    <h4 class="title"><?php echo wp_kses_post( $title ); ?></h4>
        	<?php endif; ?>
        </div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Progress_Circle() );