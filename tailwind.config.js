const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-green-700',
        'bg-red-700',
        'bg-teal-700',
        'bg-blue-700',
        'bg-orange-700',
        'bg-yellow-700',
        'bg-amber-700',
      ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    tooltipArrows: theme => ({
        'arrow': {
            borderColor: theme('colors.gray.400'),
            borderWidth: 1,
            backgroundColor: theme('white'),
            size: 10,
            offset: 10
        },
    }),

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')]
};
