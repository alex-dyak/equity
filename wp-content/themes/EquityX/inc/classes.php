<?php
/**
 * W4P Theme custom classes
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @package WordPress
 * @subpackage W4P-Theme
 */

/**
 * Class Popular_Posts_Data
 *
 * A class for retrieving an array of popular posts post data. This class is designed for use with the WordPress Popular
 * Posts plugin (@see https://wordpress.org/plugins/wordpress-popular-posts/) and will not work without it.
 *
 * @author 	Phil Smart
 * @license https://creativecommons.org/licenses/by/4.0/legalcode Creative Commons Attribution License
 */
class Popular_Posts_Data
{
	/** @var array $items Property for storing the final data array */
	protected $items = array();

	/**
	 * Constructor. This accepts either an integer or an array of query args suitable for the wpp_get_mostpopular()
	 * function. If an int is passed, it is treated as the number of posts to get. If an array is passed, it is
	 * treated as a plugin-specific query array.
	 *
	 * @param int|array $args
	 */
	function __construct( $args = 10 )
	{
		// Make sure the function is available
		if ( ! function_exists( 'wpp_get_mostpopular' ))
			return;

		// Catch the output of the function to prevent it from displaying and capture the data via the filter
		add_filter( 'wpp_custom_html', array( $this, '_get_posts_data' ), 10, 2 );

		// Ensure our arguments are of a suitable format
		$args = $this->normalise_args( $args );

		// Invoke the API method using our arguments array, and catch the output in the output buffer
		ob_start();
		wpp_get_mostpopular( $args );
		ob_get_clean();

		// Remove the filter so we don't affect other instances of the shortcode
		remove_filter( 'wpp_custom_html', array( $this, '_get_posts_data' ), 10, 2 );
	}

	/**
	 * Normalises args for the wpp_get_mostpopular() function. This ensures we pass the function a correctly formatted
	 * args array, but also allows us to define some default arguments specific to our needs.
	 *
	 * @param int|array $args
	 *
	 * @return array
	 */
	protected function normalise_args( $args )
	{
		// If an integer is passed, treat it as a limit
		if (is_int( $args ))
			$args = array( 'limit' => $args );

		// Allows passing of an array of categories by reformatting into a string
		if (isset( $args['cat'] ) and is_array( $args['cat'] ))
			$args['cat'] = implode( ',', $args['cat'] );

		// Merge parameters with defaults. Set whatever defaults you like here.
		return wp_parse_args( $args, array(
			'range'     => 'weekly',
			'freshness' => 1,
			'orderby'   => 'views',
			'limit'     => 10,
			'post_type' => 'post'
		) );
	}

	/**
	 * The hooked filter that intercepts the shortcode output and receives a list of posts.
	 *
	 * @param $data
	 * @param $instance
	 */
	public function _get_posts_data( $data, $instance )
	{
		$this->items = (array) $data;
	}

	/**
	 * Public accessor for posts array.
	 *
	 * @return array
	 */
	public function get_posts()
	{
		return $this->items;
	}
}
