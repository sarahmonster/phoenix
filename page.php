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
	
			
		<?php if (!is_front_page()): ?>
		
			<header class="twelvecol last page-title">
				<span class="page-subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
				<h1><?php the_title(); ?></h1>
			</header>
		
		<?php endif; ?>	

			

	</div><!-- row -->
	
	<div class="row page-content">
	
		<?php the_content(); ?>

	</div><!-- row -->
<?php endwhile; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>