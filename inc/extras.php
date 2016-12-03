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
	// Adds the post slug (used for individual post styles).
	if ( is_singular() ) :
		$slug = get_queried_object()->post_name;
		$classes[] = 'phoenix-' . $slug;
	endif;
	return $classes;
}
add_filter( 'body_class', 'phoenix_body_classes' );

/*
 * Filter the archive title for the main blog index, because "Archives" isn't cute.
 * This uses the page title for the blog archive (when set to a static page.)
 */
function phoenix_archive_title( $content ) {
	if ( is_home() ) :
		$content = get_queried_object()->post_title;
	endif;

	return $content;
}
add_filter( 'get_the_archive_title', 'phoenix_archive_title' );

/*
 * Filter the archive description as well.
 * This uses the page content for the blog archive (when set to a static page.)
 */
function phoenix_archive_description( $content ) {
	if ( is_home() ) :
		$content = get_queried_object()->post_content;
	endif;
	
	return $content;
}
add_filter( 'get_the_archive_description', 'phoenix_archive_description' );


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
