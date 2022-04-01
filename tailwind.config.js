module.exports = {
  content: ["./**/*.html", "./**/*.php", "./src/**/*.css", "./src/**/*.js"],
  theme: {
    container: {
      center: true,
    },
    fontFamily: {
      title: [
        "Author",
        "system-ui",
        "-apple-system",
        "BlinkMacSystemFont",
        '"Segoe UI"',
        "Roboto",
        '"Helvetica Neue"',
        "Arial",
        '"Noto Sans"',
        "sans-serif",
        '"Apple Color Emoji"',
        '"Segoe UI Emoji"',
        '"Segoe UI Symbol"',
        '"Noto Color Emoji"',
      ],
      body: [
        "Switzer",
        "system-ui",
        "-apple-system",
        "BlinkMacSystemFont",
        '"Segoe UI"',
        "Roboto",
        '"Helvetica Neue"',
        "Arial",
        '"Noto Sans"',
        "sans-serif",
        '"Apple Color Emoji"',
        '"Segoe UI Emoji"',
        '"Segoe UI Symbol"',
        '"Noto Color Emoji"',
      ],
    },
    extend: {
      colors: {
        body: "#231B33",
        black: "#000",
        white: "#fff",
        gray: "#DEDDE0",
      },
      fontSize: {
        "2xl": ["1.5rem", "2.25rem"],
        "4xl": ["2.25rem", "2.75rem"],
      },
      screens: {
        mdHeight: { raw: "(min-height: 678px)" },
      },
    },
  },
  variants: {},
  plugins: [require("@tailwindcss/forms")],
};
