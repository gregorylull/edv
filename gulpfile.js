/*
  RESOURCES

  gulp-livereload
    https://github.com/efficiently/larasset/wiki/Lightning-Fast-Assets-Reloading-with-LiveReload
*/

var gulp = require('gulp');
var watch = require('gulp-watch');
var del = require('del');
var livereload = require('gulp-livereload');
var remember = require('gulp-remember');
var cache = require('gulp-cached');

// javascript
var jshint = require('gulp-jshint');

// angular
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var ngAnnotate = require('gulp-ng-annotate');

// css
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss = require('gulp-minify-css');
var concatCSS = require('gulp-concat-css');

/*-----------------------------------------------------------------------------
    ENVIRONMENT AND PATH VARS
-----------------------------------------------------------------------------*/

// dev environment
var host = 'http://localhost';
var port = 3000;

// all js scripts EXCEPT for test scripts in angularApp folder
var paths = {
  scripts: ['./app.js', './js/angularApp/**/*.js', '!./js/angularApp/**/*_test.js'],
  template: ['./js/angularApp/**/*.html'],
  php: ['index.php','./wp_php/*.php', './php/*.php'],
  scss: ['./bower_components/foundation/scss/*.scss', './scss/*.scss', './js/angularApp/component/**/*.scss'],
  tests: ['./js/angularApp/**/*_test.js']
};

/*-----------------------------------------------------------------------------
    HELPER FUCNTIONS
-----------------------------------------------------------------------------*/

// force reload of browser page with livereload chrome extension
var reloadPage = function (f) {
  console.log('change: ', f);
  livereload.reload();
};

/*-----------------------------------------------------------------------------
    TASKS
-----------------------------------------------------------------------------*/

gulp.task('lint', function() {
  return gulp.src(paths.scripts)
    .pipe(cache('linting'))
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'));
});

// clean javascript code
gulp.task('cleanJS', function(cb) {
  // You can use multiple globbing patterns as you would with `gulp.src`
  del(['build/js'], cb);
});

// clean test js code
gulp.task('cleanTEST', function (cb) {
  del(['build/test', cb]);
});

// clean css code
gulp.task('cleanCSS', function(cb) {
  // You can use multiple globbing patterns as you would with `gulp.src`
  del(['build/css'], cb);
});

// concat, annotate angular js scripts
gulp.task('scripts', ['cleanJS','lint'], function() {
  // place code for your default task here
  return gulp.src(paths.scripts)
    .pipe(cache('scripts'))
    .pipe(ngAnnotate())
    .pipe(uglify())
    .pipe(remember('scripts'))
    .pipe(concat('production.js'))
    .pipe(gulp.dest('./build/js/'))
    .pipe(livereload());
});

// concat TEST scripts
gulp.task('tests', ['cleanTEST', 'lint'], function () {
  return gulp.src(paths.tests)
    .pipe(concat('test.js'))
    .pipe(ngAnnotate())
    .pipe(uglify())
    .pipe(gulp.dest('./build/test/'))
    .pipe(livereload());
});

// scss to css, prefix, and minify
gulp.task('sass', ['cleanCSS'],function () {
  return gulp.src(paths.scss)
    .pipe(cache('sass'))
    .pipe(sass({
      includePaths: ['bower_components/foundation/scss'],
      data: ['bower_components/foundation/scss'],
      outputStyle: 'expanded'
    }))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie'))
    .pipe(remember('sass'))
    .pipe(concatCSS('app.css'))
    .pipe(minifycss())
    .pipe(gulp.dest('./build/css/'))
    .pipe(livereload());
});

var rememberForget = function (name) {
  return function (event) {
    if (event.type === 'deleted') { // if a file is deleted, forget about it 
      delete cache.caches[name][event.path];
      remember.forget(name, event.path);
    }
  }
};

// auto watch for changes in paths.scripts
gulp.task('watch', function () {
  livereload({start: true});

  // run scripts
  gulp.watch(paths.scripts, ['scripts'], reloadPage).on('change', rememberForget('scripts'));
  gulp.watch(paths.scss, ['sass'], reloadPage).on('change', rememberForget('sass'));
  gulp.watch(paths.tests, ['tests']).on('change', rememberForget('tests'));

  // only reload
  gulp.watch(paths.template, reloadPage);
  gulp.watch(paths.php, reloadPage);
});

gulp.task('default', ['watch', 'scripts', 'sass']);
