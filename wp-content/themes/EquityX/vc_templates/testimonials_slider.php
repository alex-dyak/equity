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
				<div class="testimonials-item" >
					<div class="testimonials-item-inner">
                        <?php if ( has_post_thumbnail() ) :
                            $attachment_id = get_post_thumbnail_id();
                            ?>
                            <a href="<?php echo $meta_values['_testimonial_url'][0] ?>" class="testimonials-image" style="z-index: 1000;">
								<?php if ( ! empty( $meta_values['_testimonial_url'] ) ) : ?>
									<?php echo wp_get_attachment_image( $attachment_id, 'full' ); ?>
								<?php else : ?>
									<?php echo wp_get_attachment_image( $attachment_id, 'full' ); ?>
								<?php endif; ?>
                            </a>
                        <?php endif; ?>
						<?php if( get_field( 'testimonials_logo' ) ) : ?>
							<div class="testimonials-logo">
								<?php echo wp_get_attachment_image( get_field( 'testimonials_logo' ), 'logo_150_111' ); ?>
							</div>
						<?php endif; ?>
						<div class="testimonials-item-innerAlignment">
							<div class="testimonials-excerpt">
								<?php echo
									substr(get_the_excerpt(), 0,120);
								?>...<br>
								<a href="<?php echo add_query_arg('selected_post_id', get_the_ID(), esc_url( home_url() ) . '/testimonials'); ?>">
									<?php _e( 'Read more', 'EquityX' ) ?>
								</a>
							</div>
						</div>
                        <div class="testimonials-authorInfo">
                            <?php if ( ! empty( $meta_values ) ) : ?>
                                <?php if ( ! empty( $meta_values['_testimonial_client'] ) ) : ?>
                                    <div class="testimonials-client">
                                        <?php echo strtoupper( $meta_values['_testimonial_client'][0] ) . ','; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $meta_values['_testimonial_job'] ) ) : ?>
                                    <div class="testimonials-job">
                                        <?php echo strtoupper( $meta_values['_testimonial_job'][0] ); ?>
                                        <?php if ( ! empty( $meta_values['_testimonial_company'] ) ) : ?>
                                            <?php echo '/' . strtoupper( $meta_values['_testimonial_company'][0] ); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php endif;
// Restore original Post Data
wp_reset_postdata();
?>
