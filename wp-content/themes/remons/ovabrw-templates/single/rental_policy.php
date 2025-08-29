<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Product policy
$product_policy = $product->get_meta_value( 'product_rental_policy' );
if ( $product_policy ): ?>
    <div class="content-product-item product-rental-policy-wrapper" id="product-rental-policy">
        <h2 class="ovabrw-second-heading">
            <?php echo esc_html( ovabrw_get_meta_data( 'heading', $args ) ); ?>
        </h2>
        <div class="product-rental-policy-content">
            <?php echo apply_filters( 'ova_the_content', $product_policy ); ?>
        </div>
    </div>
<?php else:
    if ( !is_singular( 'product' ) ): ?>
        <div class="empty-item">
            <h4>
                <?php echo esc_html__( 'Empty rental policy in this product', 'remons' ); ?>
            </h4>
        </div>
    <?php endif;
endif;