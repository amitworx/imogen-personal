webpack = require('webpack');

function scriptify(cb){
    webpack(require('../../../webpack.config.js'), function(err, stats) {
        if (err) {
          console.log(err.toString());
        }
    
        console.log(stats.toString());
    });
    cb();
}

module.exports = scriptify;