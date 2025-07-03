import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css", 
                "resources/js/app.js",
                "resources/css/team/styles.css",
                "resources/css/team/vendors/styles.bundle.css",
                "resources/js/team/layout.js",
                "resources/js/team/vendors/jquery-3.7.1.slim.min.js",
                "resources/js/team/location-ajax.js"
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost',
    },
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name && assetInfo.name.endsWith('.woff')) {
                        return 'default/fonts/[name][extname]';
                    }
                    if (assetInfo.name && assetInfo.name.endsWith('.ttf')) {
                        return 'default/fonts/[name][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                }
            }
        }
    }
});
