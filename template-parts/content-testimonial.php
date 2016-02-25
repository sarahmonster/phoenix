<?php
/**
 * The template used for displaying testimonials.
 *
 * @package Phoenix
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'phoenix-square' ); ?>
	<?php endif; ?>

	<blockquote>
		<?php the_content(); ?>
	</blockquote>

  <footer class="attribution">
    <?php the_title( '<cite class="author">', '</cite>' ); ?>
  </footer>

	<?php edit_post_link( __( 'Edit', 'phoenix' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
