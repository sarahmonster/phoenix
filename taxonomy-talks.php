<?php
/**
 * The template for displaying talk archive pages.
 * Uses some special sauce.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="entry-content">
				<?php get_template_part( 'template-parts/talk', get_query_var( 'term' )  ); ?>

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/content', 'talk' ); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- .entry-content -->

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
