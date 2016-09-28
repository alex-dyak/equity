<?php
/**
 * The front page template file
 */

get_header(); ?>

<?php if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>

        <article class="post" id="post-<?php the_ID(); ?>">

	        <?php if ( is_active_sidebar( 'intro-section' ) ) : ?>
		        <?php dynamic_sidebar( 'intro-section' ); ?>
	        <?php endif; ?>

        </article>

    <?php endwhile;
endif; ?>

<?php get_footer(); ?>
