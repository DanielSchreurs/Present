<?php $today = \Carbon\Carbon::now();
$user = Auth::user();
$defaultschoolyearbegin=\Carbon\Carbon::createFromFormat('Y-m-d',$user->defaultSchoolYearBegin)->isPast()?Carbon\Carbon::now()->toDateString():$user->defaultSchoolYearBegin;
$defaultschoolyearend=\Carbon\Carbon::createFromFormat('Y-m-d',$user->defaultSchoolYearEnd)->isPast()?Carbon\Carbon::now()->toDateString():$user->defaultSchoolYearEnd
?>
<div id="planificateSeanceMeta" class="visuallyhidden"
     data-defaultschoolyearbegin="{{$defaultschoolyearbegin}}"
     data-defaultschoolyearend="{{$defaultschoolyearend}}"
     data-defaultcoursduration="{{$user->defaultCoursDuration}}"
     data-defaultdaybegin="{{$user->defaultDayBegin}}"
     data-defaultdayend="{{$user->defaultDayEnd}}"
></div>
<div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="defaultSchoolYearBegin" class="floating-placeholder__label">Début de période @include('forms.partials.required')</label>
    {!! Form::input('text','defaultSchoolYearBegin',is_null(old('defaultSchoolYearBegin'))?$defaultschoolyearbegin:old('defaultSchoolYearBegin'),['class'=>'floating-placeholder__input--huge floating-placeholder__input dateType-1','placeholder'=>'ex: '.$today->format('d-m-Y'),'id'=>'defaultSchoolYearBegin']) !!}
    <span class="form-group__svg form-group__svg--white">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-calendar"></use>
                 </svg>
            </span>
    @include('errors.error_field',['field'=>'defaultSchoolYearBegin','name'=>'début de période'])
</div>
<div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="defaultSchoolYearEnd" class="floating-placeholder__label">Fin de l’année scolaire @include('forms.partials.required')</label>
    {!! Form::input('text','defaultSchoolYearEnd',is_null(old('defaultSchoolYearEnd'))?$defaultschoolyearend:old('defaultSchoolYearEnd'),['class'=>'floating-placeholder__input--huge floating-placeholder__input dateType-1','placeholder'=>'ex: '.$today->format('d-m-Y'),'id'=>'defaultSchoolYearEnd']) !!}
    <span class="form-group__svg form-group__svg--white">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-calendar"></use>
                 </svg>
            </span>
    @include('errors.error_field',['field'=>'defaultSchoolYearEnd','name'=>'fin de l’année scolaire'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="defaultCoursDuration" class="floating-placeholder__label">Durée d’un cours par défaut @include('forms.partials.required')</label>
    {!! Form::input('text','defaultCoursDuration',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : 50','id'=>'defaultCoursDuration']) !!}
    @include('forms.partials.base-info',['message'=>'Indiquez la durée par défaut d’un cours en minutes. Le format attendu est : hh:mm'])
    @include('errors.error_field',['field'=>'defaultCoursDuration','name'=>'durée d’un cours par défaut'])
</div>

<div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="defaultDayBegin" class="floating-placeholder__label">Début du cours @include('forms.partials.required')</label>
    {!! Form::input('text','defaultDayBegin',is_null(old('defaultDayBegin'))?$user->defaultDayBegin:old('defaultDayBegin'),['class'=>'floating-placeholder__input--huge floating-placeholder__input hourType-1','placeholder'=>'ex: 08:20','id'=>'defaultDayBegin']) !!}
    <span class="form-group__svg form-group__svg--white">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-clock"></use>
                 </svg>
            </span>
    @include('errors.error_field',['field'=>'defaultDayBegin','name'=>'début du cours'])
</div>
<div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge" >
    <label for="defaultDayEnd" class="floating-placeholder__label">Fin du cours @include('forms.partials.required')</label>
    {!! Form::input('text','defaultDayEnd',is_null(old('defaultDayEnd'))?$user->defaultDayEnd:old('defaultDayEnd'),['class'=>'floating-placeholder__input--huge floating-placeholder__input hourType-1','placeholder'=>'ex: 16:20','id'=>'defaultDayEnd']) !!}
    <span class="form-group__svg form-group__svg--white">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-clock"></use>
                 </svg>
            </span>
    @include('errors.error_field',['field'=>'defaultDayEnd','name'=>'fin du cours'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn btn--small']) !!}
</div>