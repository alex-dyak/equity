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

<!--    <title>--><?php //wp_title( '|', true, 'right' ); ?><!--</title>-->
<!---->
<!--    <meta name="title" content="--><?php //wp_title( '|', true, 'right' ); ?><!--">-->
<!---->
<!--    <meta name="description" content="--><?php //bloginfo( 'description' ); ?><!--"/>-->

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
    if ( isset( get_option( 'w4p_social_profiles' )['linkedin'][1] ) ) {
	    $linkedin_link = get_option( 'w4p_social_profiles' )['linkedin'][1];
    } else {
	    $linkedin_link = '';
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
                <div class="mainNavigation-menuItem">
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

            <?php if ( $linkedin_link ) : ?>
                <div class="mainHeader-social">
                    <a href="<?php echo $linkedin_link; ?>" class="btn btn--hasIcon btn--linkedIn" title="Follow us on LinkedIn" data-linkedin-login>
                    <span class="btn-icon">
                        <svg class="svgIcon btn-icon-svgLinkedin">
                            <use xlink:href="#linkedin" />
                        </svg>
                    </span>
                        <?php _e( 'Connect with LinkedIn', 'EquityX' ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="searchTrigger">
                <a href="#" class="searchTrigger-item js-searchTrigger">
                    <i class="ft-icon-search"></i>
                </a>
            </div>

        </div>
    </header><!-- Header -->
