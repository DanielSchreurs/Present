<article class="box {{ $cour->isUpdatedNow?'box--animate':'' }} match-height {{ isset($isEdit)?'box--edit':'' }}
@if(isset($isCreate))
{{ $meta['create_view_classe_list_block']==0?'':'box--classe--list' }}
@endif">
    <div class="box-header {{ isset($isCreate)?'delta':'beta' }}">
        <h2>{!! Html::linkAction('Www\CoursController@show',$cour->name,['slug'=>$cour->slug],['class'=>'link-spacer']) !!}</h2>
        <div>
            @unless(isset($isEdit))
                {!!  Form::open(['action' => ['Www\CoursController@destroy', $cour->id], 'method' => 'delete','class'=>'inline']) !!}
                <button class="link--alert"
                        data-toggle="tooltip" title="Supprimer le cours : {!! $cour->name !!}"
                        data-form="delete-cours-form--{!! $cour->slug !!}">
                    <svg class="svg-basic svg--alert">
                        <use xlink:href="#shape-trash"></use>
                    </svg>
                    <span class="visuallyhidden">Supprimer le cours : {!! $cour->name !!}</span>
                </button>
                {!! Form::close() !!}
            @endunless
            <a href="{!! URL::action('Www\CoursController@edit',['id'=>$cour->id]) !!}"
               data-toggle="tooltip" title="Modifier le cours : {!! $cour->name !!}" class="svg-container">
                <svg class="svg-basic svg--blue">
                    <use xlink:href="#shape-edit"></use>
                </svg>
                <span class="visuallyhidden">Modifier le cours : {!! $cour->name !!}</span>
            </a>
            <a href="{!! URL::action('Www\PresentController@getPlanificateFullWithCours',['cours_slug'=>$cour->slug]) !!}"
               data-toggle="tooltip"
               title="Planifier une séance à partir du cours : {!! $cour->name !!}">
                <svg class="svg-basic svg--blue">
                    <use xlink:href="#shape-calendar"></use>
                </svg>
                <span class="visuallyhidden">Planifier une séance à partir du cours : {!! $cour->name !!}</span>
            </a>
        </div>
    </div>
    <p><i class="meta-info">Decription&nbsp;:</i> {!! $cour->description !!}</p>

    @if(!is_null($cour->classes))
        <ul class="
         @if(isset($isCreate))
        {{ $meta['create_view_cours_list_block']==1?'':'visuallyhidden' }}
        @endif
        @if(isset($isIndex))
        {{ $meta['index_view_cours_list_block']==1?'':'visuallyhidden' }}
        @endif
                ">
            @if($cour->classes()->count()>0)
                <li>Classe&nbsp;:
                    @foreach($cour->classes as $class)
                        {!! link_to_action('Www\ClassController@show',$class->name,[$class->slug],[]) !!}
                    @endforeach
                </li>
            @else
                <li>Ce cours n’est donné à aucune classe.</li>
            @endif
        </ul>
    @else
        <p class="alert-danger--soft">Le cours <i>{!! ' '.$cour->name.' ' !!}</i> n’a pas encore de
            classe. {!! Html::linkAction('Www\ClassController@create','Créer une classe') !!}</p>
    @endif
    @unless(isset($isEdit))
        <div class="form-hidde delete-cours-form--{!! $cour->slug !!}">
            {!!  Form::open(['action' => ['Www\CoursController@destroy', $cour->id], 'method' => 'delete','class'=>'']) !!}
            <a href="#" data-form="delete-cours-form--{!! $cour->slug !!}" class="hide-modal--top">
                <svg class="hide-modal--top__svg svg--alert">
                    <use xlink:href="#shape-close-modal"></use>
                </svg>
                <span class="visuallyhidden">@include('partials.panel.close-message')</span>
            </a>
            <p>Vous êtes sur le point de supprimer le cours : {!! $cour->name !!}</p>
            <div class="text--center btn-container">
                <button class=" btn btn--small btn--red-svg btn--alert"
                        title="Supprimer le cours : {!! $cour->name !!}">
                    <svg class="svg-basic svg--white">
                        <use xlink:href="#shape-trash"></use>
                    </svg>
                    <span>Supprimer le cours {!! $cour->name !!}</span>
                </button>
            </div>
            <a href="#" data-form="delete-cours-form--{!! $cour->slug !!}">@include('partials.panel.close-message')</a>
            {!! Form::close() !!}
        </div>
    @endunless
</article>