<?php
/**
 * EquityX Theme Functions and definitions
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
 * @link       https://codex.wordpress.org/Theme_Development
 * @link       https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package    WordPress
 * @subpackage EquityX-Theme
 * @since      EquityX Theme 1.0
 */

/**
 * Theme Setup.
 */
function w4ptheme_setup() {
	load_theme_textdomain( 'EquityX', get_template_directory() . '/languages' );
	add_theme_support( 'structured-post-formats', [ 'link', 'video' ] );
	add_theme_support( 'post-formats', [
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'quote',
			'status',
		]
	);
	register_nav_menu( 'primary', __( 'Navigation Menu', 'EquityX' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'EquityX' ) );
	register_nav_menu( 'popup-menu', __( 'Popup Menu', 'EquityX' ) );
	register_nav_menu( 'mobile-menu', __( 'Mobile Menu', 'EquityX' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	// Add image size.
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'testimonial_size', 300, 205, TRUE );
	}

	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'footer_logo', 240, 89, TRUE );
		add_image_size( 'logo_150_111', 150, 111, TRUE );
		add_image_size( 'logo_300_111', 300, 111, TRUE );
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
	wp_enqueue_style( 'EquityX-style',
		get_template_directory_uri() . '/css/application.css',
		[ 'js_composer_front' ] );

	// Jquery
	wp_enqueue_script( 'EquityX-jquery',
		get_template_directory_uri() . '/js/vendor/jquery.min.js', [], NULL,
		TRUE );

	// This is where we put vendors JS functions.
	wp_enqueue_script( 'EquityX-vendor',
		get_template_directory_uri() . '/js/vendor.min.js',
		[ 'EquityX-jquery' ], NULL, TRUE );

	// This is where we put our custom JS functions.
	wp_enqueue_script( 'EquityX-application',
		get_template_directory_uri() . '/js/app.min.js', [ 'EquityX-jquery' ],
		NULL, TRUE );

	// This is where we put slick JS functions.
	wp_enqueue_script( 'EquityX-slick',
		get_template_directory_uri() . '/inc/js/slick.min.js',
		[ 'EquityX-jquery' ], NULL, TRUE );

	// Load Stylesheets.
	wp_enqueue_style( 'EquityX-slick-style',
		get_template_directory_uri() . '/inc/css/slick.css',
		[ 'js_composer_front' ] );
}

add_action( 'wp_enqueue_scripts', 'w4ptheme_scripts_styles' );

/**
 * WP Title.
 *
 * @param string $title Where something interesting takes place.
 * @param string $sep   Separator string.
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'EquityX' ),
				max( $paged, $page ) );
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
	echo '	<div class="next-posts">'
	     . esc_html( get_next_posts_link( '&laquo; Older Entries' ) )
	     . '</div>';
	echo '	<div class="prev-posts">'
	     . esc_html( get_previous_posts_link( 'Newer Entries &raquo;' ) )
	     . '</div>';
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

// Classes for VC widgets.
require_once( get_template_directory()
              . '/inc/WPBakeryShortCode_equityx_members.php' );
require_once( get_template_directory()
              . '/inc/WPBakeryShortCode_testimonials_slider.php' );
require_once( get_template_directory()
              . '/inc/WPBakeryShortCode_logo_slider.php' );
require_once( get_template_directory()
              . '/inc/WPBakeryShortCode_equityx_partners.php' );
require_once( get_template_directory()
              . '/inc/WPBakeryShortCode_equityx_form.php' );

/**
 * Custom excerpt trim.
 */
function excerpt_trim( $length ) {
	$text           = get_the_content();
	$excerpt_length = apply_filters( 'excerpt_length', $length );
	$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '' );
	$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	$text           = str_replace( '[embed]', '', $text );
	$text           = str_replace( '[/embed]', '', $text );

	return $text;
}

/**
 * Register taxonomy members
 */
