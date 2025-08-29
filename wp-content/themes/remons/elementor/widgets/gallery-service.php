<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Gallery_Service
 */
class Remons_Elementor_Gallery_Service extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_gallery_service';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Gallery Service', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-gallery-group';
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
		wp_enqueue_style( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css' );
		wp_enqueue_script( 'fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', [ 'jquery' ], false, true );

		return [ 'remons-elementor-gallery-service' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-gallery-service', REMONS_URI.'/assets/scss/elementor/galleries/gallery-service.css' );
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
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template2',
					'options' 	=> [
						'template1' => esc_html__('Template 1', 'remons'),
						'template2' => esc_html__('Template 2', 'remons'),
						'template3' => esc_html__('Template 3', 'remons'),
					]
				]
			);

			$this->add_control(
				'equal_column_width',
				[
					'label' 		=> esc_html__( 'Equal Column Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
					'condition' 	=> [
						'template' => 'template1',
					]
				]
			);

			$this->add_control(
				'columns',
				[
					'label' 	=> esc_html__( 'Columns', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'four_column',
					'options' 	=> [
						'two_column' 	=> esc_html__('2 Columns', 'remons'),
						'three_column' 	=> esc_html__('3 Columns', 'remons'),
						'four_column' 	=> esc_html__('4 Columns', 'remons'),
					],
					'condition' => [
						'template' => 'template3',
					]
				]
			);

			$this->add_control(
				'background_text',
				[
					'label' 	=> esc_html__( 'Background Text', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'condition' => [
						'template' => 'template2',
					]
				]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'link',
					[
						'label' 		=> esc_html__( 'Simple Link', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
						'description' 	=> esc_html__( 'Redirect to a link instead of popup image or video', 'remons' ),
						'options' 		=> [ 'url', 'is_external', 'nofollow' ],
						'default' 		=> [
							'url' 			=> '',
							'is_external' 	=> false,
							'nofollow' 		=> false,
						],
					]
				);

				$repeater->add_control(
					'image',
					[
						'label'   => esc_html__( 'Image', 'remons' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'icon',
					[
						'label' => esc_html__( 'Icon', 'remons' ),
						'type' 	=> \Elementor\Controls_Manager::ICONS,
					]
				);

				$repeater->add_control(
					'video_link',
					[
						'label' 		=> esc_html__( 'Embed Video Link', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::URL,
						'description' 	=> esc_html__( 'https://www.youtube.com/watch?v=MLpWrANjFbI', 'remons' ),
						'options' 		=> [ 'url', 'is_external', 'nofollow' ],
						'default' 		=> [
							'url' 			=> '',
							'is_external' 	=> false,
							'nofollow' 		=> false,
						],
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' 	=> esc_html__( 'Title', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Quality Gym', 'remons' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label' 	=> esc_html__( 'Description', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Our Services', 'remons' ),
					]
				);

				$this->add_control(
					'items',
					[
						'label' 	=> esc_html__( 'Items', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::REPEATER,
						'fields' 	=> $repeater->get_controls(),
						'default' 	=> [
							[
								'title' => esc_html__( 'Quality Gym', 'remons' ),
							],
							[
								'title' => esc_html__( 'Private Chef', 'remons' ),
							],
							[
								'title' => esc_html__( 'Housekeeping', 'remons' ),
							],
							[
								'title' => esc_html__( 'Spa & Wellness', 'remons' ),
							],
						],
						'title_field' => '{{{ title }}}',
					]
				);

		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_event_style',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Gallery', 'remons' ),
			]
		);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem','custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 360,
							'max' 	=> 560,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 36,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'background_text_section',
			[
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' 	=> esc_html__( 'Background Text', 'remons' ),
				'condition' => [
					'template' => 'template2',
				],
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'background_text_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-service.template2 .background-text',
				]
			);

			$this->add_responsive_control(
				'background_text_position_bottom',
				[
					'label' 		=> esc_html__( 'Botom', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 500,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service.template2 .background-text' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'background_text_position_left',
				[
					'label' 		=> esc_html__( 'Left', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 500,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service.template2 .background-text' => 'left: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'wrap_title_section',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Wrap Title', 'remons' ),
			]
		);

			$this->add_responsive_control(
				'wrap_title_min_width',
				[
					'label' 		=> esc_html__( 'Min Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'wrap_title_background_color',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title ' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'wrap_title_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'wrap_title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 100,
							'step' 	=> 1,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .icon i' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .icon svg path' => 'fill : {{VALUE}};'
					],
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section(); 
		// End Icon Style Tab

		$this->start_controls_section(
			'title_section',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Title', 'remons' ),
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .wrap-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		/****************************  END SECTION TITLE *********************/

		$this->start_controls_section(
			'description_section',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Description', 'remons' ),
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .description' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'description_background_color',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .description' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'description_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'description_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-gallery-service .wrap-content .item .content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		/****************************  END SECTION DESCRIPTION *********************/

		$this->start_controls_section(
			'image_section',
			[
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' 	=> esc_html__( 'Image', 'remons' ),
				'condition' => [
					'template' => 'template1',
				],
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Css_Filter::get_type(),
				[
					'name' 		=> 'custom_css_filters',
					'label' 	=> esc_html__( 'Image Hover Filter', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-gallery-service .wrap-content .item:hover img',
				],
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
		$template = remons_get_meta_data( 'template', $settings );

		// Get columns
		$columns = ( isset( $settings['columns'] ) && $template === 'template3' ) ? $settings['columns'] : '';

		// Get items
		$items = remons_get_meta_data( 'items', $settings );

		// Background text
		$background_text = remons_get_meta_data( 'background_text', $settings );

		// Data gallery video
		$data_gallery_video = [];

		// Template 1
		$equal_column_width = remons_get_meta_data( 'equal_column_width', $settings );
		if ( 'template1' === $template && 'yes' === $equal_column_width ) {
			$template = 'template1 equal_column';
		}

		?>

		<div class="ova-gallery-service <?php echo esc_attr( $template ); ?> <?php echo esc_attr( $columns ); ?>">

			<?php if ( '' !== $background_text && 'template2' === $template ) : ?>
				<h3 class="background-text">
					<?php echo esc_html( $background_text ); ?>	
				</h3>
			<?php endif; ?>
		
			<div class="wrap-content">
				<?php if ( remons_array_exists( $items ) ) : foreach ( $items as $item ):
					// Get link
				 	$link = isset( $item['link']['url'] ) ? $item['link']['url'] : '';

				 	// Target
					$target = isset( $item['link']['is_external'] ) && $item['link']['is_external'] ? '_blank' : '_self';

					// Get nofollow
					$nofollow = isset( $item['link']['nofollow'] ) && $item['link']['nofollow'] ? 'nofollow' : '';

					// Get url
					$url = isset( $item['image']['url'] ) && $item['image']['url'] ? $item['image']['url'] : Utils::get_placeholder_image_src();

					// Get alt
					$alt = isset( $item['image']['alt'] ) ? $item['image']['alt'] : '';

					// Get icon
					$icon = remons_get_meta_data( 'icon', $item );

					// Get video link
					$video_link	= isset( $item['video_link']['url'] ) ? $item['video_link']['url'] : '';

					if ( $link ): ?>
						<a href="<?php echo esc_url( $link ); ?>" class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>">

					<?php elseif ( $video_link ): ?>
						<a href="<?php echo esc_url( $video_link ); ?>" class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" data-fancybox="gallery-service">
					<?php else: ?>
						<div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" data-fancybox="gallery-service" data-src="<?php echo esc_url( $url ); ?>" data-caption="<?php echo esc_attr( $item['title'] ); ?>">
					<?php endif;

						// Image
						if ( $url ): ?>
							<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
						<?php endif; ?>

						<div class="content">
							<?php if ( '' !== remons_get_meta_data( 'description', $item ) ): ?>
								<p class="description">
									<?php echo esc_html( $item['description'] ); ?>	
								</p>
							<?php endif; ?>

							<div class="wrap-title">
								<?php if ( '' !== remons_get_meta_data( 'value', $item ) ): ?>
									<span class="icon">
										<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
									</span>	
								<?php endif; ?>

								<?php if ( '' !== remons_get_meta_data( 'title', $item ) ): ?>
									<h3 class="title">
										<?php echo esc_html( $item['title'] ); ?>	
									</h3>
								<?php endif; ?>
							</div>
						</div>
					<?php if ( $link || $video_link ): ?>
						</a>
					<?php else: ?>
						</div>
					<?php endif;
				endforeach;
			endif; ?>
			</div>
		</div>
		<?php
	}
}

$widgets_manager->register( new Remons_Elementor_Gallery_Service() );