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
	<div class="searchForm-item">
		<label for="s"
			   class="screen-reader-text"><?php esc_html_e( 'Search for:', 'EquityX' ); ?></label>
		<input type="search" id="s" class="searchForm-item-field" name="s" value="" placeholder="Search on blog" />

		<button type="submit" id="searchsubmit" class="searchForm-item-submit">
			<i class="ft-icon-search"></i>
		</button>

		<div class="searchForm-item-close js-closeSearchForm">
			<svg class="svgIcon icon-svgClose">
				<use xlink:href="#close" />
			</svg>
		</div>
	</div>
</form>