add_action( 'vc_before_init', 'create_taxonomy_member', 1 );
function create_taxonomy_member() {
	$labels = [
		'name'              => 'Groups',
		'singular_name'     => 'Group',
		'search_items'      => 'Search Groups',
		'all_items'         => 'All Groups',
		'parent_item'       => 'Parent Group',
		'parent_item_colon' => 'Parent Group:',
		'edit_item'         => 'Edit Group',
		'update_item'       => 'Update Group',
		'add_new_item'      => 'Add New Group',
		'new_item_name'     => 'New Group Name',
		'menu_name'         => 'Team Groups',
	];
	$args   = [
		'label'                 => '',
		'labels'                => $labels,
		'description'           => '',
		'public'                => TRUE,
		'publicly_queryable'    => NULL,
		'show_in_nav_menus'     => TRUE,
		'show_ui'               => TRUE,
		'show_tagcloud'         => FALSE,
		'hierarchical'          => TRUE,
		'update_count_callback' => '',
		'rewrite'               => TRUE,
		'capabilities'          => [],
		'meta_box_cb'           => NULL,
		'show_admin_column'     => TRUE,
		'_builtin'              => FALSE,
		'show_in_quick_edit'    => NULL,
	];
	register_taxonomy( 'members_team_groups', [ 'member' ], $args );
}

/**
 * Widget Members to VC.
 */
add_action( 'vc_before_init', 'get_members', 9999 );
function get_members() {
	$args      = [
		'type' => 'member',
	];
	$terms     = get_terms( 'members_team_groups', [ 'hide_empty' => FALSE ] );
	$term_name = [];
	foreach ( $terms as $term ) {
		$term_name[] = $term->name;
	}

	vc_map( [
		"name"        => __( "EquityX members", "EquityX" ),
		"base"        => "equityx_members",
		"class"       => "",
		"category"    => __( "Content", "EquityX" ),
		"description" => __( "Members information." ),
		"params"      => [
			[
				"type"       => "textfield",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Title", "EquityX" ),
				"param_name" => "page_title",
				"value"      => 'Members Quantity',
			],
			[
				"type"       => "textarea",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Short Description", "EquityX" ),
				"param_name" => "description",
			],
			[
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Members Quantity", "EquityX" ),
				"param_name"  => "quantity",
				"description" => __( "Enter Members Quantity.", "EquityX" ),
			],
			[
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Members Group", "EquityX" ),
				"param_name"  => "group",
				"description" => __( "Select the Members Group.", "EquityX" ),
				"value"       => $term_name,
			],

		],
	] );
}

/**
 * Register taxonomy Clients Logo
 */
add_action( 'vc_before_init', 'create_taxonomy_logo', 1 );
function create_taxonomy_logo() {
	// Registering custom taxonomy called location
	$labels = [
		'name'              => _x( 'Clients Categories',
			'taxonomy general name' ),
		'singular_name'     => _x( 'Clients Category',
			'taxonomy singular name' ),
		'search_items'      => __( 'Search Clients Categories' ),
		'all_items'         => __( 'All Clients Categories' ),
		'parent_item'       => __( 'Parent Clients Category' ),
		'parent_item_colon' => __( 'Parent Clients Category:' ),
		'edit_item'         => __( 'Edit Clients Category' ),
		'update_item'       => __( 'Update Clients Category' ),
		'add_new_item'      => __( 'Add New Clients Category' ),
		'new_item_name'     => __( 'New State Clients Category' ),
		'menu_name'         => __( 'Clients Category' ),
	];

	$args = [
		'label'                 => '',
		'labels'                => $labels,
		'description'           => '',
		'public'                => TRUE,
		'publicly_queryable'    => NULL,
		'show_in_nav_menus'     => TRUE,
		'show_ui'               => TRUE,
		'show_tagcloud'         => FALSE,
		'hierarchical'          => TRUE,
		'update_count_callback' => '',
		'rewrite'               => TRUE,
		'capabilities'          => [],
		'meta_box_cb'           => NULL,
		'show_admin_column'     => TRUE,
		'_builtin'              => FALSE,
		'show_in_quick_edit'    => NULL,
	];
	// Registering location taxonomy to post_type post
	register_taxonomy( 'clients-category', 'clients-logo', $args );

}

/**
 * Widget Partners to VC.
 */
