<div class="main-header">
    <a href="{!! URL::to('/') !!}" class="main-header__item main-header__item--logo">
        <svg class="svg-basic svg-blue">
            <use xlink:href="#shape-logo"></use>
        </svg>
        <span class="main-header__item--logo__logo">Présent</span>
    </a>
    <div class="main-header__item main-header__item--search">
        {!! Form::open(['action'=>'Www\SearchController@mainSearch','method'=>'get','data-intro'=>'Faites toutes vos recherches ici','data-step'=>'2']) !!}
        @include('forms.search.search',['submit'=>'Rechercher'])
        {!! Form::close() !!}
    </div>
    <h1 class="main-header__item main-header__item--title accessibility--palm">@yield('title')</h1>
    <div class="main-header__item main-header__item--dropdown">
        <div class="media dropdown-menu-container dropdown-menu-container--hover dropdown-menu-container--no-click"
             data-intro="Retrouver ici les informations relatives à votre compte" data-step="1">
            <?php $url = '';
            if (!empty($user->avatar)) {
                if (filter_var($user->avatar, FILTER_VALIDATE_URL)!==false) {
                    $url = $user->avatar;
                } else {
                    $url = '/image/user/40/40/' . $user->avatar;
                }
            } else {
                $url = asset('./img/default_profile_picture--user.svg');
            }
            ?>
            <img src="{!! $url !!}"
                 alt="Votre image de profil" class="media__img user-image user-image--small user-image--teacher-action"
                 width="40" height="40">
            <div class="media__body header-meta no-underline">
                <span class="accessibility--palm user-name">{!! $user->name !!}</span>
                <svg class="svg-basic svg--blue dropdown-menu__arraw">
                    <title>Afficher le menu</title>
                    <use xlink:href="#shape-dropdown"></use>
                </svg>
            </div>
            <div class="dropdown-menu">
                <ul>
                    <li class="dropdown-menu__item">
                        <svg class="svg-basic svg--blue dropdown-menu__arraw">
                            <use xlink:href="#shape-power"></use>
                        </svg>
                        {!! Html::link('auth/logout','Se déconnecter') !!}
                    </li>
                    @if($user->schools->first())
                        @if(count($user->schools)>1)
                            <li class="dropdown-menu__item">
                                <svg class="svg-basic svg--blue dropdown-menu__arraw">
                                    <use xlink:href="#shape-school"></use>
                                </svg>
                                {!! Html::linkAction('Www\SchoolController@index','Mes écoles') !!}
                            </li>
                        @else
                            <li class="dropdown-menu__item">
                                <svg class="svg-basic svg--blue dropdown-menu__arraw">
                                    <use xlink:href="#shape-school"></use>
                                </svg>
                                {!! Html::linkAction('Www\SchoolController@index','Mon école') !!}
                            </li>
                        @endif
                    @endif
                    <li class="dropdown-menu__item">
                        <svg class="svg-basic svg--blue dropdown-menu__arraw">
                            <use xlink:href="#shape-personal-settings"></use>
                        </svg>
                        <a href="{!! URL::action('Www\UserController@getConfig') !!}">Mon compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>