<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Review
$product_review = [
    'title'    => sprintf( __( 'Reviews (%d)', 'remons' ), $product->get_review_count() ),
    'priority' => 30,
    'callback' => 'comments_template'
];

if ( is_singular( 'product' ) ): ?>
    <div class="content-product-item ova-product-review" id="ova-product-review">
        <?php call_user_func( $product_review['callback'], 'reviews', $product_review ); ?>
    </div>
<?php else: ?>
    <div class="content-product-item ova-product-review" id="ova-product-review">
        <h4>
            <?php echo esc_html__( 'Reviews are only visible in a single product page', 'remons' ); ?>
        </h4>
    </div>
<?php endif;