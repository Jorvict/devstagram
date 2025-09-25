const { defineConfig } = require('vite');
const laravelPlugin = require('laravel-vite-plugin');

module.exports = defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    origin: 'http://localhost:5173',
    hmr: { host: 'localhost' },
    watch: { usePolling: true }
  },
  plugins: [
    laravelPlugin.default({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});