@extends('layouts.teacher_layout')
@section('title', 'Mon compte')
@section('teacher_content')
{!! Form::model($user,['action' => ['Www\UserController@update',$user->id],'method'=>'patch','enctype'=>'multipart/form-data','runat'=>'server']) !!}
        @include('forms.users.edit',['submit'=>'Mettre à jour vos informations personnelles'])
{!! Form::close() !!}
{!! Form::model($user,['action' => ['Www\UserController@updatePassword'],'method'=>'patch']) !!}
        @include('forms.users.update-password',['submit'=>'Changer votre mot de passe'])
{!! Form::close() !!}

<div class="test"></div>

{!! Html::linkAction('Www\UserController@getdestroy','Supprimer mon compte',[],['title'=>'Supprimer mon compte','data-form'=>'delete-account-form']) !!}
<li class="form-hidde delete-account-form box-wrapper">
        {!! Form::open(['action'=>['Www\UserController@destroy',Auth::user()->slug],'method'=>'delete']) !!}
        <a href="#" data-form="delete-account-form" class="hide-modal--top">
                <svg class="hide-modal--top__svg svg--alert">
                        <use xlink:href="#shape-close-modal"></use>
                </svg>
                <span class="visuallyhidden">@include('partials.panel.close-message')</span>
        </a>
        @include('forms.users.delete',['submit'=>'Supprimer mon compte.'])
        <a href="#" data-form="delete-account-form">@include('partials.panel.close-message')</a>
        {!! Form::close() !!}
</li>
@stop