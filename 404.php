<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<header class="twelvecol last page-title">
		<span class="page-subtitle">Sorry kitten. Whatever you seek, it is no longer here. </span>
		<h1>404 Error</h1>
	</header>
				

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
	
					
					<div class="eightcol">
					<p class="cap">Quoth the server, &ldquo;four oh four.&rdquo;</p>
					<p>Try a search and see if you find what you&rsquo;re looking for. You can also check out some of my best blog posts, listed below. If you end up totally lost, just <a href="/contact">send me a message</a>, and I&rsquo;ll hunt it down for you.</p>
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

</div><!-- row -->	
<?php get_footer(); ?>
