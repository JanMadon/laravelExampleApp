import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/sass/admin.scss",
                "resources/js/app.js",
                // "node_modules/bootstrap/dist/css/bootstrap.css", // Dodaj ten wiersz/ hyba jendak nie
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },

    build: {
    manifest: true
    }

});