add_action( 'vc_before_init', 'get_partners', 9999 );
function get_partners() {
	$args  = [
		'taxonomy' => 'clients-category',
	];
	$terms = get_terms( $args );
	foreach ( $terms as $term ) {
		$term_name[ $term->slug ] = $term->name;
	}

	vc_map( [
		"name"        => __( "EquityX partners", "EquityX" ),
		"base"        => "equityx_partners",
		"class"       => "",
		"category"    => __( "Content", "EquityX" ),
		"description" => __( "Partners information." ),
		"params"      => [
			[
				"type"       => "textfield",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Title", "EquityX" ),
				"param_name" => "page_title",
				"value"      => 'Partners Quantity',
			],
			[
				"type"       => "dropdown",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Clients Category", "EquityX" ),
				"param_name" => "clients_category",
				"value"      => $term_name,
			],
			[
				"type"       => "textarea",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Short Description", "EquityX" ),
				"param_name" => "description",
			],
			[
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Partners Quantity", "EquityX" ),
				"param_name"  => "quantity",
				"description" => __( "Enter Partners Quantity in row.",
					"EquityX" ),
			],
		],
	] );
}

/**
 * To display number of posts.
 *
 * @param $postID current post/page id
 *
 * @return string
 */
function w4ptheme_get_post_view( $postID ) {
	$count_key = 'post_views_count';
	$count     = (int) get_post_meta( $postID, $count_key, TRUE );
	if ( ! $count ) {
		update_post_meta( $postID, $count_key, 0 );
	}

	return $count;
}

/**
 * To count number of views and store in database.
 *
 * @param $postID currently viewed post/page
 */
function w4ptheme_set_post_view( $postID ) {
	$count_key = 'post_views_count';
	$count     = (int) get_post_meta( $postID, $count_key, TRUE );
	update_post_meta( $postID, $count_key, ++ $count );
}

/**
 * Add a new column in the wp-admin posts list
 */
function w4ptheme_columns_head( $columns ) {
	$columns['views'] = 'Views';

	return $columns;
}

add_filter( 'manage_edit-post_columns', 'w4ptheme_columns_head' );

/**
 * Add rows.
 */
function w4ptheme_custom_column( $column, $post_id ) {
	switch ( $column ) {
		case 'views':
			$views_value = w4ptheme_get_post_view( $post_id );
			echo intval( $views_value );
			break;
	}
}

add_action( 'manage_post_posts_custom_column', 'w4ptheme_custom_column', 10,
	2 );

/**
 * Define sortable column.
 */
function w4ptheme_post_table_sorting( $columns ) {
	$columns['views'] = 'views';

	return $columns;
}

add_filter( 'manage_edit-post_sortable_columns',
	'w4ptheme_post_table_sorting' );

/**
 * Add sortable column data.
 */
function w4ptheme_post_column_orderby( $vars ) {
	if ( isset( $vars['orderby'] ) && 'views' == $vars['orderby'] ) {
		$vars = array_merge( $vars, [
			'meta_key' => 'post_views_count',
			'orderby'  => 'meta_value_num',
		] );
	}

	return $vars;
}

/**
 * Auto add and update Author post title field.
 *
 * @param $post_id
 */
function w4ptheme_author_post_title_update( $post_id ) {
	if ( get_post_type() == 'post_author' ) {
		$my_post               = [];
		$my_post['ID']         = $post_id;
		$my_post['post_title'] = get_field( 'author_name' );
		$my_post['post_name']  = sanitize_title( get_field( 'author_name' ) );
		// Update the post into the database
		wp_update_post( $my_post );
	}
}

/**
 * Run after ACF saves the $_POST['fields'] data
 */
add_action( 'acf/save_post', 'w4ptheme_author_post_title_update', 20 );

/**
 * Add custom query vars.
 */
function w4ptheme_query_vars_filter( $vars ) {
	$vars[] = 'post_author_meta';

	return $vars;
}

add_filter( 'query_vars', 'w4ptheme_query_vars_filter' );

/**
 * Build a custom query
 *
 * @param $query obj The WP_Query instance (passed by reference)
 *
 * @link https://codex.wordpress.org/Class_Reference/WP_Query
 * @link https://codex.wordpress.org/Class_Reference/WP_Meta_Query
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 */
function w4ptheme_pre_get_posts( $query ) {
	// Check if the user is requesting an admin page
	// or current query is not the main query
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	$meta_query = [];
	// add meta_query elements
	if ( ! empty( $query->query['post_author_meta'] ) ) {
		$meta_query[] = [
			'key'     => 'post_author',
			'value'   => get_query_var( 'post_author_meta' ),
			'compare' => '=',
		];
	}

	if ( count( $meta_query ) > 0 ) {
		$query->set( 'meta_query', $meta_query );
	}

	if ( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}

	return $query;
}

add_action( 'pre_get_posts', 'w4ptheme_pre_get_posts', 1 );
add_filter( 'request', 'w4ptheme_post_column_orderby' );

/**
 * VC testimonials slider
 */
add_action( 'vc_before_init', 'testimonials_slider' );
function testimonials_slider() {
	vc_map(
		[
			'name'        => __( 'Testimonials Slider' ),
			'base'        => 'testimonials_slider',
			'icon'        => 'icon-wpb-slideshow',
			'category'    => __( 'Content' ),
			'description' => __( 'Slider with testimonials.' ),
			'params'      => [
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Testimonials in Slide", "EquityX" ),
					'value'       => 3,
					"param_name"  => "quantity",
					"description" => __( "Enter Quantity Testimonials in Slide.",
						"EquityX" ),
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Testimonials to Scroll", "EquityX" ),
					'value'       => 3,
					"param_name"  => "slides_to_scroll",
					"description" => __( "Enter Quantity Testimonials to Scroll.",
						"EquityX" ),
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Autoplay Speed (sec)", "EquityX" ),
					'value'       => 2,
					"param_name"  => "autoplay_speed",
					"description" => __( "Enter the autoplay speed.",
						"EquityX" ),
				],
			],
		]
	);
}

/**
 * VC Clients logo slider
 */
add_action( 'vc_before_init', 'logo_slider' );
function logo_slider() {
	$args  = [
		'taxonomy' => 'clients-category',
	];
	$terms = get_terms( $args );
	foreach ( $terms as $term ) {
		$term_name[ $term->slug ] = $term->name;
	}

	vc_map(
		[
			'name'        => __( 'Clients Logo Slider' ),
			'base'        => 'logo_slider',
			'icon'        => 'icon-wpb-slideshow',
			'category'    => __( 'Content' ),
			'description' => __( 'Slider with Clients Logo.' ),
			'params'      => [
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Logo in Slide", "EquityX" ),
					'value'       => 10,
					"param_name"  => "quantity",
					"description" => __( "Enter Quantity Logo in Slide.",
						"EquityX" ),
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Clients Category", "EquityX" ),
					"param_name" => "clients_category",
					"value"      => $term_name,
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Slide to Scroll", "EquityX" ),
					'value'       => 1,
					"param_name"  => "slides_to_scroll",
					"description" => __( "Enter Quantity Logo to Scroll.",
						"EquityX" ),
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Autoplay Speed (sec)", "EquityX" ),
					'value'       => 2,
					"param_name"  => "autoplay_speed",
					"description" => __( "Enter the autoplay speed.",
						"EquityX" ),
				],
				[
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Custom CSS class", "EquityX" ),
					"param_name"  => "css_class",
					"description" => __( "Enter Custom CSS class.", "EquityX" ),
				],
			],
		]
	);
}

/**
 * Function get selected testimonial and redirect.
 */
function get_selected_testimonial() {
	global $post;

	$paged                = get_query_var( 'paged' )
		? absint( get_query_var( 'paged' ) ) : 1;
	$posts_per_page       = 5;
	$selected_testimonial = 0;

	if ( ! empty( $_GET['selected_post_id'] ) ) {
		$post_id = $_GET['selected_post_id'];
		if ( ! isset( $post_id ) ) {
			$post_id = 0;
		}

		do {
			$query_args = [
				'post_type'           => 'testimonial',
				'posts_per_page'      => $posts_per_page,
				'paged'               => $paged,
				'ignore_sticky_posts' => TRUE,
			];

			$query = new WP_Query( $query_args );

			if ( $post_id == 0 ) {
				break;
			} else {
				if ( $query->have_posts() ) {
					$post_counter = 0;
					foreach ( $query->posts as $post ) {
						$selected_testimonial = $post->ID;
						if ( $selected_testimonial == $post_id ) {
							$post_counter = 0;
							break;
						} else {
							$post_counter ++;
						}
					}
					if ( $post_counter != 0 ) {
						$paged ++;
					}
				}
			}

			wp_reset_postdata();
			wp_reset_query();
		} while ( $selected_testimonial != $post_id );

		$paged = ! $paged ? 1 : $paged;

		$link = add_query_arg( 'highlight_id', $post_id,
			get_permalink( $post->ID ) . 'page/' . $paged . '/' );

		wp_redirect( $link );

		exit;

	}
	//	else if ( ! empty( $_GET['selected_post_id'] ) && get_option( 'selected_post_id' ) ) {
	//		wp_redirect( WP_HOME . $_SERVER['REDIRECT_URL'] );
	//	}
}

