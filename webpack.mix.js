const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/build/assets')
   .css('resources/css/app.css', 'public/build/assets')
   .version()
   .webpackConfig({
      resolve: {
        extensions: ['.js', '.jsx', '.json']
      }
   });