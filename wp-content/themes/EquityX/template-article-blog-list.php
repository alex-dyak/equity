<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<?php if( has_post_thumbnail() ): ?>
		<div>
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

	<div class="entry-content">

		<div>
			<?php
			$author_link = get_the_author_posts_link();
			$date        = get_the_date( "F Y" );
			printf( esc_html__( 'by %s &#8212; %s', 'EquityX' ), $author_link, $date ); ?>
		</div>

		<div>
			<?php
			$text           = get_the_content();
			$excerpt_length = apply_filters( 'excerpt_length', 300 );
			$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '' );
			$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
			echo $text;
			?>
		</div>

	</div>

	<div>
		<a href="<?php the_permalink(); ?>" class="btn"><?php _e( 'Read More', 'EquityX' ); ?></a>
	</div>

</article>
