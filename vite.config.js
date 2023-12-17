import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/call.js',
                'resources/js/bootstrap.js',
                'resources/js/profile.js',
                'resources/js/data-transfer.js',
                'resources/css/style.css',
                'resources/css/cent1ck_style.css',
                'resources/css/normalize.css',
                'resources/css/filans_style.css',
                'resources/js/chat.js',
            ],
            refresh: true,
        }),
    ]
});
