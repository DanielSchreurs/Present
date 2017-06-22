<p class="social-separator"><span class="social-separator__word">Ou</span></p>
<div>
    <a href="{!! URL::action('AuthController@login',['driver'=>'facebook']) !!}" title="S’enregistrer avec Facebook"
       class="btn btn--social btn--small btn--facebook">
        <svg class="svg-basic svg--social">
            <use xlink:href="#shape-facebook"></use>
        </svg>
        <span class="btn--social__message">Facebook</span>

    </a><a href="{!! URL::action('AuthController@login',['driver'=>'google']) !!}" title="S’enregistrer avec Google"
       class="btn btn--social btn--small btn--google">
        <svg class="svg-basic svg--social">
            <use xlink:href="#shape-google"></use>
        </svg>
        <span class="btn--social__message">Google</span>
    </a>
</div>