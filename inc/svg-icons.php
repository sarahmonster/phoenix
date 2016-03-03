<?php
/**
 * SVG icon functionality, via Easy as SVG.
 *
 * @link https://github.com/sarahmonster/easy-as-svg
 * This makes it easier for us to get up and running with SVG icons, without
 * doing a lot of extra work or adjusting our templates.
 *
 * Currently using the <symbol> method of insertion, YMMV.
 */
$phoenix_sprite_external = true;

/*
 * Inject our SVG sprite at the bottom of the page.
 *
 * There is a possibility that this will cause issues with
 * older versions of Chrome. In which case, it may be
 * necessary to inject just after the </head> tag.
 * See: https://code.google.com/p/chromium/issues/detail?id=349175
 *
 * This function currently is only used when we're not using the external method of insertion.
 */
function phoenix_inject_sprite() {
	global $phoenix_sprite_external;
	if ( ! $phoenix_sprite_external ) :
		include_once( get_template_directory() .'/assets/svg/icons.svg' );
	endif;
}
add_filter( 'wp_footer' , 'phoenix_inject_sprite' );

/*
 * Implement svg4everybody in order to better support external sprite references
 * on IE8-10. For lower versions, we need an older copy of the script.
 * https://github.com/jonathantneal/svg4everybody
 */
function phoenix_svg4everybody() {
	global $phoenix_sprite_external;
	if ( $phoenix_sprite_external ) :
		wp_enqueue_script( 'phoenix-svg4everybody', get_template_directory_uri() . '/assets/js/svg4everybody.js', array(), '20160222', false );
	endif;
}
add_action( 'wp_enqueue_scripts', 'phoenix_svg4everybody' );

/*
 * Inject some header code to make IE play nice.
 *
 * This seems to do the trick, but may require more testing.
 * See: https://github.com/jonathantneal/svg4everybody
 */
function phoenix_inject_svg4everybody() {
	global $phoenix_sprite_external;
	if ( $phoenix_sprite_external ) :
		echo '<meta http-equiv="x-ua-compatible" content="ie=edge">';
		echo '<script type="text/javascript">svg4everybody();</script>';
	endif;
}
add_action( 'wp_head', 'phoenix_inject_svg4everybody', 20 );


/**
 * This allows us to get the SVG code and return as a variable
 * Usage: phoenix_get_icon( 'name-of-icon' );
 */
function phoenix_get_icon( $name, $id = null ) {
	global $phoenix_sprite_external;

	$attr = 'class="phoenix-icon phoenix-icon-' . $name . '"';

	if ( $id ) :
		$attr .= 'id="' . $id . '"';
	endif;

	$return = '<svg '. $attr.'>';

	if ( $phoenix_sprite_external ) :
		if ( function_exists( 'wpcom_is_vip' ) ) :
			$path = wpcom_vip_noncdn_uri( get_template_directory() );
		else :
			$path = get_template_directory_uri();
		endif;
		$return .= '<use xlink:href="' . esc_url( $path ) . '/assets/svg/icons.svg#' . $name . '" />';
	else :
		$return .= '<use xlink:href="#' . $name . '" />';
	endif;
	$return .= '</svg>';
 return $return;
}

/*
 * This allows for easy injection of SVG references inline.
 * Usage: phoenix_icon( 'name-of-icon' );
 */
function phoenix_icon( $name, $id = null ) {
	echo phoenix_get_icon( $name, $id );
}

/*
 * Filter our navigation menus to look for social media links.
 * When we find a match, we'll hide the text and instead show an SVG icon.
 */
function phoenix_social_menu( $items ) {
	foreach ( $items as $item ) :
		$subject = $item->url;
		$feed_pattern = '/\/feed\/?/i';
		$mail_pattern = '/mailto/i';
		$skype_pattern = '/skype/i';
		$domain_pattern = '/([a-z]*)(\.com|\.org|\.io|\.tv|\.co)/i';
		$domains = array( 'codepen', 'digg', 'dribbble', 'dropbox', 'facebook', 'flickr', 'foursquare', 'github', 'plus.google', 'instagram', 'linkedin', 'path', 'pinterest', 'getpocket', 'polldaddy', 'reddit', 'spotify', 'stumbleupon', 'tumblr', 'twitch', 'twitter', 'vimeo', 'vine', 'youtube' );

		// Match feed URLs
		if ( preg_match( $feed_pattern, $subject, $matches ) ) :
				$icon = phoenix_get_icon( 'feed' );
		// Match a mailto link
		elseif ( preg_match( $mail_pattern, $subject, $matches ) ) :
				$icon = phoenix_get_icon( 'mail' );
		// Match a Skype link
		elseif ( preg_match( $skype_pattern, $subject, $matches ) ) :
				$icon = phoenix_get_icon( 'skype' );
		// Match various domains
		elseif ( preg_match( $domain_pattern, $subject, $matches ) && in_array( $matches[1], $domains ) ) :
			$icon = phoenix_get_icon( $matches[1] );
		endif;

		// If we've found an icon, hide the text and inject an SVG
		if ( $icon ) {
			$item->title = $icon . '<span class="screen-reader-text">' . $item->title . '</span>';
		}
		endforeach;
return $items;
}
add_filter( 'wp_nav_menu_objects', 'phoenix_social_menu' );

/*
 * Register a custom shortcode to allow users to insert SVGs.
 * This is used to insert a regular inline SVG.
 * Usage: [svg file="filename"]
 */
function phoenix_svg_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
    'file' => '',
	), $atts );
	$file = get_template_directory_uri() . '/assets/svg/'.$atts['file'].'.svg';
	if ( function_exists( 'wpcom_is_vip' ) ) :
		return wpcom_vip_file_get_contents( esc_url( $file ) );
	else :
		return file_get_contents( esc_url( $file ) );
	endif;
}
add_shortcode( 'svg', 'phoenix_svg_shortcode' );

/*
 * Register a custom shortcode to allow users to insert SVG icons.
 * This is used to insert SVG icons using the phoenix_get_icon function.
 * Usage: [phoenix-icon name="name" id="id"]
 */
function phoenix_svg_icon_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
    'name' => '',
	 'id'   => '',
	), $atts );
	return phoenix_get_icon( $atts['name'], $atts['id'] );
}
add_shortcode( 'phoenix-icon', 'phoenix_svg_icon_shortcode' );
