<?php

    return [
        /*
         |--------------------------------------------------------------------------
         | The configurations of search index.
         |--------------------------------------------------------------------------
         |
         | The "path" is the path to Lucene search index.
         |
         | The "models" is the list of the descriptions for models. Each description
         | must contains class of model and fields available for search indexing.
         |
         | For example, model's description can be like this:
         |
         |      'namespace\ModelClass' => [
         |          'fields' => [
         |              'name', 'description', // Fields for indexing.
         |          ]
         |      ]
         |
         */
        'index'    => [

            'path' => storage_path('app') . '/lucene-search/index',

            'models' => [
                \App\User::class    => [
                    'fields' => [
                        'name', // field with default boost
                        'email', // field with default boost
                        'slug' => ['boost' => 0.2], // customize boost value
                    ],
                ],
                \App\Student::class => [
                    'fields' => [
                        'fullname',
                        'first_name',
                        'last_name',
                        'slug',
                        'email'
                    ]
                ],
                \App\School::class  => [
                    'fields' => [
                        'name',
                        'slug'
                    ]
                ],
                \App\School::class  => [
                    'fields' => [
                        'name',
                        'slug'
                    ]
                ],
                \App\Classe::class  => [
                    'fields' => [
                        'name',
                        'slug'
                    ]
                ],
                \App\Cour::class    => [
                    'fields' => [
                        'name',
                        'slug'
                    ]
                ],
                \App\Room::class    => [
                    'fields' => [
                        'name',
                        'slug'
                    ]
                ]
            ],
        ],

        /*
         |--------------------------------------------------------------------------
         | ZendSearch token filters.
         |--------------------------------------------------------------------------
         |
         | The "filters" is the list of ZendSearch token filters classes. Each class
         | must implement the TokenFilterInterface interface. Stemming token filter
         | for english and russian words is enabled by default. To disable it remove
         | class 'Nqxcode\Stemming\TokenFilterEnRu' from token filters.
         |
         | The "stopwords" is the list of paths to files with stopwords. By default
         | english and russian stopwords are used.
         |
        */
        'analyzer' => [

            'filters' => [
                'Nqxcode\Stemming\TokenFilterEnRu',
            ],

            'stopwords' => Nqxcode\LuceneSearch\Analyzer\Stopwords\Files::get(),
        ],
    ];
