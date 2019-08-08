var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    clean        = require('gulp-clean'),
    rename       = require('gulp-rename'),
    cleanCSS     = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer');

// #############################################################################
//  WATCH
// #############################################################################

gulp.task('default',function(){
  gulp.watch(['src/assets/sass/*.sass'],['sass']);
});

// #############################################################################
//  COMPILE SASS
// #############################################################################

gulp.task('sass',function(){
  gulp.src('public/assets/css/*.css',{force: true})
      .pipe(clean());
  gulp.src('src/assets/sass/*.sass')
      .pipe(sass())
      .pipe(cleanCSS())
      .pipe(autoprefixer())
      .pipe(gulp.dest('public/assets/css'));
});
