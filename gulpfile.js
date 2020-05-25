// Gulp.js configuration
'use strict';

// Parts of Gulp
const { task, src, dest, watch, parallel } = require('gulp');

const

  // source and build folders
  dir = {
    src         : './static/',
    lib         : './static/lib/',
    build       : './assets/'
  },

  // Gulp plugins
  gutil         = require('gulp-util'),
  newer         = require('gulp-newer'),
  imagemin      = require('gulp-imagemin'),
  sass          = require('gulp-sass'),
  postcss       = require('gulp-postcss'),
  deporder      = require('gulp-deporder'),
  concat        = require('gulp-concat'),
  stripdebug    = require('gulp-strip-debug'),
  uglifyes      = require('uglify-es'),
  composer      = require('gulp-uglify/composer'),
  uglify        = composer(uglifyes, console)
;

// Font settings
const fonts = {
  src           : dir.src + 'fonts/**/*.*',
  build         : dir.build + 'fonts/'
};

// Copy Font files
function processFonts() {
  return src(fonts.src)
    .pipe(newer(fonts.build))
    .pipe(dest(fonts.build));
}

// image settings
const images = {
  src         : dir.src + 'images/**/*',
  build       : dir.build + 'images/'
};

// image processing
function processImages() {
  return src(images.src)
    .pipe(newer(images.build))
    .pipe(imagemin({
        svgoPlugins: [
          {
              removeViewBox: false
          }
      ]
    }))
    .pipe(dest(images.build));
}

// JS Library settings
const jslib = {
  src           : dir.src + 'lib/js/**/*.js',
  build         : dir.build + 'lib/js/',
  filename      : 'js-libs.min.js'
};

// CSS Library settings
const csslib = {
  src           : dir.src + 'lib/css/**/*',
  build         : dir.build + 'lib/css/',
  processors: [
    require('cssnano')
  ]
};

// copy CSS Library files
function processCSSLib() {
  return src(csslib.src)
    .pipe(newer(csslib.build))
    .pipe(dest(csslib.build));
}

// // CSS settings
var css = {
  src         : dir.src + 'scss/styles.scss',
  watch       : dir.src + 'scss/**/*',
  build       : dir.build + 'css/',
  filename    : 'styles.min.css',
  sassOpts: {
    outputStyle     : 'nested',
    imagePath       : images.build,
    precision       : 3,
    errLogToConsole : true
  },
  processors: [
    require('postcss-assets')({
      loadPaths: ['images/'],
      basePath: dir.build,
      baseUrl: '/wp-content/themes/borger-beagle/'
    }),
    require('css-mqpacker'),
    require('cssnano')
  ]
};

// // CSS processing
function processCSS() {
  return src(css.src)
    .pipe(sass(css.sassOpts))
    .pipe(postcss(css.processors))
    .pipe(concat(css.filename))
    .pipe(dest(css.build))
}

// copy JS Library files
function processJSLib() {
  return src(jslib.src)
    .pipe(newer(jslib.build))
    .pipe(deporder())
    .pipe(stripdebug())
    .pipe(uglify())
    .pipe(concat(jslib.filename))
    .pipe(dest(jslib.build));
}

// JavaScript settings
const js = {
  src         : dir.src + 'js/**.js',
  build       : dir.build + 'js/',
  filename    : 'scripts.js'
};

// JavaScript processing
function processJS() {
 return src(js.src)
     .pipe(deporder())
     .pipe(stripdebug())
     .pipe(uglify())
     .pipe(concat(js.filename))
     .pipe(dest(js.build))
}

// Tasks
task("fonts", processFonts);
task("images", processImages);
task("css-lib", processCSSLib);
task("css", processCSS);
task("js-lib", processJSLib);
task("js", processJS);

// Watch task
function watchFiles() {
  // Font changes
  watch(fonts.src, processFonts);
  // image changes
  watch(images.src, processImages);
  // CSS Library changes
  watch(csslib.src, processCSSLib);
  // CSS changes
  watch(css.watch, processCSS)
  // JavaScript Library changes
  watch(jslib.src, processJSLib);
  // JS changes
  watch(js.src, processJS);
}

task("watch", watchFiles);


// Default task
task("default", parallel(processFonts, processImages, processCSSLib, processCSS, processJSLib, processJS));