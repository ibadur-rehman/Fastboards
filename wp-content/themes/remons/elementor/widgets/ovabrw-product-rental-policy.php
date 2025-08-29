<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Ovabrw_Product_Rental_Policy
 */
class Remons_Elementor_Ovabrw_Product_Rental_Policy extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {		
		return 'remons_elementor_ovabrw_product_rental_policy';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Product Rental Policy', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-editor-list-ol';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons-product' ];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_demo',
			[
				'label' => esc_html__( 'Demo', 'remons' ),
			]
		);
			// init
			$products_ids = [];

			// Default product
			$default_product = '';

			// Get rental products
			$rental_products = OVABRW()->options->get_rental_product_ids();
			if ( ovabrw_array_exists( $rental_products ) ) {
				foreach ( $rental_products as $product_id ) {
					$products_ids[$product_id] = get_the_title( $product_id );

					// Default product
					if ( !$default_product ) $default_product = $product_id;
				}
			} else {
				$products_ids[''] = esc_html__( 'There are no rental products', 'remons' );
			}

			$this->add_control(
				'product_id',
				[
					'label' 	=> esc_html__( 'Choose Product', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> $default_product,
					'options' 	=> $products_ids,
				]
			);

			$this->add_control(
				'heading',
				[
					'label' 	=> esc_html__( 'Heading', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__('Rental Policy', 'remons'),
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

		// Get product ID
		$product_id = ovabrw_get_meta_data( 'product_id', $settings );

		// Get heading
		$heading = ovabrw_get_meta_data( 'heading', $settings );

		// Global product
		global $product;
		if ( !$product ) {
			$product = wc_get_product( $product_id );
		}

		// Check rental product
    	if ( !$product || !$product->is_type( OVABRW_RENTAL ) ): ?>
			<div class="ovabrw_elementor_no_product">
				<span><?php echo wp_kses_post( $this->get_title() ); ?></span>
			</div>
			<?php return;
		endif;

		?>
		<div class="elementor-ovabrw-product-rental-policy">
			<?php ovabrw_get_template( apply_filters( 'remons_widget_template_product_policy', 'single/rental_policy.php', $settings ), [
				'product_id' 	=> $product->get_id(),
				'heading' 		=> $heading
			]); ?>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Ovabrw_Product_Rental_Policy() );