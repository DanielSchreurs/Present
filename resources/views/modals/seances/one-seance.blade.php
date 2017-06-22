<article class="time-line__item layout__item u-4/12-desk u-6/12-lap u-12/12-palm ">
    <div class="box time-line">
        <div class="time-line-header">
            <span class="visuallyhidden">Le cours se donnera </span>
            <time class="time-line-header__time"
                  datetime="{!! $occurrence->from_hour->toW3cString() !!}">{!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</time>
            {!!  Form::open(['action' => ['Www\PresentController@destroy', $occurrence->id], 'method' => 'delete','class'=>'inline']) !!}
            <button class="link--alert time-line-header__btn"
                    data-toggle="tooltip"
                    title="Supprimer la séance du : {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}"
                    data-form="delete-seance-form--{!! $occurrence->id !!}">
                <svg class="svg-basic svg--alert">
                    <use xlink:href="#shape-trash"></use>
                </svg>
                <span class="visuallyhidden">Supprimer la séance du {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</span>
            </button>
            {!! Form::close() !!}
        </div>
        <h2 class="box-header epsilon box-header--many-content">
            <a href="{!! URL::action('Www\CoursController@show',['id'=>$occurrence->cour->slug]) !!}"
               class="block no-underline"
               title="Renvoie vers la classe {!! Auth::user()->cours->find($occurrence->cour_id)->name !!}">
                <svg class="svg-basic svg--blue svg--small">
                    <use xlink:href="#shape-cours"></use>
                </svg>
                <span class="">Le cours de </span><i>{!! $occurrence->cour->name !!}</i>
            </a>
            <a href="{!! URL::action('Www\CoursController@show',['id'=>$occurrence->cour->slug]) !!}"
               class="block no-underline color-inerit"
               title="Renvoie vers la classe {!! Auth::user()->cours->find($occurrence->cour_id)->name !!}">
                <svg class="svg-basic svg--blue svg--small">
                    <use xlink:href="#shape-classes"></use>
                </svg>
                <span class="">Avec la classe </span><i>{!! $occurrence->classe->name !!}</i>
            </a>
        </h2>
        @if($occurrence->is_closed==1)
            <?php $iTotalStudent = 0;
            $statusTable = [];
            ?>
            @foreach($occurrence->presents()->get() as $present)
                <?php ++$iTotalStudent; ?>
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
            <p>Sur {{ $iTotalStudent }} élèves il y a,
                <?php $i = 1; ?>
                @foreach($statusTable as $statut)
                    {{$statut['nbr']}}
                    <i>{{$statut['name']}}</i>{{ $i<count($statusTable)?',':'' }}
                    <?php $i++;?>
                @endforeach.</p>
            <div id="piechart-{{$occurrence->id}}"
                 <?php $ii = 0 ?>
                 @foreach($statusTable as $statut)
                 <?php $ii++; ?>
                 data-present_{{$ii}}="{{$ii}},{{$statut['name']}},{{$statut['nbr']}},{{$statut['color']}}"
                 @endforeach
                 class="piechart-seances"></div>
        @endif
        <a href="{!!  URL::action($occurrence->is_closed==1?'Www\PresentController@editAllStudentfromOneOccurrence':'Www\PresentController@getAllStudentfromOneOccurrence',['id'=>$occurrence->id]) !!}"
           class="btn btn--blue-svg btn--small {{ $occurrence->is_closed==1?'btn--lighter':'' }}">
            <svg class="svg-basic svg--white svg--small">
                <use xlink:href="#shape-to-do"></use>
            </svg>
                                        <span>{{ $occurrence->is_closed==1?'Reprendre les présences':'Prendre les présences' }}
                                            <time class="visuallyhidden"
                                                  datetime="{!! $occurrence->from_hour->toW3cString() !!}">du {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</time></span>
        </a>
    </div>
</article>
<div class="form-hidde delete-seance-form--{!! $occurrence->id !!}">
    {!!  Form::open(['action' => ['Www\PresentController@destroy', $occurrence->id], 'method' => 'delete','class'=>'']) !!}
    <a href="#" data-form="delete-seance-form--{!! $occurrence->id !!}" class="hide-modal--top">
        <svg class="hide-modal--top__svg svg--alert">
            <use xlink:href="#shape-close-modal"></use>
        </svg>
        <span class="visuallyhidden">@include('partials.panel.close-message')</span>
    </a>
    <p>Vous êtes sur le point de supprimer la séances
        du&nbsp;: {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</p>
    <div class="text--center btn-container">
        <button class=" btn btn--small btn--red-svg btn--alert"
                title="Supprimer la séance du : {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}">
            <svg class="svg-basic svg--white">
                <use xlink:href="#shape-trash"></use>
            </svg>
            <span>Supprimer la séance du {!! $occurrence->from_hour->formatLocalized('%A %d %B %Y') !!}</span>
        </button>
    </div>
    <a href="#" data-form="delete-seance-form--{!! $occurrence->id !!}">@include('partials.panel.close-message')</a>
    {!! Form::close() !!}
</div>