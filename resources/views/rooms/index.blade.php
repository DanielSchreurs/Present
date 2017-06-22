@extends('layouts.teacher_layout')
@section('title', 'Mes locaux')
@section('teacher_content')
@if(empty($schools->toArray()))
    <div class="informative-box">
        <p class="informative-box__text">Vous n’êtes pas encore <b>membre d'une école</b> ?
            Faites votre <b>demande d'adhésion</b> à une école existante ou créez la vôtre.</p>
        {!! Html::linkAction('Www\SchoolController@getConfig','Aller configuration',[],['class'=>'btn']) !!}
    </div>
@else
    @foreach($schools as $school)
        @if(empty($school->rooms->toArray()))
            <div class="informative-box">
                <p class="informative-box__text">Pas encore de <b>local</b>? {!! link_to_action('Www\RoomController@create','Créer un local',[],['class'=>'']) !!}</p>
            </div>
        @else
        <h2 class="epsilon">{!! $school->name !!}</h2>
        <ul class="layout">
            @foreach($school->rooms as $room)
                <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
                    <h2 class="box-header">{!! Html::linkAction('Www\RoomController@show',$room->name,['school_slug'=>$school->slug,'room_slug'=>$room->slug],['title'=>'Renvoie vers la clase '.$room->name]) !!}</h2>
                    <ul class="box">
                            <li>08:20 cours avec les 2F</li>
                            <li>09:20 cours avec les 3G</li>
                            <li>08:20 cours avec les 6G</li>
                            <li>08:20 cours avec les 2J</li>
                    </ul>
                </li>
            @endforeach
        </ul>
        @endif
    @endforeach
@endif
@stop