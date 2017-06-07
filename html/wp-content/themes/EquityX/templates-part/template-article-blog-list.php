<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php if( has_post_thumbnail() ): ?>
		<div class="postListing-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<h2 class="postListing-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

	<div class="postListing-content">

		<?php if ( get_field( 'post_author' ) ): ?>
			<div class="postListing-content-author">
				<?php echo esc_html__( 'by ', 'EquityX' ) ?>
				<a href="<?php echo add_query_arg( 'post_author_meta', get_field( 'post_author' ), get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
					<?php printf( esc_html__( '%s', 'EquityX' ), get_field( 'author_name', get_field( 'post_author' ) ) ); ?>
				</a>
				<?php printf( esc_html__( ' &#8212; %s', 'EquityX' ), get_the_date( "F Y" ) ); ?>
			</div>
		<?php endif; ?>

		<div class="postListing-content-excerpt">
			<?php echo excerpt_trim( 300 ); ?>
		</div>

	</div>

	<div class="postListing-link">
		<a href="<?php the_permalink(); ?>" class="btn btn--white btn--arrowRight"><?php _e( 'Read More', 'EquityX' ); ?></a>
	</div>

</article>
