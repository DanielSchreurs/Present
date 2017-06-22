@extends('layouts.teacher_layout')
@section('title', 'Enregistrer  un local')
@section('teacher_content')
    {!! Form::open(array('action' => 'Www\RoomController@store')) !!}
     @include('forms.rooms.create')
    {!! Form::close() !!}
@stop