import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        plugin(function ({ addComponents, theme }) {
            addComponents({
                '.code-block': {
                    backgroundColor: theme('colors.slate.900'),
                    color: theme('colors.slate.100'),
                    borderRadius: theme('borderRadius.lg'),
                    padding: theme('spacing.4'),
                    fontSize: theme('fontSize.sm')[0],
                    lineHeight: theme('fontSize.sm')[1].lineHeight,
                    overflowX: 'auto',
                },
                '.code-block code': {
                    fontFamily: theme('fontFamily.mono'),
                    fontSize: 'inherit',
                    lineHeight: 'inherit',
                },
            });
        }),
    ],
};
