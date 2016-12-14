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
						$posts_per_page = 5;
						$query_args = array(
							'post_type'           => 'testimonial',
							'posts_per_page'      => $posts_per_page,
							'paged'               => $paged,
							'ignore_sticky_posts' => true,
						);

						$query = new WP_Query( $query_args );

						$highlight = ! empty( $_GET['highlight_id'] ) ? $_GET['highlight_id'] : null;

						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) : $query->the_post(); ?>
								<?php if ( get_the_ID() == $highlight ) : ?>
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
							<?php
							wp_reset_postdata();
							wp_reset_query();
							?>
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
