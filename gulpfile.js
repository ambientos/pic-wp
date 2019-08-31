const   gulp = require('gulp'),
        browsersync = require('browser-sync').create(),
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


// BrowserSync
function browserSync(done) {
    browsersync.init({
        proxy: 'pic'
    })

    done()
}


// CSS task
function cssGenerate() {
    return gulp
        .src( files.scss )
        .pipe(plumber())
        .pipe(sass({ outputStyle: 'nested' }).on('error', sass.logError))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(gulp.dest( [path.dist, path.css].join('/') ))
        .pipe(browsersync.stream())
}


// Watch files
function watchFiles() {
    gulp.watch( files.scss, cssGenerate )
}


const watch = gulp.parallel(watchFiles, browserSync)

exports.css = cssGenerate
exports.default = gulp.series(cssGenerate, watch)
