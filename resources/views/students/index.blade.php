@extends('layouts.teacher_layout')
@section('title', 'Mes élèves')
@section('teacher_content')
    @include('partials.panel.index_actions')
    @if($students->count()<1)
        <div class="layout">
            <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                @include('forms.partials.base-info--important',['message'=>'C’est ici que vous retrouverez tous vos élèves.'])
            </div>
        </div>
    @else
        @include('forms.filter.indexView.filterStudents')
        <ul class="layout">
            @foreach($students as $student)
                <li class="profile-container layout__item  u-4/12-desk u-6/12-lap u-12/12-palm">
                    @include('modals.students.one-student')
                </li>
            @endforeach
        </ul>
    @endif
    @include('pagination.default', ['paginator' => $students])
@stop