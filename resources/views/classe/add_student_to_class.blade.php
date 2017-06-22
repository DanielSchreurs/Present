@extends('layouts.teacher_layout')
@section('title', 'Ajouter des élèves à la classe '.$classe->name)
@section('teacher_content')
    @if(empty(Auth::user()->students->toArray()))
        {!! Form::open(['action' => ['Www\ClassController@importStudentToClasse','classe_slug'=>$classe->slug],'class'=>'','enctype'=>'multipart/form-data']) !!}
        @include('forms.class.import_student_to_school',['submit'=>'Ajouter ces élèves à la classe'])
        {!! Form::close() !!}
    @else
        {!! Form::open(['action' => ['Www\ClassController@addStudentToClasse','classe_slug'=>$classe->slug],'class'=>'','enctype'=>'multipart/form-data']) !!}
        @include('forms.class.add_student_to_school',['submit'=>'Modifier ces élèves à la classe'])
        {!! Form::close() !!}
    @endif
@stop