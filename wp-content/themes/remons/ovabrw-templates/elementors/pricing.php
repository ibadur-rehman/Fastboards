<?php if ( !defined( 'ABSPATH' ) ) exit();
    $show_button = remons_get_meta_data( 'show_button_read_more', $args );
    $text_button = remons_get_meta_data( 'package_button', $args );
    $link_url = remons_get_meta_data( 'link', $args )[ 'url' ] ?? '';
    $link_target = ( !empty( remons_get_meta_data( 'link', $args )[ 'is_external' ] ) ) ? '_blank' : '_self';
    $package_name = remons_get_meta_data( 'package_name', $args );
    $package_discount = remons_get_meta_data( 'package_discount', $args );
    $package_description = remons_get_meta_data( 'package_description', $args );
    $list_service_text = remons_get_meta_data( 'list_service_text', $args );
    $package_pricing = remons_get_meta_data( 'package_pricing', $args );
?>

<div class="pricing-wrapper">
    <div class="item">
        <?php if ( $package_name || $package_discount ): ?>
            <div class="head-card">
                <?php if ( $package_name ): ?>
                    <h3 class="package-name"><?php echo esc_html( $package_name ); ?></h3>
                <?php  endif; ?> 

                <?php if ( $package_discount ): ?>
                    <span class="package-discount"><?php echo esc_html( $package_discount ); ?></span>
                <?php  endif; ?> 
            </div>
        <?php  endif; ?> 

        <?php if ( $package_description ): ?>
            <p class="package-description"><?php echo esc_html( $package_description ); ?></p>
        <?php  endif; ?> 

        <?php if ( $package_pricing ): ?>
            <div class="package-pricing">
                <p><?php echo wp_kses_post( $package_pricing ); ?></p>
            </div>
        <?php endif; ?>

        <?php if ( $list_service_text ): ?>
            <ul class="package-content">
                <?php if ( !empty( $list_service_text ) ) : ?>
                    <?php foreach ( $list_service_text as $item ) : ?>
                        <li>
                            <span class="text_service"><?php echo esc_html( $item['text_service'] ); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        <?php  endif; ?> 

        <?php if ( $show_button ): ?>
            <button class="pakage-button" type="button">
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $text_button ); ?></a>
                <i class="fas fa-arrow-right"></i>
            </button>
        <?php  endif; ?> 
    </div>
</div>
