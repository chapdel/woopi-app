module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        tailwind: "#00b4b6"
      },
      width: {
        "68": "17rem"
      }
    }
  },
  variants: {
    extend: {}
  },
  plugins: [require("tailwind-scrollbar"), require("tailwindcss-brand-colors")]
};
