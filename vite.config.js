import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                // les fichiers CSS
                'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',


                'node_modules/admin-lte/plugins/jquery/jquery.min.js',
                'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
                'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'node_modules/admin-lte/plugins/jszip/jszip.min.js',
                'node_modules/admin-lte/plugins/pdfmake/pdfmake.min.js',
                'node_modules/admin-lte/plugins/pdfmake/vfs_fonts.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',



            },
        ],
    },
});
