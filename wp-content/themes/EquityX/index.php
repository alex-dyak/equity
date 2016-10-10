<?php
/**
 * The main template file
 */

get_header(); ?>

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
				<?php the_excerpt(); ?>
			</div>

			<div>
				<?php the_content(); ?>
			</div>

		</div>

	</article>

<?php endwhile; ?>

	<?php post_navigation(); ?>

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

/////////////////////////////////////////////////<?php
$image = get_field( 'background_image' );

if ( ! empty( $image ) ): ?>
	<div>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
	</div>
<?php endif; ?>


<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-content">

				<div>
					<?php _e( 'by ', 'EquityX' ); ?>
					<?php echo get_the_author_posts_link(); ?>    &#8212;
					<?php echo date( "F Y" ); ?>
				</div>

				<div>
					<?php the_excerpt(); ?>
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


