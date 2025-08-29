<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check is actived BRW & Woo plugins
if ( !remons_is_brw_active() || !remons_is_woo_active() ) return;

/**
 * Class Remons_Elementor_Product_Search
 */
class Remons_Elementor_Product_Search extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'remons_elementor_product_search';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Product Search', 'remons' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-site-search';
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
		$api_key = ovabrw_get_setting( 'google_key_map' );
		if ( $api_key ) {
			wp_enqueue_script( 'ovabrw-google-maps', 'https://maps.googleapis.com/maps/api/js?key='.esc_attr( $api_key ).'&libraries=places', false, true );
		} else {
			wp_enqueue_script( 'ovabrw-google-maps','https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places', [ 'jquery' ], false, true);
		}

		return [ 'remons-elementor-product-search' ];
	}

	/**
	 * Get style depends
	 */
	public function get_style_depends() {
		wp_enqueue_style( 'remons-elementor-product-search', REMONS_URI.'/assets/scss/elementor/products/product-search.css' );
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
				'template',
				[
					'label'   	=> esc_html__( 'Template', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'template1',
					'options' 	=> [
						'template1' => esc_html__( 'Template 1', 'remons' ),
						'template2' => esc_html__( 'Template 2', 'remons' ),
					],
				]
			);

			$this->add_control(
				'columns',
				[
					'label'   	=> esc_html__( 'Column', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'column3',
					'options' 	=> [
						'column1' => esc_html__( 'Column 1', 'remons' ),
						'column2' => esc_html__( 'Column 2', 'remons' ),
						'column3' => esc_html__( 'Column 3', 'remons' ),
						'column4' => esc_html__( 'Column 4', 'remons' ),
						'column5' => esc_html__( 'Column 5', 'remons' ),
					],
				]
			);

			$this->add_control(
				'search_heading',
				[
					'label' => esc_html__( 'Search Heading', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'search_desc',
				[
					'label' => esc_html__( 'Description', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::TEXTAREA,
					'rows'  => 3       
				]
			);

			// Search fields
			$search_fields = [
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
				'tags' 				=> esc_html__( 'Tags', 'remons' )
			];

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
					'default' 	=> 'name',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_2',
				[
					'label'   	=> esc_html__( 'Field 2', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'category',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_3',
				[
					'label'   	=> esc_html__( 'Field 3', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'pickup_location',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_4',
				[
					'label'   	=> esc_html__( 'Field 4', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'dropoff_location',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_5',
				[
					'label'   	=> esc_html__( 'Field 5', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'pickup_date',
					'separator' => 'before',
					'options' 	=> $search_fields,
				]
			);

			$this->add_control(
				'field_6',
				[
					'label'   	=> esc_html__( 'Field 6', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'dropoff_date',
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

			// Taxonomies data
			$data_taxonomy[''] = esc_html__( 'Select Taxonomy', 'remons' );

			// Get taxonomies
			$taxonomies = ovabrw_get_option( 'custom_taxonomy', [] );
			if ( remons_array_exists( $taxonomies ) ) {
				foreach( $taxonomies as $key => $value ) {
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_package',
			[
				'label' 	=> esc_html__( 'Create Package', 'remons' ),
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

		/* Section Search Result */
		$this->start_controls_section(
			'section_search_result',
			[
				'label' => esc_html__( 'Search Result', 'remons' ),
			]
		);

			$this->add_control(
				'search_result',
				[
					'label' 	=> esc_html__( 'Pages', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'default',
					'options' 	=> [
						'default'  	=> esc_html__( 'Default', 'remons' ),
						'new_page' 	=> esc_html__( 'New Page', 'remons' ),
					],
				]
			);

			$this->add_control(
				'search_result_url',
				[
					'label' 		=> esc_html__( 'Link', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'remons' ),
					'dynamic' 		=> [
						'active' => true,
					],
					'default' => [
						'url' 			=> '#',
						'is_external' 	=> false,
						'nofollow' 		=> false,
					],
					'condition' => [
						'search_result' => 'new_page',
					],
				]
			);

			$this->add_control(
				'search_icon',
				[
					'label' => esc_html__( 'Search Icon', 'remons' ),
					'type' 	=> \Elementor\Controls_Manager::ICONS,
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
					'default'  	=> esc_html__( 'Find a Car', 'remons' ),
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

			$args = array(
				'taxonomy' 	=> 'product_cat',
				'orderby' 	=> 'name',
				'order' 	=> 'ASC'
			);
  
		  	$categories 		= get_categories( $args );
		  	$category_args 		= [];
		  	
		  	if ( ! empty( $categories ) && is_array( $categories ) ) {
			  	foreach ( $categories as $k => $category ) {
				  	$category_args[$category->term_id] = $category->name;
			  	}
		  	} else {
			  	$category_args[''] = esc_html__( 'Category not found', 'remons' );
		  	}

			$this->add_control(
				'category_not_in_select',
				[
					'label'   		=> esc_html__( 'Category Not In', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SELECT2,
					'label_block' 	=> true,
					'multiple' 		=> true,
					'options' 		=> $category_args,
					'condition' 	=> [
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
					'condition' 	=> [
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
					'condition' 	=> [
						'inlucde_exclude_type' => 'multi_select'
					]
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
					'range' => [
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
					'range' => [
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'content_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form',
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

			$this->add_control(
				'show_shape_left',
				[
					'label' 	=> esc_html__( 'Show Shape Left', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'remons' ),
					'label_off' => esc_html__( 'Hide', 'remons' ),
					'default' 	=> 'no',
					'separetor' => 'before'
				]
			);

			$this->add_control(
				'show_shape_right',
				[
					'label' 	=> esc_html__( 'Show Shape Right', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'remons' ),
					'label_off' => esc_html__( 'Hide', 'remons' ),
					'default' 	=> 'no',
				]
			);

			$this->add_responsive_control(
				'shape_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 162,
							'step' 	=> 1,
						],
						'%' => [
							'min' => 0,
							'max' => 50,
						],
					],
					'default' => [
						'unit' => 'px'
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form::before, {{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form::after' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'shape_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 202,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px'
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form::before, {{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form::after' => 'height: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text], {{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search select' => 'color: {{VALUE}}!important',
					],
				]
			);

			$this->add_control(
				'fileds_icon_color',
				[
					'label' 	=> esc_html__( 'Icon Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search i' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'fileds_placeholder_color',
				[
					'label' 	=> esc_html__( 'Placeholder Color', 'remons' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-content .label_search input[type=text]::placeholder' => 'color: {{VALUE}}',
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


			$this->add_control(
				'fileds_select_arrow_background',
				[
					'label'   	=> esc_html__( 'Background ( Select Arrow )', 'remons' ),
					'type'    	=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'arrow_black',
					'options' 	=> [
						'arrow_black' => esc_html__( 'Black', 'remons' ),
						'arrow_white' => esc_html__( 'White', 'remons' ),
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
					'range' => [
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
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit',
				]
			);

			$this->add_responsive_control(
				'button_text_align',
				[
					'label' 	=> esc_html__( 'Text Align', 'remons' ),
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'text-align: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' 		=> 'button_border',
					'label' 	=> esc_html__( 'Border', 'remons' ),
					'selector' 	=> '{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit',
				]
			);

			$this->add_responsive_control(
				'button_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_width',
				[
					'label' 		=> esc_html__( 'Width', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 80,
							'max' => 600,
							'step' => 5,
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
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'button_height',
				[
					'label' 		=> esc_html__( 'Height', 'remons' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' 	=> 35,
							'max' 	=> 135,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'height: {{SIZE}}{{UNIT}};',
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
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_normal',
						[
							'label' 	=> esc_html__( 'Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit' => 'background-color: {{VALUE}}',
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
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_background_hover',
						[
							'label' 	=> esc_html__( 'Background', 'remons' ),
							'type' 		=> \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-product-search.ovabrw_wd_search .product-search-form .product-search-submit .ovabrw_btn_submit:hover' => 'background-color: {{VALUE}}',
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

		// Search description
		$search_desc = remons_get_meta_data( 'search_desc', $settings );

		// Template
		$template = remons_get_meta_data( 'template', $settings );

		// Columns
		$columns = remons_get_meta_data( 'columns', $settings );

		// Show time
		$show_time = ( 'yes' === remons_get_meta_data( 'show_time', $settings ) ) ? true : false;

		// For design
		$show_shape_left  = ( 'yes' === remons_get_meta_data( 'show_shape_left', $settings ) ) ? 'has_shape_left' : '';
		$show_shape_right = ( 'yes' === remons_get_meta_data( 'show_shape_right', $settings ) ) ? 'has_shape_right' : '';

		// Show shape
		$show_shape = $show_shape_left.' '.$show_shape_right;

		// Arrow background
		$fileds_select_arrow_background = remons_get_meta_data( 'fileds_select_arrow_background', $settings );

		// Get custom taxonomies
		$list_taxonomy_custom = remons_get_meta_data( 'list_taxonomy_custom', $settings );

		// Exclude category
		$exclude_id = '';
		if ( remons_get_meta_data( 'category_not_in', $settings ) ) {
			$exclude_id = explode( '|', $settings['category_not_in'] );
		}
		if ( remons_get_meta_data( 'category_not_in_select', $settings ) ) {
			$exclude_id = $settings['category_not_in_select'];
		}

		// Include category
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

		// Get package items
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

		// Attributes
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

		// Default value
		$default_cat = remons_get_meta_data( 'default_cat', $settings );

		// Pick-up location
		$pickup_location = remons_get_meta_data( 'default_pickup_loc', $settings );

		// Drop-off location
		$dropoff_location = remons_get_meta_data( 'default_dropoff_loc', $settings );

		// Search result
		$search_result = remons_get_meta_data( 'search_result', $settings );

		// Action
		$action = home_url();
		if ( 'default' != $search_result ) {
			$action = isset( $settings['search_result_url']['url'] ) ? $settings['search_result_url']['url'] : '';
		}

		?>

		<div class="ova-product-search ovabrw_wd_search <?php echo esc_attr( $template ); ?>">
			<form
				class="product-search-form
				<?php echo esc_attr( $columns ); ?>
				<?php echo esc_attr( $show_shape ); ?>"
				method="GET"
				action="<?php echo esc_url( $action ); ?>"
				autocomplete="off"
				autocapitalize="none">
				<?php ovabrw_text_input([
		        	'type' 	=> 'hidden',
		        	'name' 	=> 'ovabrw_search_url',
		        	'value' => $action
		        ]); ?>
				<div class="product-search-content wrap_content <?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $fileds_select_arrow_background ); ?>">
					<?php if ( $search_heading || $search_desc ): ?>
						<div class="heading">
							<?php if ( $search_heading ): ?>
								<h2 class="search-heading">
									<?php echo esc_html( $search_heading ); ?>
								</h2>
							<?php endif;

							if ( $search_desc ): ?>
								<p class="search-desc">
									<?php echo esc_html( $search_desc ); ?>
								</p>
							<?php endif; ?>
						</div>
					<?php endif;

					// Loop search fields
					for ( $i = 1; $i <= 10; $i++ ):
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
										autocomplete="off"
										autocapitalize="none"
										placeholder="<?php echo esc_attr( $placeholder_name ); ?>"
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
										name="map_lat"
										id="map_lat"
										autocapitalize="none"
									/>
									<input
										type="hidden"
										name="map_lng"
										id="map_lng"
										autocapitalize="none"
									/>
									<div class="input-with-icon" style="position: relative;">
								  		<input
								  			type="text"
								  			id="pac-input"
								  			name="map_address"
								  			value=""
								  			class="controls"
								  			placeholder="<?php echo esc_attr( $placeholder_location ); ?>"
								  			autocomplete="off"
								  			autocapitalize="none"
								  		/>
										<i class="locate_me icon_circle-slelected" id="locate_me"></i>
									</div>
									<input
										type="hidden"
										value=""
										name="map_name"
										id="map_name"
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
											'type' 		=> 'text',
											'id' 		=> ovabrw_unique_id( 'ovabrw_pickup_date' ),
											'class' 	=> 'ovabrw_start_date',
											'name' 		=> 'pickup_date',
											'data_type' => $show_time ? 'datetimepicker-start' : 'datepicker-start'
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
											'type' 		=> 'text',
											'id' 		=> ovabrw_unique_id( 'ovabrw_end_date' ),
											'class' 	=> 'ovabrw_start_date',
											'name' 		=> 'dropoff_date',
											'data_type' => $show_time ? 'datetimepicker-end' : 'datepicker-end'
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
							case 'quantity': ?>
								<div class="label_search ova-quantity">
									<label class="field-label">
										<?php echo esc_html( $field_quantity ); ?>
									</label>
									<div class="quantity-button">
										<input
											type="text"
											id="ovabrw_quantity"
											class="ovabrw_quantity"
											name="quantity"
											value="1"
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
										autocomplete="off"
										autocapitalize="none"
										placeholder="<?php echo esc_attr( $placeholder_tags ); ?>"
									/>
								</div> 
								<?php break;
							case 'package':
								if ( 'yes' === $show_package && remons_array_exists( $package_items ) ) : ?>
				                    <div class="label_search package">
										<label class="field-label">
											<?php echo esc_html( $package_label ); ?>
										</label>
									  	<select name="package" id="ovabrw_package">
					                		<option value>
					                			<?php echo esc_html( $package_placeholder ); ?>
					                		</option>
					                		<?php foreach ( $package_items as $package_item ) {
					                			if ( 'day' === $package_item['package_type'] ) {
					                		       	$value = $package_item['package_day_value']*24*60*60;
					                		    } elseif ( 'hour' === $package_item['package_type'] ) {
					                                $value = $package_item['package_hour_value']*60*60;  
					                            } elseif ( 'fixed' === $package_item['package_type'] ) {
					                                $value = $package_item['package_start_time'].'|'.$package_item['package_end_time'];
					                            }
					                		?>
						                		<option value="<?php echo esc_attr( $value ) ; ?>">
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
					endfor; // END search fields

					// Arguments taxonomy
					$args_taxonomy = [];

					// Get taxonomies
					$taxonomies = ovabrw_get_option( 'custom_taxonomy', [] );

					// Loop
					if ( remons_array_exists( $list_taxonomy_custom ) ):
						foreach ( $list_taxonomy_custom as $obj_taxonomy ):
							// Get tax slug
							$taxonomy_slug = remons_get_meta_data( 'taxonomy_custom', $obj_taxonomy );

							// Get defautl tax
							$selected = remons_get_meta_data( $taxonomy_slug.'_name', $_GET );

							if ( isset( $taxonomies[$taxonomy_slug] ) && $taxonomies[$taxonomy_slug] ):
								// Get tax name
								$taxonomy_name = isset( $taxonomies[$taxonomy_slug]['name'] ) ? $taxonomies[$taxonomy_slug]['name'] : '';

								// Get html tax
								$html_taxonomy = OVABRW()->options->get_html_dropdown_taxonomies_search( $taxonomy_slug, $taxonomy_name, $selected );

								if ( $taxonomy_name && $html_taxonomy ):
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
						endforeach;
					?>
						<div class="show_taxonomy" data-show_taxonomy=""></div>
						<input
							type="hidden"
							id="data_taxonomy_custom"
							name="data_taxonomy_custom"
							value="<?php echo esc_attr( json_encode( $args_taxonomy ) ); ?>"
						/>
					<?php endif;

					// Template
					if ( 'template2' !== $template ):
						if ( 'default' != $search_result ): ?>
							<div class="product-search-submit">
			                    <button class="ovabrw_btn_submit" type="submit">
			                    	<?php echo esc_html( $field_button ); ?>
			                    	<?php if ( !empty( $search_icon['value'] ) ) {
			                    	 	\Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); 
			                    	} ?>
			                    </button>
			                </div>
						<?php else: ?>
							<div class="product-search-submit">
			                    <button class="ovabrw_btn_submit" type="submit">
			                    	<?php echo esc_html( $field_button ); ?>
			                    	<?php if ( !empty( $search_icon['value'] ) ) {
			                    	 	\Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); 
			                    	} ?>
			                    </button>
			                </div>
			                <input type="hidden" name="ovabrw_search" value="search_item" />
			            <?php endif; 
			        endif; ?>
				</div>
				<?php if ( 'template2' === $template ): ?>
					<?php if ( 'default' != $search_result ): ?>
						<div class="product-search-submit">
		                    <button class="ovabrw_btn_submit" type="submit">
		                    	<?php echo esc_html( $field_button ); ?>
		                    	<?php if ( !empty( $search_icon['value'] ) ) {
		                    	 	\Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); 
		                    	} ?>
		                    </button>
		                </div>
					<?php else: ?>
						<div class="product-search-submit">
		                    <button class="ovabrw_btn_submit" type="submit">
		                    	<?php echo esc_html( $field_button ); ?>
		                    	<?php if ( !empty( $search_icon['value'] ) ) {
		                    	 	\Elementor\Icons_Manager::render_icon( $search_icon, [ 'aria-hidden' => 'true' ] ); 
		                    	} ?>
		                    </button>
		                </div>
		                <input type="hidden" name="ovabrw_search" value="search_item" />
		            <?php endif;
		        endif; ?>     
			</form>
		</div>
		<?php
	}
}

// Register new widget
$widgets_manager->register( new Remons_Elementor_Product_Search() );
