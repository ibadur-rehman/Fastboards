<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get product
$product = ovabrw_get_rental_product( $args );
if ( !$product ) return;

// Daily prices
$daily_prices = $product->get_daily_prices();

if ( ovabrw_array_exists( $daily_prices ) ): ?>
	<div class="ovabrw-product-weekdays-price">
		<label class="ovabrw-label">
			<?php esc_html_e( 'Table Price', 'remons' ); ?>
			<span class="label-note">
				<?php esc_html_e( '( by day of the week )', 'remons' ); ?>
			</span>
		</label>
		<table class="ovabrw-table">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Weekdays', 'remons' ); ?></th>
					<th><?php esc_html_e( 'Price', 'remons' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $daily_prices as $k => $price ):
					$day = '';

					switch ( $k ) {
						case 'monday':
							$day = esc_html__( 'Monday', 'remons' );
							break;
						case 'tuesday':
							$day = esc_html__( 'Tuesday', 'remons' );
							break;
						case 'wednesday':
							$day = esc_html__( 'Wednesday', 'remons' );
							break;
						case 'thursday':
							$day = esc_html__( 'Thursday', 'remons' );
							break;
						case 'friday':
							$day = esc_html__( 'Friday', 'remons' );
							break;
						case 'saturday':
							$day = esc_html__( 'Saturday', 'remons' );
							break;	
						case 'sunday':
							$day = esc_html__( 'Sunday', 'remons' );
							break;		
						default:
							$day = '';
							break;
					}
				?>
					<tr>
						<td><?php echo esc_html( $day ); ?></td>
						<td><?php echo ovabrw_wc_price( $price ); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>