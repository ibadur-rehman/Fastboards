<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Menu_Nav
 */
class Remons_Elementor_Menu_Nav extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_menu_nav';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Menu', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		/* Global Section */
		$this->start_controls_section(
			'section_menu_type',
			[
				'label' => esc_html__( 'Global', 'remons' ),
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

			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Decoration Icon', 'remons' ),
					'type' => \Elementor\Controls_Manager::ICONS,
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
						'{{WRAPPER}} .main-navigation .ova-menu-decor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .main-navigation .ova-menu-decor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .main-navigation .ova-menu-decor-icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .main-navigation .ova-menu-decor-icon svg path' => 'fill: {{VALUE}}',
					],
				]
			);
			
		$this->end_controls_section();

		/* Parent Menu Section */
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Parent Menu', 'remons' ),
			]
		);

			// Typography Parent Menu
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'menu_typography',
					'selector'	=> '{{WRAPPER}} ul li a'
				]
			);

			$this->add_responsive_control(
				'menu_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'menu_li_padding',
				[
					'label' 		=> esc_html__( 'Item Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} ul.menu > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'menu_a_padding',
				[
					'label' 		=> esc_html__( 'Content Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			// Control Tabs
			$this->start_controls_tabs(
				'style_parent_menu_tabs'
			);

				// Normal Tab
				$this->start_controls_tab(
					'style_parent_menu_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'link_color',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.menu > li > a' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'custom_background_color',
						[
							'label' 	=> esc_html__( 'Custom Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} .main-navigation ul.menu > li > a:before' => 'background-color: {{VALUE}};',
							],
							'description' => esc_html__( '( Use with class ova-menu-custom-background )', 'remons' ),
						]
					);

					$this->add_responsive_control(
						'menu_a_border_radius',
						[
							'label' 		=> esc_html__( 'Border Radius', 'remons' ),
							'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors' 	=> [
								'{{WRAPPER}} ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

				// Hover Tab
				$this->start_controls_tab(
					'style_parent_menu_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'link_color_hover',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.menu > li:hover > a' => 'color: {{VALUE}};',
							]
							
						]
					);

					$this->add_control(
						'background_color_hover',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.menu > li:hover > a' => 'background-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

				// Active Tab
				$this->start_controls_tab(
					'style_parent_menu_active_tab',
					[
						'label' => esc_html__( 'Active', 'remons' ),
					]
				);

					$this->add_control(
						'link_color_active',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.menu > li.current-menu-item > a' => 'color: {{VALUE}};',
							]
							
						]
					);

					$this->add_control(
						'background_color_active',
						[
							'label' 	=> esc_html__( 'Background Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.menu > li.current-menu-item > a' => 'background-color: {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		/* Sub Menu Section */
		$this->start_controls_section(
			'section_submenu_content',
			[
				'label' => esc_html__( 'Sub Menu', 'remons' ),
			]
		);	

			// Typography SubMenu
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'submenu_typography',
					'selector'	=> '{{WRAPPER}} ul.sub-menu li a'
				]
			);

			// Background Submenu
			$this->add_control(
				'submenu_bg_color',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu' => 'background-color: {{VALUE}};',
					]
				]
			);

			// Background Item Hover In Submenu
			$this->add_control(
				'submenu_bg_item_hover_color',
				[
					'label' 	=> esc_html__( 'Background Item Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu li a:hover' => 'background-color: {{VALUE}};',
					]
				]
			);

			$this->add_responsive_control(
				'submenu_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} ul.sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			// Control Tabs
			$this->start_controls_tabs(
				'style_sub_menu_tabs'
			);

				// Normal Tab
				$this->start_controls_tab(
					'style_sub_menu_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'submenu_link_color',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.sub-menu li a' => 'color: {{VALUE}};',
							]
						]
					);

				$this->end_controls_tab();

				// Hover Tab
				$this->start_controls_tab(
					'style_sub_menu_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'submenu_link_color_hover',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.sub-menu li a:hover' => 'color: {{VALUE}};',
							]
						]
					);

				$this->end_controls_tab();

				// Active Tab
				$this->start_controls_tab(
					'style_sub_menu_active_tab',
					[
						'label' => esc_html__( 'Active', 'remons' ),
					]
				);

					$this->add_control(
						'submenu_link_color_active',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul.sub-menu li.current-menu-item > a' => 'color: {{VALUE}};',
							]
							
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Menu slug
		$menu_slug = remons_get_meta_data( 'menu_slug', $settings );

		// Icon
		$icon = remons_get_meta_data( 'icon', $settings );
		
		?>
		<nav class="main-navigation">
			<?php if ( remons_get_meta_data( 'value', $icon ) ): ?>
				<div class="ova-menu-decor-icon">
					<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php endif; ?>
            <button class="menu-toggle" aria-label="<?php esc_attr_e( 'menu toggle', 'remons' ); ?>">
            	<span>
            		<?php echo esc_html__( 'Menu', 'remons' ); ?>
            	</span>
            </button>
			<?php $fallback_cb = $walker = '';
			 	if ( class_exists( 'Ova_Megamenu_Walker_Nav_Menu' ) ) {
			      	$fallback_cb 	= 'Ova_Megamenu_Walker_Nav_Menu::fallback';
			      	$walker 		= new Ova_Megamenu_Walker_Nav_Menu;
			    }
				wp_nav_menu([
					'theme_location'  	=> $menu_slug,
					'container_class' 	=> 'primary-navigation',
					'menu' 				=> $menu_slug,
					'fallback_cb'       => $fallback_cb,
	                'walker'            => $walker
				]);
			?>
        </nav>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Menu_Nav() );