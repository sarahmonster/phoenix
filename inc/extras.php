<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Phoenix
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function phoenix_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	return $classes;
}
add_filter( 'body_class', 'phoenix_body_classes' );

/**
 * Check for existence of Wanderlist plugin.
 *
 * This plugin is used in various places by the theme.
 */
function phoenix_has_wanderlist() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'wanderlist/wanderlist.php' ) ) :
		return true;
	else :
		return false;
	endif;
}
