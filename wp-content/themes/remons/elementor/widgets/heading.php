<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Heading
 */
class Remons_Elementor_Heading extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_heading';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Heading', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-heading';
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
		wp_enqueue_style( 'remons-elementor-heading', REMONS_URI.'/assets/scss/elementor/heading/heading.css' );
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
				'sub_title_prefix',
				[
					'label' 	=> esc_html__( 'Prefix', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'sub_title_pre',
					'options' 	=> [
						'sub_title_pre'  	=> esc_html__( 'Icon', 'remons' ),
						'sub_title_pre_img' => esc_html__( 'Image', 'remons' ),
					],
				]
			);
			
			$this->add_control(
				'sub_title_pre',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre'
					]
				]
			);

			$this->add_control(
				'sub_title_pre_img',
				[
					'label' 	=> esc_html__( 'Image', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::MEDIA,
					'default' 	=> [
						'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre_img'
					]
				]
			);

			$this->add_control(
				'sub_title',
				[
					'label' 	=> esc_html__( 'Sub Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Sub Title', 'remons' ),
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Title', 'remons' ),
				]
			);

			$this->add_control(
				'description',
				[
					'label' 	=> esc_html__( 'Description', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
					'default' 	=> ''
				]
			);

			$this->add_control(
				'link_address',
				[
					'label'   		=> esc_html__( 'Link', 'remons' ),
					'type'    		=> \Elementor\Controls_Manager::URL,
					'show_external' => false,
					'default' 		=> [
						'url' 			=> '',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
				]
			);
			
			$this->add_control(
				'html_tag',
				[
					'label' 	=> esc_html__( 'HTML Tag', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'h2',
					'options' 	=> [
						'h1' 		=> esc_html__( 'H1', 'remons' ),
						'h2'  		=> esc_html__( 'H2', 'remons' ),
						'h3'  		=> esc_html__( 'H3', 'remons' ),
						'h4' 		=> esc_html__( 'H4', 'remons' ),
						'h5' 		=> esc_html__( 'H5', 'remons' ),
						'h6' 		=> esc_html__( 'H6', 'remons' ),
						'div' 		=> esc_html__( 'Div', 'remons' ),
						'span' 		=> esc_html__( 'span', 'remons' ),
						'p' 		=> esc_html__( 'p', 'remons' ),
					],
				]
			);

			$this->add_responsive_control(
				'align_heading',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'default' 	=> 'center',
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-heading' => 'text-align: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'rtl_align_heading',
				[
					'label' 	=> esc_html__( 'RTL Alignment ( RTL Language )', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'remons' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-text-align-right',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'.rtl {{WRAPPER}} .ova-heading' => 'text-align: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		//SECTION TAB STYLE SUB TITLE PREFIX
		$this->start_controls_section(
			'section_sub_title_pre',
			[
				'label' => esc_html__( 'Prefix', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 60,
							'step' 	=> 1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-heading .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre'
					]
				]
			);

			$this->add_responsive_control(
				'gap',
				[
					'label' 		=> esc_html__( 'Gap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 40,
							'step' 	=> 1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'prefix_position' => ['left','right']
					]
				]
			);

			$this->add_control(
				'color_sub_title_pre',
				[
					'label'	 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading i' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-heading svg' => 'fill : {{VALUE}};',
						'{{WRAPPER}} .ova-heading svg path' => 'fill : {{VALUE}};'
					],
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre'
					]
				]
			);

			$this->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 120,
							'step' 	=> 1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper img' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre_img'
					]
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 120,
							'step' 	=> 1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'sub_title_prefix' => 'sub_title_pre_img'
					]
				]
			);

			$this->add_responsive_control(
				'prefix_position',
				[
					'label' 	=> esc_html__( 'Prefix Position', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'default' 	=> 'top',
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'top' => [
							'title' => esc_html__( 'Top', 'remons' ),
							'icon' 	=> 'eicon-v-align-top',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
				]
			);

			$this->add_responsive_control(
				'margin_sub_title_pre',
				[
					'label' 	 => esc_html__( 'Margin', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .sub_pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section();

		//SECTION TAB STYLE SUB TITLE
		$this->start_controls_section(
			'section_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_sub_title',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-heading .sub-title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label'	 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .sub-title' => 'color : {{VALUE}};'	
					],
				]
			);

			$this->add_control(
				'bgcolor_sub_title',
				[
					'label'	 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper' => 'background-color : {{VALUE}};'	
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_sub_title',
				[
					'label' 	 => esc_html__( 'Border Radius', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_sub_title',
				[
					'label' 	 => esc_html__( 'Padding', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_sub_title',
				[
					'label' 	 => esc_html__( 'Margin', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .sub-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'box_shadow',
					'selector' 	=> '{{WRAPPER}} .ova-heading .sub-title-wrapper',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' 		=> 'background_sub_title',
					'types' 	=> [ 'classic', 'gradient'],
					'selector' 	=> '{{WRAPPER}} .ova-heading .sub-title-wrapper',
				]
			);
			
		$this->end_controls_section();
		//END SECTION TAB STYLE SUB TITLE
		
		//SECTION TAB STYLE TITLE
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
					'name' 		=> 'content_typography_title',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-heading .title, {{WRAPPER}} .ova-heading .title-shadow',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title, {{WRAPPER}} .ova-heading .title a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .title:hover, {{WRAPPER}} .ova-heading .title:hover a' => 'color : {{VALUE}};'
					],
					
				]
			);

			$this->add_responsive_control(
				'padding_title',
				[
					'label' 	 => esc_html__( 'Padding', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .title ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 	 => esc_html__( 'Margin', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .title ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'show_title_shadow',
				[
					'label' 		=> esc_html__( 'Show Title Shadow', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

				$this->add_control(
					'color_title_shadow',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-heading .title-shadow' => '-webkit-text-stroke-color : {{VALUE}}; text-stroke-color : {{VALUE}};',
						],
						'condition' => [
							'show_title_shadow' => 'yes'
						]
					]
				);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		//SECTION TAB STYLE DESCRIPTION
		$this->start_controls_section(
			'section_description',
			[
				'label' => esc_html__( 'Description', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_description',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-heading .description',
				]
			);

			$this->add_control(
				'color_description',
				[
					'label'	 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-heading .description' => 'color : {{VALUE}};'		
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'border',
					'selector' 	=> '{{WRAPPER}} .ova-heading .description',
				]
			);
			
			$this->add_responsive_control(
				'padding_description',
				[
					'label' 	 => esc_html__( 'Padding', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .description ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_description',
				[
					'label' 	 => esc_html__( 'Margin', 'remons' ),
					'type' 		 => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-heading .description ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->end_controls_section(); // END SECTION TAB STYLE DESCRIPTION
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();
        
		// Get sub-title prefix
		$sub_title_prefix = remons_get_meta_data( 'sub_title_prefix', $settings );

		// Get icon
        $icon = isset( $settings['sub_title_pre'] ) ? $settings['sub_title_pre'] : '';

        // Get prefix position
        $prefix_position = remons_get_meta_data( 'prefix_position', $settings );

        // Get sub-title
		$sub_title = remons_get_meta_data( 'sub_title', $settings );

		// Get title
		$title = remons_get_meta_data( 'title', $settings );

		// Get description
		$description = remons_get_meta_data( 'description', $settings );

		// Get HTML tag 
		$html_tag = remons_get_meta_data( 'html_tag', $settings );

		// Get link
		$link = isset( $settings['link_address']['url'] ) ? $settings['link_address']['url'] : '';

		// Get target
		$target = isset( $settings['link_address']['is_external'] ) && $settings['link_address']['is_external'] ? '_blank' : '_self';

		// Get image URL
		$img_url = isset( $settings['sub_title_pre_img']['url'] ) ? $settings['sub_title_pre_img']['url'] : '';

		// Get image alt
		$img_alt = ( isset( $settings['sub_title_pre_img']['alt'] ) && $settings['sub_title_pre_img']['alt'] != '' ) ? $settings['sub_title_pre_img']['alt'] : $title;

		// Show title shadow
		$show_title_shadow = remons_get_meta_data( 'show_title_shadow', $settings );

		?>

		<div class="ova-heading">
            <div class="top-heading">
            	<?php if ( $sub_title || remons_get_meta_data( 'value', $icon ) ): ?>
					<div class="sub-title-wrapper <?php echo esc_attr( $prefix_position ); ?>">
						<?php if ( 'sub_title_pre' === $sub_title_prefix && remons_get_meta_data( 'value', $icon ) ): ?>
							<div class="sub_pre icon">
								<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
							</div>
						<?php endif;

						if ( 'sub_title_pre_img' === $sub_title_prefix && $img_url ): ?>
							<img class="sub_pre" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
						<?php endif;

						if ( $sub_title ): ?>
							<p class="sub-title"><?php echo esc_html( $sub_title ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif;

				if ( $title ): ?>
					<div class="title-wrapper" style="position: relative;">
						<?php if ( $link ): ?>
							<<?php echo esc_attr( $html_tag ); ?> class="title">
								<a href="<?php echo esc_url( $link ); ?>"<?php echo wp_kses_post( $target ); ?>>
									<?php echo wp_kses_post( $title ); ?>
								</a>
							</<?php echo esc_attr( $html_tag ); ?>>
						<?php else: ?>
							<<?php echo esc_attr( $html_tag ); ?> class="title"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $html_tag ); ?>>
						<?php endif;

						if ( 'yes' === $show_title_shadow ): ?>
							<span class="title-shadow">
								<?php echo wp_kses_post( $title ); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
            </div>

			<?php if ( $description ): ?>
				<p class="description"><?php echo wp_kses_post( $description ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Heading() );