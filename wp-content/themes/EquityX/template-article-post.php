<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h1 class="u-text--center entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">

		<div class="postContent-postBy">
			<?php printf( esc_html__( 'by %s &#8212; %s', 'EquityX' ), get_the_author_posts_link(), get_the_date( "F Y" ) ); ?>
		</div>

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
<?php
$meta = get_post_meta( get_the_ID(), 'post_author', true );
die();
?>