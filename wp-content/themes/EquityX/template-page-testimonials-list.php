<?php
/*
* Template Name: Testimonials Template
*/

get_header(); ?>

<!-- TESTIMONIALS PAGE TEMPLATE -->
<!-- TESTIMONIALS PAGE TEMPLATE -->
<!-- TESTIMONIALS PAGE TEMPLATE -->

<div class="main defaultPageTemplate fullWidthSection"> <!-- Start main container -->
	<div class="container">
		<div class="fullWidthSection-row" style="background-color: #fff;">
			<div class="fullWidthSection-row-inner" style="padding-top: 35px;">
				<div class="u-clearfix">
					<?php if ( get_the_title() ): ?>
						<h2 class="vc_custom_heading u-text--center"><?php the_title(); ?></h2>
					<?php endif; ?>
					<div class="testimonialsList">

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
									<div class="u-isAnimated" data-scroll-toselected>
										<?php get_template_part( 'templates-part/template-article-testimonials-list' ); ?>
									</div>
									<?php else : ?>
									<?php get_template_part( 'templates-part/template-article-testimonials-list' ); ?>
								<?php endif; ?>

							<?php endwhile; ?>

							<?php if ( function_exists( 'wp_pagenavi' ) ) {
							wp_pagenavi( array(
								'before'        => '<section class="row entityGrid-pagination paginationItem testimonialsPagination">',
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
				<div class="fullWidthSection-row" style="background-color: #edfaf9 !important;">
					<div class="fullWidthSection-row-inner joinUs">
						<?php dynamic_sidebar( 'join-us-footer' ); ?>
					</div>
				</div>
			<?php endif; ?>

<?php get_footer(); ?>
