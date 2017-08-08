<?php
/**
 * @package Phoenix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'full', array( 'class' => 'phoenix-background-image' ) );
		endif; ?>

		<div class="entry-meta">
			<?php phoenix_post_category(); ?>
			<?php phoenix_post_date(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php phoenix_subtitle( true ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'phoenix' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php phoenix_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
