<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Video
 */
class Remons_Elementor_Video extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_video';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Ova Video', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-video-playlist';
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
		return [ 'remons-elementor-video' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-video', REMONS_URI.'/assets/scss/elementor/videos/video.css' );
		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__( 'Video', 'remons' ),
			]
		);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'fas fa-play',
						'library' 	=> 'all',
					],
				]
			);

			$this->add_control(
				'icon_url_video',
				[
					'label' 		=> esc_html__( 'URL Video', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your URL', 'remons' ) . ' (YouTube)',
					'default' 		=> 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				]
			);

			$this->add_control(
				'icon_text',
				[
					'label' => esc_html__( 'Text', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
	            'link',
	            [
	                'label' 	=> esc_html__( 'Link', 'remons' ),
	                'type' 		=> \Elementor\Controls_Manager::URL,
	                'dynamic' 	=> [
	                    'active' => true,
	                ],
	                'condition' => [
	                	'icon_url_video' => '',
	                ],
	            ]
	        );

	        $this->add_control(
				'icon_animation',
				[
					'label' 		=> esc_html__( 'Animation', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'On', 'remons' ),
					'label_off' 	=> esc_html__( 'Off', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

	        $this->add_control(
				'video_options',
				[
					'label' 	=> esc_html__( 'Video Options', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'autoplay_video',
				[
					'label' 	=> esc_html__( 'Autoplay', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'mute_video',
				[
					'label' 	=> esc_html__( 'Mute', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'no',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'loop_video',
				[
					'label' 	=> esc_html__( 'Loop', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'player_controls_video',
				[
					'label' 	=> esc_html__( 'Player Controls', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'modest_branding_video',
				[
					'label' 	=> esc_html__( 'Modest Branding', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'yes',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_control(
				'show_info_video',
				[
					'label' 	=> esc_html__( 'Show Info', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'remons' ),
					'label_off' => esc_html__( 'No', 'remons' ),
					'default' 	=> 'no',
					'condition' => [
						'icon_url_video!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'alignment',
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
					'toggle' 	=> true,
					'selectors' => [
						'{{WRAPPER}} .ova-video' => 'text-align: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		// Begin section icon style
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);	

		    $this->add_responsive_control(
				'icon_font_size',
				[
					'label' 		=> esc_html__( 'Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-video .icon-content-view .content i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_bgsize',
				[
					'label' 		=> esc_html__( 'Background Size', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' => 0,
							'max' => 400,
						],
					],	
					'selectors' 	=> [
						'{{WRAPPER}} .ova-video .icon-content-view .content' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'remons' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-video .icon-content-view .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-video .icon-content-view .content:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-video .icon-content-view .content:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_group_control(
	            \Elementor\Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_before_border',
	                'selector' 	=> '{{WRAPPER}} .ova-video .icon-content-view .content:before', 
	            ]
	        );

	        $this->add_responsive_control(
				'margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-video .icon-content-view .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icon_style' );

				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'remons' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_primary_background_normal',
			            [
			                'label' 	=> esc_html__( 'Primary Background Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content:before' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_secondary_background_normal',
			            [
			                'label' 	=> esc_html__( 'Secondary Background Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content:after' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'remons' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content:hover i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_primary_background_hover',
			            [
			                'label' 	=> esc_html__( 'Primary Background Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content:hover:before' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_secondary_background_hover',
			            [
			                'label' 	=> esc_html__( 'Secondary Background Color', 'remons' ),
			                'type' 		=> \Elementor\Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-video .icon-content-view .content:hover:after' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();
	    $this->end_controls_section();

	    // Begin text Style
		$this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__( 'Text', 'remons' ),
                'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

	        $this->add_responsive_control(
				'text_alignment',
				[
					'label' 	=> esc_html__( 'Alignment', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'remons' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'remons' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
				]
			);

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_typography',
					'selector' 	=> '{{WRAPPER}} .ova-video .text',
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-video .text, {{WRAPPER}} .ova-video .text a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-video .text:hover a, {{WRAPPER}} .ova-video .text:hover' => 'color: {{VALUE}};',
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
	                    '{{WRAPPER}} .ova-video .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section(); // End text style
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get icon
		$icon = remons_get_meta_data( 'icon', $settings );

		// Get video URL
		$url_video = remons_get_meta_data( 'icon_url_video', $settings );

		// Get icon text
		$icon_text = remons_get_meta_data( 'icon_text', $settings );

		// Get link
		$link = isset( $settings['link']['url'] ) ? $settings['link']['url'] : '';

		// Target
		$target = '_self';
		if ( isset( $settings['link']['is_external'] ) && 'on' === $settings['link']['is_external'] ) {
			$target = '_blank';
		}

		// Text alignment
		$text_alignment = remons_get_meta_data( 'text_alignment', $settings );

		// Icon animation
		$icon_animation = remons_get_meta_data( 'icon_animation', $settings );

        // Autoplay
		$autoplay = remons_get_meta_data( 'autoplay_video', $settings );

		// Mute
		$mute = remons_get_meta_data( 'mute_video', $settings );

		// Loop
		$loop = remons_get_meta_data( 'loop_video', $settings );

		// Controls
		$controls = remons_get_meta_data( 'player_controls_video', $settings );

		// Modest
		$modest = remons_get_meta_data( 'modest_branding_video', $settings );

		// Show info
		$show_info = remons_get_meta_data( 'show_info_video', $settings );

		?>

		<div class="ova-video">
 			<?php if ( $icon_text && 'right' != $text_alignment ): ?>
				<div class="text">
					<?php if ( $link ): ?>
						<a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
							<?php echo esc_html( $icon_text ); ?>
						</a>
					<?php else:
						echo esc_html( $icon_text );
					endif; ?>
				</div>
			<?php endif; ?>
			<div class="icon-content-view video_active <?php if ( 'yes' != $icon_animation ) echo esc_attr( 'no-animation' ); ?>">
				<?php if ( $url_video ): ?>
					<div class="content video-btn" 
							data-src="<?php echo esc_url( $url_video ); ?>" 
							data-autoplay="<?php echo esc_attr( $autoplay ); ?>" 
							data-mute="<?php echo esc_attr( $mute ); ?>" 
							data-loop="<?php echo esc_attr( $loop ); ?>" 
							data-controls="<?php echo esc_attr( $controls ); ?>" 
							data-modest="<?php echo esc_attr( $modest ); ?>" 
							data-show_info="<?php echo esc_attr( $show_info ); ?> 
							">
						<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( $icon_text && 'right' === $text_alignment ): ?>
				<div class="text">
					<?php if ( $link ): ?>
						<a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
							<?php echo esc_html( $icon_text ); ?>
						</a>
					<?php else:
						echo esc_html( $icon_text );
					endif; ?>
				</div>
			<?php endif; ?>
			<div class="ova-modal-container">
				<div class="modal">
					<i class="modal-close ovaicon-cancel"></i>
					<iframe class="modal-video" allow="autoplay" allowFullScreen="allowFullScreen" frameBorder="0"></iframe>
				</div>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Video() );