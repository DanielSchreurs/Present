@extends('layouts.teacher_layout')
@section('title', 'Mes écoles')
@section('teacher_content')
@include('partials.panel.index_actions')
<ul class="layout">
    @foreach($schools as $school )
    <li class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        <div class="box">
        <h2 class="box-header">{!! $school->name !!}</h2>
            {!!  Form::open(array('action' => array('Www\SchoolController@destroy', $school->id), 'method' => 'delete')) !!}
            {!! Form::submit('Supprimer cette école',['class'=>'btn btn--alert btn--small']) !!}
            {!! Form::close() !!}
        </div>
    </li>
    @endforeach
    @include('pagination.default', ['paginator' => $schools])
</ul>
@stop