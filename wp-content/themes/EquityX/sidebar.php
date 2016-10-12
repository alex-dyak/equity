<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package    WordPress
 * @subpackage EquityX-Theme
 * @since      EquityX Theme 1.0
 */

?>
<aside id="sidebar">

	<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'Sidebar Widgets' ); ?>
	<?php endif; ?>

</aside>
