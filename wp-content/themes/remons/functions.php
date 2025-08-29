<?php if ( !defined( 'ABSPATH' ) ) exit();

if ( defined( 'REMONS_URL' ) == false ) define( 'REMONS_URL', get_template_directory() );
if ( defined( 'REMONS_URI' ) == false ) define( 'REMONS_URI', get_template_directory_uri() );

load_theme_textdomain( 'remons', REMONS_URL . '/languages' );

// Main Feature
require_once( REMONS_URL.'/inc/class-main.php' );

// Functions
require_once( REMONS_URL.'/inc/functions.php' );

// Hooks
require_once( REMONS_URL.'/inc/class-hook.php' );

// Widget
require_once ( REMONS_URL.'/inc/class-widgets.php' );

// Ajax
require_once ( REMONS_URL.'/inc/class-ajax.php' );


// Elementor
if ( defined( 'ELEMENTOR_VERSION' ) && defined( 'OVABRW_PREFIX' ) ) {
	require_once ( REMONS_URL.'/inc/class-elementor.php' );
}

// WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
	require_once ( REMONS_URL.'/inc/class-woo.php' );	
}

// Customize
if ( current_user_can( 'customize' ) ) {
    require_once REMONS_URL.'/customize/custom-control/google-font.php';
    require_once REMONS_URL.'/customize/custom-control/heading.php';
    require_once REMONS_URL.'/inc/class-customize.php';
}

// Active plugins
require_once ( REMONS_URL.'/install-resource/active-plugins.php' );