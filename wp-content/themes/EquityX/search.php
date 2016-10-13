<?php
/**
 * The template for displaying search results pages
 *
 * @package    WordPress
 * @subpackage EquityX-Theme
 * @since      EquityX Theme 1.0
 */

get_header(); ?>

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
						<?php if ( have_posts() ) : ?>
						<div class="u-clearfix postContent-listingTop">
							<div class="postContent-listingTop-title">
								<h1><?php esc_html_e( 'Search Results for: ', 'EquityX' ); ?><?php echo $s; ?></h1>
							</div>

							<div class="searchForm js-searchHolder">
								<?php get_search_form(); ?>
								<span class="searchForm-blocker js-closeSearchForm"></span>
							</div>
						</div>
						<div class="postListing">
							<?php while ( have_posts() ) : the_post(); ?>

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

						</div>
						<?php else : ?>
						<div class="u-clearfix postContent-listingTop">
							<div class="postContent-listingTop-title">
								<h1><?php esc_html_e( 'Nothing Found', 'EquityX' ); ?></h1>
							</div>

							<div class="searchForm js-searchHolder">
								<?php get_search_form(); ?>
								<span class="searchForm-blocker js-closeSearchForm"></span>
							</div>
						</div>
						<div class="postListing">
						</div>
						<?php endif; ?>
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
