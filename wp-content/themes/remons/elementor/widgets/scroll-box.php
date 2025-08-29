<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Scroll_Box
 */
class Remons_Elementor_Scroll_Box extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_scroll_box';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Scroll Box', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-text-field';
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
		return [ 'remons-elementor-scroll-box' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-scroll-box', REMONS_URI.'/assets/scss/elementor/scroll-box/scroll-box.css' );
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
		
			// Add Class control
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'title',
					[
						'label'   => esc_html__( 'Title', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Affordable Cost', 'remons' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label'   => esc_html__( 'Description', 'remons' ),
						'type'    => \Elementor\Controls_Manager::TEXTAREA,
		                'default' => esc_html__( 'Providing the cheapest price on the market', 'remons' ),
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
							'title' 		=> esc_html__('Affordable Cost', 'remons'),
							'description' 	=> esc_html__('Providing the cheapest price on the market', 'remons'),
						],
						[
							'title' 		=> esc_html__('Shot Time Delivery', 'remons'),
							'description' 	=> esc_html__('Delivery at exact time and location', 'remons'),
						],
						[
							'title' 		=> esc_html__('Support 24/7', 'remons'),
							'description' 	=> esc_html__('Support via phone, email, social', 'remons'),
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
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 230,
							'max' 	=> 1180,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-scroll-box' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_min_width',
				[
					'label' 		=> esc_html__( 'Min Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 1180,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-scroll-box' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'general_item_width',
				[
					'label' 		=> esc_html__( 'Item Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 100,
							'max' 	=> 500,
							'step' 	=> 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-scroll-box .item-scroll-box' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'general_border',
					'selector' 	=> '{{WRAPPER}} .ova-scroll-box',
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
						'{{WRAPPER}} .ova-scroll-box::-webkit-scrollbar-thumb' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'scroll_bar_track_bgcolor',
				[
					'label' 	=> esc_html__( 'Track Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-scroll-box::-webkit-scrollbar-track' => 'background-color: {{VALUE}}',
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
					'selectors' 	=> [
						'{{WRAPPER}} .ova-scroll-box::-webkit-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
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
					'selector' 	=> '{{WRAPPER}} .ova-scroll-box .item-scroll-box .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-scroll-box .item-scroll-box .title' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-scroll-box .item-scroll-box .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' 	=> '{{WRAPPER}} .ova-scroll-box .item-scroll-box .description',
				]
			);

			$this->add_control(
				'description_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-scroll-box .item-scroll-box .description' => 'color: {{VALUE}}',
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
						'{{WRAPPER}} .ova-scroll-box .item-scroll-box .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Tab item
		$tab_item = remons_get_meta_data( 'tab_item', $settings );

		?>

		<div class="ova-scroll-box">
			<?php if ( remons_array_exists( $tab_item ) ):
				foreach ( $tab_item as $item ):
					// Get title
					$title = remons_get_meta_data( 'title', $item );

					// Get description
					$desc = remons_get_meta_data( 'description', $item );
			?>
				<div class="item-scroll-box">
					<?php if ( $title ): ?>
						<h3 class="title">
							<?php echo esc_html( $title ); ?>
						</h3>
					<?php endif;

					if ( $desc ) : ?>
						<p class="description">
							<?php echo esc_html( $desc ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endforeach;
			endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Scroll_Box() );