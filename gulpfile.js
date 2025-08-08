
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');

const paths = {
    scss: './assets/scss/main.scss',
    cssDest: './assets/css'
};

gulp.task('styles', function () {
    return gulp.src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.cssDest));
});

gulp.task('watch', function () {
    gulp.watch('./assets/scss/**/*.scss', gulp.series('styles'));
});

gulp.task('default', gulp.series('styles', 'watch'));
