<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Phoenix
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
  	<a data-lang="en-gb" data-blog="http://triggersandsparks.com" href="http://triggersandsparks.com" class="wordpress-follow-button">Follow Triggers &amp; Sparks on WordPress.com</a>
		<script type="text/javascript">(function(d){var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');p.type = 'text/javascript';p.async = true;p.src = '//widgets.wp.com/platform.js';f.parentNode.insertBefore(p,f);}(document));</script>
		<div class="site-info">
			<?php printf( 'Made with <span class="icon-heart"></span> and', 'phoenix' ); ?>
      <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'phoenix' ) ); ?>"><?php printf( __( '%s', 'phoenix' ), 'WordPress' ); ?></a>
			<span class="sep"> &middot; </span>
			<?php printf( __( 'Theme on %1$s', 'phoenix' ), '<a href="https://github.com/sarahmonster/phoenix/" rel="designer">Github</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
