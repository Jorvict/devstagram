/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // rutas de archivos donde utilizaremos clases de tailwind
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

