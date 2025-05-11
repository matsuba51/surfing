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
    outDir: 'public/assets',  // 出力先を public/assets に変更
    manifest: true,
    rollupOptions: {
      output: {
        assetFileNames: '[name][ext]', // assets/assets/ とならないように設定
        entryFileNames: '[name].js',
      },
    },
  },
});
