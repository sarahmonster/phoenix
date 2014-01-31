<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 * We filter the output of wp_title() a bit -- see
		 * twentyten_filter_wp_title() in functions.php.
		 */
		wp_title( '|', true, 'right' );
	
		?></title>

    <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    
    <!-- Apple Touch Icons -->    
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_directory' ); ?>/images/touch-icon-iphone.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'template_directory' ); ?>/images/touch-icon-ipad.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'template_directory' ); ?>/images/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'template_directory' ); ?>/images/touch-icon-ipad-retina.png" />

	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
	
	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/1140.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/css3-mediaqueries.js"></script>
	

	
	<!-- load @font-face fonts -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/mercury/stylesheet.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/gotham/stylesheet.css" />
	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/lavanderia/stylesheet.css" />
  
  
	<link rel="author" href="https://plus.google.com/101980833582660318774/posts" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php
		wp_head();
	?>
</head>

<body <?php body_class(); ?>>





			<div id="container" class="container">
				<div class="row">
					<div class="twelvecol last" id="header">
					
					
						<a id="logo" href="<?php echo get_bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/triggers-and-sparks.png" alt="triggers &amp; sparks" /></a>
						
						
						<!-- NAVIGATION -->
					
						<div id="access" role="navigation">
							<a id="logo-icon" href="<?php echo get_bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/triggers-and-sparks-icon.png" alt="triggers &amp; sparks" /></a>
							<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
						</div><!-- #access -->
						
						<a href="#menu" id="mobile-menu-button">Menu</a>
				</div>
				
				
				</div>
				
				
				<div class="row">
					