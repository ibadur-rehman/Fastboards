<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Header_Banner
 */
class Remons_Elementor_Header_Banner extends \Elementor\Widget_Base {

	/**
	 * Constructor
	 */
	public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
        
        wp_enqueue_style( 'remons-elementor-header-banner', REMONS_URI.'/assets/scss/elementor/headers/header-banner.css', [], null );
    }

    /**
     * Get widget name
     */
	public function get_name() {
		return 'remons_elementor_header_banner';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Header Banner', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-archive-title';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
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
				'header_boxed_content',
				[
					'label' 	=> esc_html__( 'Display Boxed Content', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'default' 	=> 'no'
				]
			);

			$this->add_control(
				'header_bg_source',
				[
					'label' 	=> esc_html__( 'Display Background by Feature Image in Post/Page', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'default' 	=> 'no'
				]
			);

			// Reverse
			$this->add_control(
				'reverse_title_breadcrumbs',
				[
					'label' 	=> esc_html__( 'Reverse Title & Breadcrumbs', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'default' 	=> 'no',
				]
			);

			// Background Color
			$this->add_control(
				'cover_color',
				[
					'label' 		=> esc_html__( 'Background Cover Color', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::COLOR,
					'description' 	=> esc_html__( 'You can add background image in Advanced Tab', 'remons' ),
					'selectors' 	=> [
						'{{WRAPPER}} .cover_color' => 'background-color: {{VALUE}};',
					],
					'separator' 	=> 'after'
				]
			);

			// Title
			$this->add_control(
				'show_title',
				[
					'label' 	=> esc_html__( 'Show Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'default' 	=> 'yes',
					'selector'	=> '{{WRAPPER}} .header_banner_el .header_title',
				]
			);
			
			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Title Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header_banner_el .header_title' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' 		=> esc_html__( 'Title Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .header_banner_el .header_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'title_tag',
				[
					'label' 	=> esc_html__( 'Choose Title Format', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'options' 	=> [
						'h1' => esc_html__( 'H1', 'remons' ),
						'h2' => esc_html__( 'H2', 'remons' ),
						'h3' => esc_html__( 'H3', 'remons' ),
						'h4' => esc_html__( 'H4', 'remons' ),
						'h5' => esc_html__( 'H5', 'remons' ),
						'h6' => esc_html__( 'H6', 'remons' ),
						'div' => esc_html__( 'DIV', 'remons' ),
					],
					'default' => 'h1'
				]
			);
			

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'header_title',
					'label' 	=> esc_html__( 'Title Typo', 'remons' ),
					'selector'	=> '{{WRAPPER}} .header_banner_el .header_title'
				]
			);


			// Breadcrumbs
			$this->add_control(
				'show_breadcrumbs',
				[
					'label' 	=> esc_html__( 'Show Breadcrumbs', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'default' 	=> 'yes',
					'selector'	=> '{{WRAPPER}} .header_breadcrumbs',
					'separator' => 'before'
				]
			);
			
			$this->add_control(
				'breadcrumbs_color',
				[
					'label' 	=> esc_html__( 'Breadcrumbs Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li .separator i' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_control(
				'breadcrumbs_color_hover',
				[
					'label' 	=> esc_html__( 'Breadcrumbs Color hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li a:hover' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'header_breadcrumbs_typo',
					'label' 	=> esc_html__( 'Breadcrumbs Typography', 'remons' ),
					'selector'	=> '{{WRAPPER}} .header_banner_el ul.breadcrumb li'
				]
			);

			$this->add_responsive_control(
				'breadcrumbs_padding',
				[
					'label' 		=> esc_html__( 'Breadcrumbs Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .header_banner_el .header_breadcrumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


			// Style
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
					'selectors' => [
						'{{WRAPPER}} .wrap_header_banner' => 'text-align: {{VALUE}};',
						'{{WRAPPER}} .wrap_header_banner ul.breadcrumb' => 'width: auto; display: initial;'
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);
			

			$this->add_control(
				'class',
				[
					'label' => esc_html__( 'Class', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
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

		// Class background & attribute
		$class_bg = $attr_style = '';

		if ( 'yes' === remons_get_meta_data( 'header_bg_source', $settings ) ) {
			// Get current id
			$current_id = remons_get_current_id();

			// Get header background
			$header_bg_source = get_the_post_thumbnail_url( $current_id, 'full' );

			// Class background
			$class_bg = 'bg_feature_img';

			// Attribute style
			$attr_style = 'style="background: url( '.esc_attr( $header_bg_source ).' )" ';
		}

		// Get align
		$align = remons_get_meta_data( 'align', $settings );

		?>
	 	<div class="wrap_header_banner <?php echo esc_attr( $class_bg ).' '.esc_attr( $align ); ?>" <?php printf( '%s', $attr_style ); ?>>
	 		<?php if ( 'yes' === remons_get_meta_data( 'header_boxed_content', $settings ) ): ?>
	 			<div class="row_site">
	 				<div class="container_site">
	 		<?php endif; ?>
			 	<div class="cover_color"></div>
				<div class="header_banner_el <?php echo esc_attr( remons_get_meta_data( 'class', $settings ) ); ?>">
					<?php if ( 'yes' === remons_get_meta_data( 'show_title', $settings ) && 'yes' === remons_get_meta_data( 'reverse_title_breadcrumbs', $settings ) ): ?>
						<?php add_filter( 'remons_show_singular_title', '__return_false' ); ?>
						<<?php echo esc_html( $settings['title_tag'] ); ?> class=" header_title">
							<?php echo get_template_part( 'template-parts/parts/breadcrumbs_title' ); ?>
						</<?php echo esc_html( $settings['title_tag'] ); ?>>
					<?php endif;

					// Breadcrumbs
					if ( 'yes' === $settings['show_breadcrumbs'] ): ?>
						<div class="header_breadcrumbs">
							<?php echo get_template_part( 'template-parts/parts/breadcrumbs' ); ?>
						</div>
					<?php endif;

					if ( 'yes' == $settings['show_title'] && 'yes' != $settings['reverse_title_breadcrumbs'] ): ?>
						<?php add_filter( 'remons_show_singular_title', '__return_false' ); ?>
						<<?php echo esc_html( $settings['title_tag'] ); ?> class=" header_title">
							<?php echo get_template_part( 'template-parts/parts/breadcrumbs_title' ); ?>
						</<?php echo esc_html( $settings['title_tag'] ); ?>>
					<?php endif; ?>
				</div>
			<?php if ( 'yes' === remons_get_meta_data( 'header_boxed_content', $settings ) ): ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Header_Banner() );