<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<h2><?php esc_html_e( 'Search Results', 'EquityX' ); ?></h2>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-article-blog-list' ); ?>

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

<?php get_footer(); ?>
