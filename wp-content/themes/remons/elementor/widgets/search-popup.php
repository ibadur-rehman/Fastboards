<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Class Remons_Elementor_Ova_Search_Popup
 */
class Remons_Elementor_Ova_Search_Popup extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_ova_search_popup';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Search Popup', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		return [ 'remons-elementor-search-popup' ];
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
				'search_placeholder',
				[
					'label' 	=> esc_html__( 'Placeholder', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Search', 'remons' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_search',
			[
				'label' => esc_html__( 'Icon Search', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_control(
				'size_icon',
				[
					'label' 		=> esc_html__( 'Size Icon', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup i.front_search' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
				'color_icon_search',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup i.front_search' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'color_hover_icon_search',
				[
					'label' 	=> esc_html__( 'Icon Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup i.front_search:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'bgcolor_icon_search',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup i.front_search' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'bgcolor_hover_icon_search',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup i.front_search:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
			  	'icon_search_padding',
			  	[
				  	'label' 		=> esc_html__( 'Padding', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .ova_wrap_search_popup i.front_search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
		  	);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_popup_button',
			[
				'label' => esc_html__( 'Search Popup Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'bgcolor_search_popup_button',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup .ova_search_popup .container .search-form .search-submit' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'bgcolor_hover_icon_search_popup',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search_popup .ova_search_popup .container .search-form .search-submit:hover' => 'background-color: {{VALUE}}',
					],
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

		// Search placeholder
		$search_placeholder = remons_get_meta_data( 'search_placeholder', $settings );

		?>
		<div class="ova_wrap_search_popup">
			<i class="front_search flaticon flaticon-magnifying-glass"></i>
			<div class="ova_search_popup">
				<div class="search-popup__overlay"></div>
				<div class="container">
					<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				        <input
				        	type="search"
				        	class="search-field"
				        	name="s"
				        	value="<?php echo get_search_query(); ?>"
				        	placeholder="<?php echo esc_attr( $search_placeholder ); ?>"
				        	title="<?php esc_attr_e( 'Search for:', 'remons' ); ?>"
				        />
		   			 	<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'remons' ); ?>">
		   			 		<i class="flaticon flaticon-magnifying-glass"></i>
		   			 	</button>
					</form>									
				</div>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Ova_Search_Popup() );