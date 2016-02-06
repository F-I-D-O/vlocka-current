var elixir = require('laravel-elixir');
//var browserify = require('laravel-elixir-browserify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
//	browserify.init();
//    mix.browserify("index.js");
//	mix.copy('bower_components', 'resources/assets/js');
	mix.copy('resources/assets/js', 'public/js');
});

