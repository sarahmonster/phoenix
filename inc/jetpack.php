<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Phoenix
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function phoenix_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'      => 'main',
		'footer'         => 'page',
    'wrapper'        => true,
    'posts_per_page' => 10,
    'type'           => 'click',
    'render'         => 'phoenix_infinite_scroll_render'
	) );

  function phoenix_infinite_scroll_render() {
    while ( have_posts() ) : the_post();
      get_template_part( 'template-parts/content', get_post_type() );
    endwhile;
  }

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
    'filter'    => 'phoenix_get_featured_posts',
    'max_posts' => 2,
  ) );

  /**
   * Add theme support for Jetpack testimonials.
   * See:
  */
  add_theme_support( 'jetpack-testimonial' );

  /**
   * Add theme support for Jetpack site logo
   * See: http://jetpack.me/support/site-logo/
   */
  add_image_size( 'phoenix-logo', 700 ); // Restrict logo to 700 pixels in width (double-sized for hi-res devices)
  add_theme_support( 'site-logo', array( 'size' => 'phoenix-logo' ) );

}
add_action( 'after_setup_theme', 'phoenix_jetpack_setup' );
