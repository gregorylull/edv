var gulp = require('gulp');
var concat = require('gulp-concat');
var ngAnnotate = require('gulp-ng-annotate');
var watch = require('gulp-watch');
var del = require('del');
var livereload = require('gulp-livereload');

// dev environment
var host = 'http://localhost';
var port = 3000;

// all js scripts EXCEPT for test scripts in angularApp folder
var paths = {
  scripts: ['./app.js', './js/angularApp/**/*.js', '!./js/angularApp/**/*_test.js'],
  template: ['./js/angularApp/**/*.html'],
  php: ['./wp_php/*.php', './php/*.php']
};

var reloadPage = function (f) {
  console.log('change: ', f);
  livereload.reload();
};

// copied over from gulp docs, sample code
gulp.task('clean', function(cb) {
  // You can use multiple globbing patterns as you would with `gulp.src`
  del(['build'], cb);
});

// concat, annotate js scripts
gulp.task('scripts', ['clean'], function() {
  // place code for your default task here
  return gulp.src(paths.scripts)
    .pipe(concat('production.js'))
    .pipe(ngAnnotate())
    .pipe(gulp.dest('./build/'))
    .pipe(livereload());
});

// auto watch for changes in paths.scripts
gulp.task('watch', function () {
  livereload({start: true});
  gulp.watch(paths.template, reloadPage) // .html templates
  gulp.watch(paths.php, reloadPage) // php scripts
  gulp.watch(paths.scripts, ['scripts'], reloadPage); // concat scripts
});

gulp.task('default', ['watch', 'scripts']);
