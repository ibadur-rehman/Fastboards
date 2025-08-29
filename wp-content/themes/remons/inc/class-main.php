<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Remons_Main') ){

	class Remons_Main {

		public function __construct() {
			/* Add theme support */
			add_action( 'after_setup_theme', array( $this, 'remons_theme_support' ) );
	
			/**
			 * Register Menu
			 */
			add_action( 'init', array( $this, 'remons_register_menus' ) );

			/**
			 * Load google font from customize
			 */
			add_action('wp_enqueue_scripts', array( $this, 'remons_load_google_fonts' ) );

			/**
			 * Add Body class
			 */
			add_filter('body_class', array( $this, 'remons_body_classes' ) );
			
			/**
			 * Enqueue CSS, Javascript
			 */
			add_action('wp_enqueue_scripts', array( $this, 'remons_enqueue_scripts' ) );

			/**
			 * Elementor Enqueue CSS
			 */
			add_action('wp_enqueue_scripts', array( $this, 'remons_enqueue_elementor_style' ) );

			/**
			 * Enqueue style from customize
			 */
			add_action('wp_enqueue_scripts', array( $this, 'remons_enqueue_customize' ), 11 );
        }

		function remons_theme_support(){

			$GLOBALS['content_width'] = apply_filters('remons_content_width', 800);
		    
		    add_theme_support('title-tag');

		    // Adds RSS feed links to <head> for posts and comments.
		    add_theme_support( 'automatic-feed-links' );

		    // Switches default core markup for search form, comment form, and comments    
		    // to output valid HTML5.
		    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

		    add_theme_support( 'responsive-embeds' );

		    /* See http://codex.wordpress.org/Post_Formats */
		    add_theme_support( 'post-formats', array( 'image', 'gallery', 'audio', 'video') );

		    add_theme_support( 'post-thumbnails' );
		    
		    add_theme_support( 'custom-header' );
		    add_theme_support( 'custom-background');

		    add_theme_support('responsive-embeds');

		    add_theme_support( 'woocommerce' );
		    add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		    
		    // Show Excerpt in Page
            add_post_type_support( 'page', 'excerpt' );

		    add_theme_support( 'ova_framework_hf_el' );

		    add_filter('gutenberg_use_widgets_block_editor', '__return_false');
            add_filter('use_widgets_block_editor', '__return_false');

		    add_image_size( 'remons_thumbnail', 768, 660, true );
		    
		}

		function remons_register_menus() {
		  register_nav_menus( array(
		    'primary'   => esc_html__( 'Primary Menu', 'remons' )

		  ) );
		}
		
		function remons_load_google_fonts(){

		    $fonts_url = '';

		    $default_primary_font = json_decode( remons_default_primary_font() );
		    $default_second_font  = json_decode( remons_default_second_font() );

		    $custom_fonts = get_theme_mod('ova_custom_font','');

		    // Primary Font 
		    $primary_font = json_decode( get_theme_mod( 'primary_font' ) ) ? json_decode( get_theme_mod( 'primary_font' ) ) : $default_primary_font;
		    $primary_font_family = $primary_font->font;
		    $primary_font_weights_string = $primary_font->regularweight ? $primary_font->regularweight : '100,200,300,400,500,600,700,800,900';
		    $is_custom_primary_font = $custom_fonts != '' ? !strpos($primary_font_family, $custom_fonts) : true;

		    // Second Font
		    $second_font = json_decode( get_theme_mod( 'second_font' ) ) ? json_decode( get_theme_mod( 'second_font' ) ) : $default_second_font;
		    $second_font_family = $second_font->font;
		    $second_font_weights_string = $second_font->regularweight ? $second_font->regularweight : '100,200,300,400,500,600,700,800,900';
		    $is_custom_second_font = $custom_fonts != '' ? !strpos($second_font_family, $custom_fonts) : true;
		    
		    $general_flag = _x( 'on', $primary_font_family.': on or off', 'remons');
		    $second_flag  = _x( 'on', $second_font_family.': on or off', 'remons');
		    
		    if ( 'off' !== $general_flag || 'off' !== $three_flag  ) {
		        $font_families = array();
		 
		        if ( 'off' !== $general_flag && $is_custom_primary_font ) {
		            $font_families[] = $primary_font_family.':'.$primary_font_weights_string;
		        }

		        if ( 'off' !== $second_flag && $is_custom_second_font ) {
		            $font_families[] = $second_font_family.':'.$second_font_weights_string;
		        }

		        $custom_primary_font = get_post_meta( get_the_ID(), 'ova_met_primary_font', true );

				if ( $custom_primary_font && ( is_page() || is_single() ) ) {
					$custom_primary_font_args = explode( ':', $custom_primary_font );

					if ( isset( $custom_primary_font_args[0] ) && isset( $custom_primary_font_args[1] ) && $custom_primary_font_args[0] && $custom_primary_font_args[1] ) {
						$font_families[] = $custom_primary_font_args[0].':'.$custom_primary_font_args[1];
					}
				}

		        if ( $font_families != null ) {
		          	$query_args = array(
		              	'family' => urlencode( implode( '|', $font_families ) )
		          	);

		          	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		        }
		        
		    }
		 
		    $google_fonts =  esc_url_raw( $fonts_url );

		    /**
			 * Load google font from customize
			 */
			wp_enqueue_style( 'ova-google-fonts', $google_fonts, array(), null );
		}

		function remons_body_classes( $classes ){

            global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
            if ($is_lynx) {
                $classes[] = 'lynx';
            } elseif ($is_gecko) {
                $classes[] = 'gecko';
            } elseif ($is_opera) {
                $classes[] = 'opera';
            } elseif ($is_NS4) {
                $classes[] = 'ns4';
            } elseif ($is_safari) {
                $classes[] = 'safari';
            } elseif ($is_chrome) {
                $classes[] = 'chrome';
            } elseif ($is_IE) {
                $classes[] = 'ie';
            }

            if ($is_iphone) {
                $classes[] = 'iphone';
            }

            // Adds a class to blogs with more than 1 published author.
            if (is_multi_author()) {
                $classes[] = 'group-blog';
            }

            // Add class when using homepage template + featured image.
            if (has_post_thumbnail()) {
                $classes[] = 'has-post-thumbnail';
            }

            

            $classes[] = apply_filters( 'remons_theme_sidebar','' );

            $classes[] = remons_woo_sidebar();

            $wide_site = apply_filters( 'remons_wide_site', '' );
            if( $wide_site == 'boxed' ){
				$classes[] = 'container_boxed';
            }


            return $classes;
        }

		function remons_enqueue_scripts() {

		    // enqueue the javascript that performs in-link comment reply fanciness
		    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		        wp_enqueue_script( 'comment-reply' ); 
		    }

		    // Carousel
			wp_enqueue_script('carousel', REMONS_URI.'/assets/libs/carousel/owl.carousel.min.js', array('jquery'),null,true);
			wp_enqueue_style('carousel', REMONS_URI.'/assets/libs/carousel/assets/owl.carousel.min.css', array(), null);

			// Appear.js & animate.css
			wp_enqueue_script('appear', REMONS_URI.'/assets/libs/appear/appear.js', array('jquery'),null,true);
			wp_enqueue_style('ova-animate', REMONS_URI.'/assets/libs/animations/animate.css', array(), null);
			
		    // Font Icon
		    wp_enqueue_style('ovaicon', REMONS_URI.'/assets/libs/ovaicon/font/ovaicon.css', array(), null);

		    // Flaticon
		    wp_enqueue_style('flaticon_remons', REMONS_URI.'/assets/libs/flaticon/font/flaticon_remons.css', array(), null);

		    // Flaticon 2
		    wp_enqueue_style('flaticon_remons2', REMONS_URI.'/assets/libs/flaticon2/font/flaticon_remons2.css', array(), null);

		    // Flaticon 3
		    wp_enqueue_style('flaticon_remons3', REMONS_URI.'/assets/libs/flaticon3/font/flaticon_remons3.css', array(), null);

		    // Medical
		    wp_enqueue_style( 'remons_medical', REMONS_URI.'/assets/libs/medical/font/flaticon_remon_medical.css', [], null );

		    wp_enqueue_script('masonry', REMONS_URI.'/assets/libs/masonry.min.js', array('jquery'),null,true);
		    
		    wp_enqueue_script('remons-script', REMONS_URI.'/assets/js/script.js', array('jquery'),null,true);
		    wp_localize_script( 'remons-script', 'ScrollUpText', array('value' => esc_html__( 'Go to top', 'remons' )));
		    wp_enqueue_style( 'remons-style', get_template_directory_uri() . '/style.css' );
		}

		function remons_enqueue_elementor_style() {
			// Logo
			wp_enqueue_style( 'remons-elementor-logo', REMONS_URI.'/assets/scss/elementor/logo/logo.css', [], null );

			// Menus
			wp_enqueue_style( 'remons-elementor-menu-canvas', REMONS_URI.'/assets/scss/elementor/menus/menu-canvas.css', [], null );
			wp_enqueue_style( 'remons-elementor-menu-cart', REMONS_URI.'/assets/scss/elementor/menus/menu-cart.css', [], null );
			wp_enqueue_style( 'remons-elementor-menu-nav', REMONS_URI.'/assets/scss/elementor/menus/menu-nav.css', [], null );

			// My account button
			wp_enqueue_style( 'remons-elementor-my-account-button', REMONS_URI.'/assets/scss/elementor/buttons/my-account-button.css', [], null );

			// Search popup
			wp_enqueue_style( 'remons-elementor-search-popup', REMONS_URI.'/assets/scss/elementor/searchs/search-popup.css', [], null );

			// Contact info
			wp_enqueue_style( 'remons-elementor-contact-info', REMONS_URI.'/assets/scss/elementor/contact-info/contact-info.css' );

			// Switch language
			wp_enqueue_style( 'remons-elementor-switch-language', REMONS_URI.'/assets/scss/elementor/switch-language/switch-language.css' );
		}

        function remons_enqueue_customize(){
        	$css = '';
           
			$primary_color = remons_default_primary_color();

			$custom_primary_color = get_post_meta( get_the_ID(), 'ova_met_primary_color', true );
			if ( $custom_primary_color ) {
				$primary_color = $custom_primary_color;
			}

			$secondary_color 	= get_theme_mod( 'secondary_color', '#005CB5' );
			$heading_color 		= get_theme_mod( 'heading_color', '#0C142E' );
			$text_color 		= get_theme_mod( 'text_color', '#77797E' );
			$light_color 		= get_theme_mod( 'light_color', '#D0D7DE' );

			/* Primary Font */
			$default_primary_font = json_decode( remons_default_primary_font() );
			$primary_font = json_decode( get_theme_mod( 'primary_font' ) ) ? json_decode( get_theme_mod( 'primary_font' ) ) : $default_primary_font;
			$primary_font_family = $primary_font->font;

			/* Second Font ( Heading Font ) */
			$default_second_font = json_decode( remons_default_second_font() );
			$second_font = json_decode( get_theme_mod( 'second_font' ) ) ? json_decode( get_theme_mod( 'second_font' ) ) : $default_second_font;
			$second_font_family  = $second_font->font;
			$heading_font_weight = get_theme_mod( 'heading_font_weight', '600' );

			$custom_primary_font = get_post_meta( get_the_ID(), 'ova_met_primary_font', true );

			if ( $custom_primary_font && ( is_page() || is_single() ) ) {
				$custom_primary_font_args = explode( ':', $custom_primary_font );

				if ( isset( $custom_primary_font_args[0] ) && $custom_primary_font_args[0] ) {
					$primary_font_family = $custom_primary_font_args[0];
				}
			}

			/* General Typo */
			$general_font_size = get_theme_mod( 'general_font_size', '16px' );
			$general_font_weight = get_theme_mod( 'general_font_weight', '300' );
			$general_line_height = get_theme_mod( 'general_line_height', '1.87em' );
			$general_letter_space = get_theme_mod( 'general_letter_space', '0px' );
			
			// Width Sidebar
			$global_layout_sidebar = apply_filters( 'remons_get_layout', '' );
			$width_sidebar = is_array( $global_layout_sidebar ) ? $global_layout_sidebar[1] : '0';

			// Container width
			$container_width = get_theme_mod( 'global_boxed_container_width', '1290' );
			$container_width_break = $container_width + 60;
			$boxed_offset = get_theme_mod( 'global_boxed_offset', '20' );


			// WooCommerce Sidebar
			$woo_archive_layout = get_theme_mod( 'woo_archive_layout', 'layout_1c' );
			$woo_sidebar_width = get_theme_mod( 'woo_sidebar_width', '320' );

            $css .= '--primary: '.$primary_color.';';
            $css .= '--secondary: '.$secondary_color.';';
            $css .= '--heading: '.$heading_color.';';
            $css .= '--text: '.$text_color.';';
            $css .= '--light: '.$light_color.';';
            $css .= '--primary-font: '.$primary_font_family.';';
            $css .= '--secondary-font: '.$second_font_family.';';
            $css .= '--heading-font-weight: '.$heading_font_weight.';';
            $css .= '--font-size: '.$general_font_size.';';
            $css .= '--font-weight: '.$general_font_weight.';';
            $css .= '--line-height: '.$general_line_height.';';
            $css .= '--letter-spacing: '.$general_letter_space.';';
            $css .= '--width-sidebar: '.$width_sidebar.'px;';
            $css .= '--main-content:  calc( 100% - '.$width_sidebar.'px )'.';';
            $css .= '--container-width: '.$container_width.'px;';
            $css .= '--boxed-offset: '.$boxed_offset.'px;';
            $css .= '--woo-layout: '.$woo_archive_layout.';';
            $css .= '--woo-width-sidebar: '.$woo_sidebar_width.'px;';
            $css .= '--woo-main-content:  calc( 100% - '.$woo_sidebar_width.'px )'.';';

            $var = ":root{{$css}}";

            $var .= '@media (min-width: 1024px) and ( max-width: '.$container_width_break.'px ){
		        body .row_site,
		        body .elementor-section.elementor-section-boxed>.elementor-container{
		            max-width: 100%;
		            padding-left: 30px;
		            padding-right: 30px;
		        }
		    }';

            wp_add_inline_style( 'remons-style', $var );
        }
	}
}

return new Remons_Main();