<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Class Remons_Elementor_Ova_Search
 */
class Remons_Elementor_Ova_Search extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_ova_search';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Search', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-search';
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
		wp_enqueue_style( 'remons-elementor-search', REMONS_URI.'/assets/scss/elementor/searchs/search.css' );
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
				'placeholder_heading',
				[
					'label'	=> esc_html__( 'Placeholder', 'remons' ),
					'type'	=> \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'search_placeholder',
				[
					'label' 	=> esc_html__( 'Placeholder', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Search', 'remons' ),
				]
			);

			$this->add_control(
				'icon_placeholder',
				[
					'label'		=> esc_html__( 'Icon', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::ICONS,
				]
			);

			// Button
			$this->add_control(
				'button_heading',
				[
					'label'	=> esc_html__( 'Button', 'remons' ),
					'type'	=> \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'search_button',
				[
					'label'		=> esc_html__( 'Show Button', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on'	=> esc_html__( 'Show', 'remons' ),
					'label_off'	=> esc_html__( 'Hiden', 'remons' ),
					'return_value'	=> 'yes',
					'default'		=> 'yes',
				]
			);

			$this->add_control(
				'text_button',
				[
					'label'		=> esc_html__( 'Text Button', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::TEXT,
					'condition'	=> [
						'search_button'	=> 'yes'
					],
				]
			);

			$this->add_control(
				'icon_button',
				[
					'label'		=> esc_html__( 'Icon Button', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::ICONS,
					'default'	=> [
						'value'		=> 'flaticon flaticon-magnifying-glass',
						'library'	=> 'all'
					],
					'condition'	=> [
						'search_button'	=> 'yes'
					],
				]
			);

		$this->end_controls_section();


		// TAB STYLE
		$this->start_controls_section(
			'section_input',
			[
				'label'	=> esc_html__( 'Input', 'remons' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
			    'color_input_text',
			    [
			        'label'     => esc_html__( 'Text color', 'remons' ),
			        'type'      => \Elementor\Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .ova_wrap_search input[type="search"]' => 'color: {{VALUE}}',
			        ],
			    ]
			);

			$this->add_control(
				'color_placeholder',
				[
					'label' 	=> esc_html__( 'Placeholder Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search form.search-form input[type=search]::placeholder' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'color_placeholder_icon',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search form.search-form .search-input-wrap .search-icon i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'size_placeholder_icon',
				[
					'label' 		=> esc_html__( 'Size Icon', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search form.search-form .search-input-wrap .search-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'input_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'input_padding',
				[
					'label'			=> esc_html__( 'Padding', 'remons' ),
					'type'			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'		=> [
						'{{WRAPPER}} .ova_wrap_search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'input_border',
					'selector' 	=> '{{WRAPPER}} .ova_wrap_search',
				]
			);

			$this->add_responsive_control(
			  	'input_border_radius',
			  	[
				  	'label' 		=> esc_html__( 'Border Radius', 'remons' ),
				 	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
						'{{WRAPPER}} .ova_wrap_search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			 	 ]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_search',
			[
				'label' => esc_html__( 'Text Search', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_search_typography',
					'selector' 	=> '{{WRAPPER}} .ova_wrap_search form.search-form button[type=submit] .text-button',
				]
			);

			$this->add_control(
				'text_search_color',
				[
					'label'		=> esc_html__( 'Color', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .ova_wrap_search form.search-form button[type=submit] .text-button' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_search_color_hover',
				[
					'label'		=> esc_html__( 'Color Hover', 'remons' ),
					'type'		=> \Elementor\Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .ova_wrap_search .search-form .search-submit:hover .text-button' => 'color: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_search',
			[
				'label' => esc_html__( 'Icon Search', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_control(
				'size_icon',
				[
					'label' 		=> esc_html__( 'Size Icon', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'color_icon_search',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'color_hover_icon_search',
				[
					'label' 	=> esc_html__( 'Icon Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search .search-form .search-submit:hover i' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_popup_button',
			[
				'label' => esc_html__( 'Search Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'bgcolor_search_popup_button',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search .search-form .search-submit' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'bgcolor_hover_icon_search_popup',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova_wrap_search .search-form .search-submit:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
			  	'icon_search_popup_border_radius',
			  	[
				  	'label' 		=> esc_html__( 'Border Radius', 'remons' ),
				 	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
						'{{WRAPPER}} .ova_wrap_search .search-form .search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			 	 ]
			);

		  	$this->add_responsive_control(
			  	'icon_search_popup_padding',
			  	[
				  	'label' 		=> esc_html__( 'Padding', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .ova_wrap_search .search-form .search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				  	],
			  	]
		  	);

		  	$this->add_responsive_control(
			  	'icon_search_popup_margin',
			  	[
				  	'label' 		=> esc_html__( 'Margin', 'remons' ),
				  	'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				  	'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				  	'selectors' 	=> [
					  	'{{WRAPPER}} .ova_wrap_search .search-form .search-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Search placeholder
		$search_placeholder = remons_get_meta_data( 'search_placeholder', $settings );

		// Icon placeholder
		$icon_placeholder = remons_get_meta_data( 'icon_placeholder', $settings );

		// Search button
		$search_button = remons_get_meta_data( 'search_button', $settings );

		// Text button
		$text_button = remons_get_meta_data( 'text_button', $settings );

		// Icon button
		$icon_button = remons_get_meta_data( 'icon_button', $settings );
		?>

		<div class="ova_wrap_search">
			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				<div class="search-input-wrap <?php echo ( isset($icon_placeholder['value']) && $icon_placeholder['value'] !== '' ) ? 'has-icon' : ''; ?>">
					<?php if ( isset($icon_placeholder['value']) && $icon_placeholder['value'] !== '' ) : ?>
						<span class="search-icon">
							<i class="<?php echo esc_attr( $icon_placeholder['value'] ); ?>"></i>
						</span>
					<?php endif; ?>

					<input
						type="search"
						class="search-field"
						name="s"
						value="<?php echo get_search_query(); ?>"
						placeholder="<?php echo esc_attr( $search_placeholder ); ?>"
						title="<?php esc_attr_e( 'Search for:', 'remons' ); ?>"
					/>
				</div>

				<?php if ( $search_button === 'yes' ) : ?>
					<button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'remons' ); ?>">
						
						<?php if ( $text_button !== '' && $text_button !== null ) : ?>
							<span class="text-button"><?php echo $text_button; ?></span>
						<?php endif; ?>

						<?php if ( isset($icon_button['value']) && $icon_button['value'] !== '' ) : ?>
							<i class="<?php echo esc_attr( $icon_button['value'] ); ?>"></i>
						<?php endif; ?>
						
					</button>
				<?php endif; ?>
			</form>									
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Ova_Search() );