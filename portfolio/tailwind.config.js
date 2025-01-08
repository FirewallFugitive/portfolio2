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
                light: {
                    bg: '#F0E7C2',        
                    text: '#3B0014',      
                    primary: '#4caf50',   
                    secondary: '#f1f1f1', 
                },
                dark: {
                    bg: '#121212',        
                    text: '#f1f1f1',     
                    primary: '#1f8c4e', 
                    secondary: '#222222', 
                },
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
