/**
 * Created by emilio1625 on 18/12/16.
 */
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var util = require('gulp-util');
var plumber = require('gulp-plumber');

var config = {
    assetsDir: 'app/Resources/assets/',
    sassPattern: 'sass/**/*.scss',
    production: false
};

gulp.task('sass', function () {
    gulp.src(config.assetsDir + config.sassPattern)
        .pipe(config.production ? util.noop() : plumber())
        .pipe(config.production ? util.noop() : sourcemaps.init())
        .pipe(sass({precision:10}))
        .pipe(config.production ? concat('main.css') : util.noop())
        .pipe(config.production ? cleanCSS({compatibility: 'ie8'}) : util.noop())
        .pipe(config.production ? util.noop() : autoprefixer({
                browsers: [
                    "Android 2.3",
                    "Android >= 4",
                    "Chrome >= 20",
                    "Firefox >= 24",
                    "Explorer >= 8",
                    "iOS >= 6",
                    "Opera >= 12",
                    "Safari >= 6"
                ]
            }))//.pipe(config.production ? util.noop() : sourcemaps.write('.'))
        .pipe(config.production ? util.noop() : plumber.stop())
        .pipe(gulp.dest('web/css'));
});

gulp.task('watch', function() {
    gulp.watch(config.assetsDir + config.sassPattern, ['sass']);
});

gulp.task('default', ['sass', 'watch']);
