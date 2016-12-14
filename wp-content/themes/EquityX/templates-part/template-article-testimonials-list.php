<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<div class="testimonials-item">
		<div class="testimonials-item-inner">
			<div class="testimonials-item-innerAlignment">
				<div class="testimonials-excerpt">
					<?php the_content();
					?>
				</div>
				<div class="testimonials-authorInfo">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="testimonials-image">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
					<?php
					$meta_values = get_post_meta( get_the_ID() );
					if ( ! empty( $meta_values ) ) : ?>
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
	</div>

</article>