add_action( 'wp', 'get_selected_testimonial' );

add_filter( 'wp_pagenavi_class_previouspostslink', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_nextpostslink', 'theme_pagination_class' );
add_filter( 'wp_pagenavi_class_page', 'theme_pagination_class' );

function theme_pagination_class( $class_name ) {
	switch ( $class_name ) {
		case 'previouspostslink':
			$class_name = 'prev';
			break;
		case 'nextpostslink':
			$class_name = 'next';
			break;
		case 'page':
			$class_name = 'current';
			break;
	}

	return $class_name;
}

/*
 * Register template redirect action callback.
 */
add_action( 'template_redirect', 'meks_remove_wp_archives' );

/**
 * Remove archives
 */
function meks_remove_wp_archives() {
	//If we are on category or tag or date or author archive
	if ( is_category() || is_tag() || is_date() || is_author() ) {
		global $wp_query;
		$wp_query->set_404(); //set to 404 not found page
	}
}

/**
 * Add Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/////////////////////////////////
add_filter( 'cron_schedules', 'add_cron_interval' );

function add_cron_interval( $schedules ) {
	$schedules['30_sec'] = [
		'interval' => 30,
		'display'  => esc_html__( 'Every 30 Seconds' ),
	];
	$schedules['5_min']  = [
		'interval' => 300,
		'display'  => esc_html__( 'Every 5 minute' ),
	];

	return $schedules;
}

//wp_clear_scheduled_hook( 'startup_experts_update' );
//wp_clear_scheduled_hook( 'start_number_to_day' );
///////////////////////////////////////////

/**
 * Cron schedule.
 */
if ( ! wp_next_scheduled( 'startup_experts_update' ) ) {
	wp_schedule_event( time(), '30_sec', 'startup_experts_update' );
}
add_action( 'startup_experts_update', 'startup_experts' );

if ( ! wp_next_scheduled( 'start_number_to_day' ) ) {
	wp_schedule_event( time(), 'daily', 'start_number_to_day' );
}
add_action( 'start_number_to_day', 'start_number_to_day_update' );

function startup_experts() {
	if ( have_rows( 'startup_and_expert_block', 'option' ) ) {
		while ( have_rows( 'startup_and_expert_block', 'option' ) ) {
			the_row();
			if ( get_row_layout() == 'startup_block' ) {
				$start_number_to_day = get_sub_field( 'start_number_to_day' );
				$random              = mt_rand( - 5, 2 );
				if ( $random > 0 ) {
					$current_number = get_sub_field( 'current_number' )
					                  + $random;
				} else {
					$current_number = get_sub_field( 'current_number' );
				}
				$numbers_differents = $current_number - $start_number_to_day;
				if ( $numbers_differents <= 5 ) {
					update_sub_field( 'current_number', $current_number );
				}
			}
			if ( get_row_layout() == 'expert_block' ) {
				$start_number_to_day = get_sub_field( 'start_number_to_day' );
				$random              = mt_rand( - 3, 5 );
				if ( $random > 0 ) {
					$current_number = get_sub_field( 'current_number' )
					                  + $random;
				} else {
					$current_number = get_sub_field( 'current_number' );
				}
				$numbers_differents = $current_number - $start_number_to_day;
				if ( $numbers_differents <= 20 ) {
					update_sub_field( 'current_number', $current_number );
				}
			}
		}
	} // loop through the rows of data
}

function start_number_to_day_update() {
	if ( have_rows( 'startup_and_expert_block', 'option' ) ) {
		while ( have_rows( 'startup_and_expert_block', 'option' ) ) {
			the_row();
			if ( get_row_layout() == 'startup_block' ) {
				$current_number = get_sub_field( 'current_number' );
				update_sub_field( 'start_number_to_day', $current_number );
			}
			if ( get_row_layout() == 'expert_block' ) {
				$current_number = get_sub_field( 'current_number' );
				update_sub_field( 'start_number_to_day', $current_number );
			}
		}
	} // loop through the rows of data
}

/**
 * Widget Form to VC.
 */
add_action( 'vc_before_init', 'equityx_form', 9999 );
function equityx_form() {

	vc_map( [
		"name"        => __( "EquityX Form", "EquityX" ),
		"base"        => "equityx_form",
		"class"       => "",
		"category"    => __( "Content", "EquityX" ),
		"description" => __( "Create custom form." ),
		"params"      => [
			[
				"type"       => "checkbox",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Choose fields for the form", "EquityX" ),
				"param_name" => "first_name",
				"value"      => [ 'First Name' => 'first_name' ],
			],
			[
				"type"       => "checkbox",
				"holder"     => "div",
				"class"      => "",
				"param_name" => "last_name",
				'value'      => [ 'Last Name' => 'last_name' ],
			],
			[
				"type"       => "checkbox",
				"holder"     => "div",
				"class"      => "",
				"param_name" => "company",
				'value'      => [ 'Company' => 'company' ],
			],
			[
				"type"       => "checkbox",
				"holder"     => "div",
				"class"      => "",
				"param_name" => "email",
				'value'      => [ 'Email' => 'email' ],
			],
			[
				"type"       => "checkbox",
				"holder"     => "div",
				"class"      => "",
				"param_name" => "who_are_you",
				'value'      => [ 'Who are you' => 'who_are_you' ],
			],
			[
				"type"        => "textfield",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Submit Button Text", "EquityX" ),
				"param_name"  => "submit_text",
				"description" => __( "Choose the submit button text",
					"EquityX" ),
			],
			[
				"type"       => "textfield",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Mail To:", "EquityX" ),
				"param_name" => "mail_to",
			],
			[
				"type"       => "textfield",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Mail From:", "EquityX" ),
				"param_name" => "mail_from",
			],
			[
				"type"       => "textfield",
				"holder"     => "div",
				"class"      => "",
				"heading"    => __( "Mail Subject:", "EquityX" ),
				"param_name" => "mail_subject",
			],
		],
	] );
}

add_action( 'init', 'form_records_ct' );
function form_records_ct() {

	$labels = [
		'name'               => __( 'Form Records', "EquityX" ),
		'singular_name'      => __( 'Form Record', "EquityX" ),
		'add_new'            => __( 'Add New', "EquityX" ),
		'add_new_item'       => __( 'Add New Form Record', "EquityX" ),
		'edit_item'          => __( 'Edit Form Record', "EquityX" ),
		'new_item'           => __( 'New Form Record', "EquityX" ),
		'all_items'          => __( 'All Form Records', "EquityX" ),
		'view_item'          => __( 'View Form Record', "EquityX" ),
		'search_items'       => __( 'Search Form Records', "EquityX" ),
		'not_found'          => __( 'No Form Records found', "EquityX" ),
		'not_found_in_trash' => __( 'No Form Records found in Trash',
			"EquityX" ),
		'menu_name'          => __( 'Form Records', "EquityX" ),
	];

	$supports = [ 'title', 'editor' ];

	$slug = get_theme_mod( 'form_record_permalink' );
	$slug = ( empty( $slug ) ) ? 'event' : $slug;

	$args = [
		'labels'             => $labels,
		'public'             => TRUE,
		'publicly_queryable' => TRUE,
		'show_ui'            => TRUE,
		'show_in_menu'       => TRUE,
		'query_var'          => TRUE,
		'rewrite'            => [ 'slug' => $slug ],
		'capability_type'    => 'post',
		'has_archive'        => TRUE,
		'hierarchical'       => FALSE,
		'menu_position'      => NULL,
		'supports'           => $supports,
	];

	register_post_type( 'form-record', $args );

}

add_filter( 'manage_posts_columns', 'form_record_table_head', 10, 2 );
function form_record_table_head( $defaults, $post_type ) {
	if ( $post_type == 'form-record' ) {
		$defaults['email']     = 'Email';
		$defaults['company']   = 'Company';
		$defaults['sender']    = 'Sent By';
		$defaults['who_you']   = 'Who Are You';
		$defaults['page_name'] = 'Form Page';

		return $defaults;
	} else {
		return $defaults;
	}
}

add_action( 'manage_posts_custom_column', 'form_record_table_content', 10, 2 );
function form_record_table_content( $column_name, $post_id ) {
	if ( $column_name == 'email' ) {
		echo get_post_meta( $post_id, '_equityx_email', TRUE );
	}
	if ( $column_name == 'company' ) {
		echo get_post_meta( $post_id, '_equityx_company', TRUE );
	}

	if ( $column_name == 'sender' ) {
		echo get_post_meta( $post_id, '_equityx_sender', TRUE );
	}

	if ( $column_name == 'who_you' ) {
		echo get_post_meta( $post_id, '_equityx_who_you', TRUE );
	}

	if ( $column_name == 'page_name' ) {
		echo get_post_meta( $post_id, '_equityx_page_name', TRUE );
	}

}

add_action( 'wp_enqueue_scripts', 'equityx_form_add_script' );
function equityx_form_add_script() {
	wp_enqueue_script( 'equityx_form-script',
		get_template_directory_uri() . '/js/custom/ajax-form-script.js',
		[ 'jquery' ] );
	wp_localize_script( 'equityx_form-script', 'ajax_object',
		[ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
}

function ajax_equityx_form_action_callback() {
	$error  = '';
	$status = 'error';
	if ( empty( $_POST['first_name'] ) || empty( $_POST['email'] ) ) {
		$error = 'All fields are required to enter.';
	} else {
		if ( ! wp_verify_nonce( $_POST['_acf_nonce'], $_POST['action'] ) ) {
			$error = 'Verification error, try again.';
		} else {

			$email_to    = $_POST['mail_to'] ? $_POST['mail_to']
				: get_option( 'admin_email' );
			$subject     = $_POST['mail_subject'] ? $_POST['mail_subject'] : '';
			$first_name  = filter_var( $_POST['first_name'],
				FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW );
			$last_name   = filter_var( $_POST['last_name'],
				FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW );
			$email       = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
			$company     = $_POST['company'] ? $_POST['company'] : '';
			$who_are_you = $_POST['who_are_you'] ? $_POST['who_are_you'] : '';
			$message     = "From: $first_name $last_name <$email> ";
			$message     .= $company ? '. Company: ' . $company : '';
			$message     .= $who_are_you ? '. I am a: ' . $who_are_you : '';
			$header      = 'From: ' . get_option( 'blogname' )
			               . ' <wp-contacts@equityx.io>' . PHP_EOL;
			$header      .= 'Reply-To: ' . $email . PHP_EOL;

			// Create post with data.
			$new_post = [
				'post_title'  => 'Sent from ' . $first_name . ' ' . $last_name,
				'post_author' => $first_name . ' ' . $last_name,
				'post_status' => 'publish',
				'post_date'   => date( 'Y-m-d H:i:s' ),
				'post_type'   => 'form-record',
			];
			$post_id  = wp_insert_post( $new_post );
			update_post_meta( $post_id, '_equityx_email', $email );
			update_post_meta( $post_id, '_equityx_company', $company );
			update_post_meta( $post_id, '_equityx_sender', $first_name . ' ' . $last_name );
			update_post_meta( $post_id, '_equityx_who_you', $who_are_you );
			update_post_meta( $post_id, '_equityx_page_name', $_POST['page_name'] );

			$sendmsg
				= __( 'Thank you. We\'ve received your details and we\'ll be in touch with you soon! The EquityX team.',
				'EquityX' );

			if ( wp_mail( $email_to, $subject, $message, $header ) ) {
				$status = 'success';
				$error  = $sendmsg;
			} else {
				$error = 'Some errors occurred.';
			}
		}
	}

	$resp = [ 'status' => $status, 'errmessage' => $error ];
	header( "Content-Type: application/json" );
	echo json_encode( $resp );
	die();
}

add_action( 'wp_ajax_equityx_form_action',
	'ajax_equityx_form_action_callback' );
add_action( 'wp_ajax_nopriv_equityx_form_action',
	'ajax_equityx_form_action_callback' );
