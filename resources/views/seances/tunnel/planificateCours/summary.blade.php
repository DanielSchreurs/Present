@extends('layouts.teacher_layout')
@section('teacher_content')
    <h1 class="big-page-header">Récapitulons</h1>
    {!! Form::open(['action' => 'Www\PresentController@storePlanification']) !!}
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            {!! Form::label('from','De quand ',['class'=>'floating-placeholder__label']) !!}
            {!! Form::text('from',old('from'),['id'=>'from','class'=>'floating-placeholder__input--huge floating-placeholder__input']) !!}
        </div>
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            {!! Form::label('to','à ',['class'=>'floating-placeholder__label']) !!}
            {!! Form::text('to',old('to'),['id'=>'to','class'=>'floating-placeholder__input--huge floating-placeholder__input']) !!}
        </div>
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            {!! Form::submit('Planifier la séance',['class'=>'']) !!}
        </div>
    {!! Form::close() !!}
@stop