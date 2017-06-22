@extends('layouts.teacher_layout')
@section('title', 'Mes séances')
@section('teacher_content')
    @include('partials.panel.index_actions')
    <?php $emtyClass = [];
    $before = '';
    $i = 0;
    $ii = 0;
    $even = 0?>
    @if($occurrences->count()>0)
        <ul class="time-line-container">
            @foreach($occurrences as $occurrence)
                @if(!empty($occurrence->classe->students->toArray()))
                    <?php $even++; ?>
                    @if($even%2!==0)
                        <li class="layout layout--center {{ ($even==$occurrences->count())&&($occurrences->count()%2!==0)?'time-line--impair':'' }}">
                            @endif
                            @include('modals.seances.one-seance')
                            @if($even%2==0)
                        </li>
                    @endif
                @else
                    @unless($before==$occurrence->classe->name)
                        <?php array_push($emtyClass, ['link' => Html::linkAction('Www\ClassController@show', $occurrence->classe->name, [$occurrence->classe->slug]), 'slug' => $occurrence->classe->slug, 'name' => $occurrence->classe->name]) ?>
                    @endunless
                    <?php $before = $occurrence->classe->name; ?>
                @endif
                <?php $i++; ?>
            @endforeach
        </ul>
        @if(empty($emtyClass))
            @include('pagination.default', ['paginator' => $occurrences])
        @endif
    @else
        @include('errors.error_seances')
    @endif
    @unless(empty($emtyClass))
        <p class="alert-neutre message-box">
            <buton href="#" class="close close--message-box">
                <svg class="hide-modal--top__svg svg--gray">
                    <use xlink:href="#shape-close-modal"></use>
                </svg>
                <span class="visuallyhidden">@include('partials.panel.close-message')</span>
            </buton>
            Vous avez {!! $i !!} séances. Mais
            @if(count($emtyClass)>1)
                les classes
            @else
                la classe
            @endif
            @foreach($emtyClass as $message)
                {!! $message['link'] !!}
            @endforeach
            @if(count($emtyClass)>1)
                ne contiennent pas
                d’élèves.{!! Html::linkAction('Www\ClassController@index','Voir toutes mes classes') !!}
            @else
                ne contient pas d’élève.
                {!! Html::linkAction('Www\ClassController@getAddStudentToClass','Ajouter des élèves à classe '.$emtyClass[0]['name'],$emtyClass[0]['slug']) !!}
            @endif
        </p>
    @endunless
@stop