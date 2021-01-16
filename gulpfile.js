const gulp = require('gulp');
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

const cssFiles = [
	'./css/bootstrap.min.css',
	'./css/slick.css',
	'./css/style.css',
	'./css/media.css'
];

const jsFiles = [
	'./js/jquery-3.1.0.min.js',
	'./js/slick.min.js',
	'./js/script.js'
];

function styles(){
	return gulp.src(cssFiles)
		.pipe(concat('main.css'))
		.pipe(autoprefixer({
			browsers: ['> 0.1%']
		}))
		.pipe(cleanCSS({
			level: 2
		}))
		.pipe(gulp.dest('./'))
		.pipe(browserSync.stream())
}
function scripts(){
	return gulp.src(jsFiles)
				.pipe(concat('main.js'))
				.pipe(uglify({
					toplevel: true
				}))
				.pipe(gulp.dest('./'))
				.pipe(browserSync.stream())
}
function reload(done) {
  browserSync.reload();
  done();
}

function watch(){
	browserSync.init({
        proxy: 'lora.ru',
        notify: false
	});

	gulp.watch('./css/*.css',styles);
	gulp.watch('./js/*.js',scripts);
	gulp.watch('./*.php',reload);
}

gulp.task('styles', styles);
gulp.task('scripts', scripts);
gulp.task('watch', watch);