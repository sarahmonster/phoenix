<?php
/**
 * The template for displaying the Testimonials archive page.
 *
 * @package Phoenix
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
		</header><!-- .page-header -->

	<?php $jetpack_options = get_theme_mod( 'jetpack_testimonials' ); ?>

	<?php if ( '' !== $jetpack_options['page-content'] ) : // only display if content isn't empty ?>
		<div class="taxonomy-description">
			<?php echo convert_chars( convert_smilies( wptexturize( stripslashes( wp_filter_post_kses( addslashes( $jetpack_options['page-content'] ) ) ) ) ) ); ?>
		</div>
	<?php endif;

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'testimonial' );
		endwhile;

		phoenix_numeric_pagination();
	endif;
	wp_reset_postdata(); ?>

	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
