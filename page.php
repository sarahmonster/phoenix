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
	
	
		 
	<?php // show custom template for new portfolio items 
	
	$page_type = get_post_meta($post->ID, 'Type', $single);
	if ($page_type === "custom"):
			$template = parse_url(get_bloginfo('template_directory'));
			$slug = $post->post_name; 
			$path = $template['path']."/pages/";
			include(".".$path."/".$slug.".php"); 
	else: 
		the_content(); 
	endif;	
	?>

	</div><!-- row -->
<?php endwhile; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>