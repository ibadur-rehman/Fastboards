<?php if ( ! defined( 'ABSPATH' ) ) exit;

require_once (REMONS_URL.'/install-resource/class-tgm-plugin-activation.php');

// Required plugins
add_action( 'tgmpa_register', 'remons_register_required_plugins' );
function remons_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => esc_html__('Elementor','remons'),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('Contact Form 7','remons'),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('Widget importer exporter','remons'),
            'slug'      => 'widget-importer-exporter',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('One click demo import','remons'),
            'slug'      => 'one-click-demo-import',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('Woocommerce','remons'),
            'slug'      => 'woocommerce',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('YITH WooCommerce Wishlist','remons'),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('Mailchimp','remons'),
            'slug'      => 'mailchimp-for-wp',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('Slider Revolution','remons'),
            'slug'      => 'revslider',
            'required'  => true,
            'source'    => get_template_directory() . '/install-resource/plugins/revslider.zip',
            'version'   => '6.7.36'
        ),
        array(
            'name'      => esc_html__('CMB2','remons'),
            'slug'      => 'cmb2',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__('OvaTheme Framework','remons'),
            'slug'      => 'ova-framework',
            'required'  => true,
            'source'    => get_template_directory() . '/install-resource/plugins/ova-framework.zip',
            'version'   => '1.0.2'
        ),
        array(
            'name'      => esc_html__('Ovatheme MegaMenu','remons'),
            'slug'      => 'ova-megamenu',
            'required'  => true,
            'source'    => get_template_directory() . '/install-resource/plugins/ova-megamenu.zip',
            'version'   => '1.0.1',
        ),
        array(
            'name'      => esc_html__('BRW - Booking & Rental','remons'),
            'slug'      => 'ova-brw',
            'required'  => true,
            'source'    => get_template_directory() . '/install-resource/plugins/ova-brw.zip',
            'version'   => '1.9.3',
            'priority'  => 2
        ),
        array(
            'name'      => esc_html__('Multi Currency for WooCommerce','remons'),
            'slug'      => 'woo-multi-currency',
            'required'  => true,
            'priority'  => 3
        ),
    );

    $config = array(
        'id'           => 'remons',                // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    remons_tgmpa( $plugins, $config );

}

// Import demo files
add_filter( 'ocdi/import_files', 'remons_import_files' );
function remons_import_files() {
    return array(
        array(
            'import_file_name'              => esc_html__( 'Car', 'remons' ),
            'import_file_id'                => 'car',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/car/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/car/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/car/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/car/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com'
        ),
        array(
            'import_file_name'              => esc_html__( 'Shipping', 'remons' ),
            'import_file_id'                => 'shipping',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/shipping/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/shipping/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/shipping/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/shipping/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/shipping'
        ),
        array(
            'import_file_name'              => esc_html__( 'Scooter', 'remons' ),
            'import_file_id'                => 'scooter',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/scooter/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/scooter/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/scooter/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/scooter/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/scooter'
        ),
        array(
            'import_file_name'              => esc_html__( 'Villa', 'remons' ),
            'import_file_id'                => 'villa',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/villa/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/villa/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/villa/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/villa/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/villa'
        ),
        array(
            'import_file_name'              => esc_html__( 'Equipment', 'remons' ),
            'import_file_id'                => 'equipment',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/equipment/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/equipment/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/equipment/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/equipment/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/equipment'
        ),
        array(
            'import_file_name'              => esc_html__( 'Taxi', 'remons' ),
            'import_file_id'                => 'taxi',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/taxi/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/taxi/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/taxi/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/taxi/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/taxi'
        ),
        array(
            'import_file_name'              => esc_html__( 'Medical', 'remons' ),
            'import_file_id'                => 'medical',
            'local_import_file'             => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/medical/demo-content.xml',
            'local_import_widget_file'      => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/medical/widgets.wie',
            'local_import_customizer_file'  => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/medical/customize.dat',
            'import_preview_image_url'      => trailingslashit( get_template_directory_uri() ) . 'install-resource/demo-import/medical/preview.png',
            'preview_url'                   => 'https://remons.ovathemewp.com/medical'
        )
    );
}

// Before import demo data
add_action( 'ocdi/before_content_import', 'remons_before_content_import' );
function remons_before_content_import( $selected_import ) {
    // Get nav menus
    $nav_menus = wp_get_nav_menus();

    // Remove nav menus
    if ( remons_array_exists( $nav_menus ) ) {
        foreach ( $nav_menus as $menu ) {
            if ( $menu && is_object( $menu ) && is_nav_menu( $menu->term_id ) ) {
                wp_delete_nav_menu( $menu->term_id );
            }
        }
    } // End remove nav menus

    // Custom Taxonomies
    $custom_taxonomies = remons_recursive_replace( '\\', '', get_option( 'ovabrw_custom_taxonomy', array() ) );
    if ( !remons_array_exists( $custom_taxonomies ) ) $custom_taxonomies = [];

    if ( isset( $selected_import['import_file_name'] ) && $selected_import['import_file_name'] ) {
        $import_file = isset( $selected_import['local_import_file'] ) ? $selected_import['local_import_file'] : '';

        if ( $import_file ) {
            $xml = simplexml_load_file($import_file);

            if ( isset( $xml->channel->ovabrw_custom_taxonomies ) ) {
                foreach ( $xml->channel->ovabrw_custom_taxonomies as $k => $obj_taxonomy ) {
                    if ( is_object( $obj_taxonomy ) ) {
                        $arr_taxonomy = get_object_vars( $obj_taxonomy );

                        if ( ! empty( $arr_taxonomy ) && is_array( $arr_taxonomy ) ) {
                            if ( isset( $arr_taxonomy['slug'] ) && $arr_taxonomy['slug'] && ! array_key_exists( $arr_taxonomy['slug'], $custom_taxonomies ) ) {
                                $custom_taxonomies[$arr_taxonomy['slug']] = [
                                    'name'              => isset( $arr_taxonomy['name'] ) ? $arr_taxonomy['name'] : '',
                                    'singular_name'     => isset( $arr_taxonomy['singular_name'] ) ? $arr_taxonomy['singular_name'] : '',
                                    'label_frontend'    => isset( $arr_taxonomy['label_frontend'] ) ? $arr_taxonomy['label_frontend'] : '',
                                    'enabled'           => isset( $arr_taxonomy['enabled'] ) ? $arr_taxonomy['enabled'] : '',
                                    'show_listing'      => isset( $arr_taxonomy['show_listing'] ) ? $arr_taxonomy['show_listing'] : ''
                                ];
                            }
                        }
                    }
                }
            }
        }

        if ( ! empty( $custom_taxonomies ) && is_array( $custom_taxonomies ) ) {
            update_option('ovabrw_custom_taxonomy', $custom_taxonomies);

            if ( function_exists( 'ovabrw_create_type_taxonomies' ) ) {
                $taxonomies = ovabrw_create_type_taxonomies();
            }
        }
    }

    // Custom Checkout Fields
    $checkout_fields = remons_recursive_replace( '\\', '', get_option( 'ovabrw_booking_form', [] ) );
    if ( !remons_array_exists( $checkout_fields ) ) $checkout_fields = [];

    if ( isset( $selected_import['import_file_name'] ) && $selected_import['import_file_name']  ) {
        $import_file = isset( $selected_import['local_import_file'] ) ? $selected_import['local_import_file'] : '';

        if ( $import_file ) {
            $xml = simplexml_load_file($import_file);

            if ( isset( $xml->channel->ovabrw_custom_checkout_fields ) ) {
                foreach ( $xml->channel->ovabrw_custom_checkout_fields as $k => $obj_checkout_field ) {
                    if ( is_object( $obj_checkout_field ) ) {
                        $arr_ckf = get_object_vars( $obj_checkout_field );
                        
                        if ( ! empty( $arr_ckf ) && is_array( $arr_ckf ) ) {
                            if ( isset( $arr_ckf['slug'] ) && $arr_ckf['slug'] && ! array_key_exists( $arr_ckf['slug'], $checkout_fields ) ) {
                                $checkout_fields[$arr_ckf['slug']] = [
                                    'type'          => isset( $arr_ckf['type'] ) ? $arr_ckf['type'] : '',
                                    'label'         => isset( $arr_ckf['label'] ) ? $arr_ckf['label'] : '',
                                    'default'       => isset( $arr_ckf['default'] ) ? $arr_ckf['default'] : '',
                                    'placeholder'   => isset( $arr_ckf['placeholder'] ) ? $arr_ckf['placeholder'] : '',
                                    'class'         => isset( $arr_ckf['class'] ) ? $arr_ckf['class'] : '',
                                    'required'      => isset( $arr_ckf['required'] ) ? $arr_ckf['required'] : '',
                                    'enabled'       => isset( $arr_ckf['enabled'] ) ? $arr_ckf['enabled'] : '',
                                ];

                                if ( isset( $arr_ckf['select_keys'] ) && $arr_ckf['select_keys'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_options_key'] = explode( '|', $arr_ckf['select_keys'] );
                                }
                                if ( isset( $arr_ckf['select_texts'] ) && $arr_ckf['select_texts'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_options_text'] = explode( '|', $arr_ckf['select_texts'] );
                                }
                                if ( isset( $arr_ckf['select_prices'] ) && $arr_ckf['select_prices'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_options_price'] = explode( '|', $arr_ckf['select_prices'] );
                                }
                                if ( isset( $arr_ckf['select_qtys'] ) && $arr_ckf['select_qtys'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_options_qty'] = explode( '|', $arr_ckf['select_qtys'] );
                                }
                                if ( isset( $arr_ckf['radio_values'] ) && $arr_ckf['radio_values'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_values'] = explode( '|', $arr_ckf['radio_values'] );
                                }
                                if ( isset( $arr_ckf['radio_prices'] ) && $arr_ckf['radio_prices'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_prices'] = explode( '|', $arr_ckf['radio_prices'] );
                                }
                                if ( isset( $arr_ckf['radio_qtys'] ) && $arr_ckf['radio_qtys'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_qtys'] = explode( '|', $arr_ckf['radio_qtys'] );
                                }
                                if ( isset( $arr_ckf['checkbox_keys'] ) && $arr_ckf['checkbox_keys'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_checkbox_key'] = explode( '|', $arr_ckf['checkbox_keys'] );
                                }
                                if ( isset( $arr_ckf['checkbox_texts'] ) && $arr_ckf['checkbox_texts'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_checkbox_text'] = explode( '|', $arr_ckf['checkbox_texts'] );
                                }
                                if ( isset( $arr_ckf['checkbox_prices'] ) && $arr_ckf['checkbox_prices'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_checkbox_price'] = explode( '|', $arr_ckf['checkbox_prices'] );
                                }
                                if ( isset( $arr_ckf['checkbox_qtys'] ) && $arr_ckf['checkbox_qtys'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['ova_checkbox_qty'] = explode( '|', $arr_ckf['checkbox_qtys'] );
                                }
                                if ( isset( $arr_ckf['max_file_size'] ) && $arr_ckf['max_file_size'] ) {
                                    $checkout_fields[$arr_ckf['slug']]['max_file_size'] = $arr_ckf['max_file_size'];
                                }
                            }
                        }
                    }
                }
            }
        }

        if ( ! empty( $checkout_fields ) && is_array( $checkout_fields ) ) {
            update_option('ovabrw_booking_form', $checkout_fields);
        }
    }

    // Specifications
    $specifications = remons_recursive_replace( '\\', '', get_option( 'ovabrw_specifications', [] ) );
    if ( !remons_array_exists( $specifications ) ) $specifications = [];

    if ( isset( $selected_import['import_file_name'] ) && $selected_import['import_file_name']  ) {
        $import_file = isset( $selected_import['local_import_file'] ) ? $selected_import['local_import_file'] : '';

        if ( $import_file ) {
            $xml = simplexml_load_file($import_file);

            if ( isset( $xml->channel->ovabrw_specifications ) ) {
                foreach ( $xml->channel->ovabrw_specifications as $k => $obj_specification ) {
                    if ( is_object( $obj_specification ) ) {
                        $arr_spefication = get_object_vars( $obj_specification );
                        
                        if ( ! empty( $arr_spefication ) && is_array( $arr_spefication ) ) {
                            if ( isset( $arr_spefication['slug'] ) && $arr_spefication['slug'] && ! array_key_exists( $arr_spefication['slug'], $specifications ) ) {
                                $specifications[$arr_spefication['slug']] = [
                                    'type'          => isset( $arr_spefication['type'] ) ? $arr_spefication['type'] : '',
                                    'label'         => isset( $arr_spefication['label'] ) ? $arr_spefication['label'] : '',
                                    'default'       => isset( $arr_spefication['default'] ) ? $arr_spefication['default'] : '',
                                    'icon-font'     => isset( $arr_spefication['icon-font'] ) ? $arr_spefication['icon-font'] : '',
                                    'class'         => isset( $arr_spefication['class'] ) ? $arr_spefication['class'] : '',
                                    'multiple'      => isset( $arr_spefication['multiple'] ) ? $arr_spefication['multiple'] : '',
                                    'enable'        => isset( $arr_spefication['enable'] ) ? $arr_spefication['enable'] : '',
                                    'show_in_card'  => isset( $arr_spefication['show_in_card'] ) ? $arr_spefication['show_in_card'] : '',
                                ];

                                if ( isset( $arr_spefication['options'] ) && $arr_spefication['options'] ) {
                                    $specifications[$arr_spefication['slug']]['options'] = explode( '|', $arr_spefication['options'] );
                                }
                            }
                        }
                    }
                }
            }
        }

        if ( ! empty( $specifications ) && is_array( $specifications ) ) {
            update_option('ovabrw_specifications', $specifications);
        }
    }
}

// After import setup Home & Blog page
add_action( 'ocdi/after_import', 'remons_after_import_setup' );
function remons_after_import_setup( $selected_import ) {
    // After import setup
    $demo_id = isset( $selected_import['import_file_id'] ) ? $selected_import['import_file_id'] : '';

    switch ( $demo_id ) {
        case 'car':
            // Setup Demo Car
            remons_after_import_setup_demo_car();
            break;
        case 'shipping':
            // Setup Demo Shipping
            remons_after_import_setup_demo_shipping();
            break;
        case 'scooter':
            // Setup Demo Scooter
            remons_after_import_setup_demo_scooter();
            break;
        case 'villa':
            // Setup Demo Villa
            remons_after_import_setup_demo_villa();
            break;
        case 'equipment':
            // Setup Demo Equipment
            remons_after_import_setup_demo_equipment();
            break;
        case 'taxi':
            // Setup Demo Taxi
            remons_after_import_setup_demo_taxi();
            break;
        case 'medical':
            // Setup Demo medical
            remons_after_import_setup_demo_medical();
            break;    
        default:
            // code...
            break;
    }

    // Get demo URL
    $demo_url = isset( $selected_import['preview_url'] ) ? $selected_import['preview_url'] : '';

    // Import slideshows
    remons_import_slideshows_demo( $demo_id );

    // Update customize
    remons_replace_url_in_customize( $demo_url );

    // After import replace URLs
    remons_after_import_replace_urls( $demo_url );

    // Replce default URL
    $default_url = apply_filters( 'remons_demo_default_url', 'https://remons.ovathemewp.com' );
    remons_after_import_replace_urls( $default_url );
}

// Get page by title
if ( ! function_exists( 'remons_get_page_by_title' ) ) {
    function remons_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
        global $wpdb;

        if ( is_array( $post_type ) ) {
            $post_type           = esc_sql( $post_type );
            $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
            $sql                 = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type IN ($post_type_in_string)
            ",
                $page_title
            );
        } else {
            $sql = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type = %s
            ",
                $page_title,
                $post_type
            );
        }

        $page = $wpdb->get_var( $sql );

        if ( $page ) {
            return get_post( $page, $output );
        }

        return null;
    }
}

// Replace url in customize
if ( !function_exists( 'remons_replace_url_in_customize' ) ) {
    function remons_replace_url_in_customize( $demo_url = '' ) {
        // Demo URL
        if ( !$demo_url ) {
            $demo_url = apply_filters( 'remons_demo_url', 'https://remons.ovathemewp.com' );
        }

        // Get theme mods
        $theme_mods = get_theme_mods();

        if ( !empty( $theme_mods ) ) {
            foreach ( $theme_mods as $key => $val ) {
                if ( is_string( $val ) && str_contains( $val, $demo_url ) ) {
                    $val = str_replace( $demo_url, get_site_url(), $val );

                    // Update theme mod
                    set_theme_mod( $key, $val );
                }
            }
        }
    }
}

// After import replace URLs
if ( ! function_exists( 'remons_after_import_replace_urls' ) ) {
    function remons_after_import_replace_urls( $demo_url = '' ) {
        global $wpdb;

        $site_url = get_site_url();

        // Demo URL
        if ( ! $demo_url ) {
            $demo_url = apply_filters( 'remons_demo_url', 'https://remons.ovathemewp.com' );
        }

        // Replace in option value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->options} " .
                "SET `option_value` = REPLACE(`option_value`, %s, %s);",
                $demo_url,
                $site_url
            )
        );

        // Replace in posts
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->posts} " .
                "SET `post_content` = REPLACE(`post_content`, %s, %s), `guid` = REPLACE(`guid`, %s, %s);",
                $demo_url,
                $site_url,
                $demo_url,
                $site_url
            )
        );

        // Replace in meta value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                "SET `meta_value` = REPLACE(`meta_value`, %s, %s) " .
                "WHERE `meta_key` <> '_elementor_data';",
                $demo_url,
                $site_url
            )
        );

        // Elementor Data
        $escaped_from       = str_replace( '/', '\\/', $demo_url );
        $escaped_to         = str_replace( '/', '\\/', $site_url );
        $meta_value_like    = '[%'; // meta_value LIKE '[%' are json formatted

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ' .
                "WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE %s;",
                $escaped_from,
                $escaped_to,
                $meta_value_like
            )
        );

        // Multiple sites
        for ( $i = 1; $i <= 10; $i++ ) {
            $escaped_from   = str_replace( '/', '\\/', $site_url.'/wp-content/uploads/sites/'.$i );
            $escaped_to     = str_replace( '/', '\\/', $site_url.'/wp-content/uploads' );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->postmeta} " .
                    'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ' .
                    "WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE %s;",
                    $escaped_from,
                    $escaped_to,
                    $meta_value_like
                )
            );
        } // End
    }
}

// After import - setup Demo Car
if ( ! function_exists( 'remons_after_import_setup_demo_car' ) ) {
    function remons_after_import_setup_demo_car() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#005CB5' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#FF3726' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Lexend' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#ff3726' );
        update_option( 'ovabrw_glb_light_color', '#77797e' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '26px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#0c142e' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '20px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '30px' );
        update_option( 'ovabrw_glb_second_heading_color', '#0c142e' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#0c142e' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '300' );
        update_option( 'ovabrw_glb_text_line_height', '28px' );
        update_option( 'ovabrw_glb_text_color', '#77797e' );
    }
}

// After import - setup Demo Shipping
if ( ! function_exists( 'remons_after_import_setup_demo_shipping' ) ) {
    function remons_after_import_setup_demo_shipping() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/shipping/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/shipping/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#005CB5' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#FF3726' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Lexend' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#ff3726' );
        update_option( 'ovabrw_glb_light_color', '#77797e' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '26px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#0c142e' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '20px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '30px' );
        update_option( 'ovabrw_glb_second_heading_color', '#0c142e' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#0c142e' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '300' );
        update_option( 'ovabrw_glb_text_line_height', '28px' );
        update_option( 'ovabrw_glb_text_color', '#77797e' );
    }
}

// After import - setup Demo Scooter
if ( ! function_exists( 'remons_after_import_setup_demo_scooter' ) ) {
    function remons_after_import_setup_demo_scooter() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/scooter/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/scooter/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#005CB5' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#FF3726' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Lexend' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#ff3726' );
        update_option( 'ovabrw_glb_light_color', '#77797e' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '26px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#0c142e' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '20px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '30px' );
        update_option( 'ovabrw_glb_second_heading_color', '#0c142e' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#0c142e' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '300' );
        update_option( 'ovabrw_glb_text_line_height', '28px' );
        update_option( 'ovabrw_glb_text_color', '#77797e' );
    }
}

// After import - setup Demo Villa
if ( ! function_exists( 'remons_after_import_setup_demo_villa' ) ) {
    function remons_after_import_setup_demo_villa() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single - Villa/Hotel', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/villa/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/villa/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#005CB5' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#FF3726' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Lexend' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#ff3726' );
        update_option( 'ovabrw_glb_light_color', '#77797e' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '26px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#0c142e' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '20px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '30px' );
        update_option( 'ovabrw_glb_second_heading_color', '#0c142e' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#0c142e' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '300' );
        update_option( 'ovabrw_glb_text_line_height', '28px' );
        update_option( 'ovabrw_glb_text_color', '#77797e' );
    }
}

// After import - setup Demo Equipment
if ( ! function_exists( 'remons_after_import_setup_demo_equipment' ) ) {
    function remons_after_import_setup_demo_equipment() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single 2', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/equipment/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/equipment/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#FDB900' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#D12525' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Inter' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#fdb900' );
        update_option( 'ovabrw_glb_light_color', '#c3c3c3' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '24px' );
        update_option( 'ovabrw_glb_heading_font_weight', '700' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#222222' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '22px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '33px' );
        update_option( 'ovabrw_glb_second_heading_color', '#222222' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#222222' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '400' );
        update_option( 'ovabrw_glb_text_line_height', '22px' );
        update_option( 'ovabrw_glb_text_color', '#696969' );

        // Global Card Template
        update_option( 'ovabrw_glb_card_template', 'cardequipment' );

        // Card Display Thumbnail
        update_option( 'ovabrw_glb_card1_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card2_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card3_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card4_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card5_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card6_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardvilla_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardequipment_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardtaxi_display_thumbnail', 'contain' );
    }
}

// After import - setup Demo Taxi
if ( ! function_exists( 'remons_after_import_setup_demo_taxi' ) ) {
    function remons_after_import_setup_demo_taxi() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        
        // Config BRW
        $product_template = remons_get_page_by_title( 'Product Rental Single 2', '', 'elementor_library' );
        
        if ( isset( $product_template->ID ) && absint( $product_template->ID ) ) {
            update_option( 'ova_brw_template_elementor_template', $product_template->ID );
        }

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/taxi/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/taxi/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#FDB900' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#D12525' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Inter' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#fdb900' );
        update_option( 'ovabrw_glb_light_color', '#c3c3c3' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '24px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#222222' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '22px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '33px' );
        update_option( 'ovabrw_glb_second_heading_color', '#222222' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#222222' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '400' );
        update_option( 'ovabrw_glb_text_line_height', '22px' );
        update_option( 'ovabrw_glb_text_color', '#5E5F63' );

        // Global Card Template
        update_option( 'ovabrw_glb_card_template', 'cardtaxi' );

        // Card Display Thumbnail
        update_option( 'ovabrw_glb_card1_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card2_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card3_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card4_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card5_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card6_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardvilla_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardequipment_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardtaxi_display_thumbnail', 'contain' );
    }
}

// After import - setup Demo Medical
if ( ! function_exists( 'remons_after_import_setup_demo_medical' ) ) {
    function remons_after_import_setup_demo_medical() {
        // Assign menus to their locations.
        $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        if ( !is_wp_error( $primary ) ) {
            set_theme_mod( 'nav_menu_locations', [
                'primary' => $primary->term_id
            ]);
        }

        // Assign front page and posts page (blog page).
        $front_page_id = remons_get_page_by_title( 'Home 1' );
        $blog_page_id  = remons_get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );

        // Config Elementor
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_css_print_method', 'internal' );
        update_option( 'elementor_load_fa4_shim', 'yes' );
        

        update_option( 'ova_brw_booking_form_terms_conditions', 'yes' );
        update_option( 'ova_brw_booking_form_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/taxi/refund_returns/" target="_blank">terms and conditions</a>' );

        update_option( 'ova_brw_request_booking_terms_conditions', 'yes' );
        update_option( 'ova_brw_request_booking_terms_conditions_content', 'I have read and agree to the website <a href="https://remons.ovathemewp.com/taxi/refund_returns/" target="_blank">terms and conditions</a>' );

        // Calendar Primary background
        update_option( 'ovabrw_primary_background_calendar', '#FDB900' );

        // Calendar Background of unavailble dates
        update_option( 'ovabrw_background_not_available', '#D12525' );

        // Typography & Color
        update_option( 'ovabrw_glb_primary_font', 'Inter' );
        update_option( 'ovabrw_glb_primary_font_weight', ['100','200','300','regular','500','600','700','800','900'] );
        update_option( 'ovabrw_glb_primary_color', '#fdb900' );
        update_option( 'ovabrw_glb_light_color', '#c3c3c3' );

        // Heading
        update_option( 'ovabrw_glb_heading_font_size', '24px' );
        update_option( 'ovabrw_glb_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_heading_line_height', '36px' );
        update_option( 'ovabrw_glb_heading_color', '#222222' );

        // Second Heading
        update_option( 'ovabrw_glb_second_heading_font_size', '22px' );
        update_option( 'ovabrw_glb_second_heading_font_weight', '600' );
        update_option( 'ovabrw_glb_second_heading_line_height', '33px' );
        update_option( 'ovabrw_glb_second_heading_color', '#222222' );

        // Label
        update_option( 'ovabrw_glb_label_font_size', '16px' );
        update_option( 'ovabrw_glb_label_font_weight', '500' );
        update_option( 'ovabrw_glb_label_line_height', '24px' );
        update_option( 'ovabrw_glb_label_color', '#222222' );

        // Text
        update_option( 'ovabrw_glb_text_font_size', '16px' );
        update_option( 'ovabrw_glb_text_font_weight', '400' );
        update_option( 'ovabrw_glb_text_line_height', '22px' );
        update_option( 'ovabrw_glb_text_color', '#5E5F63' );

        // Global Card Template
        update_option( 'ovabrw_glb_card_template', 'card1' );

        // Card Display Thumbnail
        update_option( 'ovabrw_glb_card1_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card2_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card3_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card4_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card5_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_card6_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardvilla_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardequipment_display_thumbnail', 'contain' );
        update_option( 'ovabrw_glb_cardtaxi_display_thumbnail', 'contain' );
    }
}

// Import slideshows
if ( ! function_exists( 'remons_import_slideshows_demo' ) ) {
    function remons_import_slideshows_demo( $demo_id = false ) {
        if ( $demo_id && is_plugin_active('revslider/revslider.php') && class_exists( 'RevSliderSliderImport' ) ) {
            $slide_files = glob( get_template_directory() . '/install-resource/demo-import/'.$demo_id.'/slideshows/*.zip' );

            if ( ! empty( $slide_files ) && is_array( $slide_files ) ) {
                $import = new RevSliderSliderImport();

                foreach ( $slide_files as $path_file ) {
                    if ( file_exists( $path_file ) ) {
                        $return = $import->import_slider( false, $path_file );
                    }
                }
            }
        }
    }
}