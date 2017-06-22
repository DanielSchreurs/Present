<section class="box">
    <h2 class="box-header beta">{!! Html::linkAction('Www\ClassController@index','Mes classes',[],['class'=>'link-spacer']) !!}
        <a href="{!! URL::action('Www\ClassController@create') !!}"
           data-toggle="tooltip" title="Créer une classe" data-form="create-classe-form">
            <svg class="svg-basic svg--blue">
                <use xlink:href="#shape-create"></use>
            </svg>
        </a>
    </h2>
    @if($classes->total()==0)
        <div class="box__item">
            {!! link_to_action('Www\ClassController@create','Créer une classe',[],['class'=>'btn btn--small',]) !!}
        </div>
    @else
        <div>
            {!! Form::open(['action'=>'Www\SearchController@mainSearch','method'=>'get','class'=>'box__search--small']) !!}
            @include('forms.search.classe.search')
            {!! Form::close() !!}
        </div>
        @foreach($classes as $classe)
            <div class="box__item box__item--small">
                <div class="box__item__body">
                    {!! Html::linkAction('Www\ClassController@show',$classe->name,['slug'=>$classe->slug],['title'=>'Afiiche la classe','class'=>'']) !!}
                </div>
                <div class="box__item__actions">
                    <div class="form-hidde delete-class-form--{!! $classe->slug !!}">
                        {!!  Form::open(['action' => ['Www\ClassController@destroy', $classe->id], 'method' => 'delete','class'=>'']) !!}
                        <a href="#" data-form="delete-class-form--{!! $classe->slug !!}" class="hide-modal--top">
                            <svg class="hide-modal--top__svg svg--alert">
                                <use xlink:href="#shape-close-modal"></use>
                            </svg>
                            <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                        </a>
                        <p>Vous êtes sur le point de supprimer la classe : {!! $classe->name !!}</p>
                        <div class="text--center btn-container">
                            <button class=" btn btn--small btn--red-svg btn--alert"
                                    title="Supprimer la classe : {!! $classe->name !!}">
                                <svg class="svg-basic svg--white">
                                    <use xlink:href="#shape-trash"></use>
                                </svg>
                                <span>Supprimer la classe {!! $classe->name !!}</span>
                            </button>
                        </div>
                        <a href="#" data-form="delete-class-form--{!! $classe->slug !!}">@include('partials.panel.close-message')</a>
                        {!! Form::close() !!}
                    </div>
                    {!!  Form::open(['action' => ['Www\ClassController@destroy', $classe->id], 'method' => 'delete','class'=>'inline']) !!}
                    <button class="link--alert"
                            data-toggle="tooltip" data-form="delete-class-form--{!! $classe->slug !!}"
                            title="Supprimer la classe : {!! $classe->name !!}">
                        <svg class="svg-basic svg--alert">
                            <use xlink:href="#shape-trash"></use>
                        </svg>
                        <span class="visuallyhidden">Supprimer la classe {!! $classe->name !!}</span>
                    </button>
                    {!! Form::close() !!}
                    <a href="{!! URL::action('Www\ClassController@edit',['slug'=>$classe->slug]) !!}"
                       data-toggle="tooltip" title="Modifier la classe : {!! $classe->name !!}" class="svg-container">
                        <svg class="svg-basic svg--blue">
                            <use xlink:href="#shape-edit"></use>
                        </svg>
                        <span class="visuallyhidden">Modifier la classe {!! $classe->name !!}</span>
                    </a>
                    <a href="{!! URL::action('Www\ClassController@getAddStudentToClass',['slug'=>$classe->slug]) !!}"
                       data-toggle="tooltip" title="Ajouter des élèves à la classe : {!! $classe->name !!}" class="svg-container">
                        <svg class="svg-basic svg--blue">
                            <use xlink:href="#shape-add-student"></use>
                        </svg>
                        <span class="visuallyhidden">Ajouter des élèves à la classe {!! $classe->name !!}</span>
                    </a>
                </div>
            </div>
        @endforeach
        <div>
            @include('pagination.default', ['paginator' => $classes])
        </div>
    @endif
    <div class="form-hidde create-classe-form">
        {!! Form::open(['action' => 'Www\ClassController@store','enctype'=>'multipart/form-data','class'=>'']) !!}
        <a href="#" data-form="create-classe-form" class="hide-modal--top">
            <svg class="hide-modal--top__svg svg--alert">
                <use xlink:href="#shape-close-modal"></use>
            </svg>
            <span class="visuallyhidden">@include('partials.panel.close-message')</span>
        </a>
        @include('forms.class.create',['submit'=>'Créer la classe'])
        <a href="#" data-form="create-classe-form">@include('partials.panel.close-message')</a>
        {!! Form::close() !!}
    </div>
</section>