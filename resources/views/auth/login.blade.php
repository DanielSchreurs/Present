@extends('layouts.master_layout')
@section('title', 'S’identifier')
@section('content')
    @include('partials.nav.visitors_nav')
    <h1 class="visuallyhidden">Présent, l’outil indispensable pour une gestion efficace des présences.</h1>
    <div class="welcome-container wrapper">
        <h2 class="alpha">S’identifier</h2>
        {!! Form::open( ['action'=>'Auth\AuthController@getLastRegisterFormOrLoginUser','class'=>'welcome-form']) !!}
        @include('forms.users.auth.login')
        {!! Form::close() !!}
        @include('forms.partials.social-link')
        <p class="welkcome-caption">Vous n’êtes pas encore membre ?  {!! Html::linkAction('Auth\AuthController@getRegister','Inscrivez-vous',[],['class'=>'']) !!}</p>
    </div>
    @include('partials.visitors_footer')
@endsection