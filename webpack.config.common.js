const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const glob = require('glob');

module.exports = {
  mode: 'development',
  entry: './static/src/main.js',
  output: {
    filename: 'main.bundle.js',
    path: path.resolve(__dirname, 'assets/dist'),
  },
  plugins: [
    new ImageminPlugin({
      externalImages: {
        context: '.',
        sources: glob.sync('assets/src/images/**/*.{png,jpg,jpeg,gif,svg}'),
        destination: 'assets/dist/images',
        fileName: '[name].[ext]',
      },
    }),
    new MiniCssExtractPlugin(),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1,
            },
          },
          {
            loader: 'sass-loader',
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [require('tailwindcss'), require('autoprefixer')],
              },
            },
          },
        ],
      },
    ],
  },
};
