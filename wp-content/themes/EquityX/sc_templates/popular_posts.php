<?php
if ( ! $use_plugin ) {
	// Getting posts from database with WP_Query.
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'ignore_sticky_posts' => TRUE,
		'offset'              => $offset,
		'orderby'             => 'meta_value_num',
		/* this will look at the meta_key you set below */
		'meta_key'            => 'post_views_count',
		'order'               => 'DESC',
		'meta_query'          => array(
			array(
				'key'     => 'post_views_count',
				'value'   => array( '0' ),
				'compare' => 'NOT IN'
			),
		),
	);
	$loop = new WP_Query( $args );
} else {
	// Getting posts from Wordpress Popular Posts plugin.
	$query = new Popular_Posts_Data( $limit );
	$items = $query->get_posts();
	$ids   = array();
	foreach ( $items as $item ) {
		if ( isset( $item->id ) ) {
			$ids[] = $item->id;
		}
	}
	$args = array(
		'post__in'            => $ids,
		'orderby'             => 'post__in',
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'ignore_sticky_posts' => TRUE,
		'offset'              => $offset,
	);

	$loop = new WP_Query( $args );
}

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