@extends('layouts.teacher_layout')
@section('title', 'Enregistrer un cours')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.create_nav')
            {!! Form::open(['action' => 'Www\CoursController@store']) !!}
            @include('forms.cours.create',['submit'=>'Créer un cours'])
            {!! Form::close() !!}
        </div>
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm remove-padding-palm">
            @if(Auth::user()->cours->count()>0)
                @include('forms.filter.createAndEditView.filterCours')
            @endif
            @foreach($cours as $cour)
                <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                    @include('modals.cours.one-cour')
                </div>
            @endforeach
            @include('pagination.default', ['paginator' => $cours])
        </div>
    </div>
@stop