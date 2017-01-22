<?php
/**
 * @package Phoenix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php phoenix_post_category(); ?>
				<?php phoenix_post_date(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		printf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">%2$s</a></h2>',
						 esc_url( get_permalink() ),
						 esc_html( get_the_title() )
					);
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			/* translators: %s: Name of current post */
			the_excerpt();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
