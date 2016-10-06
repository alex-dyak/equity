<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'member',
		'posts_per_page' => $quantity,
	    'order'          => 'ASC'
	);
	$query = new WP_Query( $query_args );
	?>

	<?php if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post(); ?>

	<div style="float: left;" class="">
		<ul>
				<li class="member_item">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail(); ?>
				<? endif; ?>
					<?php if ( get_the_title() ) : ?>
						<div class="member-name"><?php echo strtoupper( esc_html_e( get_the_title() ) ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( get_the_content() ) ) : ?>
						<div class="member-content">
							<?php echo strtoupper( strip_tags( get_the_content() ) ); ?>
						</div>
					<?php endif; ?>
					<ul>
						<?php if ( get_field( 'instagram' ) ) : ?>
							<li>
								<a href="<?php echo strip_tags( get_field( 'instagram' ) ); ?>">Insta</a>
							</li>
						<?php endif; ?>
						<?php if ( get_field( 'twitter' ) ) : ?>
							<li>
								<a href="<?php echo strip_tags( get_field( 'twitter' ) ); ?>">Twitter</a>
							</li>
						<?php endif; ?>
					</ul>
				</li>
		</ul>
	</div>

		<?php endwhile; ?>
	<?php endif; ?>
<?php endif; ?>