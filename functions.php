<?php
/**
 * Flare functions and definitions
 *
 * @package Flare
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'flare_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function flare_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Flare, use a find and replace
	 * to change 'flare' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'flare', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 300, true );
  add_image_size( 'flare-square', 200, 200, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'flare' ),
	) );

	register_nav_menus( array(
		'secondary' => __( 'Secondary Menu', 'flare' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'status',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'flare_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // flare_setup
add_action( 'after_setup_theme', 'flare_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function flare_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'flare' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'flare_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function flare_scripts() {
	wp_enqueue_style( 'flare-style', get_stylesheet_uri() );
	wp_enqueue_style( 'flare-icons', get_template_directory_uri() . '/icons/styles.css', array(), '20150620', all );
	wp_enqueue_script( 'flare-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'flare-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Mapbox libraries and initialisation code
	wp_enqueue_script( 'flare-mapbox', 'https://api.tiles.mapbox.com/mapbox.js/v2.2.1/mapbox.js', array(), '20150719', true );
	wp_enqueue_style( 'flare-mapbox-css', 'https://api.tiles.mapbox.com/mapbox.js/v2.2.1/mapbox.css', array(), '20150719', all );
	wp_enqueue_script( 'flare-map', get_template_directory_uri() . '/js/map.js', array( 'jquery', 'flare-mapbox' ), '20150719', true );

	// Text animation/manipulation libraries
	wp_enqueue_style( 'flare-animate', get_template_directory_uri() . '/js/animate.css', array(), '20150719', screen );
	wp_enqueue_script( 'flare-animate', get_template_directory_uri() . '/js/animate.js', array(), '20150719', true );
	wp_enqueue_script( 'flare-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '20150719', true );
	wp_enqueue_script( 'flare-lettering', get_template_directory_uri() . '/js/jquery.lettering.js', array( 'jquery' ), '20150719', true );
	wp_enqueue_script( 'flare-textillate', get_template_directory_uri() . '/js/jquery.textillate.js', array( 'jquery', 'flare-lettering' ), '20150719', true );
	wp_enqueue_script( 'flare-texteffects', get_template_directory_uri() . '/js/texteffects.js', array( 'jquery', 'flare-lettering', 'flare-textillate' ), '20150719', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flare_scripts' );

/**
 * Add editor styles
 */
function flare_editor_styles() {
  add_editor_style( array( 'editor-style.css' ) );
}
add_action( 'after_setup_theme', 'flare_editor_styles' );

/**
 * Nuke Jetpack styles
 */
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom location functionality.
 */
require get_template_directory() . '/inc/locations.php';

/**
 * Custom portfolio functionality.
 */
require get_template_directory() . '/inc/portfolio.php';
