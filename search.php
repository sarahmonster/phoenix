<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<div class="twelvecol last">
		<span class="page-subtitle">You searched for <?php echo get_search_query(); ?>. Here&rsquo;s what I found.</span>
				
	
		
				
<?php if ( have_posts() ) : ?>
				<h1><?php printf( __( 'Search Results', 'twentyten' ), '' . get_search_query() . '' ); ?></h1>
				</div>
				<div class="row">
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
				</div>
<?php else : ?>
					<h1><?php _e( 'Absolutely nothing!', 'twentyten' ); ?></h1>
					
					</div>
					
					<div class="eightcol">
					<p class="cap">Oh no! I couldn&rsquo;t find anything to match your search request. Try another search and see if you find what you&rsquo;re looking for. You can also check out some of my best blog posts, listed below. If you end up totally lost, just <a href="/contact">send me a message</a>, and I&rsquo;ll hunt it down for you.</p>
					</div>
					<div id="sidebar" class="fourcol last">
					  <span class="date"> &middot; <span class="highlight">Search</span> this site &middot; </span>
					  	<?php	get_search_form(); ?>
					</div>
					
					<div class="fourcol stickies">
						<?php echo list_stickies(28, 5, 'blog'); ?>
					</div>
					<div class="fourcol stickies">
						<?php echo list_stickies(31, 5, 'blog'); ?>
					</div>
					<div class="fourcol last stickies">
						<?php echo list_stickies(77, 5, 'blog'); ?>
					</div>
<?php endif; ?>

</div><!-- row -->	
<?php get_footer(); ?>
