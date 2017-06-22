@extends('layouts.teacher_layout')
@section('title', 'Éditer un élève')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.create_nav')
            {!! Form::model($student,['action' => ['Www\StudentController@update','id'=>$student->slug],'method'=>'patch','enctype'=>'multipart/form-data']) !!}
            @include('forms.students.edit',['submit'=>'Modifier l’élève'])
            {!! Form::close() !!}
        </div>
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm remove-padding-palm">
            @if(Auth::user()->students()->count()>0)
                @include('forms.filter.createAndEditView.filterStudents')
            @endif
            <div class="profile-container layout__item  u-6/12-desk u-12/12-lap u-12/12-palm">
                @include('modals.students.one-student',['isEdit'=>true])
            </div>
            @foreach($students as $student)
                <div class="profile-container layout__item  u-6/12-desk u-12/12-lap u-12/12-palm">
                    @include('modals.students.one-student')
                </div>
            @endforeach
            @include('pagination.default', ['paginator' => $students])
        </div>
    </div>
@stop