@extends('layouts.teacher_layout')
@section('title', 'Créer  une classe')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.create_nav')
            {!! Form::open(['action' => 'Www\ClassController@store','enctype'=>'multipart/form-data']) !!}
            @include('forms.class.create',['submit'=>'Créer la classe'])
            {!! Form::close() !!}
        </div>
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm remove-padding-palm">
            @if(Auth::user()->classes->count()>0)
                @include('forms.filter.createAndEditView.filterClasse')
            @endif
            @if($classes->count()>0)
                @foreach($classes as $classe)
                    <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                        @include('modals.classes.one-classe')
                    </div>
                @endforeach
            @else
                @include('forms.partials.import-student-message')
            @endif
            @include('pagination.default', ['paginator' => $classes])
        </div>
    </div>
@stop