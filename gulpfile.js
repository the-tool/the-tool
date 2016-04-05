var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

var paths = {
    bootstrap: './resources/assets/bower/bower_components/bootstrap-sass/assets/',
    fontawesome: './resources/assets/bower/bower_components/fontawesome/',
    jquery: './resources/assets/bower/bower_components/jquery/',
    semantic: './resources/assets/bower/bower_components/semantic-ui/'
};

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

    mix.copy(
        'node_modules/jquery/dist/jquery.js',
        'resources/assets/js/jquery.js'
    ).copy(
        'vendor/bower_components/fontawesome/scss',
        'resources/assets/sass/fontawesome'
    ).copy(
        'vendor/bower_components/fontawesome/fonts',
        'public/assets/fonts'
    ).copy(
        'resources/assets/vendor/semantic/dist/semantic.css',
        'resources/assets/css'
    ).copy(
        'resources/assets/vendor/semantic/dist/semantic.js',
        'resources/assets/js'
    );

    mix.sass(
        [
            'app/app.scss',
            'fontawesome/font-awesome.scss'
        ],
        'resources/assets/css'
    );

    mix.styles(
        [
            'semantic.css',
            'font-awesome.css',
            'app.css'
        ],
        'public/assets/css/all.css',
        'resources/assets/css'
    );

    mix.scripts(
        [
            'jquery.js',
            'semantic.js',
            'main.js',
        ],
        'public/assets/js/all.js',
        'resources/assets/js'
    );

    mix.version([
        'public/assets/css/all.css',
        'public/assets/js/all.js'
    ]);

    mix.phpUnit();

});
