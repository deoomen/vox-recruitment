const resourcesDir = 'resources';
const distDir = 'dist';

const gulp = require('gulp');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const { parallel } = require('gulp');

gulp.task('vendor', (done) => {
  gulp
    .src('node_modules/bootstrap/dist/css/bootstrap.min.css')
    .pipe(gulp.dest(distDir + '/css'));
  gulp
    .src('node_modules/bootstrap/dist/js/bootstrap.min.js')
    .pipe(gulp.dest(distDir + '/js'));

  return done();
});

gulp.task('scss', () => {
  return gulp
    .src(resourcesDir + '/scss/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(distDir + '/css'));
});

gulp.task('js', () => {
  return gulp
    .src(resourcesDir + '/js/*.js')
    .pipe(uglify())
    .pipe(gulp.dest(distDir + '/js'));
});

gulp.task('watch', () => {
  gulp.watch(resourcesDir + '/scss/*.scss', scssTask);
  gulp.watch(resourcesDir + '/js/*.js', jsTask);
});

exports.default = parallel(
  'vendor',
  'scss',
  'js'
);
