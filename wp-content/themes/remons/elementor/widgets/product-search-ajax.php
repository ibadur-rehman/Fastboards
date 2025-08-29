<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Search_Ajax
 */
class Remons_Elementor_Product_Search_Ajax extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_search_ajax';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Product Search Ajax', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-search-results';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'remons-product' ];
	}

	/**
	 * Get script depends
	 */
	public function get_script_depends() {
		// Get Google API Key
		$api_key = ovabrw_get_setting( 'google_key_map', false );
		if ( $api_key ) {
			wp_enqueue_script( 'ovabrw-google-maps','https://maps.googleapis.com/maps/api/js?key='.$api_key.'&libraries=places', false, true );
		} else {
			wp_enqueue_script( 'ovabrw-google-maps','https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places', array('jquery'), false, true);
		}

		// Jquery UI
		wp_enqueue_script('jquery-ui', get_template_directory_uri().'/assets/libs/jquery-ui/jquery-ui.min.js', array('jquery'), false, true);
		wp_enqueue_style('jquery-ui', get_template_directory_uri().'/assets/libs/jquery-ui/jquery-ui.min.css', array(), null);

		return [ 'remons-elementor-product-search-ajax' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-search', REMONS_URI.'/assets/scss/elementor/products/product-search.css' );
		wp_enqueue_style( 'remons-elementor-product-search-ajax', REMONS_URI.'/assets/scss/elementor/products/product-search-ajax.css' );
		return [];
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_search_form',
			[
				'label' => esc_html__( 'Search Form', 'remons' ),
			]
		);

			$this->add_control(
				'search_heading',
				[
					'label' 	=> esc_html__( 'Search Heading', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Search Car', 'remons' ),
				]
			);

			$this->add_control(
				'search_position',
				[
					'label'   => esc_html__( 'Search Position', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'left',
					'options' => [
						'left' 	=> esc_html__('Left', 'remons'),
						'right' => esc_html__('Right', 'remons'),
					],
				]
			);

			$search_fields = array(
				'' 					=> esc_html__( 'Select Search', 'remons' ),
				'name' 				=> esc_html__( 'Name', 'remons' ),
				'category' 			=> esc_html__( 'Category', 'remons' ),
				'location' 			=> esc_html__( 'Location', 'remons' ),
				'pickup_location' 	=> esc_html__( 'Pick-up Location', 'remons' ),
				'dropoff_location' 	=> esc_html__( 'Drop-off Location', 'remons' ),
				'pickup_date' 		=> esc_html__( 'Pick-up Date', 'remons' ),
				'dropoff_date' 		=> esc_html__( 'Drop-off Date', 'remons' ),
				'package' 		    => esc_html__( 'Package', 'remons' ),
				'attribute' 		=> esc_html__( 'Name Attribute', 'remons' ),
				'quantity' 			=> esc_html__( 'Quantity', 'remons' ),
				'tags' 				=> esc_html__( 'Tags', 'remons' ),
			);

			$this->add_control(
				'show_time',
				[
					'label' 	=> esc_html__( 'Show Time', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'remons' ),
					'label_off' => esc_html__( 'Hide', 'remons' ),
					'default' 	=> 'no',
				]
			);

			$this->add_control(
				'show_package',
				[
					'label' 		=> esc_html__('Show Package', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'no',
				]
			);

			$this->add_control(
				'field_1',
				[
					'label'   	=> esc_html__( 'Field 1', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_2',
				[
					'label'   	=> esc_html__( 'Field 2', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_3',
				[
					'label'   	=> esc_html__( 'Field 3', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_4',
				[
					'label'   	=> esc_html__( 'Field 4', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_5',
				[
					'label'   	=> esc_html__( 'Field 5', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_6',
				[
					'label'   	=> esc_html__( 'Field 6', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_7',
				[
					'label'   	=> esc_html__( 'Field 7', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_8',
				[
					'label'   	=> esc_html__( 'Field 8', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_9',
				[
					'label'   	=> esc_html__( 'Field 9', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_10',
				[
					'label'   	=> esc_html__( 'Field 10', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> '',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			// Data taxonomy
			$data_taxonomy[''] = esc_html__( 'Select Taxonomy', 'remons' );

			// Get custom taxonomies
			$taxonomies = ovabrw_get_option( 'custom_taxonomy', [] );
			if ( ovabrw_array_exists( $taxonomies ) ) {
				foreach ( $taxonomies as $key => $value ) {
					$data_taxonomy[$key] = $value['name'];
				}
			}

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'taxonomy_custom', [
					'label' 		=> esc_html__( 'Taxonomy Custom', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT,
					'label_block' 	=> true,
					'options' 		=> $data_taxonomy,
				]
			);

			$this->add_control(
				'list_taxonomy_custom',
				[
					'label' 	=> esc_html__( 'List Taxonomy Custom', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						'' => esc_html__( 'Select Taxonomy', 'remons' ),
					],
				]
			);

			$this->add_control(
				'search_icon',
				[
					'label' => esc_html__( 'Icon Button', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::ICONS,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_package',
			[
				'label' => esc_html__( 'Create Package', 'remons' ),
				'condition' => [
					'show_package' => 'yes'
				]
			]
		);

			$this->add_control(
				'package_label',
				[
					'label' 	=> esc_html__( 'Label', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Package', 'remons' ),
					
				]
			);

			$this->add_control(
				'package_placeholder',
				[
					'label' 	=> esc_html__( 'Placeholder', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Select Package', 'remons' ),
					
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'package_type',
				[
					'label' 	=> esc_html__( 'Type', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'hour',
					'options' 	=> [
						'day' 	=> esc_html__('Day', 'remons'),
						'hour' 	=> esc_html__('Hour', 'remons'),
					]
				]
			);

			$repeater->add_control(
				'package_name',
				[
					'label' 	=> esc_html__( 'Name', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__('Morning', 'remons'),
				]
			);

			$repeater->add_control(
				'package_day_value',
				[
					'label' 	=> esc_html__( 'Day Value', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,	
					'min' 		=> 0,
					'default' 	=> 1,
					'condition' => [
						'package_type' => 'day'
					]
				]
			);

			$repeater->add_control(
				'package_hour_value',
				[
					'label' 	=> esc_html__( 'Hour Value', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,	
					'min' 		=> 0,
					'default' 	=> 3,
					'condition' => [
						'package_type' => 'hour'
					]
				]
			);

			$this->add_control(
				'package_items',
				[
					'label' 	=> esc_html__( 'Items', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'package_type' 			=> 'hour',
							'package_title' 		=> esc_html__( 'Morning', 'remons' ),
							'package_day_value' 	=> 1,
							'package_hour_value' 	=> 3,
						],
					],
					'title_field' => '{{{ package_name }}} < {{{ package_type }}} >',
				]
			);	

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_field',
			[
				'label' => esc_html__( 'Label Field', 'remons' ),
			]
		);

			$this->add_control(
				'field_name',
				[
					'label' 	=> esc_html__( 'Label Name', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Product Name', 'remons' ),
				]
			);

			$this->add_control(
				'field_category',
				[
					'label' 	=> esc_html__( 'Label Category', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Select Category', 'remons' ),
				]
			);

			$this->add_control(
				'field_location',
				[
					'label' 	=> esc_html__( 'Label Location', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Location', 'remons' ),
				]
			);

			$this->add_control(
				'field_pickup_location',
				[
					'label' 	=> esc_html__( 'Label Pick-up Location', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Pick-up Location', 'remons' ),
				]
			);

			$this->add_control(
				'field_dropoff_location',
				[
					'label' 	=> esc_html__( 'Label Drop-off Location', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Drop-off Location', 'remons' ),
				]
			);

			$this->add_control(
				'field_pickup_date',
				[
					'label' 	=> esc_html__( 'Label Pick-up Date', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Pick-up Date', 'remons' ),
				]
			);

			$this->add_control(
				'field_dropoff_date',
				[
					'label' 	=> esc_html__( 'Label Drop-off Date', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Drop-off Date', 'remons' ),
				]
			);

			$this->add_control(
				'field_attribute',
				[
					'label' 	=> esc_html__( 'Label Attribute', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Select Attribute', 'remons' ),
				]
			);

			$this->add_control(
				'field_tags',
				[
					'label' 	=> esc_html__( 'Label Tags', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Tags Product', 'remons' ),
				]
			);

			$this->add_control(
				'field_quantity',
				[
					'label' 	=> esc_html__( 'Label Quantity', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Quantity', 'remons' ),
				]
			);

			$this->add_control(
				'field_button',
				[
					'label' 	=> esc_html__( 'Label Button', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Find a Car', 'remons' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_placeholder_field',
			[
				'label' => esc_html__( 'Placeholder Field', 'remons' ),
			]
		);

			$this->add_control(
				'placeholder_name',
				[
					'label' => esc_html__( 'Placeholder Name', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'placeholder_category',
				[
					'label' => esc_html__( 'Placeholder Category', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'placeholder_location',
				[
					'label' => esc_html__( 'Placeholder Location', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'placeholder_attribute',
				[
					'label' => esc_html__( 'Placeholder Attribute', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'placeholder_tags',
				[
					'label' => esc_html__( 'Placeholder Tags', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_default_field',
			[
				'label' => esc_html__( 'Default Field', 'remons' ),
			]
		);

			$this->add_control(
				'default_cat',
				[
					'label' 		=> esc_html__( 'Default Category', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'Enter the product slug category', 'remons' ),
				]
			);

			$this->add_control(
				'default_pickup_loc',
				[
					'label' 		=> esc_html__( 'Default Pick-up Location', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'Enter the name Pick-up Location', 'remons' ),
				]
			);

			$this->add_control(
				'default_dropoff_loc',
				[
					'label' 		=> esc_html__( 'Default Drop-off Location', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'Enter the name Drop-off Location', 'remons' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_inlucde_exclude',
			[
				'label' => esc_html__( 'Exclude/Include Category', 'remons' ),
			]
		);

			$this->add_control(
				'inlucde_exclude_type',
				[
					'label' 	=> esc_html__( 'Type', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'default',
					'options' 	=> [
						'default' 		=> esc_html__( 'Default', 'remons' ),
						'multi_select' 	=> esc_html__( 'Multi Select', 'remons' ),
					]
				]
			);

			$this->add_control(
				'category_not_in',
				[
					'label'   		=> esc_html__( 'Category Not In', 'remons' ),
					'type'    		=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'Enter the product category IDs. IDs are separated by "|". Ex: 1|2|3.', 'remons' ),
					'condition' 	=> [
						'inlucde_exclude_type' => 'default'
					]
				]
			);

			// Categpries agruments
			$category_args = [];

			// Get categories
		  	$categories = get_categories([
		  		'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
		  	]);
		  	
		  	if ( ovabrw_array_exists( $categories ) ) {
			  	foreach ( $categories as $k => $category ) {
				  	$category_args[$category->term_id] = $category->name;
			  	}
		  	} else {
			  	$category_args[''] = esc_html__( 'No categories found!', 'remons' );
		  	}

			$this->add_control(
				'category_not_in_select',
				[
					'label'   		=> esc_html__( 'Category Not In', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $category_args,
					'condition' => [
						'inlucde_exclude_type' => 'multi_select'
					]
				]
			);

			$this->add_control(
				'category_in',
				[
					'label'   		=> esc_html__( 'Category In', 'remons' ),
					'type'    		=> \Elementor\Controls_Manager::TEXT,
					'description' 	=> esc_html__( 'Enter the product category IDs. IDs are separated by "|". Ex: 1|2|3.', 'remons' ),
					'condition' => [
						'inlucde_exclude_type' => 'default'
					]
				]
			);

			$this->add_control(
				'category_in_select',
				[
					'label'   		=> esc_html__( 'Category In', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $category_args,
					'condition' => [
						'inlucde_exclude_type' => 'multi_select'
					]
				]
			);
		
		$this->end_controls_section();

		// Section Search Result
		$this->start_controls_section(
			'section_search_result',
			[
				'label' => esc_html__( 'Search Result', 'remons' ),
			]
		);

			$this->add_control(
				'show_results_found',
				[
					'label' 	=> esc_html__( 'Show Results Found', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'remons' ),
					'label_off' => esc_html__( 'Hide', 'remons' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'show_sort_by',
				[
					'label' 		=> esc_html__('Show Sort By', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'remons' ),
					'label_off' 	=> esc_html__( 'Hide', 'remons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			// Default card template
			$default_card = [ '' => esc_html__( 'Default', 'remons' ) ];

			// Get card templates
			$card_templates = ovabrw_get_card_templates();
			if ( !ovabrw_array_exists( $card_templates ) ) $card_templates = [];

			$this->add_control(
				'card',
				[
					'label' 	=> esc_html__( 'Choose Card', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'card1',
					'options' 	=> array_merge( $default_card, $card_templates ),
				]
			);

			$this->add_control(
				'posts_per_page',
				[
					'label' 	=> esc_html__( 'Per Page', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'min' 		=> 1,
					'max' 		=> 50,
					'step' 		=> 1,
					'default' 	=> 12,
				]
			);

			$this->add_control(
				'result_column',
				[
					'label'   => esc_html__( 'Column', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'two-column',
					'options' => [
						'one-column' 	=> esc_html__('1 Column', 'remons'),
						'two-column' 	=> esc_html__('2 Columns', 'remons'),
						'three-column' 	=> esc_html__('3 Columns', 'remons'),
					],
				]
			);

			$orderby = apply_filters( 'ovabrw_search_map_orderby', array(
				'title' 		=> esc_html__( 'Title', 'remons' ),
				'ID' 			=> esc_html__( 'ID', 'remons' ),
				'date' 			=> esc_html__( 'Date', 'remons' ),
				'modified' 		=> esc_html__( 'Modified', 'remons' ),
				'rand' 			=> esc_html__( 'Random', 'remons' ),
				'menu_order' 	=> esc_html__( 'Menu Order', 'remons' )
			));

			if ( 'yes' === get_option( 'woocommerce_enable_reviews' ) ) {
				$orderby['rating'] = esc_html__( 'Average rating', 'remons' );
			}

			$this->add_control(
				'orderby',
				[
					'label'   => esc_html__( 'Order By', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'date',
					'options' => $orderby,
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'remons' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'ASC' 	=> esc_html__('Ascending', 'remons'),
						'DESC' 	=> esc_html__('Descending', 'remons'),
					],
				]
			);


		$this->end_controls_section();

		/* STYLE TAB */
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'heading_typography',
					'selector' 	=> '.ovabrw-product-search-ajax .ova-product-search.ovabrw_wd_search .product-search-form .search-heading'
				]
			);

			$this->add_control(
				'heading_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-search-ajax .ova-product-search.ovabrw_wd_search .product-search-form .search-heading' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'heading_background',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ovabrw-product-search-ajax .ova-product-search.ovabrw_wd_search .product-search-form .search-heading' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'heading_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-search-ajax .ova-product-search.ovabrw_wd_search .product-search-form .search-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'heading_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ovabrw-product-search-ajax .ova-product-search.ovabrw_wd_search .product-search-form .search-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_search_style',
			[
				'label' => esc_html__( 'Content', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'content_max_width',
				[
					'label' 		=> esc_html__( 'Max Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 300,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
						'%' => [
							'min' => 30,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_grap',
				[
					'label' 		=> esc_html__( 'Grap', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'content_background',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'content_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content',
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'content_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			[
				'label' => esc_html__( 'Fields', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'fields_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text], {{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select'
				]
			);

			$this->add_control(
				'fileds_color',
				[
					'label' 	=> esc_html__( 'Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text], {{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'fileds_background',
				[
					'label' 	=> esc_html__( 'Background', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text]' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'fields_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'fields_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', 'em', '%', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 35,
							'max' 	=> 120,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text]' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'fileds_label_heading',
				[
					'label' => esc_html__( 'Label', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::HEADING,
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'fields_label_typography',
						'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search .field-label'
					]
				);

				$this->add_control(
					'fileds_label_color',
					[
						'label' 	=> esc_html__( 'Color', 'remons' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search .field-label' => 'color: {{VALUE}}',
						],
					]
				);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'remons' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit',
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
						'{{WRAPPER}} .ova-product-search .product-search-form .product-search-submit .ovabrw_btn_submit i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-product-search .product-search-form .product-search-submit .ovabrw_btn_submit svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_margin',
				[
					'label' 		=> esc_html__( 'Marin', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' 		=> [
						'px' => [
							'min' 	=> 160,
							'max' 	=> 600,
							'step' 	=> 5,
						],
						'%' => [
							'min' => 20,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%'
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom'],
					'range' 		=> [
						'px' => [
							'min' 	=> 35,
							'max' 	=> 135,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
				'style_button_tabs',
			);

				$this->start_controls_tab(
					'style_button_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'remons' ),
					]
				);

					$this->add_control(
						'button_color_normal',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit svg' => 'fill: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_normal',
						[
							'label' 	=> esc_html__( 'Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_button_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'remons' ),
					]
				);

					$this->add_control(
						'button_color_hover',
						[
							'label' 	=> esc_html__( 'Color', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit:hover svg' => 'fill: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_hover',
						[
							'label' 	=> esc_html__( 'Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .product-search-submit .ovabrw_btn_submit:hover' => 'background-color: {{VALUE}}',
							],
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

		// Search heading
		$search_heading = remons_get_meta_data( 'search_heading', $settings );

		// Search position
		$search_position = remons_get_meta_data( 'search_position', $settings );

		// Columns
		$columns = 'column1';

		// Show time
		$show_time = ( 'yes' == remons_get_meta_data( 'show_time', $settings ) ) ? true : false;

		// Custom taxonomies
		$list_taxonomy_custom = $settings['list_taxonomy_custom'];

		// Include categories
		$exclude_id = '';
		if ( remons_get_meta_data( 'category_not_in', $settings ) ) {
			$exclude_id = explode( '|', $settings['category_not_in'] );
		}
		if ( remons_get_meta_data( 'category_not_in_select', $settings ) ) {
			$exclude_id = $settings['category_not_in_select'];
		}

		// Exclude categories
		$include_id = '';
		if ( remons_get_meta_data( 'category_in', $settings ) ) {
			$include_id = explode( '|', $settings['category_in'] );
		}
		if ( remons_get_meta_data( 'category_in_select', $settings ) ) {
			$include_id = $settings['category_in_select'];
		}

		// Search icon
		$search_icon = remons_get_meta_data( 'search_icon', $settings );

		// Show package
		$show_package = remons_get_meta_data( 'show_package', $settings );

		// Package label
		$package_label = remons_get_meta_data( 'package_label', $settings );

		// Package placeholder
		$package_placeholder = remons_get_meta_data( 'package_placeholder', $settings );

		// Package items
		$package_items = remons_get_meta_data( 'package_items', $settings );

		// Product name
		$field_name = remons_get_meta_data( 'field_name', $settings );

		// Category
		$field_category = remons_get_meta_data( 'field_category', $settings );

		// Location
		$field_location = remons_get_meta_data( 'field_location', $settings );

		// Pick-up location
		$field_pickup_location = remons_get_meta_data( 'field_pickup_location', $settings );

		// Drop-off location
		$field_dropoff_location = remons_get_meta_data( 'field_dropoff_location', $settings );

		// Pick-up date
		$field_pickup_date = remons_get_meta_data( 'field_pickup_date', $settings );

		// Drop-off date
		$field_dropoff_date = remons_get_meta_data( 'field_dropoff_date', $settings );

		// Attribute
		$field_attribute = remons_get_meta_data( 'field_attribute', $settings );

		// Product tags
		$field_tags = remons_get_meta_data( 'field_tags', $settings );

		// Button
		$field_button = remons_get_meta_data( 'field_button', $settings );

		// Quantity
		$field_quantity = remons_get_meta_data( 'field_quantity', $settings );

		// Placeholder product name
		$placeholder_name = remons_get_meta_data( 'placeholder_name', $settings, $field_name );

		// Placeholder category
		$placeholder_category = remons_get_meta_data( 'placeholder_category', $settings, $field_category );

		// Placeholder location
		$placeholder_location = remons_get_meta_data( 'placeholder_location', $settings, $field_location );

		// Placeholder attribute
		$placeholder_attribute = remons_get_meta_data( 'placeholder_attribute', $settings, $field_attribute );

		// Placeholder product tags
		$placeholder_tags = remons_get_meta_data( 'placeholder_tags', $settings, $field_tags );

		// Date format
		$date_format = OVABRW()->options->get_date_format();

		// Time format
		$time_format = OVABRW()->options->get_time_format();

		// Product name
		$product_name = sanitize_text_field( remons_get_meta_data( 'product_name', $_GET ) );

		// Default category
		$default_cat = sanitize_text_field( remons_get_meta_data( 'cat', $_GET ) );
		if ( !$default_cat ) {
			$default_cat = remons_get_meta_data( 'default_cat', $settings );
		}

		// Pick-up location
		$pickup_location = sanitize_text_field( remons_get_meta_data( 'pickup_location', $_GET ) );
		if ( !$pickup_location ) {
			$pickup_location = remons_get_meta_data( 'default_pickup_loc', $settings );
		}

		// Drop-off location
		$dropoff_location = sanitize_text_field( remons_get_meta_data( 'dropoff_location', $_GET ) );
		if ( !$dropoff_location ) {
			$dropoff_location = remons_get_meta_data( 'default_dropoff_loc', $settings );
		}

		// Pick-up date
		$pickup_date = sanitize_text_field( remons_get_meta_data( 'pickup_date', $_GET ) );

		// Drop-off date
		$dropoff_date = sanitize_text_field( remons_get_meta_data( 'dropoff_date', $_GET ) );

		// Product tags
		$product_tags = sanitize_text_field( remons_get_meta_data( 'product_tag', $_GET ) );

		// Package
		$package = sanitize_text_field( remons_get_meta_data( 'package', $_GET ) );

		// Latitude
		$map_lat = sanitize_text_field( remons_get_meta_data( 'map_lat', $_GET ) );

		// Longitude
		$map_lng = sanitize_text_field( remons_get_meta_data( 'map_lng', $_GET ) );

		// Map address
		$map_address = sanitize_text_field( remons_get_meta_data( 'map_address', $_GET ) );

		// Map name
		$map_name = sanitize_text_field( remons_get_meta_data( 'map_name', $_GET ) );

		// Default latitude
		$lat_default = ovabrw_get_setting( 'latitude_map_default', '39.177972' );

		// Default longitude
		$lng_default = ovabrw_get_setting( 'longitude_map_default', '-100.36375' );

		// Order
		$order = remons_get_meta_data( 'order', $settings );

		// Orderby
		$orderby = remons_get_meta_data( 'orderby', $settings );

		// Posts per page
		$posts_per_page = remons_get_meta_data( 'posts_per_page', $settings );

		// Get products
		$products = OVABRW()->options->get_product_from_search([
			'posts_per_page' 	=> $posts_per_page,
			'order' 			=> $order,
			'orderby' 			=> $orderby
		]);

		// Card template
		$card = remons_get_meta_data( 'card', $settings );

		// Result columns
		$result_column = remons_get_meta_data( 'result_column', $settings );

		if ( $card === 'card5' || $card === 'card6' ) $column = 'one-column';

		// Show results found, sort by
		$show_results_found = $settings['show_results_found'];
		$show_sort_by 		= $settings['show_sort_by'];

		?>
			<div class="ovabrw-product-search-ajax search-position-<?php echo esc_attr( $search_position ); ?>">
				<div class="ova-product-search ovabrw_wd_search">
					<form
						class="product-search-form"
						method="POST"
						action=""
						autocomplete="off"
						autocapitalize="none">
						<div class="product-search-content wrap_content <?php echo esc_attr( $columns ); ?>">
							<h2 class="search-heading">
								<?php echo esc_html( $search_heading ); ?>
							</h2>
							<?php for ( $i = 1; $i <= 10; $i++ ):
								$key = remons_get_meta_data( 'field_'.$i, $settings );

								switch ( $key ) {
									case 'name': ?>
										<div class="label_search ova-product-name">
											<label class="field-label">
												<?php echo esc_html( $field_name ); ?>
											</label>
											<input
												type="text"
												name="product_name"
												value="<?php echo esc_attr( $product_name ); ?>"
												placeholder="<?php echo esc_attr( $placeholder_name ); ?>"
												autocomplete="off"
												autocapitalize="none"
											/>
										</div>
										<?php break;
									case 'category': ?>
										<div class="label_search ova-category">
											<label class="field-label">
												<?php echo esc_html( $field_category ); ?>
											</label>
											<?php echo OVABRW()->options->get_html_dropdown_categories( $default_cat, '', $exclude_id, $placeholder_category, $include_id ); ?>
										</div>
										<?php break;
									case 'location': ?>
										<div class="label_search wrap_search_location">
											<label class="field-label">
												<?php echo esc_html( $field_location ); ?>
											</label>
											<input
												type="hidden"
												id="map_lat"
												name="map_lat"
												value="<?php echo esc_attr( $map_lat ); ?>"
												autocapitalize="none"
											/>
											<input
												type="hidden"
												id="map_lng"
												name="map_lng"
												value="<?php echo esc_attr( $map_lng ); ?>"
												autocapitalize="none"
											/>
											<div class="input-with-icon" style="position: relative;">
										  		<input
										  			type="text"
										  			id="pac-input"
										  			class="controls"
										  			name="map_address"
										  			value="<?php echo esc_attr( $map_address ); ?>"
										  			placeholder="<?php echo esc_attr( $placeholder_location ); ?>"
										  			autocomplete="off"
										  			autocapitalize="none"
										  		/>
												<i class="locate_me icon_circle-slelected" id="locate_me"></i>
											</div>
											<input
												type="hidden"
												id="map_name"
												name="map_name"
												value="<?php echo esc_attr( $map_name ); ?>"
												autocapitalize="none"
											/>
										</div>
										<?php break;
									case 'pickup_location': ?>
										<div class="label_search ova-pickup-location">
											<label class="field-label">
												<?php echo esc_html( $field_pickup_location ); ?>
											</label>
											<?php echo OVABRW()->options->get_html_location( 'pickup', 'pickup_location', '', $pickup_location ); ?>
										</div>
										<?php break;
									case 'dropoff_location': ?>
										<div class="label_search ova-dropoff-location">
											<label class="field-label">
												<?php echo esc_html( $field_dropoff_location ); ?>
											</label>
											<?php echo OVABRW()->options->get_html_location( 'dropoff', 'dropoff_location', '', $dropoff_location ); ?>
										</div>
										<?php break;
									case 'pickup_date': ?>
										<div class="label_search ova-pickup-date">
											<label class="field-label">
												<?php echo esc_html( $field_pickup_date ); ?>
											</label>
											<div class="input-with-icon" style="position: relative;">
												<?php ovabrw_text_input([
													'type' 			=> 'text',
													'id' 			=> ovabrw_unique_id( 'ovabrw_pickup_date' ),
													'class' 		=> 'ovabrw_start_date',
													'name' 			=> 'pickup_date',
													'value' 		=> $pickup_date,
													'data_type' 	=> $show_time ? 'datetimepicker-start' : 'datepicker-start',
													'attrs' 		=> [
														'data-date' => strtotime( $pickup_date ) ? date( $date_format, strtotime( $pickup_date ) ) : '',
														'data-time' => strtotime( $pickup_date ) ? date( $time_format, strtotime( $pickup_date ) ) : ''
													]
												]); ?>
												<i class="ova-calendar ovaicon-calendar"></i>
											</div>
										</div>
										<?php break;
									case 'dropoff_date': ?>
										<div class="label_search ova-dropoff-date">
											<label class="field-label">
												<?php echo esc_html( $field_dropoff_date ); ?>
											</label>
											<div class="input-with-icon" style="position: relative;">
												<?php ovabrw_text_input([
													'type' 			=> 'text',
													'id' 			=> ovabrw_unique_id( 'ovabrw_dropoff_date' ),
													'class' 		=> 'ovabrw_end_date',
													'name' 			=> 'dropoff_date',
													'value' 		=> $dropoff_date,
													'data_type' 	=> $show_time ? 'datetimepicker-end' : 'datepicker-end',
													'attrs' 		=> [
														'data-date' => strtotime( $dropoff_date ) ? date( $date_format, strtotime( $dropoff_date ) ) : '',
														'data-time' => strtotime( $dropoff_date ) ? date( $time_format, strtotime( $dropoff_date ) ) : ''
													]
												]); ?>
												<i class="ova-calendar ovaicon-calendar"></i>
											</div>
										</div>
										<?php break;
									case 'attribute':
										$data_html_attr = OVABRW()->options->get_html_dropdown_attributes( $placeholder_attribute );

										if ( $data_html_attr['html_attr'] ): ?>
											<div class="label_search ova-attribute ovabrw_search">
												<label class="field-label">
													<?php echo esc_html( $field_attribute ); ?>
												</label>
												<?php echo $data_html_attr['html_attr']; ?>
											</div>
										<?php endif;

										if ( $data_html_attr['html_attr_value'] ) {
											echo $data_html_attr['html_attr_value'];
										}

										break;
									case 'quantity':
										$default_qty = (int)remons_get_meta_data( 'quantity', $_GET, 1 );
									?>
										<div class="label_search ova-quantity">
											<label class="field-label">
												<?php echo esc_html( $field_quantity ); ?>
											</label>
											<div class="quantity-button">
												<input
													type="text"
													id="ovabrw_quantity"
													class="ovabrw_quantity"
													name="ovabrw_quantity"
													value="<?php echo esc_attr( $default_qty ); ?>"
													min="1"
												/>
												<div class="quantity-icon minus">
													<i class="ovaicon ovaicon-minus"></i>
												</div>
												<div class="quantity-icon plus">
													<i class="ovaicon ovaicon-plus"></i>
												</div>
											</div>
										</div>
										<?php break;
									case 'tags': ?>
										<div class="label_search ova-tags">
											<label class="field-label">
												<?php echo esc_html( $field_tags ); ?>
											</label>
											<input
												type="text"
												name="product_tag"
												value="<?php echo esc_attr( $product_tags ); ?>"
												placeholder="<?php echo esc_attr( $placeholder_tags ); ?>"
												autocomplete="off" 
												autocapitalize="none"
											/>
										</div>
										<?php break;
									case 'package': ?>
										<?php if ( 'yes' === $show_package && remons_array_exists( $package_items ) ) : ?>
						                    <div class="label_search package">
												<label class="field-label">
													<?php echo esc_html( $package_label ); ?>
												</label>
											  	<select name="package" id="ovabrw_package">
							                		<option value>
							                			<?php echo esc_html( $package_placeholder ); ?>
							                		</option>
							                		<?php foreach( $package_items as $package_item) {
							                			if ( 'day' === $package_item['package_type'] ) {
							                		       	$value = $package_item['package_day_value']*24*60*60;
							                		    } elseif ( 'hour' == $package_item['package_type'] ) {
							                                $value = $package_item['package_hour_value']*60*60;  
							                            } elseif ( 'fixed' === $package_item['package_type'] ) {
							                                $value = $package_item['package_start_time'].'|'.$package_item['package_end_time'];
							                            }
							                		?>
								                		<option value="<?php echo esc_attr( $value ) ; ?>"<?php ovabrw_selected( $package, $value ); ?>>
								                			<?php echo esc_html( $package_item['package_name'] ); ?>
								                		</option>
							                	    <?php }?>
						                	    </select>
											</div>
								        <?php endif;
								        break;
									default:
										break;
								}
							endfor; // END for

							// Arguments taxonomies
							$args_taxonomy = [];

							// Get taxonomies
							$taxonomies = ovabrw_get_option( 'custom_taxonomy', [] );

							if ( remons_array_exists( $list_taxonomy_custom ) ):
								foreach ( $list_taxonomy_custom as $obj_taxonomy ):
									$taxonomy_slug 	= $obj_taxonomy['taxonomy_custom'];
									$selected 		= remons_get_meta_data( $taxonomy_slug.'_name', $_GET );

									if ( isset( $taxonomies[$taxonomy_slug] ) && $taxonomies[$taxonomy_slug] ):
										$taxonomy_name = isset( $taxonomies[$taxonomy_slug]['name'] ) ? $taxonomies[$taxonomy_slug]['name'] : '';
										$html_taxonomy = OVABRW()->options->get_html_dropdown_taxonomies_search( $taxonomy_slug, $taxonomy_name, $selected );
										if ( !empty( $taxonomy_name ) && $html_taxonomy ):
											$args_taxonomy[$taxonomy_slug] = $taxonomy_name;
										?>
											<div class="label_search wrap_search_taxonomies <?php echo esc_attr( $taxonomy_slug ); ?>">
												<label class="field-label">
													<?php echo esc_html( $taxonomy_name ); ?>
												</label>
												<?php echo $html_taxonomy; ?>
											</div>
										<?php
										endif;
									endif;
								endforeach; // END loop
							?>
								<div class="show_taxonomy" data-show_taxonomy=""></div>
								<input
									type="hidden"
									id="data_taxonomy_custom"
									name="data_taxonomy_custom"
									value="<?php echo esc_attr( json_encode( $args_taxonomy ) ); ?>"
								/>
							<?php endif; // END if ?>

							<div class="product-search-submit">
			                    <button class="ovabrw_btn_submit" type="submit">
			                    	<?php echo esc_html( $field_button ); ?>
			                    	<?php if ( !empty( $search_icon['value'] ) ) {
			                    	 	\Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); 
			                    	} ?>
			                    </button>
			                </div>

				            <?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
			                	<input type="hidden" name="lang" value="'.ICL_LANGUAGE_CODE.'" />
			                <?php endif; ?>
						</div>      
					</form>
				</div>

				<div class="wrap_search_result">
					<?php if ( 'yes' === $show_results_found || 'yes' === $show_sort_by ): ?>
						<div class="wrap_search_filter">
							<?php if ( 'yes' === $show_results_found ): ?>
								<div class="results_found">
									<?php if ( $products->found_posts == 1 ): ?>
									<span>
										<?php echo sprintf( esc_html__( '%s Result Found', 'remons' ), esc_html( $products->found_posts ) ); ?>
									</span>
									<?php else: ?>
									<span>
										<?php echo sprintf( esc_html__( '%s Results Found', 'remons' ), esc_html( $products->found_posts ) ); ?>
									</span>
									<?php endif; ?>

									<?php if ( 1 == ceil( $products->found_posts / $products->query_vars['posts_per_page']) && $products->have_posts() ): ?>
										<span>
											<?php echo sprintf( esc_html__( '(Showing 1-%s)', 'remons' ), esc_html( $products->found_posts ) ); ?>
										</span>
									<?php elseif ( !$products->have_posts() ): ?>
										<span></span>
									<?php else: ?>
										<span>
											<?php echo sprintf( esc_html__( '(Showing 1-%s)', 'remons' ), esc_html( $products->query_vars['posts_per_page'] ) ); ?>
										</span>
									<?php endif; ?>
								</div>
							<?php endif;?>

							<?php if ( 'yes' === $show_sort_by ): ?>
								<div id="search_sort">
									<?php
										$sort = apply_filters( 'search_sort_default', $orderby );

										if ( 'date' === $orderby && 'DESC' === $order ) {
											$sort = 'date-desc';
										} elseif ( 'date' === $orderby && 'ASC' === $order ) {
											$sort = 'date-asc';
										} elseif ( 'title' === $orderby && 'DESC' === $order ) {
											$sort = 'a-z';
										} elseif ( 'title' === $orderby && 'ASC' === $order ) {
											$sort = 'z-a';
										} elseif ( 'rating' === $orderby ) {
											$sort = 'rating';
										}
									?>
									<select name="sort">
										<option value=""><?php esc_html_e( 'Sort By', 'remons' ); ?></option>
										<option value="date-desc"<?php selected( $sort, 'date-desc' ); ?>>
											<?php esc_html_e( 'Newest First', 'remons' ); ?>
										</option>
										<option value="date-asc"<?php selected( $sort, 'date-asc' ); ?>>
											<?php esc_html_e( 'Oldest First', 'remons' ); ?>
										</option>
										<?php if ( 'yes' === get_option( 'woocommerce_enable_reviews' ) ): ?>
											<option value="rating"<?php selected( $sort, 'rating' ); ?>>
												<?php esc_html_e( 'Average rating', 'remons' ); ?>
											</option>
										<?php endif; ?>
										<option value="a-z" <?php selected( $sort, 'a-z' ); ?>>
											<?php esc_html_e( 'A-Z', 'remons' ); ?>
										</option>
										<option value="z-a" <?php selected( $sort, 'z-a' ); ?> >
											<?php esc_html_e( 'Z-A', 'remons' ); ?>
										</option>
									</select>
								</div>
							<?php endif;?>
						</div>
					<?php endif; ?>

					<!-- Radius -->
					<div class="wrap_search_radius" 
						data-map_range_radius="<?php echo apply_filters( OVABRW_PREFIX.'map_range_radius', 50 ); ?>" 
						data-map_range_radius_min="<?php echo apply_filters( OVABRW_PREFIX.'map_range_radius_min', 0 ); ?>" 
						data-map_range_radius_max="<?php echo apply_filters( OVABRW_PREFIX.'map_range_radius_max', 100 ); ?>">
						<span><?php esc_html_e( 'Radius:', 'remons' ); ?></span>
						<span class="result_radius">
							<?php echo apply_filters( OVABRW_PREFIX.'map_range_radius', 50 ); ?>
							<?php esc_html_e( 'km', 'remons' ); ?>
						<div id="wrap_pointer"></div>
						<input
							type="hidden"
							value=""
							name="radius"
						/>
					</div>
					<!-- End Radius -->

					<!-- Load more -->
					<div class="wrap_load_more" style="display: none;">
						<svg class="loader" width="50" height="50">
							<circle cx="25" cy="25" r="10" stroke="#FF3726"/>
							<circle cx="25" cy="25" r="20" stroke="#FF3726"/>
						</svg>
					</div>

					<!-- Search result -->
					<div
						id="search_result"
						class="search_result"
						data-card="<?php echo esc_attr( $card ); ?>"
						data-column="<?php echo esc_attr( $result_column ); ?>"
						data-order="<?php echo esc_attr( $order ); ?>"
						data-orderby="<?php echo esc_attr( $orderby ); ?>"
						data-per_page="<?php echo esc_attr( $posts_per_page ); ?>"
						data-lat="<?php echo esc_attr( $lat_default ); ?>"
						data-lng="<?php echo esc_attr( $lng_default ); ?>"
					>
						<?php
							$total = $products->max_num_pages;
							if (  $total > 1 ): ?>
								<div class="ovabrw_pagination_ajax">
								<?php
									echo OVABRW()->options->get_html_pagination_ajax( $products->found_posts, $products->query_vars['posts_per_page'], 1 );
								?>
								</div>
								<?php
							endif;
						?>
					</div>
				</div>
			</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Search_Ajax() );