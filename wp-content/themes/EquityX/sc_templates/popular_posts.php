<?php

// Getting posts from database with WP_Query.
$args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => $limit,
	'ignore_sticky_posts' => TRUE,
	'offset'              => $offset,
	'orderby'             => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ),
	/* this will look at the meta_key you set below */
	'meta_key'            => 'post_views_count',
	'meta_query'          => array(
		array(
			'key'     => 'post_views_count',
			'value'   => array( 0 ),
			'compare' => 'NOT IN'
		),
	),
);
$loop = new WP_Query( $args );

// If count of posts is greater then 0, starting to print posts content on page.
if ( ! empty( $loop ) && $loop->post_count ) : ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li>
			<a href="<?php echo get_permalink(); ?>">
				<h2 id="popular-post-title"><?php the_title(); ?></h2>
			</a>
			<span class="post-date">
				<?php echo get_the_date( 'F, Y' ); ?>
			</span>
		</li>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>

<?php endif; ?>
