<?php
/**
 * Template for displaying search forms in EquityX Theme
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */

?>
<form role="search" method="get" id="searchform"
	  action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<label for="s"
			   class="screen-reader-text"><?php esc_html_e( 'Search for:', 'EquityX' ); ?></label>
		<input type="search" id="s" name="s" value=""/>

		<input type="submit" value="<?php esc_attr_e( 'Search', 'EquityX' ); ?>"
			   id="searchsubmit"/>
	</div>
</form>
