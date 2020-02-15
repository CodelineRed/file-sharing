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

var config      = require('./gulpfile-config.json');

// processing scss to css and minify result
function scss() {
    return gulp.src(config.sourcePath + 'scss/styles.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(prefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.publicPath + 'css/'));
}

// lint scss files
function scssLint() {
    return gulp.src([
            config.sourcePath + 'scss/**/*.scss',
            // exclude third party and special files
            '!' + config.sourcePath + 'scss/module/_datatables.scss'
        ])
        .pipe(sassLint(require('./scss-lint.json')))
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError());
}

// concatinate and uglify js files
function js() {
    return gulp.src([
            'node_modules/jquery/dist/jquery.js',
            'node_modules/bootstrap/dist/js/bootstrap.bundle.js',
            //'node_modules/@fortawesome/fontawesome-free/js/all.js',
            config.sourcePath + 'js/lib/**/*.js',
            'node_modules/cookieconsent/src/cookieconsent.js',
            'node_modules/cssuseragent/cssua.js',
            'node_modules/datatables.net/js/jquery.dataTables.js',
            'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
            'node_modules/string-format-js/format.js',
            config.sourcePath + 'js/plugin/**/*.js',
            config.sourcePath + 'js/module/**/*.js',
            config.sourcePath + 'js/scripts.js'
        ])
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.publicPath + 'js/'));
}

// lint js files
function jsLint() {
    return gulp.src([
            config.sourcePath + 'js/**/*.js'
        ])
        .pipe(eslint(require('./js-lint.json')))
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

// copy all json files and minify
function json() {
    return gulp.src([
            config.sourcePath + 'json/**/*.json'
        ])
        .pipe(minifyJson())
        .pipe(gulp.dest(config.publicPath + 'json/'));
}

// compress images
function img() {
    return gulp.src(config.sourcePath + 'img/**/*.{png,gif,jpg,jpeg,ico,xml,json,svg}')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imagemin.mozjpeg({progressive: true}),
            imagemin.optipng({optimizationLevel: 5}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(config.publicPath + 'img/'));
}

// copy font files
function font() {
    return gulp.src([
            'node_modules/@fortawesome/fontawesome-free/webfonts/**',
            config.sourcePath + 'font/**'
        ])
        .pipe(gulp.dest(config.publicPath + 'font/'));
}

// compress and copy svg files
function svg() {
    return gulp.src([
//            'node_modules/@fortawesome/fontawesome-free/svgs/**',
//            'node_modules/@fortawesome/fontawesome-free/sprites/**',
            config.sourcePath + 'svg/**/*.svg'
        ])
        .pipe(imagemin([
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(config.publicPath + 'svg/'));
}

// clean up folders
function cleanUp() {
    return del([
            config.publicPath + 'css/**/*',
            config.publicPath + 'js/**/*',
            config.publicPath + 'img/**/*',
            config.publicPath + 'json/**/*',
            config.publicPath + 'font/**/*',
            config.publicPath + 'svg/**/*'
        ]);
}

// initialize BrowserSync
function browserSyncInit(done) {
    // start browsersync
    browserSync.init({
        proxy: config.localServer
    });
    done();
}

// reload browser
function browserSyncReload(done) {
    browserSync.reload();
    done();
}

// watch files
function watch() {
    // watch scss files
    gulp.watch(config.sourcePath + 'scss/**', gulp.series(scss, scssLint));
    // watch js files
    gulp.watch(config.sourcePath + 'js/**', gulp.series(js, jsLint));
    // watch images
    gulp.watch(config.sourcePath + 'img/**', img);
    // watch json files
    gulp.watch(config.sourcePath + 'json/**', json);
    // watch fonts
    gulp.watch(config.sourcePath + 'font/**', font);
    // watch svg
    gulp.watch(config.sourcePath + 'svg/**', svg);
}

// watch files and reload browser on file change
function watchAndReload() {
    // watch scss files
    gulp.watch(config.sourcePath + 'scss/**', gulp.series(scss, scssLint));
    // watch js files
    gulp.watch(config.sourcePath + 'js/**', gulp.series(js, jsLint));
    // watch images
    gulp.watch(config.sourcePath + 'img/**', img);
    // watch json files
    gulp.watch(config.sourcePath + 'json/**', json);
    // watch fonts
    gulp.watch(config.sourcePath + 'font/**', font);
    // watch svg
    gulp.watch(config.sourcePath + 'svg/**', svg);
    
    gulp.watch(config.publicPath + '**/*.{css,eot,ico,js,json,jpg,otf,png,svg,ttf,woff,woff2}', browserSyncReload);
    gulp.watch('{templates,locale,config,src}/**/*.{php,twig}', browserSyncReload);
}

exports.scss = scss;
exports.scssLint = scssLint;
exports.js = js;
exports.jsLint = jsLint;
exports.json = json;
exports.img = img;
exports.font = font;
exports.svg = svg;
exports.cleanUp = cleanUp;
exports.watch = watch;
exports.watchAndReload = watchAndReload;
exports.browserSyncInit = browserSyncInit;
exports.browserSyncReload = browserSyncReload;

// build task
gulp.task('build', gulp.series(cleanUp, scss, js, scssLint, jsLint, json, img, font, svg));

// default task if just called gulp
gulp.task('default', gulp.parallel(watchAndReload, browserSyncInit));
