<div class="visitor-nav-container" role="navigation">
    <div class="wrapper">
        <div class="visitor-nav__header">
            <a class=" svg-container visitor-nav__header-link--home"
               href="{!! URL::action('Www\PageController@dashboard') !!}">
                <svg class="svg-basic svg-blue">
                    <use xlink:href="#shape-logo"></use>
                </svg>
                <span class="visuallyhidden">Présent</span>
            </a>
            <a href="#" class="visitor-nav__header-link--open">
                <svg class="inline-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="40" height="27" viewBox="0 0 32 22.5" enable-background="new 0 0 32 22.5"
                     xml:space="preserve">
					<title>Mobile Menu</title>
                    <g class="svg-menu-toggle">

                        <path class="bar" d="M20.945,8.75c0,0.69-0.5,1.25-1.117,1.25H3.141c-0.617,0-1.118-0.56-1.118-1.25l0,0
						c0-0.69,0.5-1.25,1.118-1.25h16.688C20.445,7.5,20.945,8.06,20.945,8.75L20.945,8.75z">
                        </path>
                        <path class="bar"
                              d="M20.923,15c0,0.689-0.501,1.25-1.118,1.25H3.118C2.5,16.25,2,15.689,2,15l0,0c0-0.689,0.5-1.25,1.118-1.25 h16.687C20.422,13.75,20.923,14.311,20.923,15L20.923,15z">
                        </path>
                        <path class="bar" d="M20.969,21.25c0,0.689-0.5,1.25-1.117,1.25H3.164c-0.617,0-1.118-0.561-1.118-1.25l0,0
						c0-0.689,0.5-1.25,1.118-1.25h16.688C20.469,20,20.969,20.561,20.969,21.25L20.969,21.25z">
                        </path>
                        <!-- needs to be here as a 'hit area' -->
                        <rect width="320" height="220" fill="none">

                        </rect>
                    </g>

		</svg>
            </a>
        </div>
        <div class="list-item-container list-item-container--close">
            <div class="visitor-nav__item">
                {!! Html::linkAction('Auth\AuthController@getRegister','S’inscrire',[],['class'=>'header-fix__item']) !!}
            </div>
            <div class="visitor-nav__item">
                {!! Html::linkAction('Auth\AuthController@getLogin','S’identifier',[],['class'=>'header-fix__item']) !!}
            </div>
            <div class="visitor-nav__item">
                {!! Html::linkAction('Auth\PasswordController@getEmail','Mot de passe oublié',[],['class'=>'header-fix__item']) !!}
            </div>
        </div>
    </div>
</div>