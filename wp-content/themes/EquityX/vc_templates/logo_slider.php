<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$speed = $autoplay_speed * 1000;

if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'clients-logo',
		'posts_per_page' => $quantity,
		'paged'          => 1,
	);
	$query      = new WP_Query( $query_args );
	?>
	<div class="slick-list js-LogoSlider"
	     data-slick='{"slidesToShow": 1,
	"slidesToScroll": <?php echo $slides_to_scroll; ?>,
	"autoplaySpeed": <?php echo $speed; ?> }'>
		<?php
		if ( $query->have_posts() ) : while ( $query->have_posts() ) :?>
			<div class="slide-container">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="slide-item">
						<?php if ( ! empty ( get_field( 'image_clients_logo' ) ) ) : ?>
							<div class="logo-image">
								<img src="<?php echo get_field( 'image_clients_logo' ); ?>" alt="">
							</div>
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
