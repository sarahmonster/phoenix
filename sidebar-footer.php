<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>




					<div class="threecol">
						<h3>Talk to me</h3>
						<div class="social">
							<a id="twitter" href="http://twitter.com/sarahsemark">Twitter</a>
							<a id="facebook" href="http://facebook.com/triggersandsparks">Facebook</a>
							<a id="subscribe" href="/feed">Subscribe</a>
							<a id="quote" href="/contact">Quote Request</a>
						</div>
						<h3>Search the site</h3>
						<?php get_search_form(); ?>
						
						<div id="footer-blog-preview">
						<h3>Read my blog</h3>
						<?php global $TRIGGER_CATEGORIES ?>
						<?php echo list_stickies($TRIGGER_CATEGORIES[array_rand($TRIGGER_CATEGORIES)], 1, 'blog') ?>
						</div>
						
						
												
					</div>




					<div class="fourcol">
						<h3>Client lovenotes</h3>
						<blockquote>
						<?php $quote = quotescollection_quote('show_author=0&show_source=0&random=1&tags=footer&ajax_refresh=1&echo=0'); ?>
						<?php echo $quote; ?>
						</blockquote>
					</div>











					<div class="fivecol last">
					<h3>Check out my work</h3>
					<?php
					$args = array( 'posts_per_page' => 1, 'post_type' => 'pieces', 'orderby' => 'rand' );
					query_posts($args);
					while ( have_posts() ) : the_post();
					?>
						<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">	
			<?php 
			if (has_post_thumbnail()) {
				the_post_thumbnail('portfolio');
			} 
			?>
		</a>
		<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">
			<h2><?php echo the_title();  ?></h2>
			<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'Subtitle', true); ?></p>
		</a>
					<?php 
					endwhile;
					wp_reset_query();
					?>
					</div>

