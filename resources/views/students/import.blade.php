@extends('layouts.teacher_layout')
@section('title', 'Importer une liste d’élève')
@section('teacher_content')
    <div class="layout">
        <div class="box-container layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.import_nav')
            {!! Form::open(['action' => 'Www\StudentController@importStudentsList','enctype'=>'multipart/form-data']) !!}
            @include('forms.students.import')
            {!! Form::close() !!}
        </div>
        <div class="box-container layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('forms.partials.import-student-message')
        </div>
    </div>
@stop