var elixir    = require( 'laravel-elixir' ),
    htmlmin   = require( 'gulp-htmlmin' ),
    gulp      = require( 'gulp' );

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
elixir.config.sourcemaps = true;
elixir( function ( mix ) {
    mix.rubySass( 'app.scss' );
    mix.scripts( [
        "vendor/moment.js",// need for date picker
        "vendor/jquery.js",
        "vendor/jqueryCollapseAndTransition.js",
        'vendor/datepicker.js',
        'tools/datepicker-init.js',
        "vendor/minified/slimScroll.min.js",
        "vendor/bootstrap_tooltip.min.js",
        'vendor/minified/intro.min.js',
        'vendor/chosen.jquery.js',
        'tools/select.js',
        'tools/chosen.js',
        'tools/tooltip.js',
        'tools/alert-message.js',
        //'tools/introduction.js',
         'tools/nav-tabs.js',
        'tools/dropdown.js',
        'tools/jquery.matchHeight-min.js',
        'forms/create_cours.js',
        'forms/login.js',
        'forms/data-form.js',
        'forms/users/load-avatar-file.js',
        'forms/users/load-user-file.js',
        'forms/presents/take-presents.js',
        'forms/filter.js',
        'forms/delete-student-when-import.js',
        'graphiques/chart-loader.js',
        'graphiques/seances/seances.index.js',// erreur
        'graphiques/students/present.js',
        'graphiques/students/statutsCours.js',
        'forms/begin-date.js',
        '/tools/nav-bar.js'
        // '../../../node_modules/croppie/croppie.min.js',
        // 'tools/croppie.js'
    ] );
    mix.browserSync(
        {
            proxy: "localhost:8888"
        }
    );
} );



