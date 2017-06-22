@extends('layouts.teacher_layout')
@section('title', 'Supprimer mon compte.')
@section('teacher_content')
    {!! Form::open(['action'=>['Www\UserController@destroy',Auth::user()->slug],'method'=>'delete']) !!}
    @include('forms.users.delete',['submit'=>'Supprimer mon compte.'])
    {!! Form::close() !!}
@stop