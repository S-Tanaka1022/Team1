import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/index_css.css',
                'resources/css/testcss.css',
                'resources/css/addplaylist_css.css',
            ],
            refresh: true,
        }),
    ],
});
