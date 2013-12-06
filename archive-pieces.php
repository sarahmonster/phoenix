<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<?php
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	
	if (is_main_query() && $_GET['showhidden'] != "yes") {
		query_posts($query_string . '&cat=-86');
	}
	
	 while (have_posts()):
		the_post();
		
	endwhile;
?>






	<header class="twelvecol last page-title">
		<span class="page-subtitle">It&rsquo;s hard to choose, but here are some of my favourite projects</span>
		<h1 class="pagetitle">Selected Portfolio</h1>
	</header>

	</div><!-- row -->
	<div class="row">
	<div id="scroll-container">
<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'pieces' );
?>
	</div>
</div><!-- row -->	

<?php get_footer(); ?>