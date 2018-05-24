<?php
/**
 * The template for displaying search forms in upBootWP
 *
 * @author Rafał Puczel
 */
?>
<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input type="search" class="search-field form-control input-lg" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'rfswp' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Szukaj:', 'label', 'rfswp' ); ?>">
	</div>
	<input type="submit" class="search-submit btn btn-default input-lg" value="<?php echo esc_attr_x( 'Szukaj', 'submit button', 'rfswp' ); ?>">
</form>
