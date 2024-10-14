import {defineConfig} from 'vite';
export default defineConfig({
  build: {
    emptyOutDir: true,
    manifest: false,
    rollupOptions: {
      input: ['resources/js/apexcharts.js'],
      output: {
        entryFileNames: `apexcharts.js`,
      }
    },
    outDir: 'public',
  },
});
