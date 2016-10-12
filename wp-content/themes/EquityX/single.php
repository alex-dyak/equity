<?php
/**
 * The template for displaying all single posts and attachments
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
						<?php if ( have_posts() ) :
							while ( have_posts() ) : the_post(); ?>

								<p class="postContent-link">
									<a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="backToMain">
										<i class="ft-icon-grid"></i><?php echo __( strtoupper( 'Back to main' ), 'EquityX' ); ?>
									</a>
								</p>

								<?php get_template_part( 'templates-part/template-article-post' ); ?>

							<?php endwhile;
						endif; ?>
					</div>
					<div class="postWidgets">
						<!--Place reserved for post widgets -->
						<p>popular posts</p>
						<p>posts by authors</p>
					</div>
				</div>
			</div>
		</div>

<?php get_sidebar(); ?>

<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
	<div class="defaultSection">
		<div class="defaultSection-inner joinUs">
			<?php dynamic_sidebar( 'join-us-footer' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
