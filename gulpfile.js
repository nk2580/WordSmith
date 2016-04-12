var gulp = require('gulp');
var imageop = require('gulp-image-optimization');
 
gulp.task('default', function(cb) {
    gulp.src(['_site/**/*.png','_site/**/*.jpg','_site/**/*.gif','_site/**/*.jpeg']).pipe(imageop({
        optimizationLevel: 5,
        progressive: true,
        interlaced: true
    })).pipe(gulp.dest('public/images')).on('end', cb).on('error', cb);
});