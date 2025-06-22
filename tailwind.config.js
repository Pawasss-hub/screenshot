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
                sans: ['Inter', 'Roboto', 'system-ui', ...defaultTheme.fontFamily.sans],
                display: ['Oswald', 'Bebas Neue', 'Impact', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', 'Montserrat', 'Inter', ...defaultTheme.fontFamily.sans],
                body: ['Inter', 'Open Sans', 'system-ui', ...defaultTheme.fontFamily.sans],
                cinematic: ['Cinzel', 'Playfair Display', 'serif'],
                modern: ['Space Grotesk', 'JetBrains Mono', 'monospace'],
            },
            colors: {
                'text': '#e8e8e8',
                'background': '#0d0d0d',
                'primary': '#4F51CD',
                'secondary': '#1e1e1e',
                'accent': '#00d4aa',
            },
        },
    },

    plugins: [forms],
};
