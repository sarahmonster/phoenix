<?php
/**
 * @package Flare
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-meta">
			<?php flare_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php flare_subtitle(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'flare' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //flare_entry_footer(); ?>
		Like this post? Hate this post? Let&rsquo;s talk about it.
		<a href="http://twitter.com/home?status=Hey @sarahsemark, loved your blog post!">Tweet tweet.</a>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
