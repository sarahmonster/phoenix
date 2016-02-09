<?php
/**
 * The template for displaying single projects.
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'portfolio-single' ); ?>

		<?php endwhile; // End of the loop. ?>

		<?php the_post_navigation( array(
									'prev_text'          => '<span>Previous Project</span> %title',
									'next_text'          => '<span>Next Project</span> %title',
								) ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
