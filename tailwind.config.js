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
                sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'ios-pink': '#FF375F',
                'ios-blue': '#007AFF',
                'ios-gray': '#8E8E93',
                'ios-bg': '#F2F2F7',
            }
        },
    },

    plugins: [forms],
};