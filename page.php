<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="twelvecol last">
				<span class="page-subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
					<?php if ( is_front_page() ) { ?>

					<?php } else { ?>	
						<h1><?php the_title(); ?></h1>
					<?php } ?>	
	</div>			

	</div><!-- row -->
	
	<div class="row page-content">
	
	<!--START WORDPRESS CONTENT-->
					<?php the_content(); ?>
	<!-- AND IT'S OVER NOW -->

	</div><!-- row -->
<?php endwhile; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>