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
