import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'js/call.js',
                'css/style.css',
                'css/normalize.css',
            ],
            refresh: true,
            publicDirectory: 'resources/'
        }),
    ],
});
