const colors = require("tailwindcss/colors");
module.exports = {
  purge: ["./src/**/*.{js}", "./public/index.html"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        blue: colors.blue,
        gray: colors.gray,
      },
      fontSize: {
        sm: "0.70rem",
        md: "1.2rem",
        lg: "1.8rem",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
