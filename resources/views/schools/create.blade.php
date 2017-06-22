@extends('layouts.teacher_layout')
@section('title', 'Créer une école')
@section('teacher_content')
{!! Form::open(array('action' => 'Www\SchoolController@store')) !!}
    @include('forms.schools.create',['submit'=>'Créer l’école'])
{!! Form::close() !!}
@stop