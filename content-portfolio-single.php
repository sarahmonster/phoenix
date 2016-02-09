<?php
/**
 * Template part for displaying single projects.
 *
 * @package Phoenix
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<span class="subtitle"><?php //echo get_post_meta($post->ID, 'Subtitle', $single); ?></span>
	</header>

	<div class="entry-content">
		<?php
			the_content();
			$template = parse_url( get_template_directory_uri() );
			$slug = $post->post_name;
			$path = $template['path'] . '/pieces/' . $slug;
			include( '.' . $path . '/' . $slug . '.php' );
		?>
	</div><!-- .entry-content -->

	<div class="entry-meta">
		<?php // phoenix_portfolio_meta(); ?>
	</div><!-- .entry-meta -->

</article><!-- #post-## -->
