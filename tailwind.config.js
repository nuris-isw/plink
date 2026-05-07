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
            colors: {
                // Palet Global
                'brand-red': '#E4252C',
                'brand-red-light': '#EF3F3C',
                'brand-red-dark': '#8F1924',
                'brand-red-deep': '#6C0C1C',
                'dark': '#010101',
                'gray-dark': '#737272',
                'gray-medium': '#BCBCBC',
                'gray-light': '#DCDBDB',
                
                // Social Media Colors
                'facebook': '#1877F2',
                'instagram': '#E4405F',
                'youtube': '#FF0000',
                'tiktok': '#000000',
            },
            fontFamily: {
                // Menggunakan Plus Jakarta Sans sebagai font sans utama
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
