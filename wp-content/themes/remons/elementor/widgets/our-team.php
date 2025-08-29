<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Remons_Elementor_Our_Team
 */
class Remons_Elementor_Our_Team extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_our_team';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Our Team', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-person';
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
		wp_enqueue_style( 'remons-elementor-our-team', REMONS_URI.'/assets/scss/elementor/teams/our-team.css' );

		return [];
	}
	
	/**
	 * Register controls
	 */
	protected function register_controls() {
		// Content
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'remons' ),
			]
		);	

			// Add Class control
			$this->add_control(
				'template',
				[
					'label' 	=> esc_html__( 'Template', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
						'template3' => esc_html__( 'Template 3', 'remons' ),
					]
				]
			);

			$this->add_control(
				'link_team',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'options' 		=> [ 'url', 'is_external', 'nofollow' ],
					'default' 		=> [
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'label_block' 	=> true,
				]
			);

		    $this->add_control(
				'image',
				[
					'label' 	=> esc_html__( 'Choose Image', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' => true,
					],
					'default' 	=> [
						'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
				
			$this->add_control(
				'name',
				[
					'label' 	=> esc_html__( 'Name', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Michael S. Stewart', 'remons' ),
				]
			);

			$this->add_control(
				'job',
				[
					'label' 	=> esc_html__( 'Job', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'CEO & Founder', 'remons' ),
				]
			);
            
			// List icons control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::ICONS,
					'default' 	=> [
						'value' 	=> 'fab fa-facebook-f',
						'library' 	=> 'all',
					],
				]
			);

			$repeater->add_control(
				'link',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'options' 		=> [ 'url', 'is_external', 'nofollow' ],
					'default' 		=> [
						'url' 			=> '#',
						'is_external' 	=> true,
						'nofollow' 		=> false,
					],
					'label_block' 	=> true,
				]
			);

			$repeater->add_control(
				'icon_title', [
					'label' 		=> esc_html__( 'Icon Title', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'List Icon Title' , 'remons' ),
					'label_block' 	=> true,
				]
			);
			
            $this->add_control(
				'social_icon',
				[
					'label' 	=> esc_html__( 'Social Icons', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[	
							'icon' => [
								'value' => 'fab fa-facebook-f',
							],
							'icon_title' => esc_html__( 'Facebook', 'remons' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-twitter',
							],
							'icon_title' => esc_html__( 'Twitter', 'remons' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-linkedin-in',
							],
							'icon_title' => esc_html__( 'Linkedin', 'remons' ),
						],
						[	
							'icon' => [
								'value' => 'fab fa-youtube',
							],
							'icon_title' => esc_html__( 'Youtube', 'remons' ),
						],
	
					],
					'title_field' => '{{{ icon_title }}}',
				]
			);

		$this->end_controls_section();

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
						'{{WRAPPER}} .ova-our-team .info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-our-team .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'items_bg',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info' => 'background: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Image */
		$this->start_controls_section(
			'image_style_section',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Image', 'remons' ),
			]
		);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 200,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 30,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .image img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-our-team .image img, {{WRAPPER}} .ova-our-team .image:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		/* Name */
		$this->start_controls_section(
				'name_style_section',
				[
					'label' => esc_html__( 'Name', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'name_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-our-team .info .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'name_typography',
					'selector' 	=> '{{WRAPPER}} .ova-our-team .info .name',
				]
			);

			$this->add_control(
				'name_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .name' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Job */
		$this->start_controls_section(
				'job_style_section',
				[
					'label' => esc_html__( 'Job', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'job_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-our-team .info .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'job_typography',
					'selector' 	=> '{{WRAPPER}} .ova-our-team .info .job',
				]
			);

			$this->add_control(
				'job_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .info .job' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		/* Social Icon */
		$this->start_controls_section(
				'social_style_section',
				[
					'label' => esc_html__( 'Social Icon', 'remons' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			/* Icon */
			$this->add_control(
				'icon_style',
				[
					'label' 	=> esc_html__( 'Icon', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
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
							'step' 	=> 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .social-icon .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-our-team .social-icon .icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .social-icon .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-our-team .social-icon .icon svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_color_hover',
				[
					'label' 	=> esc_html__( 'Hover Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .social-icon .icon:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .ova-our-team .social-icon .icon:hover svg' => 'fill: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor',
				[
					'label' 	=> esc_html__( 'Background Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .social-icon .icon' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'icon_bgcolor_hover',
				[
					'label' 	=> esc_html__( 'Background Color Hover', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-our-team .social-icon .icon:hover' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();
	}

	/**
	 * Render HTMl
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		// Get template
		$template = remons_get_meta_data( 'template', $settings );

		// Get image url
		$image_url = isset( $settings['image']['url'] ) ? $settings['image']['url'] : '';

		// Get social icon
		$social_icon = remons_get_meta_data( 'social_icon', $settings, [] );

		// Get image id
		$image_id = remons_get_meta_data( 'id', $settings );
		
		// Get image atl
		$image_alt = '';
		if ( $image_id ) {
			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

			if ( !$image_alt ) {
				$image_alt = get_the_title( $image_id );
			}
		}

		// Get name
		$name = remons_get_meta_data( 'name', $settings );

		// Get job
		$job = remons_get_meta_data( 'job', $settings );

		// Get link
		$link = remons_get_meta_data( 'link_team', $settings );

		// Get url
		$url = remons_get_meta_data( 'url', $link );

		// Get rel
		$rel = remons_get_meta_data( 'nofollow', $link ) ? 'nofollow' : '';

		// Get target
		$target = remons_get_meta_data( 'is_external', $link ) ? '_blank' : '_self';

		?>
		<div class="ova-our-team <?php echo esc_attr( $template ); ?>">
			<?php if ( $image_url ): ?>
				<div class="image">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
					<?php if ( remons_array_exists( $social_icon ) && 'template2' === $template ): ?>
						<div class="share-button">
							<i class="fas fa-share-alt"></i>
						</div>
						<ul class="social-icon">
							<?php foreach ( $social_icon as $key => $item ):
								// Item icon
								$item_icon = remons_get_meta_data( 'icon', $item );
								if ( !remons_get_meta_data( 'value', $item_icon ) ) continue;

								// Get social title
								$social_title = remons_get_meta_data( 'icon_title', $item );

								// Get social link
								$social_link = remons_get_meta_data( 'link', $item );

								// Get social url
								$social_url = remons_get_meta_data( 'url', $social_link );

								// Get social rel
								$social_rel = remons_get_meta_data( 'nofollow', $social_link ) ? 'nofollow' : '';

								// Get social target
								$social_target = remons_get_meta_data( 'is_external', $social_link ) ? '_blank' : '_self';
							?>
								<li>
									<a href="<?php echo esc_url( $social_url ); ?>" class="icon" title="<?php echo esc_attr( $social_title ); ?>" target="<?php echo esc_attr( $social_target ); ?>" rel="<?php echo esc_attr( $social_rel ); ?>">
										<?php \Elementor\Icons_Manager::render_icon( $item_icon, [ 'aria-hidden' => 'true' ] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="info">
				<?php if ( $name ):
					if ( $url ): ?>	
						<a href="<?php echo esc_attr( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
					<?php endif; ?>
						<h3 class="name"><?php echo esc_html( $name ); ?></h3>
					<?php if ( $url ): ?>	
						</a>
					<?php endif;
				endif;

				if ( $job ): ?>
					<p class="job"><?php echo esc_html( $job ); ?></p>
				<?php endif;

				if ( $social_icon && 'template2' !== $template ):
					if ( $template === 'template3' ): ?>
						<div class="share-button">
							<i class="flaticon flaticon-plus"></i>
						</div>
					<?php endif; ?>
					<ul class="social-icon">
						<?php foreach ( $social_icon as $key => $item ):
							// Item icon
							$item_icon = remons_get_meta_data( 'icon', $item );
							if ( !remons_get_meta_data( 'value', $item_icon ) ) continue;

							// Get social title
							$social_title = remons_get_meta_data( 'icon_title', $item );

							// Get social link
							$social_link = remons_get_meta_data( 'link', $item );

							// Get social url
							$social_url = remons_get_meta_data( 'url', $social_link );

							// Get social rel
							$social_rel = remons_get_meta_data( 'nofollow', $social_link ) ? 'nofollow' : '';

							// Get social target
							$social_target = remons_get_meta_data( 'is_external', $social_link ) ? '_blank' : '_self';
						?>
							<li>
								<a href="<?php echo esc_url( $social_url ); ?>" class="icon" title="<?php echo esc_attr( $social_title ); ?>" target="<?php echo esc_attr( $social_target ); ?>" rel="<?php echo esc_attr( $social_rel ); ?>">
									<?php \Elementor\Icons_Manager::render_icon( $item_icon, [ 'aria-hidden' => 'true' ] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Our_Team() );