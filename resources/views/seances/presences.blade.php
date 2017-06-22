@extends('layouts.teacher_layout')
@section('title', 'Mes présences')
@section('teacher_content')
    <div class="layout">
        <?php $emtyClass = [];
        $before = '';
        $i = 0;?>
        @if(false)
            <div class="informative-box">
                <p class="informative-box__text">Pas encore de
                    <b>Classes</b>? {!! link_to_action('Www\ClassController@create','Créer une classe',[],['class'=>'']) !!}
                </p>
            </div>
        @else
            @foreach($occurrences as $occurrence)
                @if(!empty($occurrence->classe->students->toArray()))
                    <div class="box-container layout__item u-4/12-desk u-6/12-lap u-12/12-palm">
                        <div class="box">
                            <h2 class="box-header gamma box-header--many-content">
                                <a href="{!! URL::action('Www\CoursController@show',['id'=>$occurrence->cour->slug]) !!}"
                                   class="block no-underline"
                                   title="Renvoie vers la classe {!! Auth::user()->cours->find($occurrence->cour_id)->name !!}">
                                    <svg class="svg-basic svg--blue">
                                        <use xlink:href="#shape-cours"></use>
                                    </svg>
                                    <span class="meta-info">Le cours de </span><i>{!! $occurrence->cour->name !!}</i>
                                </a>
                                <a href="{!! URL::action('Www\CoursController@show',['id'=>$occurrence->cour->slug]) !!}"
                                   class="block no-underline color-inerit"
                                   title="Renvoie vers la classe {!! Auth::user()->cours->find($occurrence->cour_id)->name !!}">
                                    <svg class="svg-basic svg--blue">
                                        <use xlink:href="#shape-classes"></use>
                                    </svg>
                                    <span class="meta-info">Avec la classe </span><i>{!! $occurrence->classe->name !!}</i>
                                </a>
                            </h2>
                            <p><span class="visuallyhidden">Le cours se donnera </span>
                                <time datetime="{!! $occurrence->from_hour->toW3cString() !!}">{!! $occurrence->from_hour->toDayDateTimeString() !!}</time>
                            </p>
                            <a href="{!! URL::action('Www\PresentController@getAllStudentfromOneOccurrence',['id'=>$occurrence->id]) !!}"
                               class="btn btn--blue-svg">
                                <svg class="svg-basic svg--white">
                                    <use xlink:href="#shape-to-do"></use>
                                    <span>Prendre les présence</span>
                                </svg>
                            </a>
                        </div>
                    </div>
                @else
                    @unless($before==$occurrence->classe->name)
                        <?php array_push($emtyClass, Html::linkAction('Www\ClassController@show', $occurrence->classe->name, [$occurrence->classe->slug])) ?>
                    @endunless
                    <?php $before = $occurrence->classe->name; ?>
                @endif
                <?php $i++; ?>
            @endforeach
            @include('pagination.default', ['paginator' => $occurrences])
        @endif
        @unless(empty($emtyClass))
            <p>
                Vous avez {!! $i !!} séances. Mais
                @if(count($emtyClass)>1)
                    les classes
                @else
                    la classe
                @endif
                @foreach($emtyClass as $message)
                    {!! $message !!}
                @endforeach
                @if(count($emtyClass)>1)
                    ne contiennent pas d’élèves.
                @else
                    ne contient pas d’élève.
                @endif
            </p>
        @endunless
    </div>
@stop