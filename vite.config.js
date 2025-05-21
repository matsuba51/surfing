import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
<<<<<<< Updated upstream
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/auth.css',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
=======
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
>>>>>>> Stashed changes
});
