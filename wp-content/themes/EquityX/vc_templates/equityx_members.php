<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


if ( ! empty( $quantity ) ) :
	$query_args = array(
		'post_type'      => 'member',
		'posts_per_page' => $quantity,
		'tax_query' => array(
			array(
				'taxonomy' => 'members_team_groups',
				'field'    => 'name',
				'terms'    => $group
			)
		)
	);
	$query      = new WP_Query( $query_args );
	?>

	<?php if ( ! empty( $page_title ) ) : ?>
		<div class="title"><h3><?php echo strip_tags( $page_title ); ?></h3></div>
	<?php endif; ?>
	<?php if ( ! empty( $description ) ) : ?>
		<div class="description"><?php echo strip_tags( $description ); ?></div>
	<?php endif; ?>
	<div class="u-clearfix membersList js-equalItems">
	<?php if ( $query->have_posts() ) :
	while ( $query->have_posts() ) : $query->the_post(); ?>

		<div class="membersList-item" data-equal="1">
			<div class="membersList-item-inner">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="membersList-item-inner-image">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>
				<?php if ( get_the_title() ) : ?>
					<p class="membersList-item-inner-title">
						<?php echo strtoupper( esc_html_e( get_the_title() ) ); ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( get_the_content() ) ) : ?>
					<div class="membersList-item-inner-content">
						<?php echo strtoupper( strip_tags( get_the_content() ) ); ?>
					</div>
				<?php endif; ?>
				<ul class="u-list--plain membersList-item-inner-contacts">
					<?php if ( get_field( 'linkedin' ) ) : ?>
						<li>
							<a href="<?php echo strip_tags( get_field( 'linkedin' ) ); ?>" class="contactsIco-linkedIn" target="_blank">
								<svg class="svgIcon linkedInFilled">
									<use xlink:href="#filllinkedin" />
								</svg>
							</a>
						</li>
					<?php else : ?>
						<li>
							<span class="contactsIco-linkedIn">
								<svg class="svgIcon linkedInFilled">
									<use xlink:href="#filllinkedin" />
								</svg>
							</span>
						</li>
					<?php endif; ?>

					<?php if ( get_field( 'twitter' ) ) : ?>
						<li>
							<a href="<?php echo strip_tags( get_field( 'twitter' ) ); ?>" class="contactsIco-twitterIco" target="_blank">
								<svg class="svgIcon twitterIco">
									<use xlink:href="#twitter" />
								</svg>
							</a>
						</li>
					<?php else : ?>
						<li>
							<span class="contactsIco-twitterIco">
								<svg class="svgIcon twitterIco">
									<use xlink:href="#twitter" />
								</svg>
							</span>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

	<?php endwhile; ?>
<?php endif; ?>
	</div>
<?php endif; ?>
