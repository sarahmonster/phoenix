<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>


</div><!-- container -->

<div id="footer" class="container">
	<div class="row">

						<?php
							/* A sidebar in the footer? Yep. You can can customize
							 * your footer with four columns of widgets.
							 */
							get_sidebar( 'footer' );
						?>
						
	</div>
</div>
				
				
				
				
<div id="sub-footer">
	<div class="row">
		<div class="twelvecol last">
		<h5>You've got the fuel, I light the fire. Creative graphic design for web &amp; print.</h5>



    <a href="<?php echo get_bloginfo('url'); ?>">Home</a> | 
    
    <a href="/blog">Blog</a> | 
    
    <a href="/portfolio">Portfolio</a> | 
        
    <a href="/about">About</a> | 
    
    <a href="/clients">Client Testimonials</a> | 
    
    <a href="/services">Services</a> | 
    
    <a href="/contact">Contact &amp; Request a Quote</a>
    
    	</div>
    </div>
</div>		


<!-- MOBILE MENU -->
<div id="menu" style="display:none">

	<a id="mobile-menu-close" href="javascript:jQuery.pageslide.close()">x</a>

	<div id="mobile-nav" role="navigation">
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	</div>
	
	<a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/triggers-and-sparks.png" alt="triggers &amp; sparks" /></a>
</div>	


	<!-- add support for various jQuery plugins and custom scripts file -->
	<script src="<?php bloginfo( 'template_url' ); ?>/js/scripts.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.cycle.all.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.pageslide.min.js"></script>
	
	    
    <script>


</script>
    




				

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>