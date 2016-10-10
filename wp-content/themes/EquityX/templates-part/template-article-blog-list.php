<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php if( has_post_thumbnail() ): ?>
		<div>
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

	<div class="entry-content">

		<div>
			<?php printf( esc_html__( 'by %s &#8212; %s', 'EquityX' ), get_the_author_posts_link(), get_the_date( "F Y" ) ); ?>
		</div>

		<div>
			<?php echo excerpt_trim( 300 ); ?>
		</div>

	</div>

	<div>
		<a href="<?php the_permalink(); ?>" class="btn"><?php _e( 'Read More', 'EquityX' ); ?></a>
	</div>

</article>
