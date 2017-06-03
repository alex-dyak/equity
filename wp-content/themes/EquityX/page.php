<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */

get_header(); ?>

<!-- DEFAULT PAGE TEMPLATE -->
<!-- DEFAULT PAGE TEMPLATE -->
<!-- DEFAULT PAGE TEMPLATE -->

<div class="main defaultPageTemplate"> <!-- Start main container -->
	<div class="container">

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<article class="post" id="post-<?php the_ID(); ?>">

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile;
endif; ?>

<?php get_footer(); ?>
