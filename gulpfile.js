
var
    gulp = require('gulp'),
    sass = require('gulp-sass');

var
    source = 'resources/assets/',
    dest = 'public/';

// Bootstrap scss source
var bootstrapSass = {
    in: 'public/bower_components/bootstrap-sass/'
};

// css source file: .scss files
var css = {
    in: source + 'sass/bootstrap.scss',
    out: dest + 'bootstrap/css/',
    watch: source + 'sass/**/*',
    sassOpts: {
        outputStyle: 'compressed',
        sourceMap: true,
        precision: 5,
        errLogToConsole: true,
        includePaths: [bootstrapSass.in + 'assets/stylesheets']
    }
};

gulp.task('sass', [], function () {
    return gulp.src(css.in)
        .pipe(sass(css.sassOpts))
        .pipe(gulp.dest(css.out));
});

// default task
gulp.task('default', ['sass'], function () {
    gulp.watch(css.watch, ['sass']);
});