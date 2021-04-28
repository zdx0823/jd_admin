const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/confirm.js', 'public/js').extract([
    'jquery',
    'jquery-toast-plugin',
    'jquery-toast-plugin/dist/jquery.toast.min.css'
])

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
])
