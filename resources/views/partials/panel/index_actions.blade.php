<div class="header-action-box">
    @if($nav=="cours")
        <a href="{!! URL::action('Www\CoursController@create') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de créer un cours">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-create"></use>
            </svg>
            <span>Créez un cours</span>
        </a>
    @endif
    @if($nav=='students')
        <a href="{!! URL::action('Www\StudentController@create') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de créer un élève">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-create"></use>
                <span>Créez un élève</span>
            </svg>
        </a>
        <a href="{!! URL::action('Www\StudentController@getImportStudentsList') !!}" class="header-action-box__item btn btn--small btn--blue-svg visuallyhidden--palm"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet d’mporter une liste d’élèves">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-import"></use>
                <span>Importez une liste d’élèves</span>
            </svg>
        </a>
    @endif
    @if($nav=='classes')
        <a href="{!! URL::action('Www\ClassController@create') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de créer une classe">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-create"></use>
            </svg>
            <span>Créez une classe</span>
        </a>
    @endif
    @if($nav=='schools')
        <a href="{!! URL::action('Www\SchoolController@create') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de créer une école">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-create"></use>
                <span>Créez une école</span>
            </svg>
        </a>
    @endif
    @if(!empty(Auth::user()->cours->toArray()))
        <a href="{!! URL::action('Www\PresentController@getPlanificateFull') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de planifier une séance de cours">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-calendar"></use>
            </svg>
            <span>Planifier des séances de cours</span>
        </a>
    @endif
    @if((Auth::user()->hasOccurrence)&&($nav!=='seances'))
        <a href="{!! URL::action('Www\PresentController@index') !!}" class="header-action-box__item btn btn--small btn--blue-svg"
           data-toggle="tooltip" title="Renvoie vers le formulaire qui permet de prendre les présences">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-to-do"></use>
                <span>Prendre les présences</span>
            </svg>
        </a>
    @endif
</div>