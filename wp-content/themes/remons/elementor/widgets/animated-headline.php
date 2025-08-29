<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Animated_Headline
 */
class Remons_Elementor_Animated_Headline extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_animated_headline';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Animated Headline', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-animated-headline';
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
		return [ 'remons-elementor-animated-headline' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-animated-headline', REMONS_URI.'/assets/scss/elementor/heading/animated-headline.css' );
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
			
			// Add Class control
			$this->add_control(
				'heading',
				[
					'label' 	=> esc_html__( 'Heading', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Booking & Rental Wordpress Theme', 'remons' ),
					'rows'      => 3
				]
			);

			$this->add_control(
				'text',
				[
					'label' 	=> esc_html__( 'Text', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'For', 'remons' ),
				]
			);

			$this->add_control(
				'heading2',
				[
					'label' 	=> esc_html__( 'Heading 2', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'rows'      => 3
				]
			);

			// Repeater
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'list_title',
				[
					'label' 		=> esc_html__( 'Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Cars' , 'remons' ),
					'label_block' 	=> true,
				]
			);

			$this->add_control(
				'tab_list',
				[
					'label' 	=> esc_html__( 'Repeater List', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'list_title' => esc_html__( 'Cars', 'remons' ),
						],
						[
							'list_title' => esc_html__( 'Shipping', 'remons' ),
						],
						[
							'list_title' => esc_html__( 'Scooters', 'remons' ),
						],
						[
							'list_title' => esc_html__( 'Villa', 'remons' ),
						],
					],
					'title_field' => '{{{ list_title }}}',
				]
			);

			$this->add_responsive_control(
				'align_heading',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
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
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-animated-headline .cd-intro' => 'text-align: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		// SECTION TAB STYLE HEADING
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'typography_heading',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-animated-headline .cd-intro .heading',
				]
			);

			$this->add_control(
				'color_heading',
				[
					'label'	 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-animated-headline .cd-intro .heading' => 'color : {{VALUE}};'	
					],
				]
			);

			$this->add_responsive_control(
				'heading_margin',
				[
					'label' 	 => esc_html__( 'Margin', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-animated-headline .cd-intro .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section();

		// SECTION TAB STYLE REPEATER
		$this->start_controls_section(
			'section_repeater_style',
			[
				'label' => esc_html__( 'Reapeater', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'typography_repeater',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-animated-headline .cd-headline b',
				]
			);

			$this->add_control(
				'color_repeater',
				[
					'label'	 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-animated-headline .cd-headline b' => 'color : {{VALUE}};'	
					],
				]
			);

			$this->add_control(
				'color_repeater_line',
				[
					'label'	 	=> esc_html__( 'Line Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-animated-headline .cd-headline .cd-words-wrapper:after' => 'background-color : {{VALUE}};'	
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

		// Get heading
		$heading = remons_get_meta_data( 'heading', $settings );

		// Get text
		$text = remons_get_meta_data( 'text', $settings );

		// Get heading 2
		$heading2 = remons_get_meta_data( 'heading2', $settings );

		// replace % to %% avoid printf error
		if ( false !== strpos( $heading2, '%' ) ) {
		    $heading2 = str_replace( '%', '%%', $heading2 );
		}

		// Get tab list
		$tab_list = remons_get_meta_data( 'tab_list', $settings );

		?>
			<div class="ova-animated-headline">
				<div class="cd-intro">
					<h2 class="heading"><?php echo wp_kses_post( $heading ); ?></h2>
					<h3 class="heading cd-headline clip is-full-width">
						<span><?php echo wp_kses_post( $text ); ?></span>
						<span class="cd-words-wrapper">
							<?php if ( remons_array_exists( $tab_list ) ):
								foreach ( $tab_list as $k => $list ) :?>
								<b class="<?php if ( $k == 0 ) echo esc_attr( 'is-visible' ) ; ?>">
									<?php echo esc_html( remons_get_meta_data( 'list_title', $list ) ); ?>	
								</b>		
							<?php endforeach;
							endif; ?>
						</span>
					</h3>
					<h2 class="heading"><?php echo wp_kses_post( $heading2 ); ?></h2>
				</div>
			</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Animated_Headline() );