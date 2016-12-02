// Include Gulp
var gulp = require( 'gulp' );

// Include Plugins
var sass = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var imagemin = require( 'gulp-imagemin' );
var pngquant = require( 'imagemin-pngquant' );
var jshint = require( 'gulp-jshint' );
var concat = require( 'gulp-concat' );
var cache = require( 'gulp-cache' );
var sourcemaps = require( 'gulp-sourcemaps' );
var csscomb = require( 'gulp-csscomb' );
var livereload = require( 'gulp-livereload' );
var svgmin = require( 'gulp-svgmin' );
var cheerio = require( 'gulp-cheerio' );
var svgstore = require( 'gulp-svgstore' );
var notify = require( 'gulp-notify' );

// Styles tasks
gulp.task( 'styles', function() {
	return gulp.src( 'assets/sass/style.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass( { style: 'expanded' } ).on( 'error', sass.logError ) )
		.pipe( autoprefixer( { browsers: ['last 2 versions', 'ie >= 9'], cascade: false } ) )
		.pipe( sourcemaps.write( './' ) )
		//.pipe( csscomb() )
		.on( 'error', notify.onError( function( err ) {
			return "Stylesheet Error in " + err.message;
		} ) )
		.pipe( gulp.dest( './' ) )
		.pipe( livereload() );
} );

// Scripts
gulp.task( 'scripts', function() {
	return gulp.src( 'assets/js/*.js' )
		.pipe( jshint.reporter( 'default' ) )
		//.pipe( concat( 'main.js' ) )
		.pipe( gulp.dest( 'assets/js' ) );
} );

// Images
gulp.task( 'images', function() {
	return gulp.src( 'assets/images/*' )
	.pipe( cache( imagemin( {
		optimizationLevel: 3,
		progressive: true,
		interlaced: true,
		svgoPlugins: [{ removeViewBox: false }],
		use: [pngquant()]
	} ) ) )
	.pipe( gulp.dest( 'assets/images' ) );
} );

// Minify our icons and make them into an inline sprite
gulp.task( 'icons', function() {
	return gulp.src( 'assets/svg/icons/*.svg' )
		.pipe( svgmin() )
		.pipe( svgstore( {
			fileName: 'icons.svg',
			inlineSvg: true
		} ) )
		.pipe( cheerio( {
		run: function( $, file ) {
			$( 'svg' ).addClass( 'hide' );
			$( '[fill]' ).removeAttr( 'fill' );
		},
		parserOptions: { xmlMode: true }
		}))
		.pipe( gulp.dest( 'assets/svg' ) );
});

// Watch files for changes
gulp.task( 'watch', function() {
	livereload.listen();
	gulp.watch( 'assets/sass/**/*.scss', ['styles'] );
	gulp.watch( 'assets/js/**/*.js', ['scripts'] );
	gulp.watch( 'assets/images/*', ['images'] );
	gulp.watch( 'assets/svg/icons/*', ['icons'] );
} );

// Default Task
gulp.task( 'default', ['styles', 'scripts', 'images', 'icons', 'watch'] );
