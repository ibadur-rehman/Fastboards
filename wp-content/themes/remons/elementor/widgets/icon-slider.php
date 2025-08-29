<?php if( !defined('ABSPATH') ) exit; //Exit if accessed directly

/**
 * Class Remons_Elementor_Icon_Slider
 */

class Remons_Elementor_Icon_Slider extends \Elementor\Widget_Base {

	/**
	 * Get witget name
	 * */
	public function get_name() {
		return ( 'remons_elementor_icon_slider' );
	}

	/**
	 * Get widget title
	 * */
	public function get_title() {
		return esc_html__( 'Icon Slider', 'remons' );
	}

	/**
	 * Get widget icon
	 * */
	public function get_icon() {
		return 'eicon-carousel';
	}

	/**
	 * Get widget categories
	 * */
	public function get_categories() {
		return [ 'remons' ];
	}

	/**
	 * Get script depends
	 * */
	public function get_script_depends() {
		return [ 'remons-elementor-icon-slider' ];
	}

	/**
	 * Get style depends
	 * */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-icon-slider', REMONS_URI.'/assets/scss/elementor/icons/icon-slider.css' );
		return [];
	}

	/**
	 * Register controls
	 * */

	public function register_controls() {
		// START CONTROLS SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label'	=> esc_html__( 'Content', 'remons' ),
			]
		);

			// add class controls
			$repeater = new \Elementor\Repeater();
				$repeater->add_control(
					'Icon',
					[
						'label'		=> esc_html__( 'Icon', 'remons' ),
						'type'		=> \Elementor\Controls_Manager::ICONS,
						'default'	=> [
							'value'		=> 'flaticon4-health-insurance',
							'library'	=> 'all',
						],
					]
				);

				$repeater->add_control(
					'title', 
					[
						'label' 	=> esc_html__( 'Title', 'remons' ),
						'type'		=> \Elementor\Controls_Manager::TEXT,
						'default'	=> esc_html__( 'Medical Clinic', 'remons' ),
					]
				);

				$repeater->add_control(
					'link',
					[
						'label' 		=> esc_html__( 'Link', 'remons' ),
						'type' 			=> \Elementor\Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
						'options' 		=> [ 'url', 'is_external', 'nofollow' ],
						'default' => [
							'url' 			=> '#',
							'is_external' 	=> true,
							'nofollow' 		=> false,
						],
						'dynamic' => [
							'active' => true
						],
						'label_block' => true,
					]
				);

			$this->add_control(
			    'tab_item',
			    [
			        'label'     => esc_html__( 'Item Icon Slider', 'remons' ),
			        'type'      => \Elementor\Controls_Manager::REPEATER,
			        'fields'    => $repeater->get_controls(),
			        'default'   => [
			            [
			                'title' => esc_html__( 'Medical Clinic', 'remons' ),
			            ],
			            [
			                'title' => esc_html__( 'Vaccination ', 'remons' ),
			            ],
			            [
			                'title' => esc_html__( 'Blood Tests ', 'remons' ),
			            ],
			            [
			                'title' => esc_html__( 'Doctors Consultations ', 'remons' ),
			            ],
			            [
			                'title' => esc_html__( 'Medical Tests', 'remons' ),
			            ],
			            [
			                'title' => esc_html__( 'X-ray imaging', 'remons' ),
			            ],
			        ],
			    ]
			);


		$this->end_controls_section();
		// END CONTROL SECTION CONTENT

		/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'remons' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'remons' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'default' => 0,	
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'remons' ),
					'type'        => \Elementor\Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'remons' ),
					'default'     => 6,
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
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'remons' ),
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
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'remons' ),
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
					'default' => 300,
				]
			);

		$this->end_controls_section();
		/****************************  END SECTION ADDITIONAL *********************/

		/* General */
		$this->start_controls_section(
				'items_style_section',
				[
					'label' => esc_html__( 'General', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'items_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-slider' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* title */
		$this->start_controls_section(
				'title_style_section',
				[
					'label' => esc_html__( 'Title', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .title' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Icon */
		$this->start_controls_section(
				'social_style_section',
				[
					'label' => esc_html__( 'Icon', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'icon_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
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
							'max' 	=> 50,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-icon-slider .icon-slider .item.icon-item  a .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Render HTML
	 * */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Carousel data option
		$data_options = [
			'items'            => remons_get_meta_data( 'item_number', $settings, 2 ),
			'slideBy'          => remons_get_meta_data( 'slides_to_scroll', $settings ),
			'margin'           => remons_get_meta_data( 'margin_items', $settings, 0 ),
			'loop'             => 'yes' === remons_get_meta_data( 'infinite', $settings ),
			'autoplay'         => 'yes' === remons_get_meta_data( 'autoplay', $settings ),
			'autoplay_speed'   => remons_get_meta_data( 'autoplay_speed', $settings ),
			'smartSpeed'       => remons_get_meta_data( 'smartspeed', $settings ),
			'rtl'              => is_rtl(),
			'responsive'       => [
				0    => [ 'items' => 1 ],
				768  => [ 'items' => 2 ],
				1024 => [ 'items' => 3 ],
				1350 => [ 'items' => 4 ],
				1600 => [ 'items' => 6 ],
			]
		];

		if ( empty( $settings[ 'tab_item' ] ) || !is_array( $settings[ 'tab_item' ] ) ) {
			return;
		}
		?>
		<div class="ova-icon-slider">
			<div class="icon-slider owl-carousel" data-options='<?php echo esc_attr( json_encode( $data_options ) ); ?>'>
				<?php foreach ( $settings[ 'tab_item' ] as $item ) :
					$icon = $item[ 'Icon' ];
					$title = $item[ 'title' ];
					$url_data = $item[ 'link' ];
					$url = !empty( $url_data[ 'url' ] ) ? $url_data[ 'url' ] : '';
					$is_external = !empty( $url_data[ 'is_external' ] ) ? ' target="_blank"' : '';
					$nofollow = !empty( $url_data[ 'nofollow' ] ) ? ' rel="nofollow"' : '';
				?>
					<div class="item icon-item">
						<?php if ( $url ): ?>
							<a href="<?php echo esc_url( $url ); ?>"<?php echo $is_external . $nofollow; ?>>
						<?php endif; ?>

						<span class="icon">
							<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>

						<?php if ( $title ): ?>
							<h3 class="title"><?php echo esc_html( $title ); ?></h3>
						<?php endif; ?>

						<?php if ( $url ): ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Icon_Slider() );