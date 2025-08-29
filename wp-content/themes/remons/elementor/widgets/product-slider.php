<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Slider
 */
class Remons_Elementor_Product_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Products Slider 2', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slider-album';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons-product' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		return [ 'remons-elementor-product-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-slider', REMONS_URI.'/assets/scss/elementor/products/product-slider.css' );
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

			// init categories
			$categories = [];

			// Default category
			$default_category = [];

			// Get product categories
			$product_categories = get_categories([
				'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
			]);
		  	
		  	if ( remons_array_exists( $product_categories ) ) {
			  	foreach ( $product_categories as $k => $category ) {
				  	$categories[$category->term_id] = $category->name;

				  	if ( $k <= 3 ) array_push( $default_category, $category->term_id );
			  	}
		  	} else {
			  	$categories[''] = esc_html__( 'Category not found', 'remons' );
		  	}

		  	$this->add_control(
				'categories',
				[
					'label' 		=> esc_html__( 'Select Category', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $categories,
					'default' 		=> $default_category,
				]
			);
			
			// Get card templates
			$card_templates = ovabrw_get_card_templates();
			if ( !ovabrw_array_exists( $card_templates ) ) $card_templates = [];

			$this->add_control(
				'card_template',
				[
					'label' 	=> esc_html__( 'Choose Card', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'cardvilla',
					'options' 	=> $card_templates,
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label'   => esc_html__( 'Posts per page', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'min'     => -1,
					'default' => 5,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 	=> esc_html__( 'Order By', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'date',
					'options' 	=> [
						'ID'  			=> esc_html__( 'ID', 'remons' ),
						'title' 		=> esc_html__( 'Title', 'remons' ),
						'date' 			=> esc_html__( 'Date', 'remons' ),
						'modified' 		=> esc_html__( 'Modified', 'remons' ),
						'rand' 			=> esc_html__( 'Random', 'remons' ),
						'menu_order' 	=> esc_html__( 'Menu Order', 'remons' )
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'DESC',
					'options' 	=> [
						'ASC'  	=> esc_html__( 'Ascending', 'remons' ),
						'DESC'  => esc_html__( 'Descending', 'remons' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options Slider', 'remons' ),
			]
		);

			$this->add_control(
				'item_number',
				[
					'label' 	=> esc_html__( 'Item number', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'remons' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'remons' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'margin_item',
				[
					'label' 	=> esc_html__( 'Margin item', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 30,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'false',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'false',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'remons' ),
					'type'      => \Elementor\Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'dots_control',
				[
					'label'   => esc_html__( 'Show Dots', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 220,
							'max' 	=> 600,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-slider .item .card-header .ovabrw-product-img-feature img' => 'height:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ovabrw-product-slider .item .card-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Number of items
		$numberof_items = (int)remons_get_meta_data( 'item_number', $settings );

		// Card Template
		$card_template = remons_get_meta_data( 'card_template', $settings );

		// Responsive
		$responsive = [
			'0' => [
				'items' => 1
			],
        	'767' => [
        		'items' => 2
        	],
        	'1024' => [
        		'items' => $numberof_items - 1
        	],
        	'1200' => [
        		'items' => $numberof_items
        	]
		];

		// Data
		$args = [
			'categories' 		=> $settings['categories'],
			'posts_per_page' 	=> $settings['posts_per_page'],
			'orderby' 			=> $settings['orderby'],
			'order' 			=> $settings['order'],
			'slide_options' 	=> [
				'items' 				=> $settings['item_number'],
				'slideBy' 				=> $settings['slides_to_scroll'],
				'margin' 				=> $settings['margin_item'],
				'autoplayTimeout' 		=> $settings['autoplay_speed'],
				'smartSpeed' 			=> $settings['smartspeed'],
				'autoplayHoverPause' 	=> $settings['pause_on_hover'] === 'yes' ? true : false,
				'loop' 					=> $settings['infinite'] === 'yes' ? true : false,
				'autoplay' 				=> $settings['autoplay'] === 'yes' ? true : false,
				'nav' 					=> $settings['nav_control'] === 'yes' ? true : false,
				'dots' 					=> $settings['dots_control'] === 'yes' ? true : false,
				'rtl' 					=> is_rtl() ? true : false,
				'nav_left'              => 'ovaicon-back',
	        	'nav_right'             => 'ovaicon-next',
				'responsive' 			=> $responsive,
			],
		];

		// Get products
		$products = OVABRW()->options->get_product_from_search([
			'posts_per_page' 	=> remons_get_meta_data( 'posts_per_page', $settings, 5 ),
			'orderby' 			=> remons_get_meta_data( 'orderby', $settings, 'date' ),
			'order' 			=> remons_get_meta_data( 'order', $settings, 'DESC' ),
			'category_ids' 		=> remons_get_meta_data( 'categories', $settings )
		]);

		// Slide options
		$slide_options = [
			'items' 				=> $numberof_items,
			'slideBy' 				=> remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> remons_get_meta_data( 'margin_item', $settings ),
			'autoplayTimeout' 		=> remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 			=> remons_get_meta_data( 'smartspeed', $settings ),
			'autoplayHoverPause' 	=> 'yes' === remons_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === remons_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === remons_get_meta_data( 'autoplay', $settings ) ? true : false,
			'nav' 					=> 'yes' === remons_get_meta_data( 'nav_control', $settings ) ? true : false,
			'dots' 					=> 'yes' === remons_get_meta_data( 'dots_control', $settings ) ? true : false,
			'rtl' 					=> is_rtl() ? true : false,
			'nav_left'              => 'ovaicon-back',
        	'nav_right'             => 'ovaicon-next',
			'responsive' 			=> $responsive
		];

		if ( $products->have_posts() ): ?>
			<div class="ovabrw-product-slider product-slide owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $slide_options ) ); ?>">
				<?php while ( $products->have_posts() ): $products->the_post(); ?>
					<?php ovabrw_get_template( 'modern/products/cards/ovabrw-'.sanitize_text_field( $card_template ).'.php', [ 'thumbnail_type' => 'image' ]); ?>
				<?php endwhile; ?>
			</div>
		<?php else: ?>
			<div class="not-found">
				<?php esc_html_e( 'No products found!', 'remons' ); ?>
			</div>
		<?php endif; wp_reset_postdata();
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Slider() );