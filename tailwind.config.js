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
        fontFamily: {
          sans: [
            '"Founders Grotesk X-Condensed Bold"',
            '"Roboto Condensed"',
            ...defaultTheme.fontFamily.sans,
          ],
          serif: [
            '"STIX Two Text"',
            ...defaultTheme.fontFamily.serif,
          ],
          'founders-light': [
            '"Founders Grotesk X-Condensed Light"',
            '"Roboto Condensed"',
            ...defaultTheme.fontFamily.sans,
          ],
        },
        fontSize: {
          '10xl': '9.375rem',
        },
        lineHeight: {
          'crunch': '0.75',
        },
        colors: {
          "primary": '#00311e', // deep green
          "secondary": '#56e13b', // bright pine
          "tertiary": '#fdc6c2', // dusk
          "accent": '#4527a0', // twilight
          "soft-yellow": "#fffae1",
          "sky": '#bff5fc',
          "sap": '#ffd700',
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
