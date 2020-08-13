const resourcesDir = 'resources';
const distDir = 'dist';

const gulp = require('gulp');
const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const { parallel } = require('gulp');

function vendorTask(done) {
  gulp
    .src('node_modules/bootstrap/dist/css/bootstrap.min.css')
    .pipe(gulp.dest(distDir + '/css'));
  gulp
    .src([
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/popper.js/dist/umd/popper.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ])
    .pipe(gulp.dest(distDir + '/js'));

  return done();
}

function scssTask() {
  return gulp
    .src(resourcesDir + '/scss/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(distDir + '/css'));
}

function jsTask() {
  return gulp
    .src(resourcesDir + '/js/*.js')
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(uglify())
    .pipe(gulp.dest(distDir + '/js'));
}

function watchTask() {
  gulp.watch(resourcesDir + '/scss/*.scss', scssTask);
  gulp.watch(resourcesDir + '/js/*.js', jsTask);
}

exports.vendor = vendorTask;
exports.scss = scssTask;
exports.js = jsTask;
exports.watch = watchTask;
exports.default = parallel(
  vendorTask,
  scssTask,
  jsTask
);
