@extends('layouts.master_layout')
@section('title', 'Réinitialisez votre mot de passe')
@section('content')
	@include('partials.nav.visitors_nav')
	<h1 class="visuallyhidden">Présent, l’outil indispensable pour une gestion efficace des présences.</h1>
	<div class="welcome-container">
		{!! Form::open(['action'=>'Auth\PasswordController@postReset','class'=>'welcome-form']) !!}
		<h2>Redéfinir votre mot de passe</h2>
		    @include('forms.users.auth.reset',['submit'=>'Réinitialisez le mot de passe'])
		{!! Form::close() !!}
	</div>
@endsection
