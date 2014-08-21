var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload;

// Sources
var sassWatch = './lib/scss/**/*.scss',
    sassSource = './lib/scss/*.scss',
    sassDestination = './',
    phpWatch = './**/*.php';

// Set the proxy.
gulp.task('browser-sync', function () {
    browserSync({
        proxy: "localhost/jump_start/"
    });
});

// Compile Sass file to CSS, and reload browser(s).
gulp.task('sass', function() {
    return gulp.src(sassSource)
        .pipe(sass())
        .pipe(gulp.dest(sassDestination))
        .pipe(reload({stream:true}));
});

// Reload Index
gulp.task('php-reload', function() {
    return gulp.src(phpWatch)
        .pipe(reload({stream:true}));
});

// Run a series of tasks when "gulp" is entered in the CLI.
gulp.task('default', ['sass','browser-sync'], function() {
    gulp.watch(sassWatch, ['sass']);
    gulp.watch(phpWatch, ['php-reload']);
});