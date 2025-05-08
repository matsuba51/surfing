const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .css('resources/css/app.css', 'public/css')
   .version()  // バージョン管理を有効にする
   .webpackConfig({
      resolve: {
        extensions: ['.js', '.jsx', '.json']
      }
   });
