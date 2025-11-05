import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    resolve: {
        alias: {
            '@': '/resources/js',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap/dist/css'),
            '~fastbootstrap': path.resolve(__dirname, 'node_modules/fastbootstrap/dist/css'),
            '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons/font'),
            '~icons': path.resolve(__dirname, 'node_modules/bootstrap-icons/icons'),
        },
    },

    build: {
        outDir: "public/build",
        manifest: "manifest.json",
    },
});
