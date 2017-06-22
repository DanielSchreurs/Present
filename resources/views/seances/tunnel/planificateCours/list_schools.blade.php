@extends('layouts.teacher_layout')
@section('teacher_content')
    <h1 class="big-page-header">Planifier une séance de cours</h1>
    @if(!empty($schools->toArray()))
        {!! Form::open(['action' => ['Www\PresentController@storePlanificateStepOne']]) !!}
            @include('forms.schools.select',['submit'=>'Passer à l’étape 2'])
        {!! Form::close() !!}
    @else
        {!! Form::open(['action' => ['Www\SchoolController@create']]) !!}
            @include('forms.schools.create',['submit'=>'Passer à l’étape 2'])
        {!! Form::close() !!}
    @endif
@stop