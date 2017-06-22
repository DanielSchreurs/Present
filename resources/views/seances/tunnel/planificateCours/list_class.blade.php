@extends('layouts.teacher_layout')
@section('teacher_content')
    <h1 class="big-page-header">Planifier une séance de cours</h1>
    {!! Form::open(['action' => 'Www\PresentController@storePlanificateStepThree']) !!}
    @include('forms.class.select',['submit'=>'Passer à l’étape 4'])
    {!! Form::close() !!}
@stop