<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package    WordPress
 * @subpackage W4P-Theme
 * @since      W4P Theme 1.0
 */

?>
<aside id="sidebar">

	<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Sidebar Widgets' ) ) : ?>

	<?php endif; ?>

</aside>
