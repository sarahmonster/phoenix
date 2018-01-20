( function($) {

	// Function to slabtext the H1 headings
	function tweakTitles() {
	    $( 'h1' ).slabText({
	        // Don't slabtext the headers if the viewport is under 380px
	        "viewportBreakpoint":380
	    });
	};

	// Run our fancy-pants text effects bits once the page has fully loaded.
	$( document ).ready( function() {
		tweakTitles();
	} );

})( jQuery );
