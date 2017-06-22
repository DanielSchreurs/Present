@extends('layouts.teacher_layout')
@section('title', 'Résultats de recherche')
@section('teacher_content')
    <h1>Résultats de recherche pour : <i>{{ $query }}</i></h1>
    @if($students->count()>0)
        <h2><?php echo($students->count() > 1 ? $students->count() : 'Un') ?>
            élève<?php echo($students->count() > 1 ? 's' : '') ?></h2>
        <ul class="layout">
            @foreach($students as $student)
                <li class="profile-container layout__item  u-3/12-desk u-4/12-lap u-12/12-palm">
                    @include('modals.students.one-student')
                </li>
            @endforeach
        </ul>
        {!! $students->appends(Request::except('more_students'))->render() !!}
    @endif
    @if($cours->count()>0)
        <h2><?php echo($cours->count() > 1 ? $cours->count() : 'Un') ?> cours</h2>
        <ul class="layout">
            @foreach($cours as $cour)
                <li class="profile-container layout__item  u-3/12-desk u-4/12-lap u-12/12-palm">
                    @include('modals.cours.one-cour')
                </li>
            @endforeach
        </ul>
    @endif
    @if($classes->count()>0)
        <h2><?php echo($classes->count() > 1 ? $classes->count() : 'Une') ?>
            classe<?php echo($classes->count() > 1 ? 's' : '') ?></h2>
        <ul class="layout">
            @foreach($classes as $classe)
                <li class="profile-container layout__item  u-3/12-desk u-4/12-lap u-12/12-palm">
                    @include('modals.classes.one-classe')
                </li>
            @endforeach
        </ul>
        {!! $classes->appends(Request::except('more_classes'))->render() !!}
    @endif
@stop