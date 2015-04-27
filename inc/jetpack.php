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
}
add_action( 'after_setup_theme', 'flare_jetpack_setup' );
