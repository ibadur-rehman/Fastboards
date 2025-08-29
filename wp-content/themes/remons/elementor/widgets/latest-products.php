<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Latest_Products
 */
class Remons_Elementor_Latest_Products extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_latest_products';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Latest Products', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-post-list';
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
		return [ '' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-latest-products', REMONS_URI.'/assets/scss/elementor/products/latest-products.css' );

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

			// init
			$categories = $default_cat = [];

			// Get product categories
			$product_categories = get_categories([
				'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
			]);

			if ( remons_array_exists( $product_categories ) ) {
				foreach ( $product_categories as $k => $cat ) {
				  	$categories[$cat->term_id] = $cat->name;

				  	if ( $k <= 3 ) array_push( $default_cat, $cat->term_id );
			  	}
			}

		  	$this->add_control(
				'categories',
				[
					'label' 		=> esc_html__( 'Select Category', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $categories,
					'default' 		=> $default_cat,
				]
			);

			$this->add_control(
				'show_featured',
				[
					'label' 		=> esc_html__( 'Only Show Featured', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'total_count',
				[
					'label' 	=> esc_html__( 'Total', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'desc',
					'options' 	=> [
						'asc' 	=> esc_html__( 'Ascending', 'remons' ),
						'desc' 	=> esc_html__( 'Descending', 'remons' ),
					]
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' 	=> esc_html__( 'Order By', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ID',
					'options' 	=> [
						'none' 		=> esc_html__( 'None', 'remons' ),
						'ID' 		=> esc_html__( 'ID', 'remons' ),
						'title' 	=> esc_html__( 'Title', 'remons' ),
						'date' 		=> esc_html__( 'Date', 'remons' ),
						'modified' 	=> esc_html__( 'Modified', 'remons' ),
						'rand' 		=> esc_html__( 'Rand', 'remons' ),
					]
				]
			);

		$this->end_controls_section();

		// SECTION TAB STYLE GENERAL
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => esc_html__( 'General', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'item_gap',
				[
					'label' 	=> esc_html__( 'Column Gap', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-latest-products .item' => 'gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'margin_item',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-products .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
				'general_tabs'
			);

			$this->start_controls_tab(
				'general_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'remons' ),
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'general_background',
						'types' 	=> [ 'classic', 'gradient'],
						'selector' 	=> '{{WRAPPER}} .ova-latest-products .item',
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'general_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'remons' ),
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'general_background_hover',
						'types' 	=> [ 'classic', 'gradient'],
						'selector' 	=> '{{WRAPPER}} .ova-latest-products .item:hover',
					]
				);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'general_box_shadow',
					'selector' 	=> '{{WRAPPER}} .ova-latest-products .item',
				]
			);

		$this->end_controls_section(); // END SECTION TAB STYLE General

		// Image
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
 			$this->add_responsive_control(
				'img_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-products .item .media a img' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'img_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-products .item .media a img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

 		$this->end_controls_section();
		 
		// SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-latest-products .item .info .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-products .item .info .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-products .item:hover .info .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-products .item .info .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// SECTION TAB STYLE PRICE
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => esc_html__( 'Price', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'price_typography',
					'selector' 	=> '{{WRAPPER}} .ova-latest-products .item .info .ovabrw-price',
				]
			);

			$this->add_control(
				'color_price',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-products .item .info .ovabrw-price' => 'color : {{VALUE}};',
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

		// Get categories
		$categories = $settings['categories'];

		// Get posts per page
		$posts_per_page = remons_get_meta_data( 'total_count', $settings );

		// Get order
		$order = remons_get_meta_data( 'order', $settings );

		// Get orderby
		$order_by = remons_get_meta_data( 'order_by', $settings );

		// Base query
		$base_query = [
            'post_type'         => 'product',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_per_page,
            'orderby'           => $order_by,
            'order'             => $order
        ];

        // Category query
        if ( remons_array_exists( $categories ) ) {
            $base_query['tax_query'] = [
                [
                	'taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $categories,
                    'operator'  => 'IN'
                ]
            ];
        } // END if

        // Show featured
        if ( 'yes' === remons_get_meta_data( 'show_featured', $settings ) ) {
	        $featured = [
	        	'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN'
	        ];

	        array_push( $base_query['tax_query'], $featured );
	    } // END if

	    // Get products
        $products = new WP_Query( $base_query );

		?>

		<div class="ova-latest-products">
			<?php if ( $products->have_posts()) : while( $products->have_posts()) : $products->the_post(); 
				$pid 		= get_the_ID();
				$product   	= wc_get_product( $pid );
				$image_id  	= $product->get_image_id();
				$link 		= $product->get_permalink();
				$title 		= $product->get_title();
				$url_thumb 	= wp_get_attachment_image_url( $image_id, 'thumbnail' );
			?>
				<div class="item">
					<div class="media">
			        	<a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title ); ?>">
			        		<img src="<?php echo esc_url( $url_thumb ) ?>" alt="<?php echo esc_attr( $title ); ?>">
			        	</a>
			        </div>

			        <div class="info">
			        	<a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title ); ?>">
			            	<h4 class="title">
					          	<?php echo wp_kses_post( $title ); ?>
					   	 	</h4>
					    </a>
					   <?php ovabrw_get_template( 'modern/products/cards/sections/ovabrw-card-price.php' ); ?>
			        </div>
				</div>
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Latest_Products() );