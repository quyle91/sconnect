const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Task để biên dịch SCSS thành CSS
gulp.task('sass', function () {
    return gulp.src('../assets/scss/*.scss') // Đường dẫn đến các file SCSS của bạn
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('../assets/css')); // Thư mục đích để lưu trữ file CSS biên dịch
});

// Task để theo dõi sự thay đổi trong file SCSS và tự động biên dịch lại
gulp.task('watch', function () {
    gulp.watch('../assets/scss/*.scss', gulp.series('sass'));
});

// Task mặc định khi chạy lệnh 'gulp' trong terminals
gulp.task('default', gulp.series('sass', 'watch'));



/**
wp-content/thems/flatsome-child
    - node_modules
    - gulp
        - gulpfile.js
    - assets
        - scss
            - *.scss
        - css
            - *.css



 */