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
	<div class="testimonialsSlider js-testimonialsSlider"
	     data-slick='{"slidesToShow": <?php echo $quantity; ?>,
	"slidesToScroll": <?php echo $slides_to_scroll; ?>,
	"autoplaySpeed": <?php echo $speed; ?> }'>
		<?php
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$meta_values = get_post_meta( get_the_ID() );
				?>
				<a href="<?php echo esc_url( home_url() ) . '/testimonials' . '/?testimonialId=' . get_the_ID(); ?>" class="testimonialsSlider-item">
					<div class="testimonialsSlider-item-inner">
						<div class="testimonialsSlider-item-innerAlignment">
							<div class="testimonialsSlider-excerpt">
								<?php echo
									substr(get_the_excerpt(), 0,350);
								?>
							</div>
							<div class="testimonialsSlider-authorInfo">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="testimonialsSlider-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php endif; ?>
								<?php if ( ! empty( $meta_values ) ) : ?>
									<?php if ( ! empty( $meta_values['_testimonial_client'] ) ) : ?>
										<div class="testimonialsSlider-client">
											<?php echo
												strtoupper( $meta_values['_testimonial_client'][0] )
												. ','; ?>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $meta_values['_testimonial_job'] ) ) : ?>
										<div class="testimonialsSlider-job">
											<?php echo strtoupper( $meta_values['_testimonial_job'][0] ); ?>
											<?php if ( ! empty( $meta_values['_testimonial_company'] ) ) : ?>
												<?php echo '/'
													. strtoupper( $meta_values['_testimonial_company'][0] ); ?>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</a>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php endif;
// Restore original Post Data
wp_reset_postdata();
?>
