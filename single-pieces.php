<?php
/**
 * The template for displaying all single portfolio pieces.
 *
 * @package Pique
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<span class="subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
	</header>

	<div class="row">

	<?php // show custom template for new portfolio items
		$piece_type = get_post_meta( $post->ID, 'Type', $single );
		if ( $piece_type === "new" ):
	?>

		<!-- PORTFOLIO IMAGES -->
		<div id="project-gallery" class="new-design">
			<?php
				$template = parse_url(get_bloginfo('template_directory'));
				$slug = $post->post_name;
				$path = $template['path']."/pieces/".$slug;
				include(".".$path."/".$slug.".php");
			?>
		</div>

	<?php else: // show old template! ?>

		<!-- PORTFOLIO IMAGES -->
		<div id="project-gallery" class="sevencol">
			<?php the_content(); ?>
		</div><!-- /project-gallery-->

		<!-- PROJECT DETAILS -->
		<div id="project-details" class="fivecol last">

		  <p><?php echo get_post_meta($post->ID, 'Problem', $single); ?></p>
		  <p><?php echo get_post_meta($post->ID, 'Solution', $single); ?></p>

			<?php $url = get_post_meta($post->ID, 'Url', true);   if($url) : ?>
			<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo esc_url($url); ?></a> &middot; </span>
			<?php endif; ?>

	        <?php $url = get_post_meta($post->ID, 'Url2', true);   if($url) : ?>
			<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo esc_url($url); ?></a> &middot; </span>
			<?php endif; ?>
	        <?php $url = get_post_meta($post->ID, 'Url3', true);   if($url) : ?>
			<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo esc_url($url); ?></a> &middot; </span>
			<?php endif; ?>
	        <?php $url = get_post_meta($post->ID, 'Url4', true);   if($url) : ?>
			<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo esc_url($url); ?></a> &middot; </span>
			<?php endif; ?>

			<?php $quote = get_post_meta($post->ID, 'Quote', true);   if($quote != "") : ?>
		        <blockquote>
		        <p><?php echo $quote; ?></p>
		        </blockquote>
		    <?php endif; ?>

		</div><!-- #project-details-->

	<?php endif; // end template-switchin' ?>


</div><!-- .row -->


	<div class="piece-nav">
		<?php
		// Check to see if we're using a fancy-pants plugin for post nav
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'loop_post_navigation_links' ) ):
			echo do_action('c2c_previous_or_loop_post_link', $format='%link', $link='<div class="nav-left"><h3>Previous piece</h3><span>%title</span></div>', $excluded_categories = '86');
			echo do_action('c2c_next_or_loop_post_link', $format='%link', $link='<div class="nav-right"><h3>Next piece</h3><span>%title</span></div>', $excluded_categories = '86');
		else:
			the_post_navigation( array(
        'prev_text'          => '<span>Previous</span> %title',
        'next_text'          => '<span>Next</span> %title',
    	) );
		endif;
		?>
	</div>



<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>
