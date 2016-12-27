var gulp = require('gulp'),
    browserify = require('gulp-browserify');

var src = 'public/js/react-src',
    app = 'public/js/react-build';

gulp.task('js', function(){
    return gulp.src(src + '/app.js')
        .pipe(browserify({
            transform: 'reactify',
            debug: true
        })).on('error', function(err){
            console.error('Error', err.message);
        })
        .pipe(gulp.dest(app))
});


gulp.task('watch', function(){
    gulp.watch(src + '/*.js', ['js']);
});


gulp.task('default', ['watch', 'js']);