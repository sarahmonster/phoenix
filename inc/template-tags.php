<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Phoenix
 */

if ( ! function_exists( 'phoenix_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function phoenix_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'phoenix' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$posted_on = phoenix_format_date(get_the_time('l '), get_the_time('F'), get_the_time('jS'), get_the_time('Y') );

	$byline = sprintf(
		_x( 'by %s', 'post author', 'phoenix' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';
	//echo edit_post_link( __( 'Edit', 'phoenix' ), '<span class="edit-link">', '</span>' );

}
endif;

/**
 * Outputs a fully-formatted post date.
 * This is used to hide portions of the date on smaller screens, as well as
 * doing some extra styling to make it more dynamic-looking.
 */
function phoenix_format_date($dayofweek, $month, $day, $year) {
	$date = $dayofweek . '<span class="highlight">';
	// generate date with a special hidey-class
	$month_short = substr($month, 0, 3);
	$month_remainder = substr($month, 3, 500);
	$month = $month_short . '<span class="extra-date">' . $month_remainder . '</span>';
	$date .= $month . " " . $day;
	$date .= '</span>&nbsp;'.$year;
	return $date;
}

if ( ! function_exists( 'phoenix_subtitle' ) ) :
/**
 * Prints a subtitle for the post, if one exists.
 */
function phoenix_subtitle() {
	$subtitle = get_post_meta( get_the_ID(), 'Subtitle', true );
	return $subtitle;
}
endif;

if ( ! function_exists( 'phoenix_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function phoenix_entry_footer() {
	esc_html_e( 'Like this post? Hate this post? Let&rsquo;s talk about it.', 'phoenix');
	echo sprintf( '<a class="twitter-share" href="http://twitter.com/home?status=%1s %2s">%3s %4s</a> ',
		urlencode( esc_html__( 'Hey @sarahsemark, loved your blog post!', 'phoenix' ) ),
		esc_url( get_the_permalink() ),
		phoenix_get_icon( 'twitter' ),
		esc_html__( 'Tweet tweet', 'phoenix' )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function phoenix_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'phoenix_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'phoenix_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so phoenix_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so phoenix_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in phoenix_categorized_blog.
 */
function phoenix_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'phoenix_categories' );
}
add_action( 'edit_category', 'phoenix_category_transient_flusher' );
add_action( 'save_post',     'phoenix_category_transient_flusher' );
