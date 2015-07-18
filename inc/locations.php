<?php
/**
 * Functions relating to the location Custom Post Type.
 * This post type will be used to generate a "where I am right now"
 * status, as well as to show a map and/or timeline of places and
 * countries.
 *
 * This is very much under development as of yet.
 * Ideally, this should really be abstracted out into a plugin.
 *
 * @package Flare
 */

/**
 * Register countries as a taxonomy, so we can count 'em.
 */
function flare_register_country_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Countries', 'Taxonomy General Name', 'flare' ),
    'singular_name'              => _x( 'Country', 'Taxonomy Singular Name', 'flare' ),
    'menu_name'                  => __( 'Countries', 'flare' ),
    'all_items'                  => __( 'All Countries', 'flare' ),
    'parent_item'                => __( 'Parent Country', 'flare' ),
    'parent_item_colon'          => __( 'Parent Country:', 'flare' ),
    'new_item_name'              => __( 'New Country Name', 'flare' ),
    'add_new_item'               => __( 'Add New Country', 'flare' ),
    'edit_item'                  => __( 'Edit Country', 'flare' ),
    'update_item'                => __( 'Update Country', 'flare' ),
    'view_item'                  => __( 'View Country', 'flare' ),
    'separate_items_with_commas' => __( 'Separate countries with commas', 'flare' ),
    'add_or_remove_items'        => __( 'Add or remove countries', 'flare' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'flare' ),
    'popular_items'              => __( 'Popular Countries', 'flare' ),
    'search_items'               => __( 'Search Countries', 'flare' ),
    'not_found'                  => __( 'Not Found', 'flare' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'country', array( 'post', ' place' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'flare_register_country_taxonomy', 0 );

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
    'taxonomies'          => array( 'post_tag', 'country' ),
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

/**
 * Show a list of upcoming locations.
 */
function flare_upcoming_locations() {
  $locations = get_posts( array(
    'posts_per_page'   => 5,
    'post_type'        => 'flare_location',
    'orderby'          => 'date',
    'order'            => 'ASC',
    'post_status'      => 'future',
  ) );
  return $locations;
}

/**
 * Register a shortcode for location tasks.
 * This just makes it stupid easy to drop into a page.
 *
 * Usage: [place], by default will show current location.
 * Pass the "show" parameter to show different information.
 * For now, [place show=current] will show current (or most recent) location,
 * [place show=countries] will show total number of countries.
 */
function flare_location_shortcode( $atts, $content = null  ){
  $a = shortcode_atts( array(
      'show' => 'current',
  ), $atts );

  if ( 'current' === $a['show'] ):
    return flare_get_current_location();
  endif;

  if ( 'countries' === $a['show'] ):
    return '45';
  endif;
}
add_shortcode( 'place', 'flare_location_shortcode' );
