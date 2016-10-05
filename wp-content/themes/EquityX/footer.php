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

<footer id="footer" class="source-org vcard copyright footer" role="contentinfo">

	<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
		<div class="container">
			<div class="join-us-footer defaultSection">
				<div class="defaultSection-inner">
					<?php dynamic_sidebar( 'join-us-footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!--        Navigation      -->
	<nav id="footer-menu" class="footer-menu" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
	</nav>

	<!--      / Navigation      -->

	<div class="footer-logo">
		<a target="_self" href="<?php echo get_home_url(); ?>">
			<img class="attachment-240x89"
				 src="<?php echo get_template_directory_uri(); ?>/img/Logo/logo-2in1.png">
		</a>
	</div>

	<div class="footer-sidebar">
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		<?php endif; ?>
	</div>

	<?php
	if ( isset( get_option( 'w4p_social_profiles' )['twitter'][1] ) ) {
		$twitter_link = get_option( 'w4p_social_profiles' )['twitter'][1];
	} else {
		$twitter_link = '';
	}
	if ( isset( get_option( 'w4p_social_profiles' )['twitter'][1] ) ) {
		$linkedin_link = get_option( 'w4p_social_profiles' )['linkedin'][1];
	} else {
		$linkedin_link = '';
	}
	?>
	<?php if ( $twitter_link || $linkedin_link ) : ?>
		<div class="footer-social">
			<?php if ( $twitter_link ) : ?>
				<a href="<?php echo $twitter_link; ?>" class="socialLink socialLink--tw"
				   target="_blank" title="Follow us on Twitter">
					<span>
						<svg class="svgIcon svgTwitter">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#twitter"></use>
						</svg>
					</span>
				</a>
			<?php endif; ?>
			<?php if ( $linkedin_link ) : ?>
				<a href="<?php echo $linkedin_link; ?>" class="socialLink socialLink--in"
				   target="_blank" title="Follow us on LinkedIn">
					<span>
						<svg class="svgIcon svgLinkedin">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#linkedin"></use>
						</svg>
					</span>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="footer-credentials">
		<?php
		if ( $copyright = get_option( 'w4p_copyright' ) ) {
			echo esc_html( $copyright );
		} else {
			echo sprintf( esc_html__( 'Copyright © %d. %s. All Rights Reserved.', 'EquityX' ), date( 'Y' ), get_bloginfo( 'name' ) );
		}
		?>
	</div>
</footer>

<div id="svgPlaceholder" class="u-hidden"></div>
<?php wp_footer(); ?>

</body>

</html>
