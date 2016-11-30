<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$speed = $autoplay_speed * 1000;

if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'clients-logo',
		'posts_per_page' => - 1
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
	<div class="slick-list js-slider"
	     data-slick='{"slidesToShow": <?php echo $quantity; ?>,
	"slidesToScroll": <?php echo $slides_to_scroll; ?>,
	"autoplaySpeed": <?php echo $speed; ?> }'>
		<?php
		if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="slide-item">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="logo-image">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php endif;
// Restore original Post Data
wp_reset_postdata();
