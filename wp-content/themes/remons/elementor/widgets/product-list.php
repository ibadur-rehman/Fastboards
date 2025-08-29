<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is active Woo plugin
if ( !remons_is_woo_active() ) return ;

/**
 * Class Remons_Elementor_Product_List
 */
class Remons_Elementor_Product_List extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_list';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Product List', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-products';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons-product' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-list', REMONS_URI.'/assets/scss/elementor/products/product-list.css' );
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_product_list_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
			]
		);

			$this->add_control(
				'show_featured',
				[
					'label' 		=> esc_html__( 'Only Show Featured', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'product_type',
				[
					'label' 	=> esc_html__( 'Product Type', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'not_rental',
					'options' 	=> [
						'all' 				=> esc_html__( 'All', 'remons' ),
						'ovabrw_car_rental' => esc_html__( 'Rental products', 'remons' ),
						'not_rental' 		=> esc_html__( 'Not Rental products', 'remons' ),
					],
				]
			);

			$this->add_control(
				'columns',
				[
					'label' 	=> esc_html__( 'Columns', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'column3',
					'options' 	=> [
						'column1' => esc_html__( 'Column 1', 'remons' ),
						'column2' => esc_html__( 'Column 2', 'remons' ),
						'column3' => esc_html__( 'Column 3', 'remons' ),
						'column4' => esc_html__( 'Column 4', 'remons' ),
					],
				]
			);

			// init
			$categories = [];

			// Get product categories
			$product_categories = get_categories([
				'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
	        	'order'   	=> 'ASC'
			]);

			if ( remons_array_exists( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$categories[$cat->term_id] = $cat->cat_name;
				}
			}

			$this->add_control(
				'categories',
				[
					'label' 	=> esc_html__( 'Include Categories', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT2,
					'options' 	=> $categories,
					'multiple' 	=> true
				]
			);

			$this->add_control(
				'exclude_categories',
				[
					'label' 	=> esc_html__( 'Exclude Categories', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT2,
					'options' 	=> $categories,
					'multiple' 	=> true
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Posts Per Page', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 	=> esc_html__( 'Order By', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ID',
					'options' 	=> [
						'title' => esc_html__( 'Title', 'remons' ),
						'ID' 	=> esc_html__( 'ID', 'remons' ),
						'date' 	=> esc_html__( 'Date', 'remons' ),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ASC',
					'options' 	=> [
						'ASC' 	=> esc_html__( 'Ascending', 'remons' ),
						'DESC' 	=> esc_html__( 'Descending', 'remons' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_list_style',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'content_gap',
				[
					'label' 		=> esc_html__( 'Gap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 50,
							'step' 	=> 5,
						],
						'%' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-list' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'content_background',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-list li.product' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-list li.product',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'content_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-list li.product',
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'content_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-list li.product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-list li.product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
        
        // Title
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
					'selector' 	=> '{{WRAPPER}} .ova-product-list li.product .woocommerce-loop-product__title',
				]
			);

			$this->start_controls_tabs( 'title_tabs' );
				$this->start_controls_tab(
					'title_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'title_normal_color',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product .woocommerce-loop-product__title' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'title_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'title_hover_color',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product .woocommerce-loop-product__title:hover' => 'color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-list li.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_review_style',
			[
				'label' => esc_html__( 'Review', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'star_color',
				[
					'label' 	=> esc_html__( 'Star Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-list li.product .star-rating' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

        // Price
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
					'selector' 	=> '{{WRAPPER}} .ova-product-list li.product .price',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-list li.product .price' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		// Button style
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'style_tabs_button'
			);

				$this->start_controls_tab(
					'style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'button_typography',		
							'label' => esc_html__( 'Typography', 'remons' ),
							'selector' => '{{WRAPPER}} .ova-product-list li.product a.add_to_cart_button',
						]
					);

					$this->add_control(	
						'color_button',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product a.add_to_cart_button' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_button_background',
						[
							'label' 	=> esc_html__( 'Background ', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product a.add_to_cart_button' => 'background-color : {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' 		=> 'button_border',
							'label' 	=> esc_html__( 'Border', 'remons' ),
							'selector' 	=> '{{WRAPPER}} .ova-product-list li.product a.add_to_cart_button',
						]
					);
					
					$this->add_control(
						'border_radius_button',
						[
							'label'      => esc_html__( 'Border Radius', 'remons' ),
							'type'       => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
							'selectors'  => [
								'{{WRAPPER}} .ova-product-list li.product a.add_to_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							]
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(	
						'color_button_hover',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product:hover a.add_to_cart_button' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_button_background_hover',
						[
							'label' 	=> esc_html__( 'Background ', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-list li.product:hover a.add_to_cart_button' => 'background-color : {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' 		=> 'button_border_hover',
							'label' 	=> esc_html__( 'Border', 'remons' ),
							'selector' 	=> '{{WRAPPER}} .ova-product-list li.product:hover a.add_to_cart_button',
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Get product list
	 */
	protected function remons_get_product_list( $args ) {
		// Base query
		$args_query = [
			'post_type' 		=> 'product',
		    'post_status' 		=> 'publish',
		    'posts_per_page' 	=> $args['posts_per_page'],
		    'orderby' 			=> $args['orderby'],
		    'order'				=> $args['order'],
		    'tax_query' 		=> []
		];

		// Show featured
		if ( 'yes' === $args['show_featured'] ) {
	        $featured = [
	        	'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN'
	        ];

	        array_push( $args_query['tax_query'], $featured );
	    } // End
        
        // Product type
        if ( 'ovabrw_car_rental' == $args['product_type'] ) {
		    $type_args = [
		    	'taxonomy'  => 'product_type',
               	'field' 	=> 'slug',
               	'terms' 	=> $args['product_type'],
               	'operator'  => 'IN'
            ];

		    array_push( $args_query['tax_query'], $type_args );
        } elseif ( 'not_rental' == $args['product_type'] ) {
		    $type_args = [
		    	'taxonomy'  => 'product_type',
               	'field' 	=> 'slug',
               	'terms' 	=> [ 'simple', 'grouped', 'variable', 'external' ],
               	'operator'  => 'IN'
            ];

            array_push( $args_query['tax_query'], $type_args );
        } // End

        // Include categories
		if ( !empty( $args['include_cat'] ) && is_array( $args['include_cat'] ) ) {
			$include_cat = [
				'taxonomy' 	=> 'product_cat',
            	'field' 	=> 'term_id',
            	'terms'     => $args['include_cat'],
            	'operator'  => 'IN'
			];

			array_push( $args_query['tax_query'], $include_cat );
		} // End

		// Exclude categories
		if ( !empty( $args['exclude_cat'] ) && is_array( $args['exclude_cat'] ) ) {
			$exclude_cat = [
				[
					'taxonomy' 	=> 'product_cat',
					'field'    	=> 'term_id',
					'terms'    	=> $args['exclude_cat'],
					'operator' 	=> 'NOT IN'
				],
			];

			array_push( $args_query['tax_query'], $exclude_cat );
		} // End

		// Get products
		$products = new \WP_Query( $args_query );

		return $products;
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get column
		$column = remons_get_meta_data( 'columns', $settings );

		// Arguments
		$args = [
			'posts_per_page' 	=> remons_get_meta_data( 'posts_per_page', $settings ),
			'orderby' 			=> remons_get_meta_data( 'orderby', $settings ),
			'order' 			=> remons_get_meta_data( 'order', $settings ),
			'include_cat' 		=> remons_get_meta_data( 'categories', $settings ),
			'exclude_cat' 		=> remons_get_meta_data( 'exclude_categories', $settings ),
			'show_featured' 	=> remons_get_meta_data( 'show_featured', $settings ),
			'product_type' 		=> remons_get_meta_data( 'product_type', $settings )
		];
		
		// Get products
		$products = $this->remons_get_product_list( $args );

		if ( $products->have_posts() ): ?>
			<ul class="ova-product-list <?php echo esc_attr( $column ); ?>">
				<?php while ( $products->have_posts() ) : $products->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile; ?>
			</ul>
		<?php else: ?>
			<div class="ova-no-products-found">
				<?php echo esc_html__( 'No products found!', 'remons' ); ?>
			</div>
		<?php endif; wp_reset_postdata();
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_List() );