<?php
/**
 * The template to display individual portfolio pieces in a list.
 */
?>




<div class="fourcol portfolio-excerpt">
	<div class="portfolio-inner">
		<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">	
			<?php 
			$template = parse_url(get_bloginfo('template_directory'));
			$slug = $post->post_name; 
			$thumbnail_path = $template['path']."/pieces/".$slug."/";
			?>
		<img src="<?php echo $thumbnail_path; ?>thumbnail.jpg" />
		<img class="hover" src="<?php echo $thumbnail_path; ?>thumbnail-alt.jpg" />
		
		<div class="overlay">
			<h2><?php echo the_title();  ?></h2>
			<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'Subtitle', true); ?></p>
		</div>
		
		</a>
	</div>
</div>

