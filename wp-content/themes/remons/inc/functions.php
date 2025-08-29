<?php if (!defined( 'ABSPATH' )) exit;

// Get current ID of post/page, etc
if ( ! function_exists( 'remons_get_current_id' ) ) {
	function remons_get_current_id(){
	    
	    $current_page_id = '';
	    // Get The Page ID You Need
	    
	    if(class_exists("woocommerce")) {
	        if( is_shop() ){ ///|| is_product_category() || is_product_tag()) {
	            $current_page_id  =  get_option ( 'woocommerce_shop_page_id' );
	        }elseif(is_cart()) {
	            $current_page_id  =  get_option ( 'woocommerce_cart_page_id' );
	        }elseif(is_checkout()){
	            $current_page_id  =  get_option ( 'woocommerce_checkout_page_id' );
	        }elseif(is_account_page()){
	            $current_page_id  =  get_option ( 'woocommerce_myaccount_page_id' );
	        }elseif(is_view_order_page()){
	            $current_page_id  = get_option ( 'woocommerce_view_order_page_id' );
	        }
	    }
	    if($current_page_id=='') {
	        if ( is_home () && is_front_page () ) {
	            $current_page_id = '';
	        } elseif ( is_home () ) {
	            $current_page_id = get_option ( 'page_for_posts' );
	        } elseif ( is_search () || is_category () || is_tag () || is_tax () || is_archive() ) {
	            $current_page_id = '';
	        } elseif ( !is_404 () ) {
	           $current_page_id = get_the_id();
	        } 
	    }

	    return $current_page_id;
	}
}

if (!function_exists('remons_is_elementor_active')) {
    function remons_is_elementor_active(){
        return did_action( 'elementor/loaded' );
    }
}

if (!function_exists('remons_is_woo_active')) {
    function remons_is_woo_active(){
        return class_exists('woocommerce');    
    }
}

if (!function_exists('remons_is_brw_active')) {
    function remons_is_brw_active(){
        return class_exists('OVABRW');    
    }
}

if (!function_exists('remons_is_blog_archive')) {
    function remons_is_blog_archive() {
        return (is_home() && is_front_page()) || is_archive() || is_category() || is_tag() || is_home();
    }
}

if (!function_exists('remons_is_woo_archive')) {
    function remons_is_woo_archive() {
        return is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag');
    }
}

/* Get ID from Slug of Header Footer Builder - Post Type */
function remons_get_id_by_slug( $page_slug ) {
    $page = get_page_by_path( $page_slug, OBJECT, 'ova_framework_hf_el' ) ;
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function remons_custom_text ($content = "",$limit = 15) {

    $content = explode(' ', $content, $limit);

    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }

    $content = preg_replace('`[[^]]*]`','',$content);
    
    return strip_tags( $content );
}

/**
 * Google Font sanitization
 *
 * @param  string   JSON string to be sanitized
 * @return string   Sanitized input
 */
if ( ! function_exists( 'remons_google_font_sanitization' ) ) {
    function remons_google_font_sanitization( $input ) {
        $val =  json_decode( $input, true );
        if( is_array( $val ) ) {
            foreach ( $val as $key => $value ) {
                $val[$key] = sanitize_text_field( $value );
            }
            $input = json_encode( $val );
        }
        else {
            $input = json_encode( sanitize_text_field( $val ) );
        }
        return $input;
    }
}

/* Default Primary Color in Customize */
if ( ! function_exists( 'remons_default_primary_color' ) ) {
    function remons_default_primary_color() {
        $primary_color = get_theme_mod( 'primary_color', '#FF3726' );

        return $primary_color;
    }
}

/* Default Primary Font in Customize */
if ( ! function_exists( 'remons_default_primary_font' ) ) {
    function remons_default_primary_font() {
        $customizer_defaults = json_encode(
            array(
                'font' => 'Lexend',
                'regularweight' => '100,200,300,regular,500,600,700,800,900',
                'category' => 'serif'
            )
        );

        return $customizer_defaults;
    }
}

/* Default Second Font ( Heading Font ) in Customize */
if ( ! function_exists( 'remons_default_second_font' ) ) {
    function remons_default_second_font() {
        $customizer_defaults = json_encode(
            array(
                'font' => 'Lexend',
                'regularweight' => '100,200,300,regular,500,600,700,800,900',
                'category' => 'serif'
            )
        );

        return $customizer_defaults;
    }
}

if ( ! function_exists( 'remons_woo_sidebar' ) ) {
    function remons_woo_sidebar(){
        if( class_exists('woocommerce') && is_product() ){
            return get_theme_mod( 'woo_product_layout', 'woo_layout_1c' );
        }else{
            return get_theme_mod( 'woo_archive_layout', 'woo_layout_1c' );
        }
    }
}

if( !function_exists( 'remons_blog_show_media' ) ){
    function remons_blog_show_media(){
        $show_media = get_theme_mod( 'blog_archive_show_media', 'yes' );
        return isset( $_GET['show_media'] ) ? $_GET['show_media'] : $show_media;
    }
}

if( !function_exists( 'remons_blog_show_title' ) ){
    function remons_blog_show_title(){
        $show_title = get_theme_mod( 'blog_archive_show_title', 'yes' );
        return isset( $_GET['show_title'] ) ? $_GET['show_title'] : $show_title;
    }
}

if( !function_exists( 'remons_blog_show_date' ) ){
    function remons_blog_show_date(){
        $show_date = get_theme_mod( 'blog_archive_show_date', 'yes' );
        return isset( $_GET['show_date'] ) ? $_GET['show_date'] : $show_date;
    }
}

if( !function_exists( 'remons_blog_show_cat' ) ){
    function remons_blog_show_cat(){
        $show_cat = get_theme_mod( 'blog_archive_show_cat', 'yes' );
        return isset( $_GET['show_cat'] ) ? $_GET['show_cat'] : $show_cat;
    }
}

if( !function_exists( 'remons_blog_show_author' ) ){
    function remons_blog_show_author(){
        $show_author = get_theme_mod( 'blog_archive_show_author', 'yes' );
        return isset( $_GET['show_author'] ) ? $_GET['show_author'] : $show_author;
    }
}

if( !function_exists( 'remons_blog_show_comment' ) ){
    function remons_blog_show_comment(){
        $show_comment = get_theme_mod( 'blog_archive_show_comment', 'yes' );
        return isset( $_GET['show_comment'] ) ? $_GET['show_comment'] : $show_comment;
    }
}

if( !function_exists( 'remons_blog_show_excerpt' ) ){
    function remons_blog_show_excerpt(){
        $show_excerpt = get_theme_mod( 'blog_archive_show_excerpt', 'yes' );
        return isset( $_GET['show_excerpt'] ) ? $_GET['show_excerpt'] : $show_excerpt;
    }
}

if( !function_exists( 'remons_blog_show_readmore' ) ){
    function remons_blog_show_readmore(){
        $show_readmore = get_theme_mod( 'blog_archive_show_readmore', 'yes' );
        return isset( $_GET['show_readmore'] ) ? $_GET['show_readmore'] : $show_readmore;
    }
}

if( !function_exists( 'remons_post_show_media' ) ){
    function remons_post_show_media(){
        $show_media = get_theme_mod( 'blog_single_show_media', 'yes' );
        return isset( $_GET['show_media'] ) ? $_GET['show_media'] : $show_media;
    }
}

if( !function_exists( 'remons_post_show_title' ) ){
    function remons_post_show_title(){
        $show_title = get_theme_mod( 'blog_single_show_title', 'yes' );
        return isset( $_GET['show_title'] ) ? $_GET['show_title'] : $show_title;
    }
}

if( !function_exists( 'remons_post_show_date' ) ){
    function remons_post_show_date(){
        $show_date = get_theme_mod( 'blog_single_show_date', 'yes' );
        return isset( $_GET['show_date'] ) ? $_GET['show_date'] : $show_date;
    }
}

if( !function_exists( 'remons_post_show_cat' ) ){
    function remons_post_show_cat(){
        $show_cat = get_theme_mod( 'blog_single_show_cat', 'yes' );
        return isset( $_GET['show_cat'] ) ? $_GET['show_cat'] : $show_cat;
    }
}

if( !function_exists( 'remons_post_show_author' ) ){
    function remons_post_show_author(){
        $show_author = get_theme_mod( 'blog_single_show_author', 'yes' );
        return isset( $_GET['show_author'] ) ? $_GET['show_author'] : $show_author;
    }
}

if( !function_exists( 'remons_post_show_comment' ) ){
    function remons_post_show_comment(){
        $show_comment = get_theme_mod( 'blog_single_show_comment', 'yes' );
        return isset( $_GET['show_comment'] ) ? $_GET['show_comment'] : $show_comment;
    }
}

if( !function_exists( 'remons_post_show_tag' ) ){
    function remons_post_show_tag(){
        $show_tag = get_theme_mod( 'blog_single_show_tag', 'yes' );
        return isset( $_GET['show_tag'] ) ? $_GET['show_tag'] : $show_tag;
    }
}

if( !function_exists( 'remons_post_show_share_social_icon' ) ){
    function remons_post_show_share_social_icon(){
        $show_share_social_icon = get_theme_mod( 'blog_single_show_share_social_icon', 'yes' );
        return isset( $_GET['show_share_social_icon'] ) ? $_GET['show_share_social_icon'] : $show_share_social_icon;
    }
}

if( !function_exists( 'remons_post_show_next_prev_post' ) ){
    function remons_post_show_next_prev_post(){
        $show_next_prev_post = get_theme_mod( 'blog_single_show_next_prev_post', 'yes' );
        return isset( $_GET['show_next_prev_post'] ) ? $_GET['show_next_prev_post'] : $show_next_prev_post;
    }
}

// Add Card Templates
add_filter('ovabrw_get_card_templates', function() {
    $card_templates = [
        'card1' => esc_html__( 'Card 1', 'remons' ),
        'card2' => esc_html__( 'Card 2', 'remons' ),
        'card3' => esc_html__( 'Card 3', 'remons' ),
        'card4' => esc_html__( 'Card 4', 'remons' ),
        'card5' => esc_html__( 'Card 5', 'remons' ),
        'card6' => esc_html__( 'Card 6', 'remons' ),
        'cardvilla'      => esc_html__( 'Card Villa', 'remons' ),
        'cardequipment'  => esc_html__( 'Card Equipment', 'remons' ),
        'cardtaxi'       => esc_html__( 'Card Taxi', 'remons' ),
        'cardmedical'    => esc_html__( 'Card Medical', 'remons' )
    ];

    return $card_templates;
});

// Custom metabox with cmb2 - Product
add_action( 'cmb2_init', 'ovabrw_custom_metaboxes_cmb2' );

function ovabrw_custom_metaboxes_cmb2() {

    $prefix = 'ovabrw_';
    
    $cmb2_settings = new_cmb2_box( array(
        'id'            => 'ovabrw_custom_metaboxs_cmb2_settings',
        'title'         => esc_html__( 'Product custom metaboxes', 'remons' ),
        'object_types'  => array( 'product'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'closed'        => true,
        'show_names'    => true,    
    ) );

        // Included 
        $cmb2_settings->add_field( array(
            'name'    => esc_html__( 'Product Included', 'remons' ),
            'id'      => $prefix . 'product_included',
            'type'    => 'wysiwyg',
        ) ); 


        // Product Rental Policy
        $cmb2_settings->add_field( array(
            'name'    => esc_html__( 'Product Rental Policy', 'remons' ),
            'id'      => $prefix . 'product_rental_policy',
            'type'    => 'wysiwyg',
        ) );    

}

// cpt registering on theme activation elementor post types support
function ovatheme_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'ova_framework_hf_el' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but cpt is NOT defined
    else if( ! in_array( 'ova_framework_hf_el', $cpt_support ) ) {
        $cpt_support[] = 'ova_framework_hf_el'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, cpt already exists in elementor_cpt_support option

}
add_action( 'after_switch_theme', 'ovatheme_add_cpt_support' );

/**
 * Get meta data
 */
if ( !function_exists( 'remons_get_meta_data' ) ) {
    function remons_get_meta_data( $key = '', $args = [], $default = false ) {
        $value = '';

        // Check $args
        if ( empty( $args ) || !is_array( $args ) ) $args = [];

        // Get value by key
        if ( $key !== '' && isset( $args[$key] ) && '' !== $args[$key] ) {
            $value = $args[$key];
        }

        // Set default
        if ( !$value && false !== $default ) {
            $value = $default;
        }

        return apply_filters( 'remons_get_meta_data', $value, $key, $args, $default );
    }
}

/**
 * Check array exists
 */
if ( !function_exists( 'remons_array_exists' ) ) {
    function remons_array_exists( $arr ) {
        if ( !empty( $arr ) && is_array( $arr ) ) {
            return true;
        }

        return false;
    }
}

/**
 * Recursive array replace \\
 */
if ( !function_exists( 'remons_recursive_replace' ) ) {
    function remons_recursive_replace( $find, $replace, $array ) {
        if ( !is_array( $array ) ) {
            return str_replace( $find, $replace, $array );
        }

        foreach ( $array as $key => $value ) {
            $array[$key] = remons_recursive_replace( $find, $replace, $value );
        }

        return apply_filters( 'remons_recursive_replace', $array, $find, $replace );
    }
}

/**
 * remons get blog ids
 */
if( !function_exists ( 'remons_get_blog_ids' ) ) {
    function remons_get_blog_ids( $settings, $paged = 1 ){
        $posts_per_page = (int) remons_get_meta_data( 'posts_per_page', $settings);

        if ( !$posts_per_page ) {
            $posts_per_page = (int) remons_get_meta_data( 'total_count', $settings );
        }

        $order          = remons_get_meta_data( 'order', $settings );
        $order_by       = remons_get_meta_data( 'order_by', $settings );
        $category       = remons_get_meta_data( 'category', $settings );


        $args = [];
                
        if ( 'all' == $category ) {
            $args = [
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'posts_per_page'    => -1,
                'order'             => $order,
                'orderby'           => $order_by,
                'paged'             => $paged,
                'fields'            =>  'ids'
            ];
        } else {
            $args = [
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'category_name'     =>  $category,
                'posts_per_page'    =>  -1,
                'order'             =>  $order,
                'orderby'           =>  $order_by,
                'paged'             =>  $paged,
                'fields'            =>  'ids'
            ];
        }

        $blog_ids = get_posts( $args );

        return $blog_ids;
    }
}

/**
 * remons render pagination
 */
if( !function_exists ( 'remons_render_pagination' ) ) {
    function remons_render_pagination( $total_pages, $current_page, $settings ) {
        $show_pagination = $settings[ 'show_pagination' ];

        if ( $total_pages > 1 && $show_pagination === 'yes' ) {
            ob_start(); ?>
            <div class="pagination-wrapper" data-total-page="<?php echo esc_attr( $total_pages ); ?>" data-current-page="<?php echo esc_attr( $current_page ); ?>">
                <ul class="pagination">
                    <?php if ( $current_page > 1 ) : ?>
                        <li>
                            <span class="prev page-numbers" data-paged="<?php echo esc_attr( $current_page - 1 ); ?>">
                                <?php esc_html_e( 'Previous', 'remons' ); ?>
                            </span>
                        </li>
                    <?php else : ?>
                        <li>
                            <span class="prev page-numbers disabled">
                                <?php esc_html_e( 'Previous', 'remons' ); ?>
                            </span>
                        </li>
                    <?php endif;

                    $range = 2;
                    $start_page = max( 1, $current_page - $range );
                    $end_page = min( $total_pages, $current_page + $range );

                    if ( $start_page > 1 ) { ?>
                        <li>
                            <span class="page-numbers" data-paged="1">1</span>
                        </li>
                    <?php }
                    if ( $start_page > 2 ) { ?>
                        <li>
                            <span class="page-numbers dots">...</span>
                        </li>
                    <?php }

                    for ( $i = $start_page; $i <= $end_page; $i++ ) : ?>
                        <li>
                            <span class="page-numbers <?php echo ( $i == $current_page ) ? 'current' : ''; ?>" data-paged="<?php echo esc_attr( $i ); ?>">
                                <?php echo esc_html( $i ); ?>
                            </span>
                        </li>
                    <?php endfor;

                    if ( $end_page < $total_pages ) {
                        if ( $end_page < $total_pages - $range ) { ?>
                            <li><span class="page-numbers dots">...</span></li>
                        <?php } ?>
                        <li>
                            <span class="page-numbers" data-paged="<?php echo esc_attr( $total_pages ); ?>">
                                <?php echo esc_attr( $total_pages ) ?>
                            </span>
                        </li>
                    <?php }

                    if ( $current_page < $total_pages ) : ?>
                        <li>
                            <span class="next page-numbers" data-paged="<?php echo esc_attr( $current_page + 1 ); ?>">
                                <?php esc_html_e('Next', 'remons'); ?>
                            </span>
                        </li>
                    <?php else : ?>
                        <li>
                            <span class="next page-numbers disabled">
                                <?php esc_html_e( 'Next', 'remons' ); ?>
                            </span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php
            return ob_get_clean();
        }
        
        return '';
    }
}

