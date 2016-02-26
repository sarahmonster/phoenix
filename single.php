<?php
/**
 * The template for displaying all single posts.
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation( array(
        'prev_text'          => '<span>Previous</span> %title',
        'next_text'          => '<span>Next</span> %title',
    	) );
    	?>

			<?php
				/* Comments are the devil. Get your own website!
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				*/
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
