<?php
/**
 * The front page template file
 */

get_header(); ?>

<!-- FRONT PAGE TEMPLATE -->
<!-- FRONT PAGE TEMPLATE -->
<!-- FRONT PAGE TEMPLATE -->

<div class="parallaxHolder">
    <?php if(get_the_post_thumbnail()): ?>
        <div class="parallaxHolder-item" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url(); ?>"></div>
    <?php endif; ?>
</div> <!-- Parallax section -->

<div class="main"> <!-- Start main container -->
    <div class="container">

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<article class="post" id="post-<?php the_ID(); ?>">

			<?php if ( is_active_sidebar( 'intro-section' ) ) : ?>
				<?php dynamic_sidebar( 'intro-section' ); ?>
			<?php endif; ?>

			<div class="entry">
				<?php the_content(); ?>
			</div>

		</article>

	<?php endwhile;
endif; ?>

<?php get_footer(); ?>
