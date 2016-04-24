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
	if ( is_multi_author() ) :
		$classes[] = 'group-blog';
	endif;
	// Adds the post category (used for colour-coding).
	if ( is_single() ) :
		foreach ( get_the_category() as $category ) :
			$classes[] = 'phoenix-category-' . $category->slug;
		endforeach;
	endif;
	return $classes;
}
add_filter( 'body_class', 'phoenix_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function phoenix_post_classes( $classes ) {
	// Adds the post slug.
	if ( is_singular() ) :
		$slug = get_queried_object()->post_name;
		$classes[] = 'phoenix-' . $slug;
	endif;
	return $classes;
}
add_filter( 'post_class', 'phoenix_post_classes' );

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
