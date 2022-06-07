const { task,watch,series } = require('gulp'),
browserSync = require('browser-sync').create(),
settings = require('./settings');

const sassify = require('./resources/gulp/tasks/styles');
const scriptify = require('./resources/gulp/tasks/script');

// BrowserSync
function browsersync(done){
    browserSync.init({
        notify: false,
        proxy: settings.urlToPreview,
        ghostMode: false
    });

    done();
}



// BrowserSync Reload
function browserSyncReload(done) {
    browserSync.reload();
    done();
}

// browser sync init and Watch files
function watchfiles() {
    browserSync.init({
        notify: false,
        proxy: settings.urlToPreview,
        ghostMode: false
    });
    watch(settings.themeLocation + '**/*.php', browserSyncReload);
    watch('./resources/scss/**/*.scss', series(sassify,browserSyncReload));
    watch('./resources/js/**/*.js', series(scriptify, browserSyncReload ));

}

// tasks
task(sassify);
task(scriptify);
task(browsersync);
task(watchfiles);
