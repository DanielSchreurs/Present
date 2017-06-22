<?php $schools = Auth::user()->schools ?>
<ul class="box">
    <li class="box-header beta">{!! Html::linkAction('Www\SchoolController@index','Mes écoles',[],['class'=>'']) !!} {!! link_to_action('Www\SchoolController@create','Créer une école',[],['class'=>'btn btn--add btn--small btn--soft']) !!}</li>
    @if(empty(Auth::user()->schools->toArray()))
        <li class="box__item"><span class="link-spacer">Vous n'avez pas encore
            d’école ? </span> {!! link_to_action('Www\SchoolController@create','Créer une école !',[],['class'=>'']) !!}
        </li>
    @else
        @foreach($schools as $school)
            <li>{!! link_to_action('Www\SchoolController@show',$school->name,['slug'=>$school->slug],['class'=>'']) !!}</li>
        @endforeach
    @endif
</ul>