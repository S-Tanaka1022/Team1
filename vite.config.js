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
                'resources/css/region_area.css',
<<<<<<< HEAD
=======
                'resources/css/stylesheet.css'
>>>>>>> origin/Develop
            ],
            refresh: true,
        }),
    ],
});
