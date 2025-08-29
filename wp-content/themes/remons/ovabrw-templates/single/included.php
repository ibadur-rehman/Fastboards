<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get rental product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Product included
$product_included = $product->get_meta_value( 'product_included' );
if ( $product_included ): ?>
    <div class="content-product-item product-included-wrapper" id="product-included">
        <h2 class="ovabrw-second-heading">
            <?php echo esc_html( ovabrw_get_meta_data( 'heading', $args ) ); ?>
        </h2>
        <div class="product-included-content">
            <?php echo apply_filters( 'ova_the_content', $product_included ); ?>
        </div>
    </div>
<?php else:
    if ( !is_singular( 'product' ) ): ?>
        <div class="empty-item">
            <h4>
                <?php echo esc_html__( 'Empty included in the price in this product', 'remons' ); ?>
            </h4>
        </div>
    <?php endif;
endif;