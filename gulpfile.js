var browserSync = require('browser-sync').create();
var del         = require('del');
var gulp        = require('gulp');
var prefixer    = require('gulp-autoprefixer');
var minifyCss   = require('gulp-clean-css');
var concat      = require('gulp-concat');
var eslint      = require('gulp-eslint');
var imagemin    = require('gulp-imagemin');
var minifyJson  = require('gulp-jsonminify');
var sass        = require('gulp-sass');
var sassLint    = require('gulp-sass-lint');
var sourcemaps  = require('gulp-sourcemaps');
var uglify      = require('gulp-uglify');

var localServer = "http://localhost/imhh-fs/public";
var sourcePath  = "gulpfiles/";
var publicPath  = "public/";

// processing scss to css and minify result
gulp.task('scss', function() {
    gulp.src(sourcePath + 'scss/styles.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(prefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(publicPath + 'css/'));
});

// lint scss files
gulp.task('scss-lint', function () {
    gulp.src([
            sourcePath + 'scss/**/*.scss',
            // exclude third party and special files
            '!' + sourcePath + 'scss/module/_datatables.scss'
        ])
        .pipe(sassLint(require('./scss-lint.json')))
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError());
});

// concatinate and uglify all js
gulp.task('js', function() {
    gulp.src([
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
            'node_modules/@fortawesome/fontawesome-free/js/all.js',
            sourcePath + 'js/lib/**/*.js',
            'node_modules/cookieconsent/src/cookieconsent.js',
            'node_modules/cssuseragent/cssua.js',
            'node_modules/datatables/media/js/jquery.dataTables.js',
            'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
            sourcePath + 'js/plugin/**/*.js',
            sourcePath + 'js/module/**/*.js',
            sourcePath + 'js/scripts.js'
        ])
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(publicPath + 'js/'));
});

// lint js files
gulp.task('js-lint', function () {
    gulp.src([
            sourcePath + 'js/**/*.js'
        ])
        .pipe(eslint(require('./js-lint.json')))
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
});

// minify images
gulp.task('img', function() {
    gulp.src(sourcePath + 'img/**/*.{png,gif,jpg,jpeg,ico,xml,json,svg}')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.jpegtran({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(publicPath + 'img/'));
});

// copy all json files and minify
gulp.task('json', function() {
    gulp.src([
            sourcePath + 'json/**/*.json'
        ])
        .pipe(minifyJson())
        .pipe(gulp.dest(publicPath + 'json/'));
});

// copy all fonts
gulp.task('font', function() {
    gulp.src([
            'node_modules/@fortawesome/fontawesome-free/webfonts/**',
            sourcePath + 'font/**'
        ])
        .pipe(gulp.dest(publicPath + 'font/'));
});

// copy all svg images
gulp.task('svg', function() {
    gulp.src([
//            'node_modules/@fortawesome/fontawesome-free/svgs/**',
//            'node_modules/@fortawesome/fontawesome-free/sprites/**',
            sourcePath + 'svg/**/*.svg'
        ])
        .pipe(imagemin([
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(publicPath + 'svg/'));
});

// clean up folders
gulp.task('cleanup', function() {
//    del([
//            systemPath + 'css/**/*',
//            systemPath + 'js/**/*',
//            systemPath + 'img/**/*',
//            systemPath + 'font/**/*',
//            systemPath + 'svg/**/*',
//            systemPath + 'json/**/*'
//        ], {force: true});
        
    del([
            publicPath + 'css/**/*',
            publicPath + 'js/**/*',
            publicPath + 'img/**/*',
            publicPath + 'font/**/*',
            publicPath + 'svg/**/*',
            publicPath + 'json/**/*'
        ]);
});

// add the watcher
gulp.task('watch', function() {
    // watch scss files
    gulp.watch(sourcePath + 'scss/**', ['scss', 'scss-lint']);
    // watch js files
    gulp.watch(sourcePath + 'js/**', ['js', 'js-lint']);
    // watch images
    gulp.watch(sourcePath + 'img/**', ['img']);
    // watch fonts
    gulp.watch(sourcePath + 'font/**', ['font']);
    // watch svg
    gulp.watch(sourcePath + 'svg/**', ['svg']);
    // watch json
    gulp.watch(sourcePath + 'json/**', ['json']);
});

// production
gulp.task('prod', ['scss', 'scss-lint', 'js', 'js-lint', 'img', 'font', 'svg', 'json']);

// default task if just called gulp (incl. Watch)
gulp.task('default', ['scss', 'scss-lint', 'js', 'js-lint', 'img', 'font', 'svg', 'json', 'watch'], function() {
    // start browsersync
    browserSync.init({
        proxy: localServer
    });

    gulp.watch(publicPath + '**/*.{css,js,jpg,png,svg,ico,json}').on('change', browserSync.reload);
    gulp.watch('{templates,src}/**/*.{php,html,phtml,twig}').on('change', browserSync.reload);
});