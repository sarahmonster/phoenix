<?php
/**
 * The template for displaying the front page.
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); // Loopety-loop ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->
			<?php endwhile; ?>

			<div class="phoenix-frontpage-widget">
				<h3><?php esc_html_e( 'Newest stories', 'phoenix' ); ?></h3>

				<?php
				// Grab the most recent posts
					$phoenix_recent_posts = wp_get_recent_posts( array(
						'numberposts' => 2,
						'post_status' => 'publish',
			 		), OBJECT );

			 		get_posts( $phoenix_recent_posts );

			 		foreach ( $phoenix_recent_posts as $post):
			 			setup_postdata( $post);

			 			echo '<article class="phoenix-short-post">';
						printf( '<a href="%1$s" rel="bookmark" title="%2$s">',
										esc_url( get_permalink() ),
										esc_html( phoenix_subtitle() )
									);

							// Title
							printf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">%2$s</a></h2>',
					 			esc_url( get_permalink() ),
					 			esc_html( get_the_title() )
							);

							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'phoenix-square' );
							} else {
								echo '<img src="/wp-content/themes/phoenix/images/placeholder.png" alt="View post" />';
							}
							echo '</a>';

							echo '<div class="entry-content">';
							the_excerpt();
							echo '</div>';

						echo "</article>";

						wp_reset_postdata();
					endforeach;
				?>
			</div><!-- .phoenix-frontpage-widget -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
