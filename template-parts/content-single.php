<?php
/**
 * @package Phoenix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
		<div class="phoenix-panel-background" style="background-image:url(<?php echo esc_url( $thumbnail[0] ); ?>)"></div>
		<?php endif; ?>

		<div class="phoenix-header-text">
			<div class="entry-meta">
				<?php phoenix_post_category(); ?>
				<?php phoenix_post_date(); ?>
			</div><!-- .entry-meta -->

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php phoenix_subtitle( true ); ?>
		<div class="phoenix-header-text">

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
