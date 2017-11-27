var gulp = require('gulp');
var sass = require('gulp-sass');
var cssbeautify = require('gulp-cssbeautify');

gulp.task('sass', function(done) {
 gulp.src('scss/*.scss')
   .pipe(sass())
   .on('error', sass.logError)
   .pipe(cssbeautify({
        indent: '  ',
        autosemicolon: true
    }))
   .pipe(gulp.dest(''))
   .on('end', done);
});

gulp.task('watch', function() {
 gulp.watch('scss/*.scss', ['sass']);
});