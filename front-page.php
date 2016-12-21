<?php
/**
 * The template for displaying the front page.
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="phoenix-intro-text phoenix-panel">
				<span>Hi. I&rsquo;m <a href="/about" data-hover="Sarah">Sarah</a>.</span>
				<span>I <a href="/work" data-hover="make">make</a> things,</span>
				<span>I <a href="/travels" data-hover="travel">travel</a> the world,</span>
				<span>&amp; I write <a href="/stories" data-hover="stories">stories</a>.</span>
			</div>

			<div class="phoenix-newest-stories phoenix-panel">
				<h2><?php esc_html_e( 'Newest stories', 'phoenix' ); ?></h2>

				<?php
				// Grab the most recent posts
					$phoenix_recent_posts = wp_get_recent_posts( array(
						'numberposts' => 3,
						'post_status' => 'publish',
			 		), OBJECT );

			 		get_posts( $phoenix_recent_posts );

			 		foreach ( $phoenix_recent_posts as $post):
			 			setup_postdata( $post);

			 			echo '<article class="phoenix-short-post">';

							// Title
							printf( '<h3 class="entry-title"><a href="%1$s" rel="bookmark">%2$s</a></h3>',
					 			esc_url( get_permalink() ),
					 			esc_html( get_the_title() )
							);

							printf( '<a href="%1$s" rel="bookmark" title="%2$s">',
											esc_url( get_permalink() ),
											esc_html( phoenix_subtitle() )
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


<?php get_footer(); ?>
