<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Switch_Language
 */
class Remons_Elementor_Switch_Language extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_switch_language';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Switch Language', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-global-settings';
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
		return [ 'remons-elementor-switch-language' ];
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
				'image',
				[
					'label'   => esc_html__( 'Image', 'remons' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'icon_select',
				[
					'label' 	=> esc_html__( 'Icon Select', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'ovaicon ovaicon-download',
						'library' 	=> 'all',
					],
				]
			);

		$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'language', [
					'label' 		=> esc_html__( 'Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'English' , 'remons' ),
					'label_block' 	=> true,
				]
			);

		$this->add_control(
			'list',
			[
				'label' 	=> esc_html__( 'Language', 'remons' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'language' => esc_html__( 'English', 'remons' ), 
					],
					[
						'language' => esc_html__( 'France', 'remons' ),
					],
				],
				'title_field' => '{{{ language }}}',
			]
		);


		$this->end_controls_section();

		// TAB STYLE ICON
		$this->start_controls_section(
			'section_switch_language_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'image_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-switch-language .flag-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'image_border',
					'selector' 	=> '{{WRAPPER}} .ova-switch-language .flag-img',
				]
			);
		
		$this->end_controls_section();
		
		// TAB STYLE SELECT
		$this->start_controls_section(
			'section_switch_language',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'typography',
					'selector' => '{{WRAPPER}} .ova-switch-language select#ova-language',
				]
			);
					
			$this->add_control(
				'color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-language select#ova-language' => 'color : {{VALUE}};',		
					],
				]
			);		

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-language .icon-select i' => 'color : {{VALUE}};',		
					],
				]
			);	

		$this->end_controls_section(); // END SECTION TAB STYLE SELECT
		
		// TAB STYLE OPTION
		$this->start_controls_section(
			'section_switch_language_option',
			[
				'label' => esc_html__( 'Option', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'typography_option',
					'selector' => '{{WRAPPER}} .ova-switch-language select#ova-language option',
				]
			);
					
			$this->add_control(
				'color_option',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-language select#ova-language option' => 'color : {{VALUE}};',		
					],
				]
			);	

			$this->add_control(
				'color_bg_option',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-switch-language select#ova-language option' => 'background-color : {{VALUE}};',		
					],
				]
			);		

		$this->end_controls_section(); // END SECTION TAB OPTION
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();
		
		// Icon select
		$icon_select = remons_get_meta_data( 'icon_select', $settings );

		// List language
		$list_language = remons_get_meta_data( 'list', $settings );

		// Get URL
		$url = isset( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$alt = isset( $settings['image']['alt'] ) ? $settings['image']['alt'] : esc_html__(' Flag', 'remons' );
		?>		

		<div class="ova-switch-language">
			<?php if ( $url ): ?>
				<img class="flag-img" src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
			<?php endif; ?>
			<label class="visuallyhidden" for="ova-language">
				<?php esc_html_e( 'Language', 'remons' ); ?>
			</label>
		 	<select name="language" id="ova-language">
				<?php foreach ( $list_language as $item ): ?>
					<option value="<?php echo esc_attr( $item['language'] ); ?>">
						<?php echo esc_html( $item['language'] ); ?>
					</option>
				<?php endforeach; ?>
			</select>
			<div class="icon-select">
				<?php 
			        \Elementor\Icons_Manager::render_icon( $icon_select, [ 'aria-hidden' => 'true' ] );
			    ?>
			</div>	
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Switch_Language() );