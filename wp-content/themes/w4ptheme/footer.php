<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package    WordPress
 * @subpackage W4P-Theme
 * @since      W4P Theme 1.0
 */

?>
		</div>
	</div> <!-- end main container -->
</div><!-- end wrapper -->
<footer id="footer" class="source-org vcard copyright" role="contentinfo">

	<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
		<div class="join-us-footer">
			<?php dynamic_sidebar( 'join-us-footer' ); ?>
		</div>
	<?php endif; ?>

	<!--        Navigation      -->
	<nav id="footer-menu" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
	</nav>

	<!--      / Navigation      -->

	<div class="footer-logo">
		<div class="footer-logo">
			<a target="_self" href="<?php echo get_home_url(); ?>">
				<img class="attachment-240x89"
				     src="<?php echo get_template_directory_uri(); ?>/img/Logo/logo-2in1.png">
			</a>
		</div>
	</div>

	<div class="siteSidebar-footer">
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		<?php endif; ?>
	</div>

	<?php $twitter_link = get_option( 'w4p_social_profiles' )['twitter'][1]; ?>
	<?php $linkedin_link = get_option( 'w4p_social_profiles' )['linkedin'][1]; ?>
	<?php if ( $twitter_link || $linkedin_link ) : ?>
		<div class="footer-social">
			<?php if ( $twitter_link ) : ?>
				<a href="<?php echo $twitter_link; ?>"
				   target="_blank" title="Follow us on Twitter">
					<?php _e( 'Twitter', 'w4ptheme' ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $linkedin_link ) : ?>
				<a href="<?php echo $linkedin_link; ?>"
				   target="_blank" title="Follow us on LinkedIn">
					<?php _e( 'LinkedIn', 'w4ptheme' ); ?>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

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

<div id="svgPlaceholder" class="u-hidden"></div>
<?php wp_footer(); ?>

</body>

</html>
