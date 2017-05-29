<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$speed = $autoplay_speed * 1000;

if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'clients-logo',
		'posts_per_page' => $quantity,
		'paged'          => 1,
		'clients-category' => $clients_category,
	);
	$query      = new WP_Query( $query_args );
	?>
	<div class="logoSlider js-LogoSlider <?php if ( $css_class ) echo $css_class; ?>"
		 data-slick='{"slidesToShow": 1,
	"slidesToScroll": <?php echo $slides_to_scroll; ?>,
	"autoplaySpeed": <?php echo $speed; ?> }'>
		<?php
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : ?>
				<div class="logoSlider-item">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<div class="logoSlider-item-logo">
							<?php if ( ! empty ( get_field( 'image_clients_logo' ) ) ) : ?>
								<?php if ( ! empty ( get_field( 'partners_link' ) ) ) : ?>
									<a href="<?php echo get_field( 'partners_link' ); ?>" target="_blank"><img src="<?php echo get_field( 'image_clients_logo' ); ?>" alt=""></a>
								<?php else: ?>
									<a href="<?php echo get_home_url() . '/our-partners'; ?>" target="_blank"><img src="<?php echo get_field( 'image_clients_logo' ); ?>" alt=""></a>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php
					$query_args['paged'] ++;
					$query = new WP_Query( $query_args );
					?>
				</div>
			<?php endwhile; ?>
		<?php endif ?>
	</div>
<?php endif;
