<?php
/**
 * Functions relating to the portfolio Custom Post Type.
 * This post type will be used to save portfolio items.
 *
 * This can likely be easily replaced using Jetpack's built-in
 * Portfolio CPT, but for now this is a slap-dash hack.
 * http://jetpack.me/support/custom-content-types/
 *
 * @package Phoenix
 */

/**
 * Register services as a taxonomy.
 */
function phoenix_register_service_taxonomy() {

  $labels = array(
    "name" => "services",
    "label" => "Services",
    );

  $args = array(
    "labels" => $labels,
    "hierarchical" => 0,
    "label" => "Services",
    "show_ui" => true,
    "query_var" => true,
    "rewrite" => array( 'slug' => 'services', 'with_front' => false ),
    "show_admin_column" => '',
  );
  register_taxonomy( "services", array( "pieces" ), $args );
}

// Hook into the 'init' action
add_action( 'init', 'phoenix_register_service_taxonomy', 0 );

/**
 * Register the 'pieces' Custom Post Type.
 */
function phoenix_register_portfolio_cpt() {
  $labels = array(
    "name" => "Pieces",
    "singular_name" => "Piece",
    "menu_name" => "Portfolio Pieces",
    "add_new_item" => "Add New Portfolio Piece",
    );

  $args = array(
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "show_ui" => true,
    "has_archive" => true,
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => array( "slug" => "portfolio", "with_front" => false ),
    "query_var" => true,
    "menu_position" => 5,
    "supports" => array( "title", "editor", "excerpt", "custom-fields", "revisions", "thumbnail", "author" ),
    "taxonomies" => array( "category", "services" )
  );
  register_post_type( "pieces", $args );
}

add_action( 'init', 'phoenix_register_portfolio_cpt', 0 );
