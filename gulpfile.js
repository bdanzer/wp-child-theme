// Load all the modules from package.json
var gulp = require( 'gulp' ),
  plumber = require( 'gulp-plumber' ),
  autoprefixer = require('gulp-autoprefixer'),
  watch = require( 'gulp-watch' ),
  minifycss = require( 'gulp-minify-css' ),
  jshint = require( 'gulp-jshint' ),
  stylish = require( 'jshint-stylish' ),
  uglify = require( 'gulp-uglify' ),
  rename = require( 'gulp-rename' ),
  notify = require( 'gulp-notify' ),
  include = require( 'gulp-include' ),
  sass = require( 'gulp-sass' ),
  imagemin = require('gulp-imagemin'),
  bower = require('gulp-bower'),
  cleanCSS = require('gulp-clean-css'),
  concatCss = require('gulp-concat-css'),
  concat = require('gulp-concat'),
  sourcemaps = require('gulp-sourcemaps'),
  clean = require('gulp-clean');;


var config = {
  bowerDir: './bower_components'
}

// Default error handler
var onError = function( err ) {
  console.log( 'An error occured:', err.message );
  this.emit('end');
}

// Install all Bower components
gulp.task('bower', function() {
  return bower()
    .pipe(gulp.dest(config.bowerDir))
});

gulp.task('clean', function () {
  return gulp.src('js/dist/*', {read: false})
      .pipe(clean());
});

// Minify Custom JavaScript files
gulp.task('custom-scripts', function() {
  return gulp.src('./js/src/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe( rename( { basename: 'main.min' } ) )
    .pipe(gulp.dest('./js/dist/'))
    .pipe(notify({ message: 'Custom JS task complete' }));
});


// Concatenates all files that it finds in the manifest
// and creates two versions: normal and minified.
// It's dependent on the jshint task to succeed.
gulp.task( 'scripts', ['custom-scripts'], function() {
  return gulp.src( './js/manifest.js' )
    .pipe(sourcemaps.init())
    .pipe( include() )
    .pipe( rename( { basename: 'scripts' } ) )
    .pipe( uglify() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe(sourcemaps.write())
    .pipe( gulp.dest( './js/dist' ) )
    .pipe(notify({ message: 'Scripts task complete' }));
  }
);

// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
var options = {};
options.sass = {
  errLogToConsole: true,
  sourceMap: 'sass',
  sourceComments: 'map',
  outputStyle: 'nested',
  precision: 10,
  imagePath: 'assets/img',
};
options.autoprefixer = {
  map: true
  //from: 'sass',
  //to: 'asrp.min.css'
};

gulp.task('sass', function() {
  return gulp.src('./sass/style.scss')
    .pipe(sourcemaps.init())
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe(sass(options.sass))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4',
      options.autoprefixer
      ))
    .pipe( minifycss() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe(sourcemaps.write())
    .pipe( gulp.dest( '.' ) )
    .pipe(notify({ message: 'SASS task complete' }))
});

gulp.task('style', function() {
  return gulp.src(['css/**/*.css', 'css/*.css'])
    .pipe(concatCss("custom.css"))
    .pipe( minifycss() )
    .pipe( rename( {
      prefix: "style.",
      basename: 'custom',
      suffix: '.min'
    } ) )
    .pipe(gulp.dest('.'))
    .pipe(notify({ message: 'custom CSS style complete' }));
});

// Optimize Images
gulp.task('images', function() {
  return gulp.src('./images/**/*')
    .pipe(imagemin({ progressive: true, svgoPlugins: [{removeViewBox: false}]}))
    .pipe(gulp.dest('./images'))
    .pipe(notify({ message: 'Images task complete' }));
});


gulp.task( 'watch', function() {
  // don't listen to whole js folder, it'll create an infinite loop
  gulp.watch( [ './js/**/*.js', '!./js/dist/*.js' ], [ 'clean', 'scripts' ]);

  gulp.watch( './sass/**/*.scss', ['sass'] );

  gulp.watch( ['css/**/*.css', 'css/*.css'], ['style'] );

  gulp.watch( './images/**/*', ['images']);
} );


gulp.task( 'default', ['bower', 'scripts','sass','style','images']);
