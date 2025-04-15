const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/build/assets')
   .css('resources/css/app.css', 'public/build/assets')
   .webpackConfig({
      resolve: {
        extensions: ['.js', '.jsx', '.json']
      }
   });