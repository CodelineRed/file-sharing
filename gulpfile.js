const browserSync = require('browser-sync').create();
const del         = require('del');
const gulp        = require('gulp');
const prefixer    = require('gulp-autoprefixer');
const minifyCss   = require('gulp-clean-css');
const concat      = require('gulp-concat');
const eslint      = require('gulp-eslint');
const gulpIf      = require('gulp-if');
const minifyImg   = require('gulp-imagemin');
const minifyJson  = require('gulp-jsonminify');
const sass        = require('gulp-sass');
const sassLint    = require('gulp-sass-lint');
const sourcemaps  = require('gulp-sourcemaps');
const uglify      = require('gulp-uglify-es').default;

const config      = require('./gulpfiles/app/gulpfile.json');
const isEnv       = require('./gulpfiles/app/is-env');
const lint        = require('./gulpfiles/app/lint');

// processing scss to css and minify result
function scss() {
    return gulp.src(config.sourcePath + 'scss/styles.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(prefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulpIf(isEnv(['test', 'prod'], config.env), minifyCss({compatibility: 'ie8'})))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.publicPath + 'css/'));
}

// lint scss files
function scssLint() {
    return lint(gulp, sassLint, [config.sourcePath + 'scss/**/*.scss', '!' + config.sourcePath + 'scss/module/_datatables.scss'], 'scss');
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
        .pipe(gulpIf(isEnv(['test', 'prod'], config.env), uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.publicPath + 'js/'));
}

// lint js files
function jsLint() {
    return lint(gulp, eslint, [config.sourcePath + 'js/**/*.js'], 'js');
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
        .pipe(minifyImg([
            minifyImg.gifsicle({interlaced: true}),
            minifyImg.mozjpeg({progressive: true}),
            minifyImg.optipng({optimizationLevel: 5}),
            minifyImg.svgo({
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
        .pipe(minifyImg([
            minifyImg.svgo({
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
        port: 3000,
        ui: {
            port: 3001
        },
        // ui: false, // enable in production
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
    watch();
    
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
