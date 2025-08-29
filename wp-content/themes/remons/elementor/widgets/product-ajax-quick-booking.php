<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Ajax_Quick_Booking
 */
class Remons_Elementor_Product_Ajax_Quick_Booking extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_ajax_quick_booking';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ajax Quick Booking', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-tabs';
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
		return [ 'remons-elementor-product-ajax-quick-booking' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-ajax-quick-booking', REMONS_URI.'/assets/scss/elementor/products/product-ajax-quick-booking.css' );
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
			$product_ids = [];

			// Default product
			$default_product = [];

			// Get rental products
			$rental_products = OVABRW()->options->get_rental_product_ids();
			if ( ovabrw_array_exists( $rental_products ) ) {
				foreach ( $rental_products as $pid ) {
					$product_ids[$pid] = get_the_title( $pid );

					// Default product
					if ( !ovabrw_array_exists( $default_product ) ) $default_product = [ $pid ];
				}
			} else {
				$product_ids[''] = esc_html__( 'There are no rental products', 'remons' );
			}

			$this->add_control(
				'product_ids',
				[
					'label' 		=> esc_html__( 'Choose Product', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $product_ids,
					'default' 		=> $default_product
				]
			);

			$this->add_control(
				'filter_type',
				[
					'label' 	=> esc_html__( 'Filter Type', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'list',
					'options' 	=> [
						'list' 			=> esc_html__( 'List', 'remons' ),
						'list_vertical' => esc_html__( 'Vertical List', 'remons' ),
						'select' 		=> esc_html__( 'Select', 'remons' ),
					]
				]
			);

			$this->add_control(
				'show_gallery',
				[
					'label' 		=> esc_html__( 'Show Gallery', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'separator' 	=> 'before'
				]
			);

			$this->add_control(
				'show_short_desc',
				[
					'label' 		=> esc_html__( 'Show Short Description', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'show_button',
				[
					'label' 		=> esc_html__( 'Show Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Read More', 'remons' ),
					'condition' => [
						'show_button' => 'yes'
					]
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'caregory_section',
			[
				'label' => esc_html__( 'Product', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'term_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item',
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
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor_item',
						[
							'label'		=> esc_html__( 'Background Color Item', 'remons' ),
							'type'		=> \Elementor\Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item'	=> 'background-color: {{VALUE}}',
							],
							'condition' => [
					            'filter_type' => 'list_vertical',
					        ],
						]
					);

					$this->add_control(
						'term_bgcolor',
						[
							'label'		=> esc_html__( 'Background Color', 'remons' ),
							'type'		=> \Elementor\Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter'	=> 'background-color: {{VALUE}}',
							],
							'condition' => [
					            'filter_type' => 'list_vertical',
					        ],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' 		=> 'term_border',
							'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item',
							'condition' => [
					            'filter_type' => 'list_vertical',
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
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor_hover',
						[
							'label'		=> esc_html__( 'Background Color', 'remons' ),
							'type'		=> \Elementor\Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item:hover'	=> 'background-color: {{VALUE}}',
							],
							'condition' => [
					            'filter_type' => 'list_vertical',
					        ],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' 		=> 'term_border_hover',
							'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item:hover',
							'condition' => [
					            'filter_type' => 'list_vertical',
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
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item.active' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'term_bgcolor_active',
						[
							'label'		=> esc_html__( 'Background Color', 'remons' ),
							'type'		=> \Elementor\Controls_Manager::COLOR,
							'selectors'	=> [
								'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item.active'	=> 'background-color: {{VALUE}}',
							],
							'condition' => [
					            'filter_type' => 'list_vertical',
					        ],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' 		=> 'term_border_active',
							'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item.active',
							'condition' => [
					            'filter_type' => 'list_vertical',
					        ],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'term_padding_item',
				[
					'label' 		=> esc_html__( 'Padding Item', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'description' => esc_html__( 'Applies padding to each product filter item.', 'remons' ),
					'condition' => [
			            'filter_type' => 'list_vertical',
			        ],
				]
			);

			$this->add_responsive_control(
				'term_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'term_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .products-filter .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'booking_form_style',
			[
				'label' => esc_html__( 'Form', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'form_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .quick-booking-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'form_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .quick-booking-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
			    'form_border_radius',
			    [
			        'label' => esc_html__( 'Border Radius', 'remons' ),
			        'type' => \Elementor\Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', '%', 'em', 'rem' ],
			        'selectors' => [
			            '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .quick-booking-wrap .ovabrw-modern-product .ovabrw-product-form-tabs .ovabrw-tab-head' => 
			                'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
			            '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .quick-booking-wrap .ovabrw-modern-product .ovabrw-product-form-tabs .ovabrw-tab-content #booking_form' => 
			                'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
			            '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .quick-booking-wrap .ovabrw-modern-product .ovabrw-product-form-tabs ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'short_desc_style_section',
			[
				'label' => esc_html__( 'Short Description', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'short_desc_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .content-product .ovabrw-product-short-description',
				]
			);

			$this->add_control(
				'short_desc_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .content-product .ovabrw-product-short-description' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Details Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .ovabrw-product-ajax-quick-booking .content-product .details-button',
				]
			);

			$this->add_control(
				'button_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .content-product .details-button' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'button_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .content-product .details-button:hover' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_style_section',
			[
				'label'	=> esc_html__( 'Gallery', 'remons' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'gallery_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-ajax-quick-booking .ajax-quick-booking-result .content-product .gallery .product-gallery .gallery-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Get product ids
		$product_ids = ovabrw_get_meta_data( 'product_ids', $settings );

		// Get filter type
		$filter_type = ovabrw_get_meta_data( 'filter_type', $settings );

		// Get show gallery
		$show_gallery = ovabrw_get_meta_data( 'show_gallery', $settings );

		// Show short description
		$show_short_desc = ovabrw_get_meta_data( 'show_short_desc', $settings );

		// Show button
		$show_button = ovabrw_get_meta_data( 'show_button', $settings );

		// Text button
		$text_button = ovabrw_get_meta_data( 'text_button', $settings, esc_html__( 'Read More', 'remons' ));

		if ( ovabrw_array_exists( $product_ids ) ):
			$first_pid = reset( $product_ids );
		?>
			<div class="ovabrw-product-ajax-quick-booking <?php echo esc_attr( $filter_type ); ?>">
				<div class="filter-wrap">
					<?php if ( 'select' === $filter_type ): ?>
						<select class="products-select-filter">
							<?php foreach ( $product_ids as $k => $product_id ):
								$product_name = get_the_title( $product_id );
							?>
								<option class="item" value="<?php echo esc_attr( $product_id ); ?>">
									<?php echo esc_html( $product_name ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					<?php else : ?>
						<ul class="products-filter">
							<?php foreach ( $product_ids as $k => $product_id ):
								$product_name  = get_the_title( $product_id );
							?>
								<li
									class="item <?php if ( $k == 0 ) echo esc_attr( 'active' ); ?>"
									data-product-id="<?php echo esc_attr( $product_id ); ?>"
								>
									<?php echo esc_html( $product_name ); ?>
									<?php if ( 'list_vertical' == $filter_type ): ?>
										<img src="<?php echo get_the_post_thumbnail_url( $product_id ); ?>" alt="<?php echo esc_attr( $product_name ); ?>"/>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="quick-booking-wrap brw_modern_white_form">
					<div class="wrap-ajax-quick-booking-result">
						<?php do_action( 'woocommerce_before_single_product' ); ?>
						<div class="ajax-quick-booking-result">
							<div class="ovabrw-modern-product">
								<?php ovabrw_get_template( 'modern/single/detail/ovabrw-product-form-tabs.php', [
									'product_id' => $first_pid
								]); ?>
							</div>

							<div class="content-product">
							<?php
						   		$product 		= wc_get_product( $first_pid ); 
								$gallery_ids 	= $product->get_gallery_image_ids(); 
								$img_id 	 	= $product->get_image_id();
								$img_url 		= wp_get_attachment_url( $img_id );
								$img_alt 		= get_post_meta( $img_id, '_wp_attachment_image_alt', true );

								if ( !$img_alt ) $img_alt = get_the_title( $img_id );

								if ( 'yes' === $show_gallery ):
									if ( ovabrw_array_exists( $gallery_ids ) ): ?>
										<div class="gallery">
											<div class="product-gallery" >
												<div class="gallery-item">
													<a class="gallery-fancybox" data-fancybox="paqb-gallery" data-src="<?php echo esc_url( $img_url ); ?>">
									  					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
									  				</a>
												</div>
												<?php foreach ( $gallery_ids as $k => $gallery_id ):
													$gallery_url = wp_get_attachment_url( $gallery_id );
													$gallery_alt = get_post_meta( $gallery_id, '_wp_attachment_image_alt', true );

													if ( !$gallery_alt ) {
														$gallery_alt = get_the_title( $gallery_id );
													}
												?>
													<div class="gallery-item">
														<a class="gallery-fancybox" data-fancybox="paqb-gallery" data-src="<?php echo esc_url( $gallery_url ); ?>">
										  					<img src="<?php echo esc_url( $gallery_url ); ?>" alt="<?php echo esc_attr( $gallery_alt ); ?>">
										  				</a>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									<?php endif;
								endif;

								if ( 'yes' === $show_short_desc ) {
									ovabrw_get_template( 'modern/single/detail/ovabrw-product-short-description.php', array('product_id' => $first_pid ) );
								}

								if ( 'yes' === $show_button ): ?>
									<a class="details-button" href="<?php echo esc_url( $product->get_permalink() ); ?>">
										<span><?php echo esc_html( $text_button );?></span>
										<i aria-hidden="true" class="ovaicon ovaicon-next"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<?php do_action( 'woocommerce_after_single_product' ); ?>
					</div>

					<span class="ovabrw-loader"></span>
					<input
						type="hidden"
						name="data-ajax-quick-booking"
						data-show_gallery="<?php echo esc_attr( $show_gallery ); ?>"
						data-show_short_desc="<?php echo esc_attr( $show_short_desc ); ?>"
						data-show_button="<?php echo esc_attr( $show_button ); ?>"
						data-text_button="<?php echo esc_attr( $text_button ); ?>"
					/>
				</div>
			</div>
		<?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Ajax_Quick_Booking() );