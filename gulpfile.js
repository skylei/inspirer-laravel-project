var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.sass('app.scss', 'public/assets/common/css')
       .styles(['inspirer-blog/admin/login.css'], 'public/assets/inspirer-blog/admin/css/login.css')
       .version(['assets/common/css/app.css', 'assets/inspirer-blog/admin/css/login.css']);
});
