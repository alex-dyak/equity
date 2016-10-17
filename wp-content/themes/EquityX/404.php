<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */

get_header(); ?>

<div class="parallaxHolder">
    <?php
    $image = get_option( 'w4p_404_background_image' );

    if ( ! empty( $image ) ): ?>
        <div class="parallaxHolder-item" data-parallax="scroll" data-image-src="<?php echo $image['url']; ?>"></div>
    <?php endif; ?>
</div> <!-- Parallax section -->

<div class="main defaultPage defaultPage--short"> <!-- Start main container -->
    <div class="u-clearfix container">
        <div class="notFoundContainer">
            <h1><?php esc_html_e( 'Error 404', 'EquityX' ); ?></h1>
            <p class="notFoundContainer-mainText"><?php esc_html_e( 'We couldn’t find what are you looking for…', 'EquityX' ); ?></p>
            <p class="notFoundContainer-redirectText"><?php esc_html_e( 'Try visiting our', 'EquityX' ); ?>
                <a href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'home page', 'EquityX' ); ?></a> <?php esc_html_e( 'or', 'EquityX' ); ?>
                <a href="<?php echo get_page_link(15); ?>"><?php esc_html_e( 'contact us', 'EquityX' ); ?></a> <?php esc_html_e( 'if it keeps happening.', 'EquityX' ); ?></p>
        </div>

<?php get_footer(); ?>
