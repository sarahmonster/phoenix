<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<div class="twelvecol last">
			<?php echo format_date(get_the_time('l '), get_the_time('F'), get_the_time('jS'), get_the_time('Y') ); ?>
			<span class="page-subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
			<h1><?php the_title(); ?></h1>
		</div>
		</div><!-- row -->	
			
						
		<div class="row">
				<div class="eightcol entry-content">
					<?php the_content(); ?>
			</div>
			
			<div class="fourcol last" id="sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div><!-- row -->
		
		<div class="row">

			
	        <?php $prevPost = get_previous_post(true);
			if(!empty($prevPost)): ?>
				<div class="prev-post fourcol">
	            	<?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'blog' );?>
	            	<?php previous_post_link('%link',"$prevthumbnail", TRUE); ?>
	            	<?php previous_post_link('%link','<span class="date"> &middot; <span class="highlight">Previous</span> post &middot; </span>', TRUE); ?>
	            	<div class="nav-post-title"><?php previous_post_link('%link',"%title", TRUE); ?></div>
	            </div>	
			<?php endif; ?>
	    
	        <?php $nextPost = get_next_post();
			if (!empty($nextPost)): ?>
				<div class="next-post fourcol last">
					<?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'blog' );?>
					<?php next_post_link('%link',"$nextthumbnail", TRUE); ?>
					<?php next_post_link('%link','<span class="date"> &middot; <span class="highlight">Next</span> post &middot; </span>', TRUE); ?>
					<div class="nav-post-title"><?php next_post_link('%link',"%title", TRUE); ?></div>
					</div>	
			<?php endif; ?>
              
			</div><!-- row -->
			     
<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>