<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Canvas_Menu
 */
class Remons_Elementor_Canvas_Menu extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_menu_canvas';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Menu Canvas', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-menu-bar';
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
		return [ 'remons-elementor-menu-canvas' ];
	}
	
	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {

		// Global section
		$this->start_controls_section(
			'section_menu_type',
			[
				'label' => esc_html__( 'Content', 'remons' ),
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
				'menu_dir',
				[
					'label' 	=> esc_html__( 'Menu Direction', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'dir_left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'dir_right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
					'default' => 'dir_left'
				]
			);

			$this->add_control(
				'show_button',
				[
					'label' 	=> esc_html__( 'Show Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'remons' ),
					'label_off' => esc_html__( 'Hide', 'remons' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'link_button',
				[
					'label'   		=> esc_html__( 'Link Button', 'remons' ),
					'type'    		=> \Elementor\Controls_Manager::URL,
					'description' 	=> esc_html__( 'https://your-domain.com', 'remons' ),
					'show_external' => false,
					'default' 		=> [
						'url' 			=> '#',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'condition' => [
						'show_button' => 'yes'
					]
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' 	=> esc_html__( 'Text Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Find a Car', 'remons' ),
					'condition' => [
						'show_button' => 'yes'
					]
				]
			);
			
		$this->end_controls_section();	


		/* Style Section */
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Menu', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			
			$this->add_control(
				'text_align',
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
					'default' 	=> 'right',
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .menu-canvas' => 'text-align: {{VALUE}};',
					],
				]
			);
			
			// Background Button
			$this->add_control(
				'btn_color',
				[
					'label' 	=> esc_html__( 'Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .menu-toggle:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle span:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle:after' => 'background-color: {{VALUE}};',
					]
				]
			);

			// Background Menu
			$this->add_control(
				'bg_color',
				[
					'label' 	=> esc_html__( 'Menu Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .container-menu' => 'background-color: {{VALUE}};',
					],
					'separator' => 'before'
				]
			);

			// Typography Menu Item
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'typography',
					'selector'	=> '{{WRAPPER}} ul li a'
				]
			);

			// Control Tabs
			$this->start_controls_tabs(
				'style_tabs_text'
			);

				// Normal Tab
				$this->start_controls_tab(
					'style_normal_tab_text',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);
			
					$this->add_control(
						'text_color',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul li a' => 'color: {{VALUE}};',
							]
						]
					);

				$this->end_controls_tab();

				// Hover Tab
				$this->start_controls_tab(
					'style_hover_tab_text',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'text_color_hover',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul li a:hover' => 'color: {{VALUE}};',
							]
							
						]
					);

				$this->end_controls_tab();

				// Active Tab
				$this->start_controls_tab(
					'style_active_tab_text',
					[
						'label' => esc_html__( 'Active', 'remons' ),
					]
				);

					$this->add_control(
						'text_color_active',
						[
							'label' 	=> esc_html__( 'Menu Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'default' 	=> '',
							'selectors' => [
								'{{WRAPPER}} ul li.current-menu-item > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} ul li.current-menu-ancestor > a' => 'color: {{VALUE}};',
								'{{WRAPPER}} ul li.current-menu-parent > a' => 'color: {{VALUE}};',
							]
							
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();	
			
			$this->add_responsive_control(
				'padding_item',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .menu-canvas ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' 	=> 'before',
				]
			);

			$this->add_responsive_control(
				'margin_item',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .menu-canvas ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'item_border',
					'selector' 	=> '{{WRAPPER}} .menu-canvas ul li a',
				]
			);

			$this->add_control(
				'arrow_color',
				[
					'label' 	=> esc_html__( 'Arrow Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .menu-canvas .dropdown-toggle' => 'color: {{VALUE}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'margin_submenu',
				[
					'label' 		=> esc_html__( 'Margin Sub', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .menu-canvas ul.menu ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Menu class
		$menu_class = remons_get_meta_data( 'menu_dir', $settings );

		// Menu slug
		$menu_slug = remons_get_meta_data( 'menu_slug', $settings );

		// Show button
		$show_button = remons_get_meta_data( 'show_button', $settings );

		// Button link
		$button_link = isset( $settings['link_button']['url'] ) ? $settings['link_button']['url'] : '';

		// Button text
		$button_text = remons_get_meta_data( 'text_button', $settings );

		// Target
		$target = isset( $settings['link_button']['is_external'] ) && $settings['link_button']['is_external'] ? '_blank' : '_self';
		
		?>
		<nav class="menu-canvas">
            <button class="menu-toggle" aria-label="<?php esc_attr_e( 'menu toggle', 'remons' ); ?>">
            	<span></span>
            </button>
            <nav class="container-menu <?php echo esc_attr( $menu_class ); ?>">
	            <div class="close-menu">
	            	<i class="ovaicon-cancel"></i>
	            </div>
				<?php
					// Nav menu
					wp_nav_menu([
						'theme_location'  => $menu_slug,
						'container_class' => 'primary-navigation',
						'menu'            => $menu_slug
					]);
				
					if ( 'yes' === $show_button ): ?>
						<div class="menu-button-wrapper">
							<a class="menu-button" href="<?php echo esc_url( $button_link ); ?>" target="<?php echo esc_attr( $target ); ?>">
								<?php echo esc_html( $button_text ); ?>
							</a>
						</div>
				<?php endif; ?>
			</nav>
			<div class="site-overlay"></div>
        </nav>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Canvas_Menu() );