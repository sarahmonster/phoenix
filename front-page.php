<?php
/**
 * The template for displaying the front page.
 *
 * @package Flare
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); // Loopety-loop ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
						<span class="subtitle"><?php echo flare_subtitle(); ?></span>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<div class="flare-location-widget">
						<h3><?php esc_html_e( 'Upcoming Adventures', 'flare' ); ?></h3>
						<ul>
							<li>Currently exploring: <?php echo flare_get_current_location(); ?></li>
						<?php
						 foreach( flare_upcoming_locations() as $post ):
						 	echo "<li>";
						 	echo mysql2date( 'M j', $post->post_date ) . ": " . $post->post_title;
						 	echo "</li>";
						 endforeach;
						?>
						</ul>
					</div><!-- .flare-location-widget -->

				</article><!-- #post-## -->
			<?php endwhile; ?>

			<div class="flare-frontpage-widget">
				<h3><?php esc_html_e( 'Newest stories', 'flare' ); ?></h3>

				<?php
				// Grab the three most recent posts
					$flare_recent_posts = wp_get_recent_posts( array(
						'numberposts' => 3,
						'post_status' => 'publish',
			 		), OBJECT );

			 		get_posts( $flare_recent_posts );

			 		foreach ( $flare_recent_posts as $post):
			 			setup_postdata( $post);

			 			echo '<article class="flare-short-post">';
						printf( '<a href="%1$s" rel="bookmark" title="%2$s">',
										esc_url( get_permalink() ),
										esc_html( flare_subtitle() )
									);

							// Title
							printf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">%2$s</a></h2>',
					 			esc_url( get_permalink() ),
					 			esc_html( get_the_title() )
							);

							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'flare-square' );
							} else {
								echo '<img src="/wp-content/themes/flare/images/placeholder.png" alt="View post" />';
							}
							echo '</a>';

							echo '<div class="entry-content">';
							the_excerpt();
							echo '</div>';

						echo "</article>";

						wp_reset_postdata();
					endforeach;
				?>
			</div><!-- .flare-frontpage-widget -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
