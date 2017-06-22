@extends('layouts.teacher_layout')
@section('title', 'Configuration')
@section('teacher_content')
<div class="layout">
    <div class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        @include('modals.config.time-format')
    </div>
    <div class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
        @include('modals.config.present-status')
    </div>
</div>
@stop