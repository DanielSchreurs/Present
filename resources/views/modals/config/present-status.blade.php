<ul class="box">
    <li class="flex-header">
        <div class="box-header beta flex-header__title">Mes statuts</div>
        <div class="flex-header__link-container">
            <a href="{!! URL::action('Www\StatutController@create') !!}" data-form="create-statut-form" class="btn btn--small">Ajouter un statut</a>
        </div>
    </li>
    <li>
        @include('forms.partials.base-info--important',['message'=>'Définissez des statuts. Ceux-ci apparaîtront lors de la prise des présences.'])
    </li>
    @foreach($statuts as $statut)
        <li class="box__item">
            <p class="box__item__body"><span class="color-box"
                                             style="background-color:{{ $statut->color}} "></span> {{ $statut->name }}
                <span class="box__meta-info" data-toggle="tooltip"
                      title="C’est le statut attribué par défaut aux personnes lors de la prise des présences. Définissez un autre statut “par défaut” si vous voulez le supprimer.">{{ $statut->is_default?' (Par défaut)':'' }}</span>
            </p>
            <div class="box__item__actions">
                @unless($statut->is_default || $statut->presents->count()>0)
                    {!!  Form::open(['action' => ['Www\StatutController@destroy',$statut->id], 'method' => 'delete','class'=>'inline']) !!}
                    <button class="link--alert"
                            data-toggle="tooltip" title="Supprimer le statut : {!! $statut->name !!}">
                        <svg class="svg-basic svg--alert">
                            <use xlink:href="#shape-trash"></use>
                        </svg>
                        <span class="visuallyhidden">Supprimer le statut {!! $statut->name !!}</span>
                    </button>
                @endunless
                {!! Form::close() !!}
                <a href="{!! URL::action('Www\StatutController@edit',['id'=>$statut->id]) !!}"
                   data-toggle="tooltip" title="Modifier le statut : {!! $statut->name !!}"
                   data-form="edit-statut-form--{!! $statut->id !!}">
                    <svg class="svg-basic svg--blue">
                        <use xlink:href="#shape-edit"></use>
                    </svg>
                    <span class="visuallyhidden">Modifier le statut {!! $statut->name !!}</span>
                </a>
                <div class="form-hidde edit-statut-form--{!! $statut->id !!}">
                    {!! Form::model($statut,['action' => ['Www\StatutController@update','id'=>$statut->id],'method'=>'patch']) !!}
                    <a href="#" data-form="edit-statut-form--{!! $statut->id !!}" class="hide-modal--top">
                        <svg class="hide-modal--top__svg svg--alert">
                            <use xlink:href="#shape-close-modal"></use>
                        </svg>
                        <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                    </a>
                    @include('forms.statuts.edit',['submit'=>'Modifier le statut '.$statut->name])
                    <a href="#" data-form="edit-statut-form--{!! $statut->id !!}">@include('partials.panel.close-message')</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </li>
    @endforeach
    <li>
        {!!  Form::open(['action' => ['Www\StatutController@updateDefault'], 'method' => 'patch','class'=>'']) !!}
            @include('forms.statuts.update-default',['submit'=>'Mettre à jour le statut par defaut'])
        {!! Form::close() !!}
    </li>
    <li class="form-hidde  create-statut-form">
        {!! Form::open(['action' => 'Www\StatutController@store','class'=>'']) !!}
        <a href="#" data-form="create-statut-form" class="hide-modal--top">
            <svg class="hide-modal--top__svg svg--alert">
                <use xlink:href="#shape-close-modal"></use>
            </svg>
            <span class="visuallyhidden">@include('partials.panel.close-message')</span>
        </a>
        @include('forms.statuts.create',['submit'=>'Ajouter le statut'])
        <a href="#" data-form="create-statut-form">@include('partials.panel.close-message')</a>
        {!! Form::close() !!}
    </li>

</ul>