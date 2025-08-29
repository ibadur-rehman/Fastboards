<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_My_Account_Button
 */
class Remons_Elementor_My_Account_Button extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_my_account_button';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'My Account Button', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-dual-button';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons' ];
	}

	/**
	 * Get scrip depends
	 */
	public function get_script_depends() {
		return [ '' ];
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
			$this->add_control(
				'text_my_account_button',
				[
					'label' 		=> esc_html__( 'Text My Account Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'label_block' 	=> true,
					'default' 		=> esc_html__( 'My account', 'remons' ),
				]
			);

			$this->add_control(
				'text_login_button',
				[
					'label' 		=> esc_html__( 'Text Login Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'label_block' 	=> true,
					'default' 		=> esc_html__( 'Login', 'remons' ),
				]
			);

			$this->add_control(
				'text_signup_button',
				[
					'label' 		=> esc_html__( 'Text Sign Up Button', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'label_block' 	=> true,
					'default' 		=> esc_html__( 'Sign Up', 'remons' ),
				]
			);

			$this->add_control(
				'logout_status',
				[
					'label' 		=> esc_html__( 'Logout Status', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Yes', 'remons' ),
					'label_off' 	=> esc_html__( 'No', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

		$this->end_controls_section();

		// SECTION TAB STYLE MY ACCOUNT
		$this->start_controls_section(
			'section_my_account',
			[
				'label' => esc_html__( 'My Account', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'typography_my_account',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-my-account-button.logged-in a',
					
				]
			);

			$this->add_control(	
				'color_my_account',
				[
					'label' 	=> esc_html__( 'Login Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-my-account-button.logged-in a' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		// SECTION TAB STYLE button
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_title_btn',
					'label' 	=> esc_html__( 'Typography', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-my-account-button a.ma-button',
				]
			);
			
			$this->add_responsive_control(
				'padding_button',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-my-account-button a.ma-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'border_radius_button',
				[
					'label' 		=> esc_html__( 'Border radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-my-account-button a.ma-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
				'style_tabs_button'
			);

				$this->start_controls_tab(
					'style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(	
						'color_title_btn',
						[
							'label' 	=> esc_html__( 'Login Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.login-button' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_button_background',
						[
							'label' 	=> esc_html__( 'Login Background ', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.login-button' => 'background-color : {{VALUE}};',
							],
						]
					);

					$this->add_control(	
						'color_title_signup_btn',
						[
							'label' 	=> esc_html__( 'Singup Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.singup-button' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_signup_button_background',
						[
							'label' 	=> esc_html__( 'Singup Background ', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.singup-button' => 'background-color : {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'color_title_btn_hover',
						[
							'label' 	=> esc_html__( 'Login Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.login-button:hover' => 'color : {{VALUE}} ;',
							],
						]
					);

					$this->add_control(
						'color_button_hover_background',
						[
							'label' 	=> esc_html__( 'Login Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.login-button:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_title_signup_btn_hover',
						[
							'label' 	=> esc_html__( 'Singup Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.singup-button:hover' => 'color : {{VALUE}} ;',
							],
						]
					);

					$this->add_control(
						'color_signup_button_hover_background',
						[
							'label' 	=> esc_html__( 'Singup Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-my-account-button a.ma-button.singup-button:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section(); // END SECTION TAB STYLE button	
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Button text
		$text_my_account_button = remons_get_meta_data( 'text_my_account_button', $settings );
		$text_login_button 		= remons_get_meta_data( 'text_login_button', $settings );
		$text_signup_button 	= remons_get_meta_data( 'text_signup_button', $settings );
		$logout_status 			= remons_get_meta_data( 'logout_status', $settings );
		$my_account_page_url 	= get_permalink( get_option('woocommerce_myaccount_page_id') );

		if ( is_user_logged_in() && 'yes' != $logout_status ):
			$current_user = wp_get_current_user();
		?>
			<div class="ova-my-account-button logged-in">
				<?php if ( $current_user instanceof WP_User ) {
			        echo get_avatar( $current_user->ID, 30 );
			    } ?>
				<a href="<?php echo esc_url( $my_account_page_url ); ?>">
					<?php echo esc_html( $text_my_account_button ); ?>
				</a>
			</div>
		<?php else: ?>
			<div class="ova-my-account-button logged-out">
				<a class="ma-button login-button" href="<?php echo esc_url( $my_account_page_url ); ?>">
					<?php echo esc_html( $text_login_button ); ?>
				</a>
				<a class="ma-button singup-button" href="<?php echo esc_url( $my_account_page_url ); ?>">
					<?php echo esc_html( $text_signup_button ); ?>
				</a>
			</div>
		<?php endif;
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_My_Account_Button() );