<fieldset class="form-group-container">
    <legend class="form-group-container__legend">À qui s’applique cette séance&nbsp;?</legend>
    @unless(empty($cours->toArray()))
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            <label for="cour_id" class="floating-placeholder__label">Choisissez le cours que vous donnez @include('forms.partials.required')</label>
            {!! Form::select('cour_id',$cours,isset($cour)?$cour->id:null,['class'=>'mask',"data-type"=>"select",'id'=>'cour_id']) !!}
            @include('errors.error_field',['field'=>'cour_id','name'=>'choisissez le cours que vous donnez'])
            <a href="{{ URL::action('Www\CoursController@create') }}">Ou créez un cours</a>
        </div>
    @endunless
    @unless(empty($classes->toArray()))
        @include('forms.partials.base-info--important',
        ['message'=>'Attention : si vous planifiez des séances avec des classes qui  n’ont pas encore d’élèves,
        vous ne pourrez prendre les présences qu’après avoir ajouté des élèves à cette classe.'])
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            <label for="classe_id" class="floating-placeholder__label">Choisissez la classe à laquelle vous donnez le cours @include('forms.partials.required')</label>
            <select name="classe_id" id="classe_id" class="mask" data-type="select">
                @foreach($classes as $classe)
                    <?php $selectInfoval = empty($classe->students->toArray()) ? 'Ne contient pas d’élève' : 'Contient des élèves' ?>
                    <option value="{!! $classe->id !!}"
                            data-info-select="{!! $selectInfoval !!}">{!! $classe->name !!}</option>
                @endforeach
            </select>
            @include('errors.error_field',['field'=>'classe_id','name'=>'choisissez la classe à laquelle vous donnez le cours'])
            <a href="{{ URL::action('Www\ClassController@create') }}">Ou créez une classe</a>
        </div>
    @endunless
    @unless(empty($schools->toArray()))
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            <label for="school_id" class="floating-placeholder__label">Choisissez une école @include('forms.partials.required')</label>
            {!! Form::select('school_id',$schools,null,['class'=>'mask',"data-type"=>"select",'id'=>'school_id']) !!}
            @include('errors.error_field',['field'=>'school_id','name'=>'choisissez une école'])
        </div>
    @endunless
</fieldset>
<fieldset class="form-group-container">
    <legend class="form-group-container__legend">Quand s’applique cette séance&nbsp;?</legend>
    @include('forms.partials.base-info--important',['message'=>'Définissez la période pendant laquelle vous donnez votre cours.'])
    <?php $today = \Carbon\Carbon::now();
    $user = Auth::user();
    $defaultschoolyearbegin=\Carbon\Carbon::createFromFormat('Y-m-d',$user->defaultSchoolYearBegin)->isPast()?Carbon\Carbon::now()->toDateString():$user->defaultSchoolYearBegin;
    $defaultschoolyearend=\Carbon\Carbon::createFromFormat('Y-m-d',$user->defaultSchoolYearEnd)->isPast()?Carbon\Carbon::now()->addWeek()->toDateString():$user->defaultSchoolYearEnd
    ?>
    <div id="planificateSeanceMeta" class="visuallyhidden"
         data-defaultschoolyearbegin="{{$defaultschoolyearbegin}}"
         data-defaultschoolyearend="{{$defaultschoolyearend}}"
         data-defaultcoursduration="{{$user->defaultCoursDuration}}"
         data-defaultdaybegin="{{$user->defaultDayBegin}}"
         data-defaultdayend="{{$user->defaultDayEnd}}"
        ></div>
    <div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label for="from" class="floating-placeholder__label">Début de période @include('forms.partials.required')</label>
        {!! Form::input('text','from',is_null(old('from'))?$defaultschoolyearbegin:old('from'),['class'=>'floating-placeholder__input--huge floating-placeholder__input dateType-1','placeholder'=>'ex: '.$today->format('Y-m-d'),'id'=>'from']) !!}
        <span class="form-group__svg">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-calendar"></use>
                 </svg>
            </span>
    @include('errors.error_field',['field'=>'from','name'=>'Début de période'])
    </div>
    <div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label for="to" class="floating-placeholder__label">Fin de période @include('forms.partials.required')</label>
        {!! Form::input('text','to',is_null(old('to'))?$defaultschoolyearend:old('to'),['class'=>'floating-placeholder__input--huge floating-placeholder__input dateType-1','placeholder'=>'ex: '.$today->format('Y-m-d'),'id'=>'to']) !!}
        <span class="form-group__svg">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-calendar"></use>
                 </svg>
            </span>
        @include('errors.error_field',['field'=>'to','name'=>'Fin de période'])
    </div>
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label for="day" class="floating-placeholder__label">Choisissez un jour @include('forms.partials.required')</label>
        {!! Form::select('day',['0'=>'lundi','1'=>'mardi','2'=>'mercredi','3'=>'jeudi','4'=>'vendredi','5'=>'samedi','6'=>'dimanche'],old('day'),['class'=>'mask',"data-type"=>"select",'id'=>"day"]) !!}
        @include('errors.error_field',['field'=>'day','name'=>'choisissez un jour'])
    </div>
    @include('forms.partials.base-info--important',['message'=>'Définissez le moment de journée auquel vous donnez votre cours.'])
    <div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label for="from_hour" class="floating-placeholder__label">Début du cours @include('forms.partials.required')</label>
        {!! Form::input('text','from_hour',is_null(old('from_hour'))?$user->defaultDayBegin:old('from_hour'),['class'=>'floating-placeholder__input--huge floating-placeholder__input hourType-1','placeholder'=>'ex: '.$today->format('Y-m-d'),'id'=>'from_hour']) !!}
        <span class="form-group__svg">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-clock"></use>
                 </svg>
            </span>
        @include('errors.error_field',['field'=>'from_hour','name'=>'début du cours'])
    </div>
    <div class="input-group date floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge" >
        <label for="to_hour" class="floating-placeholder__label">Fin du cours @include('forms.partials.required')</label>
        {!! Form::input('text','to_hour',is_null(old('to_hour'))?$user->defaultDayEnd:old('to_hour'),['class'=>'floating-placeholder__input--huge floating-placeholder__input hourType-1','placeholder'=>'ex: '.$today->format('Y-m-d'),'id'=>'to_hour']) !!}
        <span class="form-group__svg">
                 <svg class="svg-basic svg--blue">
                     <use xlink:href="#shape-clock"></use>
                 </svg>
            </span>
        @include('errors.error_field',['field'=>'to_hour','name'=>'fin du cours'])
    </div>
</fieldset>
@include('forms.partials.required--message')
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>