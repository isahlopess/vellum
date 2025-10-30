import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'biblioteca': {
                    50: '#fdf8f3',
                    100: '#f7f0e6',
                    200: '#eeddc9',
                    300: '#e2c5a3',
                    400: '#d2a274',
                    500: '#c08550',
                    600: '#b27046',
                    700: '#945a3c',
                    800: '#774a36',
                    900: '#613e2e',
                }
            }
        },
    },

    plugins: [forms],
};
