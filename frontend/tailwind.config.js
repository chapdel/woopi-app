module.exports = {
  purge: [],
  mode: "jit",
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        tailwind: "#00b4b6",
        primary: "#007A5E",
        facebook: "#435F9B",
        twitter: "#55ACEE",
        linkedin: "#007BB5",
        github: "#333",
        laravel: "#FF2D20",
        design: "#FFD039",
        javascript: "#F7DF1E",
        typescript: "#007ACC",
        react: "#53C1DE",
        vue: "#41B883",
        php: "#777BB3",
        feedback: "#c0916f",
        docker: "#1D91B4",
        "digital-ocean": "#0080FF",
        "html-css": "#F16529"
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
