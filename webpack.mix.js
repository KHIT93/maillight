const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/messages.js', 'public/js')
   .js('resources/assets/js/message_details.js', 'public/js')
   .js('resources/assets/js/lists.js', 'public/js')
   .js('resources/assets/js/reports.js', 'public/js')
   .js('resources/assets/js/reports_messages_by_date.js', 'public/js')
   .js('resources/assets/js/settings.js', 'public/js')
   .js('resources/assets/js/tools.js', 'public/js')
   .js('resources/assets/js/login.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
