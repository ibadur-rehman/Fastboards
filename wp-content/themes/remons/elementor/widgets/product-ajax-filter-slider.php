<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Ajax_Filter_Slider
 */
class Remons_Elementor_Product_Ajax_Filter_Slider extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_ajax_filter_slider';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Category Filter Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-carousel';
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
		return [ 'remons-elementor-product-ajax-filter-slider' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-ajax-filter-slider', REMONS_URI.'/assets/scss/elementor/products/product-ajax-filter-slider.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			// Get card templates
			$card_templates = ovabrw_get_card_templates();
			if ( !ovabrw_array_exists( $card_templates ) ) $card_templates = [];

			$this->add_control(
				'card_template',
				[
					'label' 	=> esc_html__( 'Card template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'card1',
					'options' 	=> $card_templates,
				]
			);

			// init
			$product_categories = [];

			// Default
			$default_category = [];

			// Get product categories
			$categories = get_categories([
				'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
			]);
		  	
		  	if ( ovabrw_array_exists( $categories ) ) {
			  	foreach ( $categories as $k => $category ) {
				  	$product_categories[$category->term_id] = $category->name;

				  	if ( $k < 3 ) array_push( $default_category, $category->term_id );
			  	}
		  	}

		  	$this->add_control(
				'categories',
				[
					'label' 		=> esc_html__( 'Select Category', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $product_categories,
					'default' 		=> $default_category,
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label'   => esc_html__( 'Posts per page', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'min'     => -1,
					'default' => 6,
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
					'default' => 'no',
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
					'default' => 'no',
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
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'caregory_section',
			[
				'label' => esc_html__( 'Category Filter', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'term_column_gap',
				[
					'label' 		=> esc_html__( 'Gap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 60,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter' => 'column-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'term_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term',
				]
			);

			$this->start_controls_tabs(
				'term_tabs'
			);

				$this->start_controls_tab(
					'term_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'term_color',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'term_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'term_color_hover',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor_hover',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'term_active_tab',
					[
						'label' => esc_html__( 'Active', 'remons' ),
					]
				);

					$this->add_control(
						'term_color_active',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term.active' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor_active',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term.active' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'item_term_padding',
				[
					'label' 		=> esc_html__( 'Item Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'item_term_border_radius',
				[
					'label' 		=> esc_html__( 'Item Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'item_term_margin',
				[
					'label' 		=> esc_html__( 'Item Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'item_term_box_shadow',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter .item-term',
				]
			);

			$this->add_control(
				'show_separator',
				[
					'label'   => esc_html__( 'Show Separator', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'remons' ),
						'no'  => esc_html__( 'No', 'remons' ),
					],
					'frontend_available' => true,
					'separator' => 'before'
				]
			);

			$this->add_responsive_control(
				'term_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'term_border_radius',
				[
					'label' 		=> esc_html__( 'Item Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'term_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'term_border',
					'selector' => '{{WRAPPER}} .ovabrw-product-ajax-filter .categories-filter',
				]
			);
		
		$this->end_controls_section();

		// STYLE DOT CONTROL
		$this->start_controls_section(
			'section_dot_control',
			[
				'label' 	=> esc_html__( 'Dot Control', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots_control' => 'yes',
				],
			]
		);

			$this->add_control(
				'dot_color',
				[
					'label'     => esc_html__( 'Color', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .owl-dots .owl-dot span' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dot_color_active',
				[
					'label'     => esc_html__( 'Color Active', 'remons' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .owl-dots .owl-dot.active span' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'dot_control_size',
				[
					'label' 	=> esc_html__( 'Size', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'range' 	=> [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'dot_control_margin',
				[
					'label'      => esc_html__( 'Margin', 'remons' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ovabrw-product-ajax-filter .owl-dots .owl-dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$categories = ovabrw_get_meta_data( 'categories', $settings );
		if ( !ovabrw_array_exists( $categories ) ) return;

		// Get card template
		$card_template = ovabrw_get_meta_data( 'card_template', $settings );

		// Number of items
		$numberof_items = (int)ovabrw_get_meta_data( 'item_number', $settings );

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

		// For card5 & card6
		if ( 'card5' === $card_template || 'card6' === $card_template ) {
			if ( $numberof_items > 2 ) {
			  	$numberof_items = 2;
			}

			$responsive = [
				'0' => [
					'items' => 1,
				],
	        	'767' => [
	        		'items' => 1,
	        	],
	        	'1024' => [
	        		'items' => 1,
	        	],
	        	'1200' => [
	        		'items' => $numberof_items
	        	]
			];
		}

		// Slider options
		$slide_options = [
			'items' 				=> $numberof_items,
			'slideBy' 				=> ovabrw_get_meta_data( 'slides_to_scroll', $settings ),
			'margin' 				=> ovabrw_get_meta_data( 'margin_item', $settings ),
			'autoplayTimeout' 		=> ovabrw_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed' 			=> ovabrw_get_meta_data( 'smartspeed', $settings ),
			'autoplayHoverPause' 	=> 'yes' === ovabrw_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
			'loop' 					=> 'yes' === ovabrw_get_meta_data( 'infinite', $settings ) ? true : false,
			'autoplay' 				=> 'yes' === ovabrw_get_meta_data( 'autoplay', $settings ) ? true : false,
			'nav' 					=> 'yes' === ovabrw_get_meta_data( 'nav_control', $settings ) ? true : false,
			'dots' 					=> 'yes' === ovabrw_get_meta_data( 'dots_control', $settings ) ? true : false,
			'rtl' 					=> is_rtl() ? true : false,
			'nav_left'              => 'brwicon-left',
        	'nav_right'             => 'brwicon-right-1',
			'responsive' 			=> $responsive
		];

		// Data
		$args = [
			'template' 			=> $card_template,
			'categories' 		=> $categories,
			'posts_per_page' 	=> $settings['posts_per_page'],
			'orderby' 			=> $settings['orderby'],
			'order' 			=> $settings['order'],
			'show_separator'    => $settings['show_separator'],
		];

		// Posts per page
		$posts_per_page = (int)ovabrw_get_meta_data( 'posts_per_page', $settings );

		// Orderby
		$orderby = ovabrw_get_meta_data( 'orderby', $settings );

		// Order
		$order = ovabrw_get_meta_data( 'order', $settings );

		// Show separator
		$show_separator = ovabrw_get_meta_data( 'show_separator', $settings );

		// Get products
		$products = OVABRW()->options->get_product_from_search([
			'paged' 			=> 1,
			'posts_per_page' 	=> $posts_per_page,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
			'term_id' 			=> reset( $args['categories'] )
		]);

		?>
		<div class="ovabrw-product-ajax-filter-slider ovabrw-product-ajax-filter">
			<div class="filter-wrap">
				<ul class="categories-filter">
					<?php foreach ( $categories as $k => $term_id ):
						$term_name = esc_html__( 'All', 'remons' );

						if ( $term_id ) {
							$term_obj = get_term( $term_id, 'product_cat' );

							if ( $term_obj ) {
								$term_name = $term_obj->name;
							}
						}
					?>
						<li
							class="item-term <?php if ( 0 == $k ) echo esc_attr( 'active' ); ?>"
							data-term-id="<?php if ( $term_id ) echo esc_attr( $term_id ); ?>"
						>
							<?php echo esc_html( $term_name ); ?>
						</li>
						<?php if ( 'yes' === $show_separator ): ?>
							<li class="separator"></li>
						<?php endif;
					endforeach; ?>
				</ul>
			</div>
			<div class="ovabrw-result">
				<div class="ovabrw-product-filter">
					<div class="ovabrw-product-filter-slide owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $slide_options ) ); ?>">
						<?php if ( $products->have_posts() ) : while ( $products->have_posts() ): $products->the_post(); ?>
							<div class="item">
								<?php ovabrw_get_template( 'modern/products/cards/ovabrw-'.$card_template.'.php', [
									'thumbnail_type' => 'image'
								]); ?>
							</div>
						<?php endwhile; else : ?>
							<div class="not-found">
								<?php esc_html_e( 'No products found!', 'remons' ); ?>
							</div>
						<?php endif; wp_reset_postdata(); ?>
					</div>
				</div>
				<span class="ovabrw-loader"></span>
				<input
					type="hidden"
					name="ovabrw-data-ajax-filter"
					data-template="<?php echo esc_attr( $card_template ); ?>"
					data-posts-per-page="<?php echo esc_attr( $posts_per_page ); ?>"
					data-orderby="<?php echo esc_attr( $orderby ); ?>"
					data-order="<?php echo esc_attr( $order ); ?>"
					data-options="<?php echo esc_attr( json_encode( $slide_options ) ); ?>"
				/>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Ajax_Filter_Slider() );