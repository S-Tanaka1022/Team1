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
<<<<<<< HEAD
                'resources/css/region_area.css',
=======
                'resources/css/stylesheet.css',
                'resources/css/testcss.css',
>>>>>>> 085857079ee4618eb0ff28e3ec08d1c29407f7cf
            ],
            refresh: true,
        }),
    ],
});
