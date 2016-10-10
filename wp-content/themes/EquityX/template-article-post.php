<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="entry-content">

		<div>
			<?php printf( esc_html__( 'by %s &#8212; %s', 'EquityX' ), get_the_author_posts_link(), get_the_date( "F Y" ) ); ?>
		</div>

		<div>
			<?php echo excerpt_trim( 50 ); ?>
		</div>

		<?php if ( has_post_thumbnail() ): ?>
			<div>
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>

		<div>
			<?php the_content(); ?>
		</div>

	</div>

</article>