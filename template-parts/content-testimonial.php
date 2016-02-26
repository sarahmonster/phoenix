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
		<?php the_title( '<cite class="attribution">', '</cite>' ); ?>
		<?php edit_post_link( __( 'Edit', 'phoenix' ), '<span class="edit-link">', '</span>' ); ?>
	</blockquote>

</article><!-- #post-## -->
