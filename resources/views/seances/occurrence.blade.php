@extends('layouts.teacher_layout')
@section('title', $cour->name)
@section('teacher_content')
    {!! Form::open(['action'=>['Www\PresentController@storeClassePresent',$occurrence->id]]) !!}
    <div class="header-action-box">
        {!! Form::submit('Finir les présences',['class'=>'btn block btn--spacer']) !!}
        <p>Les présences du&nbsp;:
            <time datetime="{!! $occurrence->from_hour->toW3cString() !!}">{!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</time>
            avec l{{ $occurrence->classe()->count()>1?'es':'a' }} classe{{ $occurrence->classe()->count()>1?'s':'' }}
            &nbsp;:
            @foreach($occurrence->classe()->get() as $classe)
                {{ $classe->name }}
            @endforeach
        </p>
    </div>
    <div class="layout">
        <?php $i = 0; ?>
        @foreach($students as $student)
            <?php ++$i; ?>
            <div class="profile-container layout__item  u-3/12-desk u-4/12-lap u-12/12-palm is_present">
                <select name="{{ $student->id }}" id="student_id_{{ $student->id }}"
                        class="mask" data-type="select">
                    @foreach($statuts as $statut)
                        <?php $selectInfo = !!$statut->is_default ? 'Default' : 'undefined' ?>
                        <option value="{!! $statut->id !!}"
                                data-info-select="{!! $selectInfo !!}"
                                data-info-color="{{ $statut->color }}"
                                data-info-name="{{ $statut->name }}"
                                data-info-selector=".statut-{{ $i }}">{!! $statut->name !!}</option>
                    @endforeach
                </select>
                <?php $url = '';
                if (!empty($student->avatar)) {
                    if (filter_var($student->avatar, FILTER_VALIDATE_URL) !== false) {
                        $url = $student->avatar;
                    } else {
                        $url = '/image/students/50/50/' . $student->avatar;
                    }
                } else {
                    $url = 'https://api.adorable.io/avatars/50/'.$student->email.'.png';
                }
                ?>
                <div class="profile-container__box box match-height">
                    <a href="{!! URL::action('Www\StudentController@show',['slug'=>$student->slug]) !!}"
                       title="Renvoie vers la fiche de l’élèves" class="media statut-{{ $i }}">
                        <img class="profile-picture media__img user-image profile-picture--present"
                             src="{!! $url !!}" alt="Image de l’élève"
                             style="border-color: {{$defaultStatut->color}}" width="50px" height="50px">
                        <div class="media__body">
                            <span class="profile-name">{!! $student->first_name !!}</span>
                            <span class="profile-name">{!! $student->last_name !!}</span>
                        </div>
                    </a>
                    <div class="statut-{{ $i }}">
                        <span class="color-box" style="background-color:{{ $defaultStatut->color }}"></span>
                        <span>{{ $defaultStatut->name }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="header-action-box">
        {!! Form::submit('Finir les présences',['class'=>'btn block btn--spacer']) !!}
        <p>Les présences du&nbsp;:
            <time datetime="{!! $occurrence->from_hour->toW3cString() !!}">{!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</time>
            avec l{{ $occurrence->classe()->count()>1?'es':'a' }} classe{{ $occurrence->classe()->count()>1?'s':'' }}
            &nbsp;:
            @foreach($occurrence->classe()->get() as $classe)
                {{ $classe->name }}
            @endforeach
        </p>
    </div>
    {!! Form::close() !!}
@stop