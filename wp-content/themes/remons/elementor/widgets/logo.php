<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * Class Remons_Elementor_Logo
 */
class Remons_Elementor_Logo extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'ova_logo';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Logo', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-image';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'image', 'photo', 'visual' ];
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

		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'remons' ),
			]
		);

		
		$this->add_control(
			'link_to',
			[
				'label' 	=> esc_html__( 'Link', 'remons' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'options' 	=> [
					'home' 		=> esc_html__( 'Home Page', 'remons' ),
					'none' 		=> esc_html__( 'None', 'remons' ),
					'custom' 	=> esc_html__( 'Custom URL', 'remons' ),
				],
				'default' => 'home',
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> esc_html__( 'Link', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'dynamic' 		=> [
					'active' 	=> true,
				],
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
				'condition' 	=> [
					'link_to' 	=> 'custom',
				],
				'show_label' 	=> false,
			]
		);

		$this->add_control(
			'desk_logo',
			[
				'label' 	=> esc_html__( 'Desktop Logo', 'remons' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'dynamic' 	=> [
					'active' => true,
				],
				'default' 	=> [
					'url' 	=> \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'desk_logo',
				'default' 	=> 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'desk_w',
			[
				'label' 		=> esc_html__( 'Desktop Logo Width', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' 	=> 'px',
					'size' 	=> 132,
				],
				
			]
		);
		$this->add_control(
			'desk_h',
			[
				'label' 		=> esc_html__( 'Desktop Logo Height', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 36,
				],
				
			]
		);

		$this->add_control(
			'mobile_logo',
			[
				'label' 	=> esc_html__( 'Mobile Logo', 'remons' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'dynamic' 	=> [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'mobile_w',
			[
				'label' 		=> esc_html__( 'Mobile Logo Width', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 132,
				],
			]
		);
		$this->add_control(
			'mobile_h',
			[
				'label' 		=> esc_html__( 'Mobile Logo Height', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 36,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'mobile_logo',
				'default' 	=> 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'sticky_logo',
			[
				'label' 	=> esc_html__( 'Sticky Logo', 'remons' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'dynamic' 	=> [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'sticky_w',
			[
				'label' 		=> esc_html__( 'Sticky Logo Width', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 132,
				],
			]
		);

		$this->add_control(
			'sticky_h',
			[
				'label' 		=> esc_html__( 'Sticky Logo Height', 'remons' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 1000,
						'step' 	=> 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 36,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' 		=> 'sticky_logo',
				'default' 	=> 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get link URL
	 */
	private function get_link_url( $settings ) {
		// Get link to
		$link_to = remons_get_meta_data( 'link_to', $settings );

		if ( 'none' === $link_to ) {
			return false;
		} elseif ( 'home' === $link_to ) {
			return array( 'url' => esc_url( home_url('/') ) );
		} elseif ( 'custom' === $link_to ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return false;
	}

	/**
	 * Render HTML
	 */
	protected function render() {
		// Get settings
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['desk_logo']['url'] ) ) {
			return;
		}

		// Desktop logo
		$desk_logo = isset( $settings['desk_logo']['url'] ) ? $settings['desk_logo']['url'] : '';

		// Desktop width size
		$desk_ws = isset( $settings['desk_w']['size'] ) ? $settings['desk_w']['size'] : '';

		// Desktop height size
		$desk_hs = isset( $settings['desk_h']['size'] ) ? $settings['desk_h']['size'] : '';

		// Desktop unit
		$desk_unit = isset( $settings['desk_w']['unit'] ) ? $settings['desk_w']['unit'] : '';

		// Desktop width
		$desk_w = $desk_ws ? $desk_ws.$desk_unit : 'auto';

		// Desktop height
		$desk_h = $desk_hs ? $desk_hs.$desk_unit : 'auto';

		// Mobile logo
		$mobile_logo = isset( $settings['mobile_logo']['url'] ) ? $settings['mobile_logo']['url'] : '';

		// Mobile width size
		$mobile_ws = isset( $settings['mobile_w']['size'] ) ? $settings['mobile_w']['size'] : '';

		// Mobile height size
		$mobile_hs = isset( $settings['mobile_h']['size'] ) ? $settings['mobile_h']['size'] : '';

		// Mobile unit
		$mobile_unit = isset( $settings['desk_w']['unit'] ) ? $settings['desk_w']['unit'] : '';

		// Mobile width
		$mobile_w = $mobile_ws ? $mobile_ws.$mobile_unit : 'auto';

		// Mobile height
		$mobile_h = $mobile_hs ? $mobile_hs.$mobile_unit : 'auto';

		// Sticky logo
		$sticky_logo = isset( $settings['sticky_logo']['url'] ) ? $settings['sticky_logo']['url'] : '';

		// Sticky width size
		$sticky_ws = isset( $settings['sticky_w']['size'] ) ? $settings['sticky_w']['size'] : '';

		// Sticky height size
		$sticky_hs = isset( $settings['sticky_h']['size'] ) ? $settings['sticky_h']['size'] : '';

		// Sticky unit
		$sticky_unit = isset( $settings['desk_w']['unit'] ) ? $settings['desk_w']['unit'] : '';

		// Sticky width
		$sticky_w = $sticky_ws ? $sticky_ws.$sticky_unit : 'auto';

		// Sticky height
		$sticky_h = $sticky_hs ? $sticky_hs.$sticky_unit : 'auto';

		// Get logo link
		$link = $this->get_link_url( $settings );

		// Get URL
		$url = remons_get_meta_data( 'url', $link );

		// Get target
		$target = remons_get_meta_data( 'is_external', $link ) ? '_blank' : '_self';

		// Get rel
		$rel = remons_get_meta_data( 'nofollow', $link ) ? 'nofollow' : '';

		?>

		<div class="brand_el">
			<?php if ( $link ): ?>
				<a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
			<?php endif; ?>
				<img src="<?php echo esc_url( $desk_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo_desktop" style="width:<?php echo esc_attr( $desk_w ); ?>; height:<?php echo esc_attr( $desk_h ); ?>" />
				<img src="<?php echo esc_url( $mobile_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo_mobile" style="width:<?php echo esc_attr( $mobile_w ); ?>; height:<?php echo esc_attr( $mobile_h ); ?>" 
				/>
				<img src="<?php echo esc_url( $sticky_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo_sticky" style="width:<?php echo esc_attr( $sticky_w ); ?>; height:<?php echo esc_attr( $sticky_h ); ?>" 
				/>
			<?php if ( $link ): ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
	
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Logo() );