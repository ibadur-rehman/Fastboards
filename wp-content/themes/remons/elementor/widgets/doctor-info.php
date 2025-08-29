<?php if ( !defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

/**
 * Class Remons_Elementor_Doctor_Infor
 */
class Remons_Elementor_Doctor_Info extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_doctor_info';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Doctor Info', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons' ];
	}

	/**
	 * Get script depeds
	 */
	public function get_script_depends() {
		return [];
	}

	/**
	 * Get style depeds
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-doctor-info', REMONS_URI.'/assets/scss/elementor/doctor-info/doctor-info.css' );
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		// ========= CONTENT =========
		$this->start_controls_section(
			'section_doctor_info',
			[
				'label' => esc_html__( 'Doctor Info Items', 'remons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label',
			[
				'label' => esc_html__( 'Label', 'remons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Nationality:',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'value',
			[
				'label' => esc_html__( 'Value', 'remons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'New York',
				'label_block' => true,
			]
		);

		$this->add_control(
			'info_items',
			[
				'label' => esc_html__( 'Doctor Info Items', 'remons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'label' => 'Nationality:',
						'value' => 'New York',
					],
					[
						'label' => 'Language:',
						'value' => 'English',
					],
					[
						'label' => 'Specialty:',
						'value' => 'Medicine & Healthcare',
					],
					[
						'label' => 'Experience:',
						'value' => 'Harvard Medical School (HMS) and Affiliated Hospitals',
					],
				],
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		// ========= STYLE: Table Layout =========
		$this->start_controls_section(
		    'section_style_table',
		    [
		        'label' => esc_html__( 'Table', 'remons' ),
		        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

			$this->add_control(
			    'table_row_hover_bg_color',
			    [
			        'label' => esc_html__( 'Background Hover', 'remons' ),
			        'type' => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .doctor-info table tr:hover' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_responsive_control(
			    'table_padding',
			    [
			        'label' => esc_html__( 'Padding', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em' ],
			        'selectors' => [
			            '{{WRAPPER}} .doctor-info table tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();

		// ========= STYLE: Label =========
		$this->start_controls_section(
			'section_style_label',
			[
				'label' => esc_html__( 'Label', 'remons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_alignment',
			[
				'label' => esc_html__( 'Alignment', 'remons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'remons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'remons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'remons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .doctor-info td.info-label' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Color', 'remons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doctor-info table tr .info-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => esc_html__( 'Typography', 'remons' ),
				'selector' => '{{WRAPPER}} .doctor-info table tr .info-label',
			]
		);

		$this->end_controls_section();

		// ========= STYLE: Value =========
		$this->start_controls_section(
			'section_style_value',
			[
				'label' => esc_html__( 'Value', 'remons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'value_alignment',
			[
				'label' => esc_html__( 'Alignment', 'remons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'remons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'remons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'remons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .doctor-info td.info-value' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => esc_html__( 'Color', 'remons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doctor-info table tr .info-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
				'label' => esc_html__( 'Typography', 'remons' ),
				'selector' => '{{WRAPPER}} .doctor-info table tr .info-value',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get setting
	    $settings = $this->get_settings_for_display();

	    // info_item
	    $info_items = remons_get_meta_data( 'info_items', $settings );
	    ?>

	    <div class="doctor-info">
	        <table>
	            <?php if ( !empty($info_items) ) : ?>
	                <?php foreach ( $info_items as $item ) : ?>
	                    <tr>
	                        <td class="info-label"><?php echo esc_html($item['label']); ?></td>
	                        <td class="info-value"><?php echo esc_html($item['value']); ?></td>
	                    </tr>
	                <?php endforeach; ?>
	            <?php endif; ?>
	        </table>
	    </div>

	    <?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Doctor_Info() );