<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

?>
			<footer id="footer" class="source-org vcard copyright" role="contentinfo">

				<div class="join-us-footer">
					<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
						<?php dynamic_sidebar( 'join-us-footer' ); ?>
					<?php endif; ?>
				</div>

				<!--        Navigation      -->
				<nav id="footer-menu" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
				</nav>

				<!--      / Navigation      -->

				<div class="footer-logo">
					<div class="footer-logo">
						<a  target="_self" href="<?php echo get_home_url(); ?>">
							<img class="attachment-240x89" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'footer_logo' ); ?>">
						</a>
					</div>
				</div>

				<div class="siteSidebar-footer">
					<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
					<?php endif; ?>
				</div>

				<div class="footer-social">
					<a href="<?php echo get_option( 'w4p_social_profiles' )['twitter'][1]; ?>"
					   target="_blank" title="Follow us on Twitter">
						<?php _e('Twitter', 'w4ptheme'); ?>
					</a>
					<a href="<?php echo get_option( 'w4p_social_profiles' )['linkedin'][1]; ?>"
					   target="_blank" title="Follow us on LinkedIn">
						<?php _e('LinkedIn', 'w4ptheme'); ?>
					</a>
				</div>

				<small>
					<?php
					if ( $copyright = get_option( 'w4p_copyright' ) ) {
						echo esc_html( $copyright );
					} else {
						echo sprintf( esc_html__( 'Copyright © %d. %s. All Rights Reserved.', 'w4ptheme' ), date( 'Y' ), get_bloginfo( 'name' ) );
					}
					?>
				</small>
			</footer>

		</div>
		<?php wp_footer(); ?>

	</body>

</html>
