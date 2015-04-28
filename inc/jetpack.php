<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Flare
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function flare_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'page',
    'wrapper'        => true,
    'posts_per_page' => 10,
    'type'           => 'click',
	) );

  /**
   * Add theme support for Jetpack responsive videos
   * See: http://jetpack.me/support/responsive-videos/
   */
  add_theme_support( 'jetpack-responsive-videos' );

  /**
   * Add theme support for Jetpack featured content
   * See: http://jetpack.me/support/featured-content/
   */
  add_theme_support( 'featured-content', array(
    'filter'    => 'flare_get_featured_posts',
    'max_posts' => 2,
  ) );

  /**
   * Add theme support for Jetpack site logo
   * See: http://jetpack.me/support/site-logo/
   */
  add_image_size( 'flare-logo', 700 ); // Restrict logo to 700 pixels in width (double-sized for hi-res devices)
  add_theme_support( 'site-logo', array( 'size' => 'flare-logo' ) );

}
add_action( 'after_setup_theme', 'flare_jetpack_setup' );
