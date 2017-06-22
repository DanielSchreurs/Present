@extends('layouts.teacher_layout')
@section('teacher_content')
    <h1 class="big-page-header">Planifier une séance de cours</h1>
    {!! Form::open(['action' => 'Www\PresentController@storePlanificateStepTwo']) !!}
    @include('forms.cours.select',['submit'=>'Passer à l’étape 3'])
    {!! Form::close() !!}
@stop