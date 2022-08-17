const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    mode: 'jit',
    purge: [
      './views/**/*.twig',
      './blocks/**/*.twig',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
      extend: {
        colors: {
          "primary": '#',
          "secondary": '#56e13b',
          "tertiary": '#fdc6c2',
          "accent": '#4527a0',
          "black": '#000',
          "white": '#fff',
        }
      },
    },
    variants: {
      extend: {},
    },
    plugins: [
      require('@tailwindcss/typography'),
    ],
}
