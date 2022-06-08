const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'off-white': '#f4f3ef',
                'abu-black': '#212120',
                'usd': '#c0c3a1',
                'aed': '#cbc1c2',
                'gbp': '#d1c5db',
                'eur': '##c1cace'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
