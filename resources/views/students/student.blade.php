@extends('layouts.teacher_layout')
@section('title', $student->fullname)
@section('teacher_content')
    <div class="layout">
        <div class="layout__item u-12/12-desk u-12/12-lap u-12/12-palm">
            {!! Form::model($student,['action' => ['Www\StudentController@update','slug'=>$student->slug,'isOnProfil'=>true],'method'=>'patch','enctype'=>'multipart/form-data']) !!}
            @include('forms.students.edit',['submit'=>'Modifier l’élève'])
            {!! Form::close() !!}
            <dl class="">
                @if($student->classes->count()>0)
                    <dt>Appartient à la classe :</dt>
                    <dd>
                        @foreach($student->classes as $class)
                            {!! Html::linkAction('Www\ClassController@show',$class->name,['classe_slug'=>$class->slug]) !!}
                        @endforeach</dd>
                @endif
                @if($student->classes->count()>0)
                    <dt>Ses cours :</dt>
                    <dd>
                        @foreach($student->classes as $classe)
                            @foreach($classe->cours as $cour)
                                {!! Html::linkAction('Www\CoursController@show',$cour->name,['cour_slug'=>$cour->slug]) !!}
                            @endforeach
                        @endforeach</dd>
                @endif
            </dl>

            @if($student->presences->count()>1)
                <div class="nav-tab-container">
                    <nav class="nav-tabs">
                        <h2 class="visuallyhidden">Navigation des différents graphiques</h2>
                        <a class="prevent-default nav-tabs__item nav-tabs__item--active" href="#tabs-1">Répartition des
                            statuts de
                            présences.</a><!--
            --><a class="prevent-default nav-tabs__item" href="#tabs-2">Répartition des cours par séances.</a><!--
            --><a class="prevent-default nav-tabs__item" href="#tabs-3">Répartition des présences en fonction des
                            cours.</a>
                    </nav>
                    <div class="tab-container">
                        {{--Répartition des statuts de présences.--}}
                        <?php $iTotalSeances = 0;
                        $statusTable = [];
                        ?>
                        @foreach($student->presences as $present)
                            <?php ++$iTotalSeances; ?>
                            <?php
                            if (array_key_exists($present->statut->id, $statusTable)) {
                                $statusTable[ $present->statut->id ]['nbr'] += 1;
                            } else {
                                $statusTable[ $present->statut->id ]['nbr'] = 1;
                                $statusTable[ $present->statut->id ]['color'] = $present->statut->color;
                                $statusTable[ $present->statut->id ]['name'] = $present->statut->name;
                            }
                            ?>
                        @endforeach
                        <div class="one-tab-container one-tab-container--active" id="tabs-1">
                            <div id="piechart-{{$student->id}}"
                                 <?php $ii = 0 ?>
                                 @foreach($statusTable as $statut)
                                 <?php $ii++; ?>
                                 data-present_{{$ii}}="{{$ii}},{{$statut['name']}},{{$statut['nbr']}},{{$statut['color']}}"
                                 @endforeach
                                 class="piechart-seances graphique-container">
                            </div>
                        </div>

                        {{--Répartition des cours par séances.--}}
                        <?php $coursTable = []; ?>
                        @foreach($student->presences as $present)
                            <?php
                            if (array_key_exists($present->occurrence->cour->id, $coursTable)) {
                                $coursTable[ $present->occurrence->cour->id ]['nbr'] += 1;
                            } else {
                                $coursTable[ $present->occurrence->cour->id ]['nbr'] = 1;
                                $coursTable[ $present->occurrence->cour->id ]['name'] = $present->occurrence->cour->name;
                            }
                            ?>
                        @endforeach
                        <div class="one-tab-container" id="tabs-2">
                            <div id="bar-chart-{{$student->id}}"
                                 <?php $ii = 0 ?>
                                 @foreach($coursTable as $cour)
                                 <?php $ii++; ?>
                                 data-present_{{$ii}}="{{$ii}},{{$cour['name']}},{{$cour['nbr']}}"
                                 @endforeach
                                 class="bar-chart-student graphique-container">
                            </div>
                        </div>
                        {{--Répartion des statut par cours--}}
                        <?php $coursAndSatutTabble = []; ?>
                        @foreach($student->presences as $present)
                            <?php
                            if (array_key_exists($present->occurrence->cour->id, $coursAndSatutTabble)) {
                                $coursAndSatutTabble[ $present->occurrence->cour->id ]['TotalPresent'] += 1;
                                if (array_key_exists($present->statut->id, $coursAndSatutTabble[ $present->occurrence->cour->id ]['statuts'])) {
                                    // incrémente les statuts existants
                                    $coursAndSatutTabble[ $present->occurrence->cour->id ]['statuts'][ $present->statut->id ]['nbr'] += 1;
                                } else {
                                    $coursAndSatutTabble[ $present->occurrence->cour->id ]['statuts'][ $present->statut->id ] = ['name' => $present->statut->name, 'colors' => $present->statut->color, 'nbr' => 1];
                                    // Crée les deux autres statuts
                                }
                            } else {
                                $coursAndSatutTabble[ $present->occurrence->cour->id ]['TotalPresent'] = 1;
                                $coursAndSatutTabble[ $present->occurrence->cour->id ]['name'] = $present->occurrence->cour->name;
                                $coursAndSatutTabble[ $present->occurrence->cour->id ]['statuts'][ $present->statut->id ] = ['name' => $present->statut->name, 'colors' => $present->statut->color, 'nbr' => 1];
                            }
                            ?>
                        @endforeach
                        <?php
                        $statutI = 0;
                        foreach (\Auth::user()->statuts as $statut) {
                            ++$statutI;
                            $coursAndSatutTabble['meta']['statuts'][] = ['id' => $statut->id, 'name' => $statut->name, 'color' => $statut->color];
                        }
                        $coursAndSatutTabble['meta']['max-statut'] = $statutI;
                        ?>
                        <div class="one-tab-container" id="tabs-3">
                            <div id="bar-chart-2-{{$student->id}}"
                                 data-graph="{{ htmlspecialchars(json_encode($coursAndSatutTabble), ENT_QUOTES, 'UTF-8') }}"
                                 class="bar-chart-statuts-cours graphique-container"></div>
                        </div>
                    </div>
                    @else
                        @if(\Auth::user()->hasOccurrence)
                            {!!  Html::linkAction('Www\PresentController@getPlanificateFull','Planifier une séance de cours!',[],['class'=>'btn']) !!}
                        @endif
                        @include('forms.partials.base-info--important',['message'=>'Cet élève n’a pas encore participé à un
                            cours.'])
                </div>
            @endif
            <div class="layout note-conatainer">
                @foreach(config('app.noteTypes') as $type=>$name)
                    <div class="layout__item  u-4/12-desk u-12/12-lap u-12/12-palm">
                        <h2 class="gamma header_note">Notes {{ $name }}</h2>
                        <ul class="note-list">
                            @if($notes->where('type',$type)->count()<1)
                                <li>Vous n’avez pas encore de notes ici.</li>
                            @else
                                @foreach($notes as $note)
                                    @if($note->type==$type)
                                        <li>
                                            {!!  Form::open(['action' => ['Www\StudentController@destroyNote', $student->id], 'method' => 'delete','class'=>'inline']) !!}
                                            <button class="link--alert"
                                                    data-toggle="tooltip"
                                                    title="Supprimer l’élève : {!! $note->created_at->formatLocalized('%D') !!}"
                                                    data-form="delete-note-form--{!! $note->id !!}">
                                                <svg class="svg-basic svg--alert">
                                                    <use xlink:href="#shape-trash"></use>
                                                </svg>
                                                <span class="visuallyhidden">Supprimer le cours : {!! $note->created_at->formatLocalized('%D') !!}</span>
                                            </button>
                                            {!! Form::close() !!}
                                            <a href="{!! URL::action('Www\StudentController@edit',[$note->id]) !!}"
                                               data-toggle="tooltip"
                                               title="Modifier la note : {!! $note->created_at->formatLocalized('%D') !!}"
                                               data-form="edit-note-form--{!! $note->id !!}" class="svg-container">
                                                <svg class="svg-basic svg--blue">
                                                    <use xlink:href="#shape-edit"></use>
                                                </svg>
                                                <span class="visuallyhidden">Modifier la note{!! $note->created_at->formatLocalized('%D') !!}</span>
                                            </a>

                                            <time class="note-list__date"
                                                  datetime="{!! $note->created_at->toW3cString() !!}">{!! $note->created_at->formatLocalized('%D') !!}</time>
                                            <p class="note-list__text">{!! $note->note !!}</p>

                                            <div class="form-hidde edit-note-form--{!! $note->id !!} box-wrapper">
                                                {!! Form::model($note,['action' => ['Www\StudentController@updatetNote','id'=>$note->id],'method'=>'patch']) !!}
                                                <a href="#" data-form="edit-note-form--{!! $note->id !!}"
                                                   class="hide-modal--top">
                                                    <svg class="hide-modal--top__svg svg--alert">
                                                        <use xlink:href="#shape-close-modal"></use>
                                                    </svg>
                                                    <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                                                </a>
                                                @include('forms.students.edit_notes',['submit'=>'Modifier la note'])
                                                <a href="#" data-form="edit-note-form--{!! $note->id !!}">fermer la
                                                    fenêtre</a>
                                                {!! Form::close() !!}
                                            </div>
                                            <div class="form-hidde delete-note-form--{!! $note->id !!}">
                                                {!!  Form::open(['action' => ['Www\StudentController@destroyNote', $note->id], 'method' => 'delete','class'=>'']) !!}
                                                <a href="#" data-form="delete-note-form--{!! $note->id !!}"
                                                   class="hide-modal--top">
                                                    <svg class="hide-modal--top__svg svg--alert">
                                                        <use xlink:href="#shape-close-modal"></use>
                                                    </svg>
                                                    <span class="visuallyhidden">@include('partials.panel.close-message')</span>
                                                </a>
                                                <p>Vous êtes sur le point de supprimer la note du
                                                    : {!! $note->created_at->formatLocalized('%D') !!} :
                                                    {{ $note->note }}
                                                </p>
                                                <div class="text--center btn-container">
                                                    <button class=" btn btn--small btn--red-svg btn--alert"
                                                            title="Supprimer la note du {!! $note->created_at->formatLocalized('%D')!!}">
                                                        <svg class="svg-basic svg--white">
                                                            <use xlink:href="#shape-trash"></use>
                                                        </svg>
                                                        <span>Supprimer la note du {!! $note->created_at->formatLocalized('%D')!!}</span>
                                                    </button>
                                                </div>
                                                <a href="#" data-form="delete-note-form--{!! $note->id !!}">fermer la
                                                    fenêtre</a>
                                                {!! Form::close() !!}
                                            </div>

                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="section">
            {!! Form::open(['action'=>'Www\StudentController@storeNote']) !!}
            {!! Form::hidden('student_id',$student->id) !!}
            @include('forms.students.add_notes')
            {!! Form::close() !!}
        </div>
        <div>
            {!!  Form::open(['action' => ['Www\StudentController@destroy', $student->id], 'method' => 'delete','class'=>'inline']) !!}
            <button class="btn btn--alert btn--red-svg"
                    data-toggle="tooltip" title="Supprimer l’élève : : {!! $student->fullname !!}"
                    data-form="delete-student-form--{!! $student->id !!}">
                <svg class="svg-basic svg--white">
                    <use xlink:href="#shape-trash"></use>
                </svg>
                <span>Supprimer l’élève : {!! $student->fullname !!}</span>
            </button>
            {!! Form::close() !!}
        </div>

        <div class="form-hidde delete-student-form--{!! $student->id !!}">
            {!!  Form::open(['action' => ['Www\StudentController@destroy', $student->id], 'method' => 'delete','class'=>'']) !!}
            <a href="#" data-form="delete-student-form--{!! $student->id !!}" class="hide-modal--top">
                <svg class="hide-modal--top__svg svg--alert">
                    <use xlink:href="#shape-close-modal"></use>
                </svg>
                <span class="visuallyhidden">@include('partials.panel.close-message')</span>
            </a>
            <p>Vous êtes sur le point de supprimer l’élève : {!! $student->fullname !!}</p>
            <div class="text--center btn-container">
                <button class=" btn btn--small btn--red-svg btn--alert"
                        title="Supprimer l’élève : {!! $student->fullname !!}">
                    <svg class="svg-basic svg--white">
                        <use xlink:href="#shape-trash"></use>
                    </svg>
                    <span>Supprimer l’élève : {!! $student->fullname !!}</span>
                </button>
            </div>
            <a href="#" data-form="delete-student-form--{!! $student->id !!}">@include('partials.panel.close-message')</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop