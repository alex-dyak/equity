<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h1 class="u-text--center entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">

		<?php if ( get_field( 'post_author' ) ): ?>
			<div class="postContent-postBy">
				<?php echo esc_html__( 'by ', 'EquityX' ) ?>
				<a href="<?php echo add_query_arg( 'post_author_meta', get_field( 'post_author' ), get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
					<?php printf( esc_html__( '%s', 'EquityX' ), get_field( 'author_name', get_field( 'post_author' ) ) ); ?>
				</a>
				<?php printf( esc_html__( ' &#8212; %s', 'EquityX' ), get_the_date( "F Y" ) ); ?>
			</div>
		<?php endif; ?>

		<div class="postContent-introText">
			<?php echo excerpt_trim( 50 ); ?>
		</div>

		<?php if ( has_post_thumbnail() ): ?>
			<div class="postContent-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>

		<div class="postContent-text">
			<?php the_content(); ?>
		</div>

	</div>

</article>
