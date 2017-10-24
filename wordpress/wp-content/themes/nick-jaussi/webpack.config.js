const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const webpack = require('webpack');

const extractCSS = new ExtractTextPlugin('style.css');

module.exports = {
  entry: [
    path.resolve(__dirname, 'assets', 'scripts', 'app.js'),
    path.resolve(__dirname, 'assets', 'styles', 'style.scss')
  ],
  output: {
    filename: 'main.js',
  },
  devtool: false,
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
        },
      },

      {
        test: /\.scss$/,
        loader: extractCSS.extract(['css-loader', 'sass-loader']),
      },
    ],
  },
  plugins: [
    new webpack.optimize.ModuleConcatenationPlugin(),
    new UglifyJSPlugin({
      cache: true,
      parallel: true,
    }),
    extractCSS,
  ],
  resolve: {
    modules: [
      'node_modules',
      path.resolve(__dirname, 'assets/scripts/')
   ],
  },
};
