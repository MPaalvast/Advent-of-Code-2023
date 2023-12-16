/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  safelist: [
    'border',
    'rounded-md',
    'shadow-sm',
    'bg-sky-600',
    'border-sky-600',
    'md:py-2',
    'md:px-4',
    'py-1',
    'text-gray-700',
      'ml-3',
  ],
}

