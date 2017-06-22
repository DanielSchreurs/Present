@extends('layouts.teacher_layout')
@section('title', 'Planifier des séances de cours')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
            @include('partials.nav.create_nav')
            @if($isAllowToPlannificate)
                @if(isset($cour))
                    <div class="meta-header">Pour le cours
                        de&nbsp;: {!! Html::linkAction('Www\CoursController@show',$cour->name,['slug'=>$cour->slug],['class'=>'link-spacer']) !!}</div>
                @endif
                {!! Form::open(['action' => 'Www\PresentController@storePlanificateFull']) !!}
                @include('forms.seances.create_full_seance',['submit'=>'Planifier les séances de cours'])
                {!! Form::close() !!}
            @else
                @include('errors.error_seances')
                <div class="box-wrapper">
                    <div class="form-hidde create-classe-form">
                        {!! Form::open(['action' => 'Www\ClassController@store','enctype'=>'multipart/form-data','class'=>'']) !!}
                        <a href="#" data-form="create-classe-form" class="hide-modal--top">
                            <svg class="hide-modal--top__svg svg--alert">
                                <use xlink:href="#shape-close-modal"></use>
                            </svg>
                            <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                        </a>
                        @include('forms.class.create',['submit'=>'Créer la classe'])
                        <a href="#" data-form="create-classe-form">@include('partials.panel.close-message')</a>
                        {!! Form::close() !!}
                    </div>
                    <div class="form-hidde create-cours-form">
                        {!! Form::open(['action' => 'Www\CoursController@store','enctype'=>'multipart/form-data','class'=>'']) !!}
                        <a href="#" data-form="create-cours-form" class="hide-modal--top">
                            <svg class="hide-modal--top__svg svg--alert">
                                <use xlink:href="#shape-close-modal"></use>
                            </svg>
                            <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                        </a>
                        @include('forms.cours.create',['submit'=>'Créer le cours'])
                        <a href="#" data-form="create-cours-form">@include('partials.panel.close-message')</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop