@extends('layouts.teacher_layout')
@section('teacher_content')
    <h1 class="big-page-header">Stephan Blisntins</h1>
    <div class="media section">
        <img src="{!! asset('img/default_profile_picture.jpg') !!}" alt="" class="media__img user-image user-image--medium">
        <dl class="media-body">
            <dt>mail :</dt>
            <dd>{!! '1@hotmail.com' !!}</dd>
            <dt>mail2 :</dt>
            <dd>{!! '1@hotmail.com' !!}</dd>
            <dt>Dropbox</dt>
            <dd>unLien.com</dd>
        </dl>
    </div>
    <ul class="layout">
        <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
            <h2 class="bow-header box-header--big">Les cours de Stephan Blisntin d‘aujourd'hui</h2>
            <ul class="box">
                <li>08:20 cours avec les 2F</li>
                <li>08:20 cours avec les 2F</li>
                <li>08:20 cours avec les 2F</li>
                <li>08:20 cours avec les 2F</li>
                <li>08:20 cours avec les 2F</li>
            </ul>
        </li>
        <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
            <h2 class="bow-header box-header--big">Les élèves de Stephan Blisntin</h2>
            <ul class="box">
                <li>Armound Adeline</li>
                <li>Blisntin Stéphan</li>
                <li>Crutzen Marie</li>
                <li>Delayen Estelle</li>
                <li>Gérard Sylvain</li>
            </ul>
        </li>
    </ul>
@stop