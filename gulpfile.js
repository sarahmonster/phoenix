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
var browserSync = require('browser-sync').create();
var svgmin = require( 'gulp-svgmin' );
var cheerio = require( 'gulp-cheerio' );
var svgstore = require( 'gulp-svgstore' );
var notify = require( 'gulp-notify' );

var styleguide = require('sc5-styleguide');
var outputPath = 'sc5';

// Styles tasks
gulp.task( 'styles', function() {
	return gulp.src( 'assets/stylesheets/style.scss' )
		.pipe( sourcemaps.init() )
		.pipe( sass( { style: 'expanded' } ) )
		.on( 'error', notify.onError( function( err ) {
			return "Stylesheet Error in " + err.message;
		} ) )
		.pipe( autoprefixer( { browsers: ['last 2 versions', 'ie >= 9'], cascade: false } ) )
		.pipe( sourcemaps.write( './', { includeContent: false, sourceRoot: 'source' } ) )
		.pipe( gulp.dest( './' ) )
		.pipe( browserSync.stream() );
});

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

// Generate style guide assets.
gulp.task( 'style-guide', function() {
	return gulp.src( 'assets/style-guide/stylesheets/style-guide.scss' )
		.pipe( sass( { style: 'expanded' } ).on( 'error', sass.logError ) )
		.on( 'error', function ( err ) {
			console.error( 'Error!', err.message );
		} )
		.pipe( gulp.dest( 'assets/style-guide' ) )
});

// Watch files for changes
gulp.task( 'watch', function() {
	gulp.watch( 'assets/**/*.scss', ['styles', 'style-guide', 'sc5-styleguide'] );
	gulp.watch( 'assets/js/**/*.js', ['scripts'] );
	gulp.watch( 'assets/images/*', ['images'] );
	gulp.watch( 'assets/svg/icons/*', ['icons'] );
	
} );

// Generate some extra CSS for sc5.
gulp.task( 'sc5-styleguide:styles', function() {
	return gulp.src( 'assets/stylesheets/vendor/sc5/extra-styles.scss' )
		.pipe( sass( { style: 'expanded' } ).on( 'error', sass.logError ) )
		.on( 'error', function ( err ) {
			console.error( 'Error!', err.message );
		} )
		.pipe(gulp.dest(outputPath + '/css'))
});

gulp.task('sc5-styleguide:generate', function() {
  return gulp.src('assets/**/*.scss')
    .pipe(styleguide.generate({
        title: 'Style guide | Triggers & Sparks',
		extraHead: [
			//'<link rel="stylesheet" href="/css/extra-styles.css">',
			'<script src="https://use.typekit.net/rmt3uuy.js"></script>',
			'<script>try{Typekit.load({ async: true });}catch(e){}</script>'
		],
		sideNav: true,
        server: true,
        rootPath: outputPath,
		includeDefaultStyles: true,
		//customColors: 'assets/stylesheets/vendor/sc5/variables.css',
		//appRoot: '/sc5',
        overviewPath: 'README.md'
      }))
    .pipe(gulp.dest(outputPath));
});

gulp.task('sc5-styleguide:applystyles', function() {
      return gulp.src([
        'assets/stylesheets/style.scss'
        //'assets/stylesheets/vendor/sc5/variables.scss'
        ])
    .pipe(sass({
      errLogToConsole: true
    }))
    .pipe(styleguide.applyStyles())
    .pipe(gulp.dest(outputPath));
});

gulp.task('sc5-styleguide', ['sc5-styleguide:generate', 'sc5-styleguide:applystyles', 'sc5-styleguide:styles']);

// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "triggersandsparks.dev"
    });
});


// Default Task
gulp.task( 'default', ['styles', 'scripts', 'images', 'icons', 'style-guide', 'sc5-styleguide', 'browser-sync', 'watch'] );
