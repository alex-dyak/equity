<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

	<h1 class="entry-title"><?php the_title(); ?></h1>

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
			$excerpt_length = apply_filters( 'excerpt_length', 40 );
			$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '' );
			$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
			echo $text;
			?>
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