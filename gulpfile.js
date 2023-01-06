const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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


elixir(function(mix) {
    mix.copy('vendor/summernote/summernote/dist', 'public/vendor/summernote');
});
elixir(function(mix) {
    mix.copy('node_modules/animate.css/animate.min.css', 'public/vendor/animate/animate.min.css');
});