<?php
/**
 * Functions relating to the location Custom Post Type.
 * This post type will be used to generate a "where I am right now"
 * status, as well as to show a map and/or timeline of places and
 * countries. Is very under development as of yet.
 *
 * @package Flare
 */

/**
 * Register the 'location' Custom Post Type.
 */
function flare_register_location_cpt() {

  $labels = array(
    'name'                => _x( 'Places', 'Post Type General Name', 'flare' ),
    'singular_name'       => _x( 'Place', 'Post Type Singular Name', 'flare' ),
  );

  $args = array(
    'label'               => __( 'place', 'flare' ),
    'description'         => __( 'Places you have been and places you are.', 'flare' ),
    'menu_icon'           => 'dashicons-location',
    'labels'              => $labels,
    'supports'            => array( ),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_position'       => 5,
    'show_in_admin_bar'   => true,
    'show_in_nav_menus'   => true,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'rewrite' => array('slug' => 'places'),
  );
  register_post_type( 'flare_location', $args );
}
add_action( 'init', 'flare_register_location_cpt', 0 );

/**
 * Get current location.
 * This assumes that your current location is the most
 * recently-entered location, for obvious reasons.
 */
function flare_get_current_location() {
  $locations = get_posts( array(
    'posts_per_page'   => 1,
    'post_type'        => 'flare_location',
  ) );
  return $locations[0]->post_title;
}


