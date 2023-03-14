const path = require('path');
module.exports = {
    entry:['./app/test.js', './app/test2.js'], 
    output:{
        path: path.resolve(__dirname, 'dist'),
        filename:'bundle.js',
        // filename:'bundle.css'
    }
}