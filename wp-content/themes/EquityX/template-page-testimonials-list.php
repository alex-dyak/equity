<?php
/*
* Template Name: Testimonials Template
*/

get_header(); ?>


<div class="parallaxHolder">
	<?php if ( get_the_post_thumbnail() ): ?>
		<div class="parallaxHolder-item" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>"></div>
	<?php endif; ?>
</div> <!-- Parallax section -->

<div class="main defaultPage"> <!-- Start main container -->
	<div class="container">
		<div class="defaultSection decoLines decoLines--fourLined">
			<div class="defaultSection-inner">
				<div class="u-clearfix">
					<div class="postContent">

						<?php if ( get_the_title() ): ?>
							<h2 class="vc_custom_heading" style="text-align: center"><?php the_title(); ?></h2>
						<?php endif; ?>

						<?php
						$post_id = 0;
						if (isset($_GET['testimonialId'])) {
							$post_id = $_GET['testimonialId'];
						}

						$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
						$posts_per_page = 2;
						$selected_testimonial = 0;

							do {
								$query_args = array(
									'post_type'           => 'testimonial',
									'posts_per_page'      => $posts_per_page,
									'paged'               => $paged,
									'ignore_sticky_posts' => true,
								);
								$query      = new WP_Query( $query_args );
								if( $post_id == 0 ){

								} else {
									if ( $query->have_posts() ) {
										$post_counter = 0;
										foreach ( $query->posts as $post ) {
											$selected_testimonial = $post->ID;
											if ( $selected_testimonial == $post_id ) {
												$post_counter = 0;
												break;
											} else {
												$post_counter ++;
											}
										}
										if ( $post_counter != 0 ) {
											$paged ++;
										}
									}
								}
							} while ( $selected_testimonial != $post_id );


						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php if ( $post_id == get_the_ID() ) : ?>
									<div class="selected testimonial" style="background: #07bbff;">
										<?php get_template_part( 'templates-part/template-article-testimonials-list' ); ?>
									</div>
									<?php else : ?>
									<?php get_template_part( 'templates-part/template-article-testimonials-list' ); ?>
								<?php endif; ?>

							<?php endwhile; ?>

							<?php if ( function_exists( 'wp_pagenavi' ) ) {
							wp_pagenavi( array(
								'before'        => '<section class="row entityGrid-pagination paginationItem">',
								'after'         => '</section>',
								'wrapper_tag'   => 'div',
								'wrapper_class' => 'nav-links',
								'options'       => array(),
								'query'         => $query,
								'type'          => 'posts',
								'echo'          => true
							) );
						}
							?>
							<?php wp_reset_query(); ?>
						<?php else : ?>
							<h2><?php esc_html_e( 'Nothing Found', 'EquityX' ); ?></h2>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
				<div class="defaultSection">
					<div class="defaultSection-inner joinUs">
						<?php dynamic_sidebar( 'join-us-footer' ); ?>
					</div>
				</div>
			<?php endif; ?>

<?php get_footer(); ?>
