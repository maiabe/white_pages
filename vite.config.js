import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
<<<<<<< HEAD
        vue({
            template: {
                transformAssetUrls:{
                    base: null,
                    includeAbsolute: false,
                },
                compilerOptions: {

                    isCustomElement: (tag) => {return tag.endsWith('component')},

                }
            }
        }),
=======
>>>>>>> upstream/main
    ],
});
