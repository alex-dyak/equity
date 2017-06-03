<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */

get_header(); ?>

<!-- INDEX PAGE TEMPLATE -->
<!-- INDEX PAGE TEMPLATE -->
<!-- INDEX PAGE TEMPLATE -->

<div class="parallaxHolder">
	<?php
	$image = get_option( 'w4p_background_img' );

	if ( ! empty( $image ) ): ?>
		<div class="parallaxHolder-item" data-parallax="scroll" data-image-src="<?php echo $image['url']; ?>"></div>
	<?php endif; ?>
</div> <!-- Parallax section -->

<div class="main defaultPage"> <!-- Start main container -->
	<div class="container">
		<div class="defaultSection decoLines decoLines--fourLined">
			<div class="defaultSection-inner">
				<div class="u-clearfix">
					<div class="postContent">
						<div class="u-clearfix postContent-listingTop">
							<div class="postContent-listingTop-title">
								<h1><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
							</div>

							<div class="searchForm js-searchHolder">
								<?php get_search_form(); ?>
								<span class="searchForm-blocker js-closeSearchForm"></span>
							</div>
						</div>
						<div class="postListing">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'templates-part/template-article-blog-list' ); ?>

							<?php endwhile; ?>

								<section class="row entityGrid-pagination paginationItem">
									<?php echo paginate_links(
										array(
											'prev_text' => __('Prev'),
											'next_text' => __('Next')
										)
									); ?>
								</section>

							<?php else : ?>

								<h2><?php esc_html_e( 'Nothing Found', 'EquityX' ); ?></h2>

							<?php endif; ?>
						</div>
					</div>
					<div class="postWidgets">
						<!--Place reserved for post widgets -->
						<?php get_sidebar(); ?>
					</div>
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


