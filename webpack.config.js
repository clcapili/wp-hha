const path = require('path');

module.exports = {
    name: 'hha',
    mode: 'development', // production / development
    entry: './src/js/main.js',
    output: {
        path: path.resolve(__dirname, 'wordpress/wp-content/themes/hha/js'),
        filename: 'site.js',
        libraryTarget: 'var',
        library: 'HHA'
    },
    optimization: {
        concatenateModules: true,
        minimize: true,
    }
};