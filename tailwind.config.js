module.exports = {
  purge: [
    './src/**/*.html',
    './src/**/*.js',
  ],
  theme: {
    extend: {
      maxWidth: {
        '7xl': '75rem',
      },
      zIndex: {
        '-10': '-10'
      },
      colors: {
        base: '#f4f4f4'
      },
      spacing: {
        '1/2': '0.125rem'
      },
      height: {
        'screen-1/2': '50vh',
      },
      backgroundColor: {
        'black-1/2': 'rgba(0, 0, 0, .5)'
      },
      width: {
        '28': '7rem'
      },
      fontSize: {
        'md': '1rem'
      },
      height: {
        '28': '7rem'
      }
    },
  },
  variants: {},
  plugins: [],
}
