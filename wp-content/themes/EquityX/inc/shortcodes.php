<?php
/**
 * W4P Theme Custom Shortcodes
 *
 * @link       http://codex.wordpress.org/Shortcode_API
 *
 * @package    WordPress
 * @subpackage W4P-Theme
 */

/**
 * ------------------------------
 * Custom Shortcodes starts here.
 * ------------------------------
 */

/**
 * Term Items shortcode.
 */
static $block_term_counter = 0;
add_shortcode( 'bartag', 'term_items_func' );
function term_items_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'name' => '',
	), $atts ) );

	$content = wpb_js_remove_wpautop( $content, true );
	global $block_term_counter;
	$block_term_counter ++;

	return "<div class='termsItem'> <div class='termsItem-counter'>$block_term_counter</div>" . "<div class='termsItem-title'>{$name}</div>" . "<div class='u-clearfix termsItem-content'>{$content}</div></div>";
}


/**
 * Class PopularPosts_Shortcode
 */
class PopularPosts_Shortcode {

	/**
	 * Key to check if shortcode used on page.
	 *
	 * @var $add_script
	 */
	static $add_script;

	/**
	 * Init shortcode.
	 */
	static function init() {
		add_shortcode( 'popular-posts', array( __CLASS__, 'handle_shortcode' ) );

		add_action( 'init', array( __CLASS__, 'register_script' ) );
		add_action( 'wp_footer', array( __CLASS__, 'enqueue_script' ) );
	}

	/**
	 * Main shortcode function.
	 *
	 * @param mixed $atts   Shortcode attributes.
	 *
	 * @return string
	 */
	static function handle_shortcode( $atts ) {
		self::$add_script = true;
		extract( shortcode_atts( array(
			'limit' => '',
			'offset' => '',
			'use_plugin' => false,
		), $atts ) );

		// Actual shortcode handling here.
		ob_start();
		set_query_var( 'limit', isset( $atts['limit'] ) ? $atts['limit'] : 5 );
		set_query_var( 'offset', isset( $atts['offset'] ) ? $atts['offset'] : 0 );
		set_query_var( 'use_plugin', isset( $atts['use_plugin'] ) ? $atts['use_plugin'] : false );
		get_template_part( 'sc_templates/popular_posts' );
		$ret = ob_get_contents();
		ob_end_clean();

		return $ret;
	}

	/**
	 * Register scripts and css for shortcode.
	 */
	static function register_script() {
		wp_register_script( 'popular-posts-ajax', get_template_directory_uri() . '/js/custom/popular-posts-ajax.js', array( 'jquery' ), null, true );
		add_action( 'wp_ajax_nopriv_popular-posts', 'popular_posts_callback' );
		add_action( 'wp_ajax_popular-posts', 'popular_posts_callback' );
	}

	/**
	 * Enqueue shortcode scripts.
	 */
	static function enqueue_script() {
		if ( ! self::$add_script ) {
			return;
		}
		wp_enqueue_script( 'popular-posts-ajax' );
		wp_localize_script( 'popular-posts-ajax', 'ajax_data', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}

PopularPosts_Shortcode::init();

/**
 * Popular Posts AJAX callback.
 */
function popular_posts_callback() {
	$limit      = isset( $_POST['limit'] ) ? filter_var( $_POST["limit"], FILTER_SANITIZE_STRING ) : 5;
	$offset     = isset( $_POST['offset'] ) ? filter_var( $_POST["offset"], FILTER_SANITIZE_STRING ) : 0;
	$use_plugin = isset( $_POST['use_plugin'] ) ? filter_var( $_POST["use_plugin"], FILTER_SANITIZE_STRING ) : 0;
	$data       = do_shortcode( "[popular-posts limit='{$limit}' offset='{$offset}' use_plugin='{$use_plugin}']" );
	if ( $data ) {
		die( wp_json_encode(
			array(
				'type'       => 'success',
				'content'    => $data,
				'offset'     => $offset + $limit,
				'limit'      => $limit,
				'use_plugin' => $use_plugin,
			)
		) );
	} else {
		die( wp_json_encode(
			array(
				'type' => 'error'
			)
		) );
	}
}