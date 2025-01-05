import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { networkInterfaces } from 'os'

export default defineConfig({
  server: {
    cors: true,
    host: Object.values(networkInterfaces()).flat().find(i => i.family === 'IPv4' && !i.internal).address,    port: 4173,
    watch: {
      usePolling: true,
    },
  },
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
})
