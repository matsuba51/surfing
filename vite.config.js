import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/assets',
    manifest: true,
    rollupOptions: {
      output: {
        assetFileNames: '[name][ext]',  // app.css, app.js のように出力
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
      },
    },
  },
});
