<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Application Debug Mode
        |--------------------------------------------------------------------------
        |
        | When your application is in debug mode, detailed error messages with
        | stack traces will be shown on every error that occurs within your
        | application. If disabled, a simple generic error page is shown.
        |
        */

        'debug' => env('APP_DEBUG', false),

        /*
        |--------------------------------------------------------------------------
        | Application URL
        |--------------------------------------------------------------------------
        |
        | This URL is used by the console to properly generate URLs when using
        | the Artisan command line tool. You should set this to the root of
        | your application so that it is used when running Artisan tasks.
        |
        */

        'url' => env('url'),

        /*
        |--------------------------------------------------------------------------
        | Application Timezone
        |--------------------------------------------------------------------------
        |
        | Here you may specify the default timezone for your application, which
        | will be used by the PHP date and date-time functions. We have gone
        | ahead and set this to a sensible default for you out of the box.
        |
        */

        'timezone' => 'Europe/Paris',

        /*
        |--------------------------------------------------------------------------
        | Application Locale Configuration
        |--------------------------------------------------------------------------
        |
        | The application locale determines the default locale that will be used
        | by the translation service provider. You are free to set this value
        | to any of the locales which will be supported by the application.
        |
        */

        'locale' => 'fr',

        /*
        |--------------------------------------------------------------------------
        | Application Fallback Locale
        |--------------------------------------------------------------------------
        |
        | The fallback locale determines the locale to use when the current one
        | is not available. You may change the value to correspond to any of
        | the language folders that are provided through your application.
        |
        */

        'fallback_locale' => 'fr',

        /*
        |--------------------------------------------------------------------------
        | Encryption Key
        |--------------------------------------------------------------------------
        |
        | This key is used by the Illuminate encrypter service and should be set
        | to a random, 32 character string, otherwise these encrypted strings
        | will not be safe. Please do this before deploying an application!
        |
        */

        'key' => env('APP_KEY', 'SomeRandomString'),

        'cipher' => 'AES-256-CBC',

        /*
        |--------------------------------------------------------------------------
        | Logging Configuration
        |--------------------------------------------------------------------------
        |
        | Here you may configure the log settings for your application. Out of
        | the box, Laravel uses the Monolog PHP logging library. This gives
        | you a variety of powerful log handlers / formatters to utilize.
        |
        | Available Settings: "single", "daily", "syslog", "errorlog"
        |
        */

        'log' => 'single',

        /*
        |--------------------------------------------------------------------------
        | Autoloaded Service Providers
        |--------------------------------------------------------------------------
        |
        | The service providers listed here will be automatically loaded on the
        | request to your application. Feel free to add your own services to
        | this array to grant expanded functionality to your applications.
        |
        */

        'providers' => [

            /*
             * Laravel Framework Service Providers...
             */
            Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
            Illuminate\Auth\AuthServiceProvider::class,
            Illuminate\Broadcasting\BroadcastServiceProvider::class,
            Illuminate\Bus\BusServiceProvider::class,
            Illuminate\Cache\CacheServiceProvider::class,
            Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
            Illuminate\Routing\ControllerServiceProvider::class,
            Illuminate\Cookie\CookieServiceProvider::class,
            Illuminate\Database\DatabaseServiceProvider::class,
            Illuminate\Encryption\EncryptionServiceProvider::class,
            Illuminate\Filesystem\FilesystemServiceProvider::class,
            Illuminate\Foundation\Providers\FoundationServiceProvider::class,
            Illuminate\Hashing\HashServiceProvider::class,
            Illuminate\Mail\MailServiceProvider::class,
            Illuminate\Pagination\PaginationServiceProvider::class,
            Illuminate\Pipeline\PipelineServiceProvider::class,
            Illuminate\Queue\QueueServiceProvider::class,
            Illuminate\Redis\RedisServiceProvider::class,
            Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
            Illuminate\Session\SessionServiceProvider::class,
            Illuminate\Translation\TranslationServiceProvider::class,
            Illuminate\Validation\ValidationServiceProvider::class,
            Illuminate\View\ViewServiceProvider::class,

            // Barryvdh\Debugbar\ServiceProvider::class,
            /*
             * Application Service Providers...
             */

            App\Providers\AppServiceProvider::class,
            App\Providers\AuthServiceProvider::class,
            App\Providers\EventServiceProvider::class,
            App\Providers\RouteServiceProvider::class,
            App\Providers\ViewServiceProvider::class,
            Collective\Html\HtmlServiceProvider::class,
            Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
            Laracasts\Flash\FlashServiceProvider::class,
            Cviebrock\EloquentSluggable\SluggableServiceProvider::class,
            Maatwebsite\Excel\ExcelServiceProvider::class,
            Nqxcode\LuceneSearch\ServiceProvider::class,
            Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
            //Dingo\Api\Provider\LaravelServiceProvider::class,
            Intervention\Image\ImageServiceProvider::class,
            GrahamCampbell\HTMLMin\HTMLMinServiceProvider::class,
            Krisawzm\CriticalCss\CriticalCssServiceProvider::class,
            Laravel\Socialite\SocialiteServiceProvider::class,
            Jrean\UserVerification\UserVerificationServiceProvider::class,
            Cviebrock\ImageValidator\ImageValidatorServiceProvider::class,

        ],

        /*
        |--------------------------------------------------------------------------
        | Class Aliases
        |--------------------------------------------------------------------------
        |
        | This array of class aliases will be registered when this application
        | is started. However, feel free to register as many as you wish as
        | the aliases are "lazy" loaded so they don't hinder performance.
        |
        */

        'aliases'                        => [

            'App'              => Illuminate\Support\Facades\App::class,
            'Artisan'          => Illuminate\Support\Facades\Artisan::class,
            'Auth'             => Illuminate\Support\Facades\Auth::class,
            'Blade'            => Illuminate\Support\Facades\Blade::class,
            'Bus'              => Illuminate\Support\Facades\Bus::class,
            'Cache'            => Illuminate\Support\Facades\Cache::class,
            'Config'           => Illuminate\Support\Facades\Config::class,
            'Cookie'           => Illuminate\Support\Facades\Cookie::class,
            'Crypt'            => Illuminate\Support\Facades\Crypt::class,
            'DB'               => Illuminate\Support\Facades\DB::class,
            'Eloquent'         => Illuminate\Database\Eloquent\Model::class,
            'Event'            => Illuminate\Support\Facades\Event::class,
            'File'             => Illuminate\Support\Facades\File::class,
            'Gate'             => Illuminate\Support\Facades\Gate::class,
            'Hash'             => Illuminate\Support\Facades\Hash::class,
            'Input'            => Illuminate\Support\Facades\Input::class,
            'Inspiring'        => Illuminate\Foundation\Inspiring::class,
            'Lang'             => Illuminate\Support\Facades\Lang::class,
            'Log'              => Illuminate\Support\Facades\Log::class,
            'Mail'             => Illuminate\Support\Facades\Mail::class,
            'Password'         => Illuminate\Support\Facades\Password::class,
            'Queue'            => Illuminate\Support\Facades\Queue::class,
            'Redirect'         => Illuminate\Support\Facades\Redirect::class,
            'Redis'            => Illuminate\Support\Facades\Redis::class,
            'Request'          => Illuminate\Support\Facades\Request::class,
            'Response'         => Illuminate\Support\Facades\Response::class,
            'Route'            => Illuminate\Support\Facades\Route::class,
            'Schema'           => Illuminate\Support\Facades\Schema::class,
            'Session'          => Illuminate\Support\Facades\Session::class,
            'Storage'          => Illuminate\Support\Facades\Storage::class,
            'URL'              => Illuminate\Support\Facades\URL::class,
            'Validator'        => Illuminate\Support\Facades\Validator::class,
            'View'             => Illuminate\Support\Facades\View::class,
            'Form'             => Collective\Html\FormFacade::class,
            'Html'             => Collective\Html\HtmlFacade::class,
            'Flash'            => Laracasts\Flash\Flash::class,
            'Debugbar'         => Barryvdh\Debugbar\Facade::class,
            'Excel'            => Maatwebsite\Excel\Facades\Excel::class,
            'Search'           => Nqxcode\LuceneSearch\Facade::class,
            'JavaScript'       => Laracasts\Utilities\JavaScript\JavaScriptFacade::class,
            //'DingoApi'   => Dingo\Api\Facade\API::class,
            //'DingoRoute' => Dingo\Api\Facade\Route::class,
            'Image'            => Intervention\Image\Facades\Image::class,
            'HTMLMin'          => GrahamCampbell\HTMLMin\Facades\HTMLMin::class,
            'Critical'         => Krisawzm\CriticalCss\Facades\Critical::class,
            'Socialite'        => Laravel\Socialite\Facades\Socialite::class,
            'UserVerification' => Jrean\UserVerification\Facades\UserVerification::class,
        ],
        'statutsColors'                  => [
            '#1abc9c' => 'Turquoise',
            '#e67e22' => 'Orange',
            '#c0392b' => 'Rouge foncé',
            '#8e44ad' => 'Mauve',
            '#0933FF' => 'Bleu',
            '#E34A78' => 'Rouge',
            '#2FC85A' => 'Vert',
            '#CDDC39' => 'Vert clair',
            '#FFEB3B' => 'Jaune',
            '#795548' => 'Brun'
        ],
        'defaultMetas'                   => [
            // create 
            'create_view_student_list_block'     => '1',
            'create_view_classe_list_block'      => '1',
            'create_view_cours_list_block'       => '1',
            'create_view_student_nbr_pagination' => '6',
            'create_view_classe_nbr_pagination'  => '4',
            'create_view_cours_nbr_pagination'   => '4',
            'create_view_student_classe_id'      => null,
            // index
            'index_view_student_list_block'      => '1',
            'index_view_cours_list_block'        => '1',
            'index_view_classe_list_block'       => '1',
            'index_view_student_nbr_pagination'  => '8',
            'index_view_classe_nbr_pagination'   => '6',
            'index_view_cours_nbr_pagination'    => '6',
            'index_view_student_classe_id'       => null
        ],
        'defaultStatuts'                 => [
            [
                'name'       => 'Présent',
                'color'      => '#2FC85A',
                'is_default' => 1,
            ], [
                'name'       => 'Absent',
                'color'      => '#E34A78',
                'is_default' => 0
            ], [
                'name'       => 'Retard justifié',
                'color'      => '#0933FF',
                'is_default' => 0
            ]
        ],
        'defaultCreatePaginationStudent' => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
            '12' => '12',
            '14' => '14',
        ],
        'defaultCreatePaginationClasse'  => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
        ],
        'defaultCreatePaginationCours'   => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
        ],
        'defaultIndexPaginationStudent'  => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
            '12' => '12',
            '14' => '14',
            '16' => '16',
            '18' => '18',
            '20' => '20',
            '40' => '40',
        ],
        'defaultIndexPaginationClasse'   => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
            '12' => '12',
            '14' => '14',
        ],
        'defaultIndexPaginationCours'    => [
            '2'  => '2',
            '4'  => '4',
            '6'  => '6',
            '8'  => '8',
            '10' => '10',
            '12' => '12',
            '14' => '14',
        ],
        'notAllowedPassword'             => [
            'password',
            '1234567890',
            '123456789',
            '12345678',
            '1234567',
            '123456',
            '12345',
            '1234',
            '6969',
            '121212',
            'qwerty',
            'azerty',
            'dragon',
            'pussy',
            'abc123',
            '696969',
            'michael',
            'shadow',
            '111111',
            '2000',
            'jordan',
            'pass',
            'love',
            'cowboy'
        ],
        'noteTypes'                      => [
            'cours'    => 'relatives aux cours',
            'student'  => 'relatives  à l’élève',
            'presence' => 'relatives  aux présences'
        ],
        'coursTable'                     => [
            'Création de pages Web - HTMl', 'Projet', 'Applications Internet riches ', 'Projets Web'
        ],
        'iMaxStudentsClasse'             => 8,
        'iMaxUser'                       => 20
    ];
