const gulp = require('gulp'),
settings = require('../../../settings'),
sass = require('gulp-sass'),
autoprefixer = require('gulp-autoprefixer'),
plumber = require('gulp-plumber'),
sourcemaps = require('gulp-sourcemaps'),
browserSync = require('browser-sync').create();


function sassify() {
    console.log('starting styles task');
        return gulp.src('./resources/scss/style.scss')
          .pipe(sourcemaps.init())
          .pipe(sass({
            includePaths: ['node_modules']
          }))
            .pipe(plumber(function (err) {
            			console.log('Styles Task Error');
            			console.log(err);
            			this.emit('end');
            		}))
           .pipe(autoprefixer())

           .pipe(sass({
            			outputStyle: 'compressed'
                        
            		}))
             .pipe(sourcemaps.write())
            .pipe(gulp.dest(settings.themeLocation))
            .pipe(browserSync.stream());
}

module.exports = sassify;