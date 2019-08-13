const   gulp = require('gulp'),
        autoprefixer = require('gulp-autoprefixer'),
        sass = require('gulp-sass'),
        plumber = require('gulp-plumber'),

        path = {
            src: 'themes/pic',
            dist: 'themes/pic',
            scss: 'scss',
            css: 'css'
        },

        files = {
            css: [path.dist, path.css, '**', '*.css'].join('/'),
            scss: [path.src, path.scss, '**', '*.scss'].join('/')
        }


// CSS task
function cssGenerate() {
    return gulp
        .src( files.scss )
        .pipe(plumber())
        .pipe(sass({ outputStyle: 'nested' }).on('error', sass.logError))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(gulp.dest( [path.dist, path.css].join('/') ))
}


// Watch files
function watchFiles() {
    gulp.watch( files.scss, cssGenerate )
}


const watch = gulp.parallel(watchFiles)

exports.css = cssGenerate
exports.default = gulp.series(cssGenerate, watch)
