<?php
/**
 * The main template file
 */

get_header(); ?>

<?php
$image = get_field( 'background_image' );

if ( ! empty( $image ) ): ?>
	<div>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
	</div>
<?php endif; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<?php if( has_post_thumbnail() ): ?>
			<div>
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>

		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

		<div class="entry-content">

			<div>
				<?php _e( 'by ', 'EquityX' ); ?>
				<?php echo get_the_author_posts_link(); ?>    &#8212;
				<?php echo date( "F Y" ); ?>
			</div>

			<div>
				<?php the_excerpt_max_charlength( 800 ); ?>
			</div>

		</div>

		<div>
			<a href="<?php the_permalink(); ?>"
			   class="btn"><?php _e( 'Read More', 'EquityX' ); ?></a>
		</div>

	</article>

<?php endwhile; ?>

	<section class="row entityGrid-pagination">
		<section class="column">
			<?php if ( function_exists( 'wp_pagenavi' ) ) {
				wp_pagenavi( array(
					'before'        => '<nav class="navigation pagination" role="navigation">',
					'after'         => '</nav>',
					'wrapper_tag'   => 'div',
					'wrapper_class' => 'nav-links',
					'options'       => array(),
					//'query'         => $the_query,
					'type'          => 'posts',
					'echo'          => true
				) );
			}
			?>

		</section>
	</section>

<?php else : ?>

	<h2><?php esc_html_e( 'Nothing Found', 'EquityX' ); ?></h2>

<?php endif; ?>

<?php get_sidebar(); ?>

<div class="join-us-footer">
	<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
		<?php dynamic_sidebar( 'join-us-footer' ); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>


