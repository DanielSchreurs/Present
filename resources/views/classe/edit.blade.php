@extends('layouts.teacher_layout')
@section('title', 'Modifier une classe')
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                @include('partials.nav.create_nav')
                {!! Form::model($classe,['action' => ['Www\ClassController@update','id'=>$classe->id],'class'=>'','enctype'=>'multipart/form-data','method'=>'patch']) !!}
                @include('forms.class.edit',['submit'=>'Modifier la classe '.$classe->name])
                {!! Form::close() !!}
            </div>
            <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm remove-padding-palm">
                @if(Auth::user()->classes()->count()>0)
                    @include('forms.filter.createAndEditView.filterClasse')
                @endif
                <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                    @include('modals.classes.one-classe',['isEdit'=>true])
                </div>
                @foreach($classes as $classe)
                    <div class="layout__item u-6/12-desk u-12/12-lap u-12/12-palm">
                        @include('modals.classes.one-classe')
                    </div>
                @endforeach
                @include('pagination.default', ['paginator' => $classes])
            </div>
         {{--   {!! Form::open(['action' => ['Www\ClassController@importStudentToClasse','classe_slug'=>$classe->slug],'class'=>'layout__item u-6/12-desk u-12/12-lap u-12/12-palm','enctype'=>'multipart/form-data']) !!}
            @include('forms.class.import_student_to_school',['submit'=>'Ajouter ces élèves à la classe'])
            {!! Form::close() !!}--}}
        </div>
    </div>
@stop