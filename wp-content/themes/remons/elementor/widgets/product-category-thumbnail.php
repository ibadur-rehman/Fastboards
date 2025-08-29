<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Category
 */
class Remons_Elementor_Product_Category extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {		
		return 'remons_elementor_product_category';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Category Thumbnail 2', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-product-categories';
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
		wp_enqueue_style( 'remons-elementor-product-category-thumbnail', REMONS_URI.'/assets/scss/elementor/products/product-category.css' );
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

			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Select Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
					],
				]
			);
			
			// Product categories
			$product_categories = [];

			// Default category
			$default_category = '';

  			// Get product categories
		  	$categories = get_categories([
		  		'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
		  	]);
		  	
		  	if ( ovabrw_array_exists( $categories ) ) {
			  	foreach ( $categories as $category ) {
				  	$product_categories[$category->term_id] = $category->name;

				  	// Default category
				  	if ( !$default_category ) $default_category = $category->term_id;
			  	}
		  	} else {
			  	$product_categories[''] = esc_html__( 'No categories found!', 'remons' );
		  	}

		  	$this->add_control(
				'category',
				[
					'label' 	=> esc_html__( 'Select Category', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> $default_category,
					'options' 	=> $product_categories
				]
			);

			$this->add_control(
				'target_link',
				[
					'label' 		=> esc_html__( 'Open in new window', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'show_count',
				[
					'label' 		=> esc_html__( 'Show Category Count', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'text_count',
				[
					'label' 	=> esc_html__( 'Text Count', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=>  esc_html__( 'Car Available', 'remons' ),
					'condition' => [
						'show_count' => 'yes'
					]
				]
			);

			$this->add_control(
				'text_count_many',
				[
					'label' 	=> esc_html__( 'Text Count Many', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=>  esc_html__( 'Cars Available', 'remons' ),
					'condition' => [
						'show_count' => 'yes'
					]
				]
			);

			$this->add_control(
				'show_review',
				[
					'label' 		=> esc_html__( 'Show Category Review', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'flaticon flaticon-sedan',
						'library' 	=> 'all',
					],
					'condition' => [
						'template' => 'template1'
					]
				]
			);

			$this->add_control(
				'custom_image',
				[
					'label' 		=> esc_html__( 'Custom Category Image', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'image',
				[
					'label' 	=> esc_html__( 'Choose Image', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::MEDIA,
					'default' 	=> [
						'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
					],
					'condition' => [ 'custom_image' => 'yes' ],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_style',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'content_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 140,
							'max' 	=> 380,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .ova-product-category' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .ova-product-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_section',
			[
				'label' 	=> esc_html__( 'Icon', 'remons' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'template' => 'template1'
				]
			]
		);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 200,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .main-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-product-category-wrapper .main-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .main-icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-product-category-wrapper .main-icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .main-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'name',
			[
				'label' => esc_html__( 'Name', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'name_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-wrapper .name',
				]
			);

			$this->add_control(
				'name_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .name' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'name_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

		$this->start_controls_section(
			'count',
			[
				'label' => esc_html__( 'Count', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'count_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-wrapper .count',
				]
			);

			$this->add_control(
				'count_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .count' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'count_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'review',
			[
				'label' => esc_html__( 'Review', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'review_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-category-wrapper .review-average .average',
				]
			);

			$this->add_control(
				'star_color',
				[
					'label' 	=> esc_html__( 'Star Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .review-average i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'review_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-category-wrapper .review-average .average' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'review_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-category-wrapper .review-average' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Get template
		$template = ovabrw_get_meta_data( 'template', $settings );

		// Icon
		$icon = ovabrw_get_meta_data( 'icon', $settings );

		// Term ID
		$term_id = absint( ovabrw_get_meta_data( 'category', $settings ) );

		// Get term object
		$term_obj = get_term( $term_id, 'product_cat' );
		if ( !$term_obj ) {
			$term_id 	= get_option( 'default_product_cat' );
			$term_obj 	= get_term( $term_id, 'product_cat' );
		} // END

		// Show count
		$show_count = ovabrw_get_meta_data( 'show_count', $settings );

		// Text count
		$text_count = ovabrw_get_meta_data( 'text_count', $settings );

		// Text count many
		$text_count_many = ovabrw_get_meta_data( 'text_count_many', $settings );

		// Show review
		$show_review = ovabrw_get_meta_data( 'show_review', $settings );

		// Thumbnail
		$thumbnail_url 	= \Elementor\Utils::get_placeholder_image_src();
		$thumbnail_alt 	= '';
		$thumbnail_id 	= get_term_meta( $term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			$thumbnail_url 	= wp_get_attachment_image_url( $thumbnail_id , 'medium' );
			$thumbnail_alt 	= get_post_meta( $thumbnail_id , '_wp_attachment_image_alt', true );
		}

		// Custom image
		$custom_image = ovabrw_get_meta_data( 'custom_image', $settings );
		if ( 'yes' === $custom_image ) {
			$thumbnail_url 	= isset( $settings['image']['url'] ) ? $settings['image']['url'] : \Elementor\Utils::get_placeholder_image_src();
			$thumbnail_alt 	= isset( $settings['image']['alt'] ) ? $settings['image']['alt'] : '';

			if ( !$thumbnail_alt ) {
				$thumbnail_alt = esc_html__('Product Category','remons');
			}
		}
		
		$term_link = get_term_link( $term_id );
		if ( is_object( $term_link ) && isset( $term_link->errors ) ) {
			$term_link = '#';
		}

		// Target
		$target = 'yes' === ovabrw_get_meta_data( 'target_link', $settings ) ? '_blank' : '_self';

		if ( $term_obj ): ?>
			<div class="ova-product-category-wrapper <?php echo esc_attr( $template ); ?>">
				<div class="ova-product-category">
					<a href="<?php echo esc_url( $term_link ); ?>" target="<?php echo esc_attr( $target ); ?>">
						<?php if ( 'template1' === $template ): ?>
							<div class="background-overlay"></div>
						<?php endif; ?>
						<div class="image-wrap">
							<?php if ( $thumbnail_url ): ?>
								<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ); ?>">
							<?php endif; ?>
						</div>
						<div class="info">
							<?php if ( ovabrw_get_meta_data( 'value', $icon ) && 'template1' === $template ): ?>
								<div class="main-icon">
									<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $term_obj && $term_obj->name ): ?>
								<h3 class="name">
									<?php echo esc_html( $term_obj->name ); ?>
								</h3>
							<?php endif;

							// Show count
							if ( $term_obj && 'yes' === $show_count ): ?>
								<?php if ( $term_obj->count === 1 || $term_obj->count === 0 ): ?>
									<span class="count"><?php printf( esc_html( '%s'.' '.$text_count ), $term_obj->count ); ?></span>
								<?php else: ?>
									<span class="count"><?php printf( esc_html( '%s'.' '.$text_count_many ), $term_obj->count ); ?></span>
								<?php endif; ?>
							<?php endif;

							// Show review
							if ( 'yes' === $show_review ) :
								$review_average = OVABRW()->options->get_average_product_review_by_cagegory( $term_id );
							?>
								<span class="review-average">
									<i aria-hidden="true" class="brwicon-star-2"></i>
									<span class="average">
										<?php echo esc_html( $review_average ); ?>
									</span>
								</span>
							<?php endif; ?>
						</div>
					</a>	
				</div>
				  
				<?php if ( 'template1' === $template ): ?>
					<a class="view-category" href="<?php echo esc_url( $term_link ); ?>" target="<?php echo esc_attr( $target ); ?>">	
						<i aria-hidden="true" class="flaticon2 flaticon2-right-arrow"></i>
					</a>
				<?php endif; ?>
			</div>
		<?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Category() );