<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Working_Process
 */
class Remons_Elementor_Working_Process extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_working_process';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Working Process', 'remons' );
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
		return [ 'remons' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		return [ 'remons-elementor-working-process' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-working-process', REMONS_URI.'/assets/scss/elementor/process/working-process.css' );
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
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
					]
				]
			);

			$this->add_control(
				'text_count',
				[
					'label'   		=> esc_html__( 'Text Count', 'remons' ),
					'type'    		=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'To add text before the count, the count is automatic', 'remons' ),
				]
			);

			// Add Class control
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'icon',
					[
						'label' 	=> esc_html__( 'Icon', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::ICONS,
						'default' 	=> [
							'value' 	=> 'flaticon flaticon-choose',
							'library' 	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'title',
					[
						'label'   => esc_html__( 'Title', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Online Quote', 'remons' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label'   => esc_html__( 'Description', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
		                'default' => esc_html__( 'An online quote is an estimate of the cost of a product or service provided by a business.', 'remons' ),
					]
				);

				$repeater->add_responsive_control(
					'repeater_item_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'tab_item',
				[
					'label' 	=> esc_html__( 'Items', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'icon' => [
								'value' => 'flaticon flaticon-choose',
							],
							'title' => esc_html__('Online Quote', 'remons'),
							'description' => esc_html__('An online quote is an estimate of the cost of a product or service provided by a business.', 'remons'),
						],
						[
							'icon' => [
								'value' => 'flaticon flaticon-vote',
							],
							'title' => esc_html__('Picking Product', 'remons'),
							'description' => esc_html__('Picking a product refers to the process of selecting a specific from a range of products.', 'remons'),
						],
						[
							'icon' => [
								'value' => 'flaticon flaticon-box',
							],
							'title' => esc_html__('Product Packaging', 'remons'),
							'description' => esc_html__('Product packaging refers to the materials and design used to protect, product to customers.', 'remons'),
						],
						[
							'icon' => [
								'value' => 'flaticon flaticon-transportation',
							],
							'title' => esc_html__('Product Transport', 'remons'),
							'description' => esc_html__('Product transport refers to the process of moving products from one location to another', 'remons'),
						],
						[
							'icon' => [
								'value' => 'flaticon flaticon-package',
							],
							'title' => esc_html__('Delivery', 'remons'),
							'description' => esc_html__("Deliver the goods to the specified address as per the recipient's request.", 'remons'),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'General', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'general_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 430,
							'max' 	=> 1890,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-working-process' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_min_width',
				[
					'label' 		=> esc_html__( 'Min Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 1890,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-working-process' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_item_width',
				[
					'label' 		=> esc_html__( 'Item Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 600,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-working-process .item-working-process' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_item_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-working-process' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'general_border',
					'selector' 	=> '{{WRAPPER}} .ova-working-process',
				]
			);

			$this->add_responsive_control(
				'alignment',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'flex-end' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process' => 'justify-content: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_bar_style',
			[
				'label' => esc_html__( 'Scroll Bar', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'scroll_bar_thumb_bgcolor',
				[
					'label' 	=> esc_html__( 'Thumb Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process::-webkit-scrollbar-thumb' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'scroll_bar_track_bgcolor',
				[
					'label' 	=> esc_html__( 'Track Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process::-webkit-scrollbar-track' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'scrollbar_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 1,
							'max' 	=> 25,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-working-process::-webkit-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_section',
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
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon svg' => 'fill: {{VALUE}}',
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_background_color',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process .item-working-process .wrap-icon-number .icon' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_title_style',
			[
				'label' => esc_html__( 'Title', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-working-process .item-working-process .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process .item-working-process .title' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-working-process .item-working-process .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'content_description_style',
			[
				'label' => esc_html__( 'Description', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-working-process .item-working-process .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-working-process .item-working-process .description' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-working-process .item-working-process .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$template = remons_get_meta_data( 'template', $settings );

		// Get tab item
		$tab_item = remons_get_meta_data( 'tab_item', $settings );

		// Get text count
		$text_count = remons_get_meta_data( 'text_count', $settings );

		?>

		<div class="ova-working-process <?php echo esc_attr( $template ); ?>">
			<?php if ( remons_array_exists( $tab_item ) ):
				foreach ( $tab_item as $k => $item ) :
					// Get item id
					$item_id = 'elementor-repeater-item-' . esc_attr( $item['_id'] );

					// Get icon
					$icon = isset( $item['icon']['value'] ) ? $item['icon']['value'] : '';
			?>
					<div class="item-working-process <?php echo esc_attr( $item_id ); ?>">
						<?php if ( '' != $icon ): ?>
							<div class="wrap-icon-number">
								<div class="icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</div>
								<span class="count">
									<?php echo esc_html( $text_count ) . sprintf( '%02s', $k+1 ); ?>
								</span>
							</div>
						<?php endif;

						if ( '' != remons_get_meta_data( 'title', $item ) ): ?>
							<h3 class="title">
								<?php echo esc_html( $item['title'] ); ?>
							</h3>
						<?php endif;

						if ( '' != remons_get_meta_data( 'description', $item ) ): ?>
							<p class="description">
								<?php echo esc_html( $item['description'] ); ?>
							</p>
						<?php endif; ?>
					</div>

					<?php if ( ( $k % 2 ) !== 0 ): ?>
						<div class="line line-top"></div>
					<?php else: ?>
						<div class="line line-bottom"></div>
					<?php endif;
				endforeach;
			endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Working_Process() );