<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Get product URL
$product_url = get_permalink( $product_id );

// Get product title
$product_title  = get_the_title( $product_id );

// Share social
$args_social = apply_filters( 'ovabrw_ft_share_social', [
    'facebook'  => [
        'icon'  => 'fab fa-facebook-f',
        'url'   => 'https://www.facebook.com/sharer.php?u='.$product_url
    ],
    'twitter'   => [
        'icon'  => 'fab fa-twitter',
        'url'   => 'https://twitter.com/share/?url='.$product_url.'&text='.$product_title
    ],
    'whatsapp'  => [
        'icon'  => 'fab fa-whatsapp',
        'url'   => 'https://api.whatsapp.com/send?text=*'.$product_title.'*%0A'.$product_url
    ],
    'pinterest' => [
        'icon'  => 'fab fa-pinterest-p',
        'url'   => 'https://www.pinterest.com/pin/create/button/?url='.$product_url
    ]
], $product_url, $product_title );

// Wishlist
$wishlist = do_shortcode('[yith_wcwl_add_to_wishlist]');

?>
<div class="content-product-item">
    <?php if ( $product_url && $product_title ): ?>
        <div class="btn-share">
            <i aria-hidden="true" class="fas fa-share-alt"></i>
            <ul class="ova-social">
                <?php foreach ( $args_social as $name => $item_social ): ?>
                    <li>
                        <a href="<?php echo esc_url( $item_social['url'] ); ?>" class="<?php echo esc_attr( $name ); ?>" target="_blank">
                            <i aria-hidden="true" class="<?php echo esc_attr( $item_social['icon'] ); ?>"></i>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;

    // Wishlist
    if ( '[yith_wcwl_add_to_wishlist]' != $wishlist ): ?>
        <div class="ova-single-product-wishlist">
            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
        </div>
    <?php endif; ?>
</div>