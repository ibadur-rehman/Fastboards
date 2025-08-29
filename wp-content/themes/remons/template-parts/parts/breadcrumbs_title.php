<?php

 if ( is_home () && is_front_page () ) {
        
    esc_html_e('Home','remons');

} elseif ( is_front_page() ) {
    
    esc_html_e('Home','remons');

}elseif ( is_home () ) {

    if( get_option('page_for_posts', true) != '0') {
        echo get_the_title( get_option('page_for_posts', true) );
    } else {
        esc_html_e('Blog','remons');
    }

} elseif ( is_search () ) {

    esc_html_e('Search','remons');

} else if(is_category () ){

    echo single_cat_title('');

}else if (is_tag ()){

    esc_html_e('Tags','remons');

}else if( is_post_type_archive( 'product' ) ){

    echo get_the_title( get_option( 'woocommerce_shop_page_id' ) );

}else if( is_tax () || is_archive() ){

    echo get_the_archive_title();

}else if( is_singular() ){

    echo get_the_title();

}else if(  is_404() ) {
    esc_html_e('page not found','remons');
}
