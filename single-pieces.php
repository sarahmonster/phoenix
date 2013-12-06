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


		<div class="twelvecol last piece-header">
		<div class="piece-nav">
		<?php echo do_action( 'c2c_previous_or_loop_post_link', $format='%link', $link='<div class="nav-left"><h3>Previous piece</h3><span>%title</span></div>' ); ?>
		<?php echo do_action( 'c2c_next_or_loop_post_link', $format='%link', $link='<div class="nav-right"><h3>Next piece</h3><span>%title</span></div>' ); ?>
		</div>
			
			<header class="page-title">
				<span class="page-subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
				<h1><?php the_title(); ?></h1>
			</header>



			
		</div>
				
		</div>
			
		<div class="row">             
                          





	<?php // show custom template for new portfolio items 
	
	$piece_type = get_post_meta($post->ID, 'Type', $single);
	if ($piece_type === "new"): ?>
	
	<!-- PORTFOLIO IMAGES -->
	<div id="project-gallery" class="new-design">
		<?php 
			$template = parse_url(get_bloginfo('template_directory')); 
			include(".".$template['path']."/pieces/".$post->post_name.".php"); 
		?>
	</div>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php else: // show old template! ?>

		<!-- PORTFOLIO IMAGES -->
		<div id="project-gallery" class="sevencol">
		   
						<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
		
		</div><!-- /project-gallery-->

		
		<!-- PROJECT DETAILS -->
		<div id="project-details" class="fivecol last">     
		       
		
		       <!--<li><span class="label">client</span> <span class="value"><?php echo get_post_meta($post->ID, 'Client', $single); ?></span></li>-->
		       <!--<li><span class="label">project</span> <span class="value"><?php the_category(', ') ?></span></li>-->
		       <!--<li><span class="label">type</span> <span class="value"><?php 
			   foreach((get_the_category()) as $cat) {
				if (!($cat->cat_ID=='3')) echo '<a href="'.get_bloginfo('url').'/portfolio/'.$cat->category_nicename.'">'.$cat->cat_name . '</a>';
				} ?></span></li>-->
		       
		       <p><?php echo get_post_meta($post->ID, 'Problem', $single); ?></p>
		       <p><?php echo get_post_meta($post->ID, 'Solution', $single); ?></p>
		       
		       <!--<h4>What I did</h4> 
		       <?php echo get_the_term_list( $post->ID, 'services', '', ', ', '' ); ?>-->
		       
				<?php $url = get_post_meta($post->ID, 'Url', true);   if($url) : ?>
				<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo format_url($url); ?></a> &middot; </span>
				<?php endif; ?>
				
		        <?php $url = get_post_meta($post->ID, 'Url2', true);   if($url) : ?>
				<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo format_url($url); ?></a> &middot; </span>
				<?php endif; ?>
		        <?php $url = get_post_meta($post->ID, 'Url3', true);   if($url) : ?>
				<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo format_url($url); ?></a> &middot; </span>
				<?php endif; ?>
		        <?php $url = get_post_meta($post->ID, 'Url4', true);   if($url) : ?>
				<span class="date url-link"> &middot; <a href="<?php echo $url; ?>"><?php echo format_url($url); ?></a> &middot; </span>
				<?php endif; ?>
		
		       
			<?php $quote = get_post_meta($post->ID, 'Quote', true);   if($quote != "") : ?>		    
		        <blockquote>
		        <p><?php echo $quote; ?></p>
		        </blockquote>
		    <?php endif; ?>
		
		
		</div><!-- #project-details-->
		                



<?php endif; // end template-switchin ?>                
                
                
                

 </div><!-- row -->

    
    
		<div class="piece-nav">
		<?php echo do_action( 'c2c_previous_or_loop_post_link', $format='%link', $link='<div class="nav-left"><h3>Previous piece</h3><span>%title</span></div>' ); ?>
		<?php echo do_action( 'c2c_next_or_loop_post_link', $format='%link', $link='<div class="nav-right"><h3>Next piece</h3><span>%title</span></div>' ); ?>
		</div>







<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>