<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'clients-logo',
		'posts_per_page' => $quantity,
	);
	$query      = new WP_Query( $query_args );
	?>

	<div class="u-clearfix membersList js-equalItems">
	<?php if ( $query->have_posts() ) :
	while ( $query->have_posts() ) : $query->the_post(); ?>

		<div class="membersList-item" data-equal="1">
			<div class="membersList-item-inner">

				<div class="membersList-item-inner-image membersList-item-inner-image--partnersList">
					<?php if ( ! empty ( get_field( 'image_clients_logo' ) ) ) : ?>
						<a href="<?php echo get_field( 'partners_link' ); ?>" target="_blank">
							<img style="max-width: 200px;" src="<?php echo get_field( 'image_clients_logo' ); ?>" alt="">
						</a>
					<?php endif; ?>
				</div>
				<?php if ( get_the_title() ) : ?>
					<p class="membersList-item-inner-title">
						<?php echo strtoupper( esc_html_e( get_the_title() ) ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>

	<?php endwhile; ?>
<?php endif; ?>
	</div>
<?php endif; ?>
