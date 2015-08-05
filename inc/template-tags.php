<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flare
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'flare' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'flare' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'flare' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'flare' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'flare_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flare_posted_on() {
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
		_x( '%s', 'post date', 'flare' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$posted_on = flare_format_date(get_the_time('l '), get_the_time('F'), get_the_time('jS'), get_the_time('Y') );

	$byline = sprintf(
		_x( 'by %s', 'post author', 'flare' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';
	//echo edit_post_link( __( 'Edit', 'flare' ), '<span class="edit-link">', '</span>' );

}
endif;

/* output fully-formatted post date */
function flare_format_date($dayofweek, $month, $day, $year) {
	$date = $dayofweek . '<span class="highlight">';
	// generate date with a special hidey-class
	$month_short = substr($month, 0, 3);
	$month_remainder = substr($month, 3, 500);
	$month = $month_short . '<span class="extra-date">' . $month_remainder . '</span>';
	$date .= $month . " " . $day;
	$date .= '</span>&nbsp;'.$year;
	return $date;
}

if ( ! function_exists( 'flare_subtitle' ) ) :
/**
 * Prints a subtitle for the post, if one exists.
 */
function flare_subtitle() {
	$subtitle = get_post_meta( get_the_ID(), 'Subtitle', true );
	return $subtitle;
}
endif;

if ( ! function_exists( 'flare_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function flare_entry_footer() {
	esc_html_e( 'Like this post? Hate this post? Let&rsquo;s talk about it.', 'flare');
	echo sprintf( '<a class="twitter-share" href="http://twitter.com/home?status=%1s %2s">%3s</a> ',
		urlencode( esc_html__( 'Hey @sarahsemark, loved your blog post!', 'flare' ) ),
		esc_url( get_the_permalink() ),
		esc_html__( 'Tweet tweet', 'flare' )
	);
}
endif;

if ( ! function_exists( 'flare_archive_title' ) ) :
/**
 * Filters the_archive_title to add spans for styling the prefixes, and removes the colon.
 * So instead of "Category: Travel" we'll have "<span class="archive-type">Category</span> Travel"
 *
 */
function flare_archive_title( $title ) {
  $split_title = explode( ':', $title );
  if ( $split_title[1] ) {
  	$title = '<span class="archive-type">'. $split_title[0] . '</span>' . $split_title[1];
  }
  return $title;
}
add_filter( 'get_the_archive_title', 'flare_archive_title' );
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'flare' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'flare' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'flare' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'flare' ), get_the_date( _x( 'Y', 'yearly archives date format', 'flare' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'flare' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'flare' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'flare' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'flare' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'flare' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'flare' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'flare' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'flare' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Blog', 'flare' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function flare_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'flare_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'flare_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so flare_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so flare_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in flare_categorized_blog.
 */
function flare_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'flare_categories' );
}
add_action( 'edit_category', 'flare_category_transient_flusher' );
add_action( 'save_post',     'flare_category_transient_flusher' );
