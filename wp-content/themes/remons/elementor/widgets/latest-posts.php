<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Latest_Posts
 */
class Remons_Elementor_Latest_Posts extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_latest_posts';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Latest Posts', 'remons' );
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
		wp_enqueue_style( 'remons-elementor-latest-posts', REMONS_URI.'/assets/scss/elementor/blogs/latest-posts.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		// Categories
		$categories = [
			'all' => esc_html__( 'All', 'remons' )
		];
  		
  		// Get categories
		$post_categories = get_categories([
			'orderby' 	=> 'name',
			'order' 	=> 'ASC'
		]);

		if ( remons_array_exists( $post_categories ) ) {
			foreach ( $post_categories as $cat ) {
				$categories[$cat->slug] = $cat->cat_name;
			}
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
			]
		);	
			
			$this->add_control(
				'total_count',
				[
					'label' 	=> esc_html__( 'Post Total', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
					]
				]
			);

			$this->add_control(
			  	'category',
			  	[
				  	'label' 	=> esc_html__( 'Category', 'remons' ),
				  	'type' 		=> \Elementor\Controls_Manager::SELECT,
				  	'default' 	=> 'all',
				  	'options' 	=> $categories,
			  	]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__( 'Order', 'remons'),
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
						'{{WRAPPER}} .ova-latest-posts .item' => 'gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'padding_item',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-posts .item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-latest-posts .item ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item',
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
						'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item:hover',
					]
				);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'general_box_shadow',
					'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item',
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
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-posts .item .media a img' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-latest-posts .item .media a img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

 		$this->end_controls_section(); // END SECTION TAB STYLE Image
		 
		// META
		$this->start_controls_section(
			'section_meta',
			[
				'label' => esc_html__( 'Meta', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'meta_typography',
					'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item .info .item-meta',
				]
			);

			$this->add_control(
				'meta_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .item-meta .right a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon__color',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .item-meta .left i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_meta',
				[
					'label' 	=> esc_html__( 'Margin', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .item-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item .info .post-title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .post-title a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item:hover .info .post-title a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 	=> esc_html__( 'Margin', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section(); // END SECTION TAB STYLE TITLE
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Category
		$category = remons_get_meta_data( 'category', $settings );

		// Posts per page
		$posts_per_page = remons_get_meta_data( 'total_count', $settings );

		// Order
		$order = remons_get_meta_data( 'order', $settings );

		// Orderby
		$order_by = remons_get_meta_data( 'order_by', $settings );

		// Queries
		$args = [];

		// Postid
		$postid = [];
		if ( get_the_ID() ) $postid[] = get_the_ID();

		if ( 'all' == $category ) {
		  	$args = [
			  	'post_type' 		=> 'post',
			  	'post_status' 		=> 'publish',
			  	'posts_per_page' 	=> $posts_per_page,
			  	'order' 			=> $order,
	  		    'orderby' 			=> $order_by,
	  		    'post__not_in' 		=> $postid,
	  		    'fields'			=> 	'ids'
		  	];
		} else {
		  	$args = [
			  	'post_type' 		=> 'post', 
			  	'post_status' 		=> 'publish',
			  	'category_name'		=>	$category,
			  	'posts_per_page' 	=> 	$posts_per_page,
			  	'order' 			=> 	$order,
	  		    'orderby' 			=>  $order_by,
	  		    'post__not_in' 		=>  $postid,
			  	'fields'			=> 	'ids'
		  	];
		}

		// Get blog IDs
		$blog_ids = get_posts( $args );

		if ( remons_array_exists( $blog_ids ) ): ?>
			<div class="ova-latest-posts <?php echo esc_attr( $template ); ?>">
				<?php foreach ( $blog_ids as $blog_id ):
					// Blog title
					$blog_title = get_the_title( $blog_id );

					// Blog link detail
					$blog_link = get_the_permalink( $blog_id );

					// Thumbnail
					$thumbnail_id 	= get_post_thumbnail_id( $blog_id );
					$thumbnail_url 	= wp_get_attachment_image_url( get_post_thumbnail_id( $blog_id ), 'thumbnail' );
					$thumbnail_alt 	= get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

					if ( !$thumbnail_url ) $thumbnail_url = \Elementor\Utils::get_placeholder_image_src();
					if ( !$thumbnail_alt ) $thumbnail_alt = $blog_title;

					// Author ID
					$author_id = get_post_field( 'post_author', $blog_id );
				?>
					<div class="item">
						<div class="media">
				        	<a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
				        		<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $blog_title ); ?>">
				        	</a>
				        </div>
				        <div class="info">
							<div class="item-meta">
								<span class="right post-author">
								  	<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
									  	<?php echo wp_kses_post( get_the_author_meta( 'display_name', $author_id ) ); ?>
								  	</a>
							  	</span>
							  	<span class="left">
								  	<i class="fas fa-comments"></i>
							  	</span>
							  	<span class="right">
								  	<?php echo wp_kses_post( get_comments_number_text( '0', '1', '%', $blog_id ) ) ; ?>
							  	</span>
							</div>
				            <h4 class="post-title">
						        <a href="<?php echo esc_url( $blog_link ); ?>" rel="bookmark" title="<?php echo esc_attr( $blog_title ); ?>">
						          	<?php echo wp_kses_post( $blog_title ); ?>
						        </a>
						    </h4>
				        </div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Latest_Posts() );