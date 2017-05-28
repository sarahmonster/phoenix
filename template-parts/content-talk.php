<?php
/**
 * @package Phoenix
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	// Get an array of all our post meta.
	$meta = get_post_meta( get_the_ID(), 'event_details' )[0];

	if ( phoenix_date_is_upcoming( $meta['date'] ) ) : ?>
		<span class="phoenix-upcoming"><?php esc_html_e( 'Upcoming', 'phoenix' ); ?></span>
	<?php endif;

	// Display either a video clip...
	if ( array_key_exists( 'video' , $meta ) && $meta['video'] ) :
		phoenix_embed_video( $meta['video'] );

	// or a featured image...
	elseif ( has_post_thumbnail() ) :
		the_post_thumbnail( 'phoenix-square' );

	// or fall back to a placeholder.
	else : ?>
		<div class="placeholder">
			<?php the_title(); ?>
		</div>
	<?php endif;

	// Output the name of the event.
	if ( array_key_exists( 'link' , $meta ) ) :
		printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( $meta['link'] ),
			esc_html( get_the_title() )
		);
	else :
		the_title();
	endif;

	// Format and output date.
	if ( array_key_exists( 'date' , $meta ) && $meta['date'] ) :
		echo '<br />';
		if ( phoenix_date_is_upcoming( $meta['date'] ) ) :
			echo date( 'l jS F Y', $meta['date'] );
		else :
			echo date( 'F Y', $meta['date'] );
		endif;
	endif;

	// Format and output location.
	if ( array_key_exists( 'location' , $meta ) && $meta['location'] ) :
		echo '<br />';
		echo $meta['location'];
	endif;

	if ( array_key_exists( 'slides' , $meta ) && $meta['slides'] OR array_key_exists( 'video' , $meta ) && $meta['video'] ) :
		echo '<br />';
		// Format and output link to slides.
		if ( array_key_exists( 'slides' , $meta ) && $meta['slides'] ) :
			printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( $meta['slides'] ),
				esc_html__( 'Slides', 'phoenix' )
			);
		endif;

		// Format and output link to video.
		if ( array_key_exists( 'video' , $meta ) && $meta['video'] ) :
			printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( $meta['video'] ),
				esc_html__( 'Video', 'phoenix' )
			);
		endif;
	endif;

	?>

</article><!-- #post-## -->
