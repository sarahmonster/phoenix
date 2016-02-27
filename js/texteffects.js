( function($) {

	// Let's do some fun things with our entry titles.
	function tweakTitles() {
		console.log( 'Doing it!' );
		//$( '.entry-title' ).lettering( 'lines' );
		$( '.entry-title' ).lettering( 'words' );
		//$( '.word3' ).fitText( 1 );
	}

	// Fit and animate text on homepage.
	function animateHomepage() {
		$(".hello").fitText(1.3);
		$('.loves').textillate({
			selector: '.texts',
			loop: true,
			minDisplayTime: 4000,
			initialDelay: 0,
			autoStart: true,

			// custom set of 'in' effects. This effects whether or not the
			// character is shown/hidden before or after an animation
			inEffects: [],

			// custom set of 'out' effects
			outEffects: [],

			// in animation settings
			in: {
				effect: 'fadeIn',
				delayScale: 3,
				delay: 50,
				sync: false,
				shuffle: true,
				reverse: false,
				callback: function () {}
			},

			// out animation settings.
			out: {
				effect: 'fadeOut',
				delayScale: 3,
				delay: 50,
				sync: false,
				shuffle: true,
				reverse: false,
				callback: function () {}
			},

			// callback that executes once textillate has finished
			callback: function () {},

			// set the type of token to animate (available types: 'char' and 'word')
			type: 'char'
		});
	}

	// Run our fancy-pants text effects bits once the page has fully loaded.
	$( document ).ready( function() {
		tweakTitles();
		animateHomepage();
	} );

})( jQuery );
