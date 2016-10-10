<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package    WordPress
 * @subpackage W4P-Theme
 * @since      W4P Theme 1.0
 */

get_header(); ?>

<?php
$image = get_field( 'background_image' );

if ( ! empty( $image ) ): ?>
	<div>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
	</div>
<?php endif; ?>


<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<a href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php echo __( strtoupper( 'Back to main' ), 'EquityX' ); ?></a>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">

				<div>
					<?php _e( 'by ', 'EquityX' ); ?>
					<?php echo get_the_author_posts_link(); ?>    &#8212;
					<?php echo date( "F Y" ); ?>
				</div>

				<div>
					<?php the_excerpt_max_charlength( 200 ); ?>
				</div>

				<div>
					<?php the_post_thumbnail(); ?>
				</div>

				<div>
					<?php _e( 'Photo: ', 'EquityX' ); ?>
					<?php echo get_the_author_posts_link(); ?>    &#8212;
					<?php echo date( "F Y" ); ?>
				</div>

				<div>
					<?php the_content(); ?>
				</div>

			</div>

		</article>

	<?php endwhile;
endif; ?>

<?php get_sidebar(); ?>

<div class="join-us-footer">
	<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
		<?php dynamic_sidebar( 'join-us-footer' ); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
