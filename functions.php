<?php
/**
 * Phoenix functions and definitions
 *
 * @package Phoenix
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

if ( ! function_exists( 'phoenix_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function phoenix_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Phoenix, use a find and replace
	 * to change 'phoenix' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'phoenix', get_template_directory() . '/languages' );

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
	add_image_size( 'phoenix-square', 400, 400, true );
	add_image_size( 'phoenix-postcard', 600, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'phoenix' ),
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
	add_theme_support( 'custom-background', apply_filters( 'phoenix_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // phoenix_setup
add_action( 'after_setup_theme', 'phoenix_setup' );

/**
 * Enqueue scripts and styles.
 */
function phoenix_scripts() {
	wp_enqueue_style( 'phoenix-style', get_stylesheet_uri() );
	wp_enqueue_script( 'phoenix-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'phoenix-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'phoenix-typekit-cache', get_template_directory_uri() . '/js/typekit-cache.js', array(), '20120302', true );

	// Text animation/manipulation libraries
	wp_enqueue_style( 'phoenix-animate', get_template_directory_uri() . '/js/animate.css', array(), '20150719', 'screen' );
	wp_enqueue_script( 'phoenix-animate', get_template_directory_uri() . '/js/animate.js', array(), '20150719', true );
	wp_enqueue_script( 'phoenix-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '20150719', true );
	wp_enqueue_script( 'phoenix-lettering', get_template_directory_uri() . '/js/jquery.lettering.js', array( 'jquery' ), '20150719', true );
	wp_enqueue_script( 'phoenix-textillate', get_template_directory_uri() . '/js/jquery.textillate.js', array( 'jquery', 'phoenix-lettering' ), '20150719', true );
	wp_enqueue_script( 'phoenix-texteffects', get_template_directory_uri() . '/js/texteffects.js', array( 'jquery', 'phoenix-lettering', 'phoenix-textillate' ), '20150719', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'phoenix_scripts' );

/**
 * Enqueue Typekit fonts
 *
 * @action wp_head
 * @return string
 */
function phoenix_fonts() {
	$kit = 'rmt3uuy';
	?>
	<script>
	    // try{!function(t,e,n,r,a,s,i,l)
	</script>
	<script>
	(function(d) {
	var config = {
		kitId: '<?php echo $kit; ?>',
		scriptTimeout: 3000
	},
	h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
	})(document);
</script>
	<?php
}
add_action( 'wp_head', 'phoenix_fonts', 20 );

/**
 * Add editor styles
 */
function phoenix_editor_styles() {
  add_editor_style( array( 'editor-style.css' ) );
}
add_action( 'after_setup_theme', 'phoenix_editor_styles' );

/**
 * Nuke Jetpack and other plugins' styles
 */
function phoenix_dequeue_plugin_styles()  {
	wp_dequeue_style( 'wanderlist-style' );
}
add_action( 'wp_print_styles', 'phoenix_dequeue_plugin_styles', 100 );
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

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
 * Custom portfolio functionality.
 */
require get_template_directory() . '/inc/portfolio.php';

/**
 * SVG icons functionality.
 */
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Include extra wp-cli modules for post meta.
 */
if( defined( 'WP_CLI' ) && WP_CLI ) {
	require get_template_directory() . '/cli-lab/modules/posts.php';
}
