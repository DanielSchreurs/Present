<div role="navigation" class="main-nav">
    <a href="{!! URL::to('/') !!}"
       class="main-nav__item {!! $nav !!} {{ $nav=='dashboard' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-home"></use>
        </svg>
        <span class="navbar-item">Accueil</span>
    </a>
    <a href="{!! URL::to('/cours') !!}" class="main-nav__item {{ $nav=='cours' ? 'main-nav__item--active' : '' }}"
       data-intro="Retrouvez tous vos cours ici" data-step="6">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-cours"></use>
        </svg>
        <span class="navbar-item"><span class="visuallyhidden--palm">Mes</span> <span class="case visuallyhidden--lap visuallyhidden--lap-and-up">C</span><span class="case visuallyhidden--palm ">c</span>ours</span>
    </a>
    <a href="{!! URL::action('Www\ClassController@index') !!}"
       class="main-nav__item {{ $nav=='classes' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-classes"></use>
        </svg>
        <span class="navbar-item"><span class="visuallyhidden--palm">Mes</span> <span class="case visuallyhidden--lap visuallyhidden--lap-and-up">C</span><span class="case visuallyhidden--palm">c</span>lasses</span>
    </a>
    <a href="{!! URL::action('Www\StudentController@index') !!}"
       class="main-nav__item {{ $nav=='students' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-students"></use>
        </svg>
        <span class="navbar-item"><span class="visuallyhidden--palm">Mes</span> <span class="case visuallyhidden--lap visuallyhidden--lap-and-up">É</span><span class="case visuallyhidden--palm">é</span>lèves</span>
    </a>
    <a href="{!! URL::action('Www\PresentController@index') !!}"
       class="main-nav__item {{ $nav=='seances' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-calendar"></use>
        </svg>
        <span class="navbar-item"><span class="visuallyhidden--palm">Mes</span> <span class="case visuallyhidden--lap visuallyhidden--lap-and-up">S</span><span class="case visuallyhidden--palm ">s</span>éances</span>
    </a>
{{--     <a href="{!! URL::action('Www\SchoolController@index') !!}"
       class="visuallyhidden--palm main-nav__item {{ $nav=='schools' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-school"></use>
        </svg>
        <span class="navbar-item">Mes écoles</span>
    </a>--}}
    <a href="{!! URL::action('Www\PageController@getConfig') !!}"
       class="visuallyhidden--palm main-nav__item {{ $nav=='config' ? 'main-nav__item--active' : '' }}">
        <svg class="svg-basic svg-nav">
            <use xlink:href="#shape-settings"></use>
        </svg>
        <span class="navbar-item">Config<span class="visuallyhidden--palm">uration</span></span>
    </a>
</div>