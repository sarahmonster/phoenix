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
 * Numeric pagination!
 * Pinched more or less verbatim from https://www.binarymoon.co.uk/2013/10/wordpress-numeric-pagination/
 *
 * @global type $wp_query
 * @param type $pageCount
 * @param type $query
 * @return type
 */
function phoenix_numeric_pagination( $page_count = 3, $query = null ) {
	if ( null == $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	// Return early if we only have one page.
	if ( 1 >= $query->max_num_pages ) {
		return;
	}
	echo '<div class="phoenix-numeric-pagination">';
	$big = 9999999999; // need an unlikely integer
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $query->max_num_pages,
		'end_size' => 0,
		'mid_size' => $page_count,
		'next_text' => '<span>Next page</span> &raquo;',
		'prev_text' => '&laquo; <span>Prev page</span>',
	) );
	echo '</div>';
}

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

/**
 * Embed a video, using Jetpack shortcodes.
 * https://en.support.wordpress.com/videos/
 */
function phoenix_embed_video( $url ) {
	if ( strpos( $url, 'videopress' ) ) :
		// Get the video ID.
		$url_pieces = explode( '/', $url );
		$video_id = array_values(array_slice($url_pieces, -1))[0];
		echo do_shortcode( "[wpvideo $video_id]");
	elseif ( strpos( $url, 'youtu.be' ) ) :
		echo do_shortcode( "[youtube $url]");
	elseif ( strpos( $url, 'vimeo' ) ) :
		echo do_shortcode( "[vimeo $url]");
	endif;
}

/**
 * Check to see if a date is upcoming or not.
 * If the date matches today, we'll
 */
function phoenix_date_is_upcoming( $event_date ) {
	$today = time();
	if ( $event_date > $today ) {
		return true;
	} else {
		return false;
	}
}
