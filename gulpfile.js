
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');

// Paths
const paths = {
    scss: './assets/scss/**/*.scss',
    cssDest: './assets/css'
};

// Compile SCSS
gulp.task('styles', function () {
    return gulp.src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.cssDest));
});

// Watch
gulp.task('watch', function () {
    gulp.watch(paths.scss, gulp.series('styles'));
});

// Default
gulp.task('default', gulp.series('styles', 'watch'));
