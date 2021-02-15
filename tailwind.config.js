module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.jsx',
  ],
  darkMode: false,
  theme: {
    extend: {
        width: {
          '96': '24rem',
        }
    },
  },
  variants: {},

}
