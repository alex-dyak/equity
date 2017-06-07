<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */
?><!doctype html>

<!--[if lt IE 7 ]>
<html
    class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html
    class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html
    class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head data-template-set="W4P-Theme">

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Always force latest IE rendering engine (even in intranet) -->
    <!--[if IE ]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->

	<?php
	if ( get_option( 'w4p_linkedin_profile' ) ) : ?>
		<?php if ( ! empty( get_option( 'w4p_linkedin_profile' ) ) ) : ?>
			<iframe src="<?php echo get_option( 'w4p_linkedin_profile' ); ?>" height="1" width="1"
			        frameBorder="0"></iframe>
		<?php endif; ?>
	<?php endif; ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="js-wrapper">
    <?php
    if ( isset( get_option( 'w4p_social_profiles' )['login_linkedin'][1] ) ) {
	    $login_linkedin = get_option( 'w4p_social_profiles' )['login_linkedin'][1];
    } else {
	    $login_linkedin = '';
    }
    if ( isset( get_option( 'w4p_social_profiles' )['login_facebook'][1] ) ) {
	    $login_facebook = get_option( 'w4p_social_profiles' )['login_facebook'][1];
    } else {
	    $login_facebook = '';
    }
    if ( isset( get_option( 'w4p_social_profiles' )['login_google'][1] ) ) {
	    $login_google = get_option( 'w4p_social_profiles' )['login_google'][1];
    } else {
	    $login_google = '';
    }
    ?>

    <div class="mobileMenu js-mobWrap">
        <div class="mobileMenu-logo">
            <a href="<?php echo esc_url( home_url() ); ?>"
               title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img
                    src="<?php header_image(); ?>"
                    width="<?php echo esc_attr( get_custom_header()->width ); ?>"
                    height="<?php echo esc_attr( get_custom_header()->height ); ?>"
                    alt=""/></a>
        </div>
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
    </div><!-- Mobile menu -->

    <header id="header" class="mainHeader js-header" role="banner">
        <div class="container u-clearfix">
            <nav id="nav" class="mainNavigation" role="navigation">
                <a href="#" class="hamburger js-mobTrigger">
                    <span></span>
                </a>
                <div class="mainNavigation-menuItem js-hoveredMenu">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                </div>
            </nav>

            <?php
            if ( get_header_image() && ! display_header_text() ) : /* If there's a header image but no header text. */ { ?>
                <a href="<?php echo esc_url( home_url() ); ?>"
                   title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="mainHeader-logo" rel="home"><img
                        src="<?php header_image(); ?>"
                        width="<?php echo esc_attr( get_custom_header()->width ); ?>"
                        height="<?php echo esc_attr( get_custom_header()->height ); ?>"
                        alt=""/></a>
            <?php } elseif ( get_header_image() ) : /* If there's a header image. */ { ?>
                <img class="header-image" src="<?php header_image(); ?>"
                     width="<?php echo absint( get_custom_header()->width ); ?>"
                     height="<?php echo absint( get_custom_header()->height ); ?>"
                     alt=""/>
            <?php } endif; /* End check for header image. */ ?>


	        <div class="mainHeader-social">
				<?php
				if ( isset( get_option( 'w4p_social_profiles' )['login_user_link'][1] ) ) {
					$login_user_link = get_option( 'w4p_social_profiles' )['login_user_link'][1];
				} else {
					$login_user_link = '';
				}
				?>
				<?php if ( $login_user_link ) : ?>
					<a href="<?php echo $login_user_link; ?>" class="btn btn--login" title="<?php _e( 'Login', 'EquityX' ); ?>">
						<?php _e( 'Login', 'EquityX' ); ?>
					</a>
				<?php endif; ?>
                <?php if ( $expert_link ) : ?>
                <a href="<?php echo $expert_link; ?>" class="btn btn--login" title="<?php _e( 'Become an Expert', 'EquityX' ); ?>">
                    <?php _e( 'Become an Expert', 'EquityX' ); ?>
                </a>
                <?php endif; ?>
		        <div id="login-popup" class="loginPopup mfp-hide">
					<div class="loginPopup-deco"></div>
					<div class="loginPopup-inner">
						<div class="loginPopup-title">
							<span class="loginPopup-logo">
								<img
									src="<?php header_image(); ?>"
									width="<?php echo esc_attr( get_custom_header()->width ); ?>"
									height="<?php echo esc_attr( get_custom_header()->height ); ?>"
									alt=""/>
							</span>
							<strong>Login</strong>
							<span>Start Converting Service to Equity</span>
						</div>
						<div class="loginPopup-socials">
							<?php if( ! empty( $_GET ) ) :
								$get_request = '/?';
								$get_request .= http_build_query( $_GET ) . "\n";
								?>
								<?php if ( $login_facebook ) : ?>
									<a href="<?php echo $login_facebook . $get_request; ?>" class="btn btn--hasIcon btn--facebook" title="Connect with Facebook">
										<span class="btn-icon">
											<svg class="svgIcon btn-icon-svgFacebook">
												<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillfacebook"></use>
											</svg>
										</span>
										<?php _e( 'Connect with Facebook', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $login_google ) : ?>
									<a href="<?php echo $login_google . $get_request; ?>" class="btn btn--hasIcon btn--google" title="Connect with Google">
									<span class="btn-icon">
										<svg class="svgIcon btn-icon-svgGoogle">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillgoogle"></use>
										</svg>
									</span>
										<?php _e( 'Connect with Google', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $login_linkedin ) : ?>
									<a href="<?php echo $login_linkedin . $get_request; ?>" class="btn btn--hasIcon btn--linkedIn" title="Connect with LinkedIn">
									<span class="btn-icon">
										<svg class="svgIcon btn-icon-svgLinkedin">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#linkedin"></use>
										</svg>
									</span>
										<?php _e( 'Connect with LinkedIn', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
							<?php else : ?>
								<?php if ( $login_facebook ) : ?>
									<a href="<?php echo $login_facebook; ?>" class="btn btn--hasIcon btn--facebook" title="Connect with Facebook">
									<span class="btn-icon">
										<svg class="svgIcon btn-icon-svgFacebook">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillfacebook"></use>
										</svg>
									</span>
										<?php _e( 'Connect with Facebook', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $login_google ) : ?>
									<a href="<?php echo $login_google; ?>" class="btn btn--hasIcon btn--google" title="Connect with Google">
									<span class="btn-icon">
										<svg class="svgIcon btn-icon-svgGoogle">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillgoogle"></use>
										</svg>
									</span>
										<?php _e( 'Connect with Google', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
								<?php if ( $login_linkedin ) : ?>
									<a href="<?php echo $login_linkedin; ?>" class="btn btn--hasIcon btn--linkedIn" title="Connect with LinkedIn">
									<span class="btn-icon">
										<svg class="svgIcon btn-icon-svgLinkedin">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filllinkedin"></use>
										</svg>
									</span>
										<?php _e( 'Connect with LinkedIn', 'EquityX' ); ?>
									</a>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="loginPopup-terms">
							<?php _e( 'By clicking "Connect" I agree to EquityX\'s ', 'EquityX' ); ?>
							<!--        Navigation      -->
							<nav id="popup-menu" class="loginPopup-menu" role="navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'popup-menu' ) ); ?>
							</nav>
						</div>
					</div>
		        </div>
	        </div>


            <div class="searchTrigger">
                <a href="#" class="searchTrigger-item js-searchTrigger">
                    <i class="ft-icon-search"></i>
                </a>
            </div>

        </div>
    </header><!-- Header -->
