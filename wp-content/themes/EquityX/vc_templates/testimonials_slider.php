<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$speed = $autoplay_speed * 1000;

if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1
	);
	$query      = new WP_Query( $query_args );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function () {
				jQuery('.js-slider').slick({
					infinite: true,
					autoplay: true
				});
			}
		)
	</script>
	<div class="testimonials-slidelist js-slider"
	     data-slick='{"slidesToShow": <?php echo $quantity; ?>,
	"slidesToScroll": <?php echo $slides_to_scroll; ?>,
	"autoplaySpeed": <?php echo $speed; ?> }'>
		<?php
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$meta_values = get_post_meta( get_the_ID() );
				?>
				<div class="slide-item">
					<div class="testimonial-excerpt">
						<?php echo the_excerpt(); ?>
					</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="testimonial-image">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $meta_values ) ) : ?>
						<?php if ( ! empty( $meta_values['_testimonial_client'] ) ) : ?>
							<div class="testimonial-client">
								<?php echo
									strtoupper( $meta_values['_testimonial_client'][0] )
									. ',<br/>'; ?>
							</div>
						<?php endif; ?>
						<?php if ( ! empty( $meta_values['_testimonial_job'] ) ) : ?>
							<div class="testimonial-job">
								<?php echo strtoupper( $meta_values['_testimonial_job'][0] ); ?>
								<?php if ( ! empty( $meta_values['_testimonial_company'] ) ) : ?>
									<?php echo '/'
									           . strtoupper( $meta_values['_testimonial_company'][0] ); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php endif;
// Restore original Post Data
wp_reset_postdata();
?>
