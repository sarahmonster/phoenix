<?php
/**
 * The template to display individual portfolio posts in a list.
 */
?>

	<div class="blog-excerpt sixcol">
	
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php 
		// show the featured image, if there's one set
		if (has_post_thumbnail()) {
			the_post_thumbnail('blog');
		} else {
			echo '<img src="/wp-content/themes/new-triggers-sparks/images/placeholder.png" alt="View post" />';
		}
		?>
		</a>
		
		<?php echo format_date(get_the_time('l '), get_the_time('F'), get_the_time('jS'), get_the_time('Y') ); ?>
				
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo subtitle($post->ID); ?>"><?php the_title(); ?></a></h2>
	        
	
		<p><?php the_excerpt_rss() ?></p>
	    
	</div>


