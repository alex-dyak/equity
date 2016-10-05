<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<article class="post defaultPage" id="post-<?php the_ID(); ?>">

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile;
endif; ?>

<?php get_footer(); ?>
