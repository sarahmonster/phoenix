// Let's do some jQuery!
jQuery(document).ready(function() {
	
	
	// HOMEPAGE SLIDESHOW
	
	jQuery("#slideshow").css("overflow", "hidden");
	jQuery("#slides").cycle({
		fx: 'fade',
		pause: 1,
		prev: '#prev',
		next: '#next'
	});


/*	jQuery("#slideshow").hover(function() {
		jQuery("#slideshow-nav").fadeIn();
	},
		function() {
			jQuery("#slideshow-nav").fadeOut();
	});

*/


	// ACTIVATE PAGESLIDE FOR MOBILE MENU
    jQuery(".open, .impatient").pageslide();
    jQuery("#mobile-menu-button").pageslide({ direction: "right", modal: false });

});



