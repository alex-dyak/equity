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
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
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

	// This is where we put slick JS functions.
	wp_enqueue_script( 'EquityX-slick', get_template_directory_uri() . '/inc/js/slick.min.js', array( 'EquityX-jquery' ), null, true );

	// Load Stylesheets.
	wp_enqueue_style( 'EquityX-slick-style', get_template_directory_uri() . '/inc/css/slick.css', array('js_composer_front') );
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

// Classes for VC widgets.
require_once( get_template_directory() . '/inc/WPBakeryShortCode_equityx_members.php' );
require_once( get_template_directory() . '/inc/WPBakeryShortCode_testimonials_slider.php' );
require_once( get_template_directory() . '/inc/WPBakeryShortCode_logo_slider.php' );

/**
 * Custom excerpt trim.
 */
function excerpt_trim( $length )
{
	$text = get_the_content();
	$excerpt_length = apply_filters('excerpt_length', $length);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '');
	$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
	return $text;
}

/**
 * Register taxonomy
 */
add_action('vc_before_init', 'create_taxonomy', 1);
function create_taxonomy(){
	$labels = array(
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
	);
	$args = array(
		'label'                 => '',
		'labels'                => $labels,
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => null,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_tagcloud'         => false,
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => true,
		'_builtin'              => false,
		'show_in_quick_edit'    => null,
	);
	register_taxonomy('members_team_groups', array('member'), $args );
}

/**
 * Widget Members to VC.
 */
add_action( 'vc_before_init', 'get_members', 9999 );
function get_members() {
	$args = array(
		'type'      => 'member',
	);
	$terms = get_terms('members_team_groups', array('hide_empty' => false));
	$term_name = array();
	foreach($terms as $term) {
		$term_name[] = $term->name;
	}

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
			array(
				"type"        => "dropdown",
				"holder"      => "div",
				"class"       => "",
				"heading"     => __( "Members Group", "EquityX" ),
				"param_name"  => "group",
				"description" => __( "Select the Members Group.", "EquityX" ),
				"value"       => $term_name
			),

		)
	));
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
	update_post_meta( $postID, $count_key, ++$count );
}

/**
 * Add a new column in the wp-admin posts list
 */
function w4ptheme_columns_head($columns) {
	$columns['views'] = 'Views';
	return $columns;
}
add_filter('manage_edit-post_columns', 'w4ptheme_columns_head');

/**
 * Add rows.
 */
function w4ptheme_custom_column($column, $post_id ){
	switch ( $column ) {
		case 'views':
			$views_value = w4ptheme_get_post_view( $post_id );
			echo intval($views_value);
			break;
	}
}
add_action( 'manage_post_posts_custom_column' , 'w4ptheme_custom_column', 10, 2 );

/**
 * Define sortable column.
 */
function w4ptheme_post_table_sorting($columns) {
	$columns['views'] = 'views';
	return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'w4ptheme_post_table_sorting');

/**
 * Add sortable column data.
 */
function w4ptheme_post_column_orderby($vars) {
	if (isset($vars['orderby']) && 'views' == $vars['orderby'])   {
		$vars = array_merge($vars, array(
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num'
		));
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
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_title'] = get_field('author_name');
		$my_post['post_name'] = sanitize_title(get_field('author_name'));
		// Update the post into the database
		wp_update_post( $my_post );
	}
}

/**
 * Run after ACF saves the $_POST['fields'] data
 */
add_action('acf/save_post', 'w4ptheme_author_post_title_update', 20);

/**
 * Add custom query vars.
 */
function w4ptheme_query_vars_filter($vars) {
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
	$meta_query = array();
	// add meta_query elements
	if( ! empty( $query->query['post_author_meta'] ) ) {
		$meta_query[] = array( 'key' => 'post_author', 'value' => get_query_var( 'post_author_meta' ), 'compare' => '=' );
	}

	if( count( $meta_query ) > 0 ){
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
		array(
			'name'        => __( 'Testimonials Slider' ),
			'base'        => 'testimonials_slider',
			'icon'        => 'icon-wpb-slideshow',
			'category'    => __( 'Content' ),
			'description' => __( 'Slider with testimonials.' ),
			'params'      => array(
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Testimonials in Slide", "EquityX" ),
					'value'       => 3,
					"param_name"  => "quantity",
					"description" => __( "Enter Quantity Testimonials in Slide.", "EquityX" )
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Testimonials to Scroll", "EquityX" ),
					'value'       => 3,
					"param_name"  => "slides_to_scroll",
					"description" => __( "Enter Quantity Testimonials to Scroll.", "EquityX" )
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Autoplay Speed (sec)", "EquityX" ),
					'value'       => 2,
					"param_name"  => "autoplay_speed",
					"description" => __( "Enter the autoplay speed.", "EquityX" )
				),
			),
		)
	);
}

/**
 * VC Clients logo slider
 */
add_action( 'vc_before_init', 'logo_slider' );
function logo_slider() {
	vc_map(
		array(
			'name'        => __( 'Clients Logo Slider' ),
			'base'        => 'logo_slider',
			'icon'        => 'icon-wpb-slideshow',
			'category'    => __( 'Content' ),
			'description' => __( 'Slider with Clients Logo.' ),
			'params'      => array(
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Logo in Slide", "EquityX" ),
					'value'       => 10,
					"param_name"  => "quantity",
					"description" => __( "Enter Quantity Logo in Slide.", "EquityX" )
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Slide to Scroll", "EquityX" ),
					'value'       => 1,
					"param_name"  => "slides_to_scroll",
					"description" => __( "Enter Quantity Logo to Scroll.", "EquityX" )
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Autoplay Speed (sec)", "EquityX" ),
					'value'       => 2,
					"param_name"  => "autoplay_speed",
					"description" => __( "Enter the autoplay speed.", "EquityX" )
				),
			),
		)
	);
}

/**
 * Function get selected testimonial and redirect.
 */
function get_selected_testimonial() {
	global $post;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$posts_per_page = 5;
	$selected_testimonial = 0;

	if ( ! empty( $_GET['selected_post_id'] ) ) {
			$post_id = $_GET['selected_post_id'];
		if ( ! isset($post_id) ) {
			$post_id = 0;
		}

		do {
			$query_args = array(
				'post_type'           => 'testimonial',
				'posts_per_page'      => $posts_per_page,
				'paged'               => $paged,
				'ignore_sticky_posts' => true,
			);

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
		} while ( $selected_testimonial != $post_id  );

		$paged = ! $paged ? 1 : $paged;

		$link = add_query_arg( 'highlight_id', $post_id, get_permalink( $post->ID ) . 'page/' . $paged.'/' );

		wp_redirect( $link );

		exit;

	}
//	else if ( ! empty( $_GET['selected_post_id'] ) && get_option( 'selected_post_id' ) ) {
//		wp_redirect( WP_HOME . $_SERVER['REDIRECT_URL'] );
//	}
}

add_action('wp', 'get_selected_testimonial');

add_filter('wp_pagenavi_class_previouspostslink', 'theme_pagination_class');
add_filter('wp_pagenavi_class_nextpostslink', 'theme_pagination_class');
add_filter('wp_pagenavi_class_page', 'theme_pagination_class');

function theme_pagination_class($class_name) {
	switch($class_name) {
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

