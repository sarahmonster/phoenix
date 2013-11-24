<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>


<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */

 ?>
 <span class="date"> &middot; <span class="highlight">Search</span> this site &middot; </span>
 <?php	
 get_search_form(); 
 
 
	global $TRIGGER_CATEGORIES;
	foreach ($TRIGGER_CATEGORIES as $c) {
		echo list_stickies($c, 5, 'blog');
	}
?>