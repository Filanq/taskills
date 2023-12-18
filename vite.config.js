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
                'resources/css/auth.css',
                'resources/css/cent1ck_style.css',
                'resources/css/normalize.css',
                'resources/css/header.css',
                'resources/js/profile-doctor.js',
                'resources/js/auth.js',
                'resources/js/index.js',
                'resources/js/profile-edit.js',
                'resources/css/index.css',
                'resources/css/filans_style.css',
                'resources/js/header.js',
                'resources/js/chat.js',
                'resources/js/profile-data.js',
            ],
            refresh: true,
        }),
    ]
});
