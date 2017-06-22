@extends('layouts.teacher_layout')
@section('title', 'Créer un élève')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.create_nav')
            {!! Form::open(['action' => 'Www\StudentController@store','enctype'=>'multipart/form-data']) !!}
            @include('forms.students.create',['submit'=>'Créer l’élève'])
            {!! Form::close() !!}
        </div>
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm remove-padding-palm">
            @if(Auth::user()->students->count()>0)
                @include('forms.filter.createAndEditView.filterStudents')
            @endif
            @foreach($students as $student)
                <div class="profile-container layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                    @include('modals.students.one-student')
                </div>
            @endforeach
            @include('pagination.default', ['paginator' => $students])
        </div>
    </div>
@stop