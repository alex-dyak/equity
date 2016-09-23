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

		<article class="post" id="post-<?php the_ID(); ?>">

			<h2><?php the_title(); ?></h2>
			<div id="back-img">
				<?php if(get_the_post_thumbnail()): ?>
					<?php the_post_thumbnail(); ?>    <!-- need change imagesize -->
				<?php endif; ?>
			</div>

		</article>

	<?php endwhile;
endif; ?>

<?php get_footer(); ?>
