const path = require('path');

module.exports = {
  entry: {
    editor: './js/script-editor.js', // Your main JavaScript file
    main: './js/script.js' // Another entry point (optional)
  },
  output: {
    path: path.resolve(__dirname, 'dist'), // Output directory
    filename: '[name]-script.js' // Output file name (using [name] placeholder)
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react']
          }
        }
      }
    ]
  }
};
