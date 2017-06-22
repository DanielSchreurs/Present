@extends('layouts.teacher_layout')
@section('title', 'Mes classes')
@section('teacher_content')
    @include('partials.panel.index_actions')
    @if($classes->count()<1)
        <div class="layout">
            <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                @include('forms.partials.base-info--important',['message'=>'C’est ici que vous retrouverez toutes vos classes.'])
            </div>
        </div>
    @else
        @include('forms.filter.indexView.filterClasse')
        <ul class="layout">
            @foreach($classes as $classe)
                <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
                    @include('modals.classes.one-classe')
                </li>
            @endforeach
        </ul>
    @endif
    @include('pagination.default', ['paginator' => $classes])
@stop