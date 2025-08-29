<?php if ( ! defined ('ABSPATH') ) exit(); // exit if accessed directly

// Check is actived BRW $ Woo plugin
if ( !remons_is_brw_active()  || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Slider
 */
class Remons_Elementor_Product_Grid extends \Elementor\Widget_Base{
	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons-elementor-product-grid';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Product Grid' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-products-archive';
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
		return [];
	}

	/**
	 * Get styles depends
	 */
	public function get_style_depends() {
		return [];
	}

	/**
	 * Register control
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label'	=> esc_html__( 'Content', 'remons' ),
			]
		);

			// init categories
			$categories = [];

			// Default_category
			$default_category = [];

			// Get product categories
			$product_categories = get_categories([
				'taxonomy'	=> 'product_cat',
				'orderby'	=> 'name',
				'order'		=> 'ASC'
			]);

			if ( remons_array_exists( $product_categories ) ) {
				foreach ( $product_categories as $k => $category ) {
					$categories[$category->term_id] = $category->name;

					if( $k <= 3  ) array_push( $default_category, $category->term_id );
				}
			}else {
				$categories[''] = esc_html__( 'Category not found', 'remons' );
			}

			$this->add_control(
				'categories', 
				[
					'label'			=> esc_html__( 'Select Category', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::SELECT2,
					'label_block'	=> true,
					'multiple'		=> true,
					'options'		=> $categories,	
					'default'		=> $default_category,	
				]
			);

			// Get cart template
			$card_templates = ovabrw_get_card_templates();
			if( !ovabrw_array_exists( $card_templates ) ) $card_templates = [];

			$this->add_control(
				'card_templates',
				[
					'label'		=> esc_html__( 'Choose cart', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::SELECT,
					'default'	=> 'cardmedical',
					'options'	=> $card_templates
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label'		=> esc_html__( 'Post per page', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::NUMBER,
					'min'		=> -1,
					'default'	=> 3,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label'		=> esc_html__( 'Order By', 'remons' ),
					'type'		=> Elementor\Controls_Manager::SELECT,
					'default'	=> 'date',
					'options'	=> [
						'ID'			=> esc_html__( 'ID', 'remons' ),
						'title'			=> esc_html__( 'Title', 'remons' ),
						'date'			=> esc_html__( 'Date', 'remons' ),
						'modified'		=> esc_html__( 'Modified', 'remons' ),
						'rand'			=> esc_html__( 'Rand', 'remons' ),
						'menu_order'	=> esc_html__( 'Menu order', 'remons' )
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'		=> esc_html__( 'Order', 'remons' ),
					'type'		=> Elementor\Controls_Manager::SELECT,
					'default'	=> 'DESC',
					'options'	=> [
						'ASC'	=> esc_html__( 'Ascending', 'remons' ),
						'DESC'	=> esc_html__( 'Descending', 'remons' ) 
					],
				]
			);

		$this->end_controls_section();

		// TAB STYLE IMAGE
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
	public function render() {
		// Get setting
		$settings = $this->get_settings_for_display();

		// Number of items
		$numberof_items = (int)remons_get_meta_data( 'item_number', $settings );

		// Cart Template
		$card_template = remons_get_meta_data( 'card_templates', $settings );

		$args = [
			'categories'		=> $settings['categories'],
			'posts_per_page'	=> $settings['posts_per_page'],
			'orderby'			=> $settings['orderby'],
			'order'				=> $settings['order']
		];

		// Get product
		$products = OVABRW()->options->get_product_from_search([
			'posts_per_page'	=> remons_get_meta_data( 'posts_per_page', $settings, 5 ),
			'orderby'			=> remons_get_meta_data( 'orderby', $settings, 'date' ),
			'order'				=> remons_get_meta_data( 'order', $settings, 'DESC' ),
			'category_ids'		=> remons_get_meta_data( 'categories', $settings )
		]);

		if ( $products->have_posts() ): ?>
			<div class="ovabrw-product-list">
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
$widgets_manager->register( new Remons_Elementor_Product_Grid() );