@extends('layouts.master_layout')
@section('content')
    @include('partials.panel.teacher_actions')
    @include('partials.nav.teacher_nav')
    <div class="main-content">
        @include('partials.message-flash.message')
        <div class="header-for-mobile accessibility--lap visuallyhidden--lap-and-up">@yield('title')</div>
        @yield('teacher_content')
    </div>
@stop