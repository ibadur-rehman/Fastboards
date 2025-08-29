<div class="page_404">
	<div class="row_site">
		<div class="container_site">
			<h1 class="title-404">
				<?php echo esc_html__( '404', 'remons' ); ?>
			</h1>
			<h2 class="title">
				<?php echo esc_html__( 'Sorry We Can\'t Find That Page!', 'remons' ); ?>
			</h2>
			<p class="message">
				<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'remons' ); ?>
			</p>
			<?php get_search_form(); ?>	
			<div class="ova-go-home">
				<a href="<?php echo esc_url( home_url() ); ?>">
					<?php echo esc_html__( 'Back To Home', 'remons' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>