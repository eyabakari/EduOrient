import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

// Charger VITE_* depuis le .env Laravel (Reverb, URL API) pour une seule source de vérité.
// https://vite.dev/config/shared-options.html#envdir
// https://vite.dev/guide/env-and-mode.html
export default defineConfig({
  envDir: path.resolve(__dirname, '../backend'),
  plugins: [react()],
  
  /** Évite les 504 « Outdated Optimize Dep » en dev (dépendances lourdes / natives). */
  optimizeDeps: {
    include: ['@react-pdf/renderer', 'laravel-echo', 'pusher-js'],
  },
  server: {
    proxy: {
      '/storage': 'http://192.168.1.104:8000',
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (id.includes('node_modules/@react-pdf/renderer') || id.includes('node_modules/jspdf')) {
            return 'pdf';
          }
          if (id.includes('node_modules/recharts')) {
            return 'recharts';
          }
          if (id.includes('node_modules/framer-motion')) {
            return 'framer';
          }
        },
      },
    },
    chunkSizeWarningLimit: 600,
  },
})
