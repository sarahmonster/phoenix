<?php
/**
 * The template to display individual portfolio pieces in a list.
 */
?>




<div class="sixcol portfolio-excerpt">
	<div class="portfolio-inner">
		<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">	
			<?php 
			if (has_post_thumbnail()) {
				the_post_thumbnail('portfolio');
			} 
			?>
		</a>
		<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">
		<div class="overlay">
			<h2><?php echo the_title();  ?></h2>
			<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'Subtitle', true); ?></p>
		</div>
		</a>
	</div>
</div>

