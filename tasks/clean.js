/**
 * wordsmith
 * (c) nk2580 <nik.k2580@gmail.com>
 */

var config = require('./.taskconfig');
var del = require('del');
var gulp = require('gulp');

/**
 * Cleans /.tmp and /public directories.
 */
gulp.task('clean', function(callback) {
  del(config.clean.entry).then(function(paths) {
    callback();
  });
});
