<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    WordPress
 * @subpackage EquityX-Theme
 * @since      EquityX Theme 1.0
 */

get_header(); ?>

<?php
$image = get_option( 'w4p_background_img' );

if ( ! empty( $image ) ): ?>
	<div>
		<img src="<?php echo $image['url']; ?>" alt=""/>
	</div>
<?php endif; ?>


<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<a href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php echo __( strtoupper( 'Back to main' ), 'EquityX' ); ?></a>

		<?php get_template_part( 'template-article-post' ); ?>

	<?php endwhile;
endif; ?>

<?php get_sidebar(); ?>

<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
	<div class="join-us-footer">
		<?php dynamic_sidebar( 'join-us-footer' ); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
