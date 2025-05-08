const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/build/assets/app.js')
   .css('resources/css/app.css', 'public/build/assets/app.css')
   .version()
   .webpackConfig({
      resolve: {
        extensions: ['.js', '.jsx', '.json']
      }
   });