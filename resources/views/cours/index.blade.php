@extends('layouts.teacher_layout')
@section('title', 'Mes cours')
@section('teacher_content')
    @include('partials.panel.index_actions')
    @if($cours->count()<1)
        <div class="layout">
            <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                @include('forms.partials.base-info--important',['message'=>'C’est ici que vous retrouverez tous vos cours.'])
            </div>
        </div>
    @else
        @include('forms.filter.indexView.filterCours')
        <ul class="layout box-wrapper">
            @foreach($cours as $cour)
                <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
                    @include('modals.cours.one-cour')
                </li>
            @endforeach
        </ul>
    @endif

    @include('pagination.default', ['paginator' => $cours])
@stop