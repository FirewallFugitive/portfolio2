import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                'light-bg': '#ffffff',
                'dark-bg': '#121212',
                'light-text': '#1a1a1a',
                'dark-text': '#f1f1f1',
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
