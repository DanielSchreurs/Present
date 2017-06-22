<div class="header-action-box">
    @unless(empty(Auth::user()->cours->toArray()))
        <a href="{!! URL::action('Www\PresentController@getPlanificateFull') !!}" class="btn btn--blue-svg">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-calendar"></use>
            </svg>
            <span>Planifier une séance de cours</span>
        </a>
    @endunless
</div>