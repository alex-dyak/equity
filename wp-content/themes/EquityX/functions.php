<?php
/**
 * W4P Theme Functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage W4P-Theme
 * @since W4P Theme 1.0
 */

/**
 * Theme Setup.
 */
function w4ptheme_setup() {
	load_theme_textdomain( 'EquityX', get_template_directory() . '/languages' );
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	add_theme_support( 'post-formats', array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'quote',
			'status',
		)
	);
	register_nav_menu( 'primary', __( 'Navigation Menu', 'EquityX' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'EquityX' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'footer_logo', 240, 89, true );
		add_image_size( 'logo_150_111', 150, 111, true );
		add_image_size( 'logo_300_111', 300, 111, true );
	}

}

add_action( 'after_setup_theme', 'w4ptheme_setup' );

/**
 * Scripts & Styles.
 */
function w4ptheme_scripts_styles() {
	global $wp_styles;

	// Load Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load Stylesheets.
	wp_enqueue_style( 'EquityX-style', get_template_directory_uri() . '/css/application.css', array('js_composer_front') );

	// Jquery
	wp_enqueue_script( 'EquityX-jquery', get_template_directory_uri() . '/js/vendor/jquery.min.js', array(), NULL, TRUE );

	// This is where we put vendors JS functions.
	wp_enqueue_script( 'EquityX-vendor', get_template_directory_uri() . '/js/vendor.min.js', array( 'EquityX-jquery' ), null, true );

	// This is where we put our custom JS functions.
	wp_enqueue_script( 'EquityX-application', get_template_directory_uri() . '/js/app.min.js', array( 'EquityX-jquery' ), null, true );

}

add_action( 'wp_enqueue_scripts', 'w4ptheme_scripts_styles' );

/**
 * WP Title.
 *
 * @param string $title Where something interesting takes place.
 * @param string $sep Separator string.
 *
 * @return string
 */
function w4ptheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'EquityX' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'w4ptheme_wp_title', 10, 2 );

// Custom Menu.
register_nav_menu( 'primary', __( 'Navigation Menu', 'EquityX' ) );


/**
 * Navigation - update coming from twentythirteen.
 */
function post_navigation() {
	echo '<div class="navigation">';
	echo '	<div class="next-posts">' . esc_html( get_next_posts_link( '&laquo; Older Entries' ) ) . '</div>';
	echo '	<div class="prev-posts">' . esc_html( get_previous_posts_link( 'Newer Entries &raquo;' ) ) . '</div>';
	echo '</div>';
}

// Include theme options.
require_once( get_template_directory() . '/inc/options.php' );

// Widgets and Sidebars.
require_once( get_template_directory() . '/inc/widgets-sidebars.php' );

// Custom post types & Taxonomies.
require_once( get_template_directory() . '/inc/custom-post-types.php' );
require_once( get_template_directory() . '/inc/custom-taxonomies.php' );

// Filters and functions to manipulate content.
require_once( get_template_directory() . '/inc/filters.php' );

// Custom shortcodes.
require_once( get_template_directory() . '/inc/shortcodes.php' );

/**
 * Widget Term Items to VC
 */

add_action( 'vc_before_init', 'get_term_items' );
function get_term_items() {
	vc_map( array(
		"name"              => __( "Add Term Item", "EquityX" ),
		"base"              => "bartag",
		"class"             => "",
		"category"          => __( "Content", "EquityX" ),
		'admin_enqueue_js'  => array( get_template_directory_uri() . '/vc_extend/bartag.js' ),
		'admin_enqueue_css' => array(
			get_template_directory_uri() . '/vc_extend/bartag.css' ),
		"params" => array(
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Text", "EquityX" ),
				"param_name"  => "name",
				"value"       => __( "Default param value", "EquityX" ),
				"description" => __( "Description for foo param.", "EquityX" )
			),
			array(
				"type"        => "textarea_html",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Content", "EquityX" ),
				"param_name"  => "content",
				"value"       => __( "<p>Click edit button to change this text.</p>", "EquityX" ),
				"description" => __( "Enter your content.", "EquityX" )
			)
		)
	) );
}

/**
 * Widget Members to VC.
 */
add_action( 'vc_before_init', 'get_members' );
function get_members() {
	vc_map( array(
		"name"     => __( "EquityX members", "EquityX" ),
		"base"     => "equityx_members",
		"class"    => "",
		"category" => __( "Content", "EquityX" ),
		"description" => __( "Members information." ),
		"params"   => array(
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Title", "EquityX" ),
				"param_name"  => "page_title",
			    "value"       => 'Members Quantity'
			),
			array(
				"type"        => "textarea",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Short Description", "EquityX" ),
				"param_name"  => "description",
			),
			array(
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Members Quantity", "EquityX" ),
				"param_name"  => "quantity",
				"description" => __( "Enter Members Quantity.", "EquityX" )
			),

		)
	));
}

class WPBakeryShortCode_equityx_members extends WPBakeryShortCode {
}