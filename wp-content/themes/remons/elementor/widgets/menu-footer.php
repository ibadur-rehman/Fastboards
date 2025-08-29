<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Menu_Footer
 */
class Remons_Elementor_Menu_Footer extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_menu_footer';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Menu Footer', 'remons' );
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
		return [ 'hf' ];
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
		wp_enqueue_style( 'remons-elementor-menu-footer', REMONS_URI.'/assets/scss/elementor/menus/menu-footer.css', [], null );

		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {
		// Begin menu content
		$this->start_controls_section(
			'section_menu',
			[
				'label' => esc_html__( 'Menu', 'remons' ),
			]
		);

			// List menu
			$menus = [];

			// Default menu
			$default_menu = '';

			// Get menus
			$nav_menus = \wp_get_nav_menus();

			if ( remons_array_exists( $nav_menus ) ) {
				$default_menu = $nav_menus[0]->slug;

				foreach ( $nav_menus as $menu ) {
					$menus[$menu->slug] = $menu->name;
				}
			}

			$this->add_control(
				'menu_slug',
				[
					'label' 	=> esc_html__( 'Select Menu', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'options' 	=> $menus,
					'default' 	=> $default_menu
				]
			);

		$this->end_controls_section(); // End Menu Content

		/* Begin Menu Style */
		$this->start_controls_section(
            'menu_style',
            [
                'label' => esc_html__( 'Menu', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'menu_view',
				[
					'label' 	=> esc_html__( 'Layout', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'block' => [
							'title' => esc_html__( 'Default', 'remons' ),
							'icon' 	=> 'eicon-editor-list-ul',
						],
						'inline-flex' => [
							'title' => esc_html__( 'Inline Flex', 'remons' ),
							'icon' 	=> 'eicon-ellipsis-h',
						],
					],
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-menu-footer ul.menu' => 'display: {{VALUE}};',
					],
				]
			);

	        $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_typography',
					'selector' 	=> '{{WRAPPER}} .ova-menu-footer .menu li a',
				]
			);

			$this->add_control(
	            'menu_bg',
	            [
	                'label' 	=> esc_html__( 'Background', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-menu-footer .menu' => 'background-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'text_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-menu-footer .menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'text_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-menu-footer .menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->start_controls_tabs( 'tabs_title_style' );

				$this->start_controls_tab(
		            'tab_text_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

			        $this->add_control(
			            'menu_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu li > a' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

			    $this->start_controls_tab(
		            'tab_text_hover',
		            [
		                'label' => esc_html__( 'Hover', 'remons' ),
		            ]
		        );
		        
			        $this->add_control(
			            'menu_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu li:hover > a' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'underline_color_hover',
			            [
			                'label' 	=> esc_html__( 'Underline Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu a:before' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

			    $this->start_controls_tab(
		            'tab_text_active',
		            [
		                'label' => esc_html__( 'Active', 'remons' ),
		            ]
		        );
		        
			        $this->add_control(
			            'menu_color_active',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu li.current-menu-item > a' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-menu-footer .menu li.current-menu-parent > a' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

			$this->end_controls_tabs();

        $this->end_controls_section();
		/* End Menu Style */

		/* Begin Menu Style */
		$this->start_controls_section(
            'sub_menu_style',
            [
                'label' => esc_html__( 'Sub Menu', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'subtext_typography',
					'selector' 	=> '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu li a',
				]
			);

			$this->add_control(
	            'sub_menu_bg',
	            [
	                'label' 	=> esc_html__( 'Background', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu' => 'background-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'subtext_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'subtext_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->start_controls_tabs( 'tabs_subtitle_style' );

				$this->start_controls_tab(
		            'tab_subtext_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

			        $this->add_control(
			            'sub_menu_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu li a' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

			    $this->start_controls_tab(
		            'tab_subtext_hover',
		            [
		                'label' => esc_html__( 'Hover', 'remons' ),
		            ]
		        );
		        
			        $this->add_control(
			            'sub_menu_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-menu-footer .menu li .sub-menu li:hover a' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

			$this->end_controls_tabs();
	        
        $this->end_controls_section(); /* End Menu Style */
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Menu slug
		$menu_slug = remons_get_meta_data( 'menu_slug', $settings );

		?>

		<div class="ova-menu-footer">
			<?php wp_nav_menu([
				'menu'              => $menu_slug,
				'container'         => '',
				'container_class'   => '',
				'container_id'      => ''
			]); ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Menu_Footer() );