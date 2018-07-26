var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var del = require('del');
var gulp = require('gulp');
var minify = require('gulp-minify-css');
var plumber = require('gulp-plumber');
var sass = require('gulp-scss');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var browserSync = require('browser-sync').create();
var media = require('include-media');


//path
var styleSrc = 'source/scss/**/*.scss';
var styleDest = 'build/assets/css/';
var htmlSrc = 'source/';
var htmlDest = 'build/';
var vendorSrc = 'source/js/vendors/';
var vendorDest = 'build/assets/js/';
var scriptSrc = 'source/js/*.js';
var scriptDest = 'build/assets/js/';
var fontSrc = '/source/fonts/**/*';
var fontDect = '/build/assets/fonts/';
var imgSrc = '/source/img/**/*';
var imgDect = '/build/assets/img/';
// --------------------------------------------
// Stand Alone Tasks
// --------------------------------------------

// Compiles all SCSS files
gulp.task('scss', function() {
    gulp.src('source/scss/**/*.scss')
        .pipe(plumber())
        .pipe(sass({
            style: 'compressed',
            //includePath: [media.join(dist, 'node_modules', '_include-media.scss','dist')]
        }))
        .pipe(rename({
            basename: 'main',
            suffix: '.min'
          }))

        .pipe(gulp.dest('build/assets/css'));
});

// Optimizing Images 
gulp.task('images', function () {
    return gulp.src('source/img/**/*.+(png|jpg|gif|svg)')
        .pipe(cache(imagemin({
            interlaced: true
        })))
        .pipe(gulp.dest('build/assets/img'))
});

// Fonts
gulp.task('fonts', function () {
    return gulp.src('source/fonts/**/*')
        .pipe(gulp.dest('build/assets/fonts'))
});

// Uglify js files
gulp.task('scripts', function () {
    gulp.src('source/js/*.js')
        .pipe(plumber())
        .pipe(uglify())
        .pipe(gulp.dest('build/assets/js'))
        
});

//Concat and Compress Vendor .js files
gulp.task('vendors', function () {
    gulp.src(
        [
            'source/js/vendors/jquery.min.js',
            'source/js/vendors/*.js',
        ])
        .pipe(plumber())
        .pipe(concat('vendors.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/assets/js'));
});

// Watch for changes
gulp.task('watch', function () {
    //Serve files from the root of this project
    browserSync.init({
        server: {
            baseDir: './build',
        },
        notify: false
    });

    gulp.watch(styleSrc, ['scss']);
    gulp.watch(scriptSrc, ['scripts']);
    gulp.watch(vendorSrc, ['vendors']);
    gulp.watch(['build/*.html', 'build/assets/css/*.css', 'build/assets/js/*.js', 'build/assets/js/vendors/*.js', '/build/assets/img/*', '/build/assets/img/'])
        .on(' change ', browserSync.reload);

});

// use default task to launch Browsersync and watch JS files
gulp.task('default', ['scss', 'scripts', 'vendors', 'watch'], function () {});
