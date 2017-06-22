@extends('layouts.teacher_layout')
@section('title', 'Accueil')
@section('teacher_content')
    @include('partials.panel.index_actions')
    @if(session()->has('isRegister'))
        <div class="layout">
            <div class="layout__item u-12/12-desk u-12/12-lap u-12/12-palm ">
                <div class="hello-box box">
                    <P class="beta">Bonjour <i>{{ Auth::user()->name }} </i></P>
                    <P class="delta hello-box__text">Afin de prendre des présences vous devez créer
                        : {!!  Html::linkAction('Www\CoursController@create','un cours',[],['title'=>'Créez un cours'])  !!}
                        , {!! Html::linkAction('Www\ClassController@create','une classe',[],['title'=>'Créez une classe']) !!}
                        et {!! Html::linkAction('Www\StudentController@create','des élèves',[],['title'=>'Créez un élève.']) !!}
                    </P>
                    {!!  Html::linkAction('Www\CoursController@create','Commencez par créer un cours !',[],['class'=>'btn btn--small btn--dashbord-create'])!!}
                </div>
            </div>
        </div>
    @endif
    <div class="layout dashbord-layout">
        <div class="box-container layout__item u-4/12-desk u-12/12-lap u-12/12-palm dashbord-layout__item match-height">
            @include('modals.dashbord.cours')
            @include('modals.dashbord.classes')
        </div>
        <div class="box-container layout__item u-4/12-desk u-12/12-lap u-12/12-palm dashbord-layout__item dashbord-layout__item--last match-height">
            @include('modals.dashbord.planning')
        </div>
        <div class="box-container layout__item u-4/12-desk u-12/12-lap u-12/12-palm dashbord-layout__item match-height">
            @include('modals.dashbord.students')
        </div>
    </div>
@stop