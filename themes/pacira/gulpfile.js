var gulp = require('gulp');
var sass = require('gulp-sass');
var cssbeautify = require('gulp-cssbeautify');

gulp.task('sass', function(done) {
 gulp.src('scss/*.scss')
   .pipe(sass())
   .on('error', sass.logError)
   .pipe(cssbeautify({
        indent: '  ',
        openbrace: 'separate-line',
        autosemicolon: true
    }))
   .pipe(gulp.dest('css/'))
   .on('end', done);
});

gulp.task('watch', function() {
 gulp.watch('scss/*.scss', ['sass']);
});