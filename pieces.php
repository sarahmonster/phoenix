<?php
/**
 * The template to display individual portfolio pieces in a list.
 */
?>




<div class="fourcol portfolio-excerpt">
		<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title_attribute(); ?>">	
			<?php 
			$template = parse_url(get_bloginfo('template_directory'));
			$slug = $post->post_name; 
			$thumbnail_path = $template['path']."/pieces/".$slug."/";
			?>
		<img src="<?php echo $thumbnail_path; ?>thumbnail.jpg" />
		<img class="hover" src="<?php echo $thumbnail_path; ?>thumbnail-alt.jpg" />
		
		<div class="overlay">
		<?php 
		$client = get_post_meta($post->ID, 'Client', $single);
		//echo $client[0];
		
		if ($client[0] != "") {
			$title = $client[0];
		} else {
			$title = get_the_title();
		}
		?>
		
			<h2><?php echo $title; ?></h2>
			<p class="subtitle"><?php echo get_post_meta(get_the_ID(), 'Subtitle', true); ?></p>
		</div>
		
		</a>
</div>

