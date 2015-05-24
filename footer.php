<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Flare
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( 'Made with &hearts; and', 'flare' ); ?>
      <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'flare' ) ); ?>"><?php printf( __( '%s', 'flare' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme on %1$s', 'flare' ), '<a href="http://github.com/sarahsemark/flare/" rel="designer">Github</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
