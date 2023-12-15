import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/call.js',
                'resources/css/style.css',
                'resources/css/normalize.css',
            ],
            refresh: true,
        }),
    ],
});
