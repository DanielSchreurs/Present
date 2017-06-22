<?php
    return [

        /*
        |--------------------------------------------------------------------------
        | Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | The following language lines contain the default error messages used by
        | the validator class. Some of these rules have multiple versions such
        | such as the size rules. Feel free to tweak each of these messages.
        |
        */

        'accepted'             => 'Le champ, %s, doit être accepté.',
        'active_url'           => 'Le champ, %s, n’est pas une URL valide.',
        'after'                => 'Le champ, %s, doit être une date postérieure au :date.',
        'alpha'                => 'Le champ, %s, doit seulement contenir des lettres.',
        'alpha_dash'           => 'Le champ, %s, doit seulement contenir des lettres, des chiffres et des tirets.',
        'alpha_num'            => 'Le champ, %s, doit seulement contenir des chiffres et des lettres.',
        'array'                => 'Le champ, %s, doit être un tableau.',
        'before'               => 'Le champ, %s, doit être une date antérieure au :date.',
        'between'              => [
            'numeric' => 'La valeur de, %s, doit être comprise entre :min et :max.',
            'file'    => 'Le fichier, %s, doit avoir une taille entre :min et :max kilo-octets.',
            'string'  => 'Le texte, %s, doit avoir entre :min et :max caractères.',
            'array'   => 'Le tableau, %s, doit avoir entre :min et :max éléments.',
        ],
        'boolean'              => 'Le champ, %s, doit être vrai ou faux.',
        'confirmed'            => 'Le champ, de, confirmation, %s, ne correspond pas.',
        'date'                 => 'Le champ, %s, n’est pas une date valide.',
        'date_format'          => 'Le champ, %s, ne correspond pas au format :format.',
        'different'            => 'Les champs, %s, et :other doivent être différents.',
        'digits'               => 'Le champ, %s, doit avoir :digits chiffres.',
        'digits_between'       => 'Le champ, %s, doit avoir entre :min et :max chiffres.',
        'email'                => 'Le champ,  %,s doit être une adresse email valide.',
        'exists'               => 'Le champ, %s, sélectionné est invalide.',
        'filled'               => 'Le champ, %s, est obligatoire.',
        'image'                => 'Le champ, %s, doit être une image.',
        'in'                   => 'Le champ, %s, est invalide.',
        'integer'              => 'Le champ, %s, doit être un entier.',
        'ip'                   => 'Le champ, %s, doit être une adresse IP valide.',
        'json'                 => 'Le champ, %s, doit être un document JSON valide.',
        'max'                  => [
            'numeric' => 'La valeur de, %s, ne peut être supérieure à :max.',
            'file'    => 'Le fichier, %s, ne peut être plus gros que :max kilo-octets.',
            'string'  => 'Le texte de, %s, ne peut contenir plus de :max caractères.',
            'array'   => 'Le tableau, %s, ne peut avoir plus de :max éléments.',
        ],
        'mimes'                => 'Le champ, %s, doit être un fichier de type : :values.',
        'min'                  => [
            'numeric' => 'La valeur de, %s, doit être supérieure à :min.',
            'file'    => 'Le fichier, %s, doit être plus gros que :min kilo-octets.',
            'string'  => 'Le texte, %s, doit contenir au moins :min caractères.',
            'array'   => 'Le tableau, %s, doit avoir au moins :min éléments.',
        ],
        'not_in'               => 'Le champ, %s, sélectionné n’est pas valide.',
        'numeric'              => 'Le champ, %s, doit contenir un nombre.',
        'regex'                => 'Le format du champ, %s, est invalide.',
        'required'             => 'Le champ, %s, est obligatoire.',
        'required_if'          => 'Le champ, %s, est obligatoire quand la valeur de :other est :value.',
        'required_unless'      => 'Le champ, %s, est obligatoire sauf si :other est :values.',
        'required_with'        => 'Le champ, %s, est obligatoire quand :values est présent.',
        'required_with_all'    => 'Le champ, %s, est obligatoire quand :values est présent.',
        'required_without'     => 'Le champ, %s, est obligatoire quand :values n’est pas présent.',
        'required_without_all' => 'Le champ, %s, est requis quand aucun de :values n’est présent.',
        'same'                 => 'Les champs, %s, et :other doivent être identiques.',
        'size'                 => [
            'numeric' => 'La valeur de, %s, doit être :size.',
            'file'    => 'La taille du fichier de, %s, doit être de :size kilo-octets.',
            'string'  => 'Le texte de, %s, doit contenir :size caractères.',
            'array'   => 'Le tableau, %s, doit contenir :size éléments.',
        ],
        'string'               => 'Le champ, %s, doit être une chaîne de caractères.',
        'timezone'             => 'Le champ, %s, doit être un fuseau horaire valide.',
        'unique'               => 'La valeur du champ, %s, est déjà utilisée.',
        'url'                  => 'Le format de l’URL de, %s, n’est pas valide.',

        /*
        |--------------------------------------------------------------------------
        | Custom Validation Language Lines
        |--------------------------------------------------------------------------
        |
        | Here you may specify custom validation messages for attributes using the
        | convention "attribute.rule" to name the lines. This makes it quick to
        | specify a specific custom language line for a given attribute rule.
        |
        */

        'custom' => [
            'password' => [
                'not_in' => 'Ce mot de passe est vraiment trop simple.',
            ],
            'avatar'   => [
                'image_size' => 'La taille de, %s, doit être d’au moins 100 pixels par 100 pixels.'
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | Custom Validation Attributes
        |--------------------------------------------------------------------------
        |
        | The following language lines are used to swap attribute place-holders
        | with something more reader friendly such as E-Mail Address instead
        | of "email". This simply helps us make messages a little cleaner.
        |
        */

        'attributes' => [
            'name'                  => 'Nom',
            'username'              => 'Pseudo',
            'email'                 => 'E-mail',
            'first_name'            => 'Prénom',
            'last_name'             => 'Nom',
            'password'              => 'Mot de passe',
            'password_confirmation' => 'Confirmation du mot de passe',
            'city'                  => 'Ville',
            'country'               => 'Pays',
            'address'               => 'Adresse',
            'phone'                 => 'Téléphone',
            'mobile'                => 'Portable',
            'age'                   => 'Age',
            'sex'                   => 'Sexe',
            'gender'                => 'Genre',
            'day'                   => 'Jour',
            'month'                 => 'Mois',
            'year'                  => 'Année',
            'years'                 => 'Année',
            'hour'                  => 'Heure',
            'minute'                => 'Minute',
            'second'                => 'Seconde',
            'title'                 => 'Titre',
            'content'               => 'Contenu',
            'description'           => 'Description',
            'excerpt'               => 'Extrait',
            'date'                  => 'Date',
            'time'                  => 'Heure',
            'available'             => 'Disponible',
            'size'                  => 'Taille',
            'from'                  => 'Début de période',
            'to'                    => 'Fin de période',
            'students_id'           => 'Sélectionnez vos élèves',
            'from_hour'             => 'Début de la séance de cours',
            'to_hour'               => 'Fin de la séance de cours ',
            'student_list'          => 'Sélectionnez le fichier (.CSV) contenant vos élèves'
        ],
    ];
