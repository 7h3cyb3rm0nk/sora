/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./src/**/*.{html,php,js}',
    './**/*.{html,php,js}'],
  theme: {
    extend: {
      colors: {
          'sora-primary': '#4F46E5',
          'sora-secondary': '#818CF8',
          'sora-bg': '#F3F4F6',
          'sora-text': '#1F2937',
      }
  },
  },
  plugins: [],
}

