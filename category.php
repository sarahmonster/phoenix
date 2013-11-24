<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
	<div class="twelvecol last">
				<span class="page-subtitle">Archives of the category called</span>
				<h1><?php
					printf( __( '%s', 'twentyten' ), '' . single_cat_title( '', false ) . '' );
				?></h1>
		</div>
		</div><!-- row -->
		
		<div class="row">
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '' . $category_description . '';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
		</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>