<?php
/**
 * SVG icon functionality.
 *
 * Borrowed from SVGenericons: https://github.com/sarahmonster/svgenericons
 * This makes it easier for us to get up and running with SVG icons, without
 * doing a lot of extra work or adjusting our templates.
 *
 * Currently using the <symbol> method of insertion, YMMV.
 */

/*
 * Inject our SVG sprite at the bottom of the page
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 */
function phoenix_inject_sprite() {
	include_once( get_template_directory() .'/assets/svg/symbol/sprite.svg' );
}
add_filter( 'wp_footer' , 'phoenix_inject_sprite' );

/*
 * Inject some header code to make IE play nice.
 *
 * This seems to do the trick, but may require more testing.
 * Also may not be something theme authors necessarily want
 * or need added to their headers, so we'll see.
 * See: https://github.com/jonathantneal/svg4everybody
 */
function phoenix_ie_shim() {
 echo '<meta http-equiv="x-ua-compatible" content="ie=edge">';
}
add_filter( 'wp_head' , 'phoenix_ie_shim' );

 /*
  * This allows us to get the SVG code and return as a variable
  * Usage: phoenix_get_icon( 'name-of-icon' );
  */
function phoenix_get_icon( $name ) {
	$return = '<svg class="icons icon-' . $name . '">';
	 	$return .= '<use xlink:href="#' . $name . '" />';
	 	$return .= '</svg>';
 return $return;
}
/*
 * This allows for easy injection of SVG references inline.
 * Usage: jetpack_svgenericon( 'name-of-icon' );
 */
function phoenix_icon( $name ) {
	echo phoenix_get_icon( $name );
}
