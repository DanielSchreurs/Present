@extends('layouts.teacher_layout')
@section('title', 'Les locaux')
@section('teacher_content')
<ul class="layout">
    <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        <h2 class="box-header">{!! link_to('places/b12','B 12') !!}</h2>
        <ul class="box">
            <li>08:20 cours avec les 2F</li>
            <li>09:20 cours avec les 3G</li>
            <li>08:20 cours avec les 6G</li>
            <li>08:20 cours avec les 2J</li>
        </ul>
    </li>
    <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        <h2 class="box-header">{!! link_to('places/b12','B 13') !!}</h2>
        <ul class="box">
            <li>08:20 cours avec les 2F</li>
            <li>09:20 cours avec les 3G</li>
            <li>08:20 cours avec les 6G</li>
            <li>08:20 cours avec les 2J</li>
        </ul>
    </li>
    <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        <h2 class="box-header">{!! link_to('places/b12','B 14') !!}</h2>
        <ul class="box box--succes">
            <li>08:20 cours avec les 2F</li>
            <li>09:20 cours avec les 3G</li>
            <li>08:20 cours avec les 6G</li>
            <li>08:20 cours avec les 2J</li>
            <li>{!! Html::link('#','Réserver ce local',['class'=>'btn']) !!}</li>
        </ul>
    </li>
    <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        <h2 class="box-header">{!! link_to('places/b12','B 15') !!}</h2>
        <ul class="box">
            <li>08:20 cours avec les 2F</li>
            <li>09:20 cours avec les 3G</li>
            <li>08:20 cours avec les 6G</li>
            <li>08:20 cours avec les 2J</li>
        </ul>
    </li>
</ul>
@stop