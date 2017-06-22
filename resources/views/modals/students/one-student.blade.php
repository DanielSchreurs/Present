<article
        class="profile-container__box box {{ $student->isUpdatedNow?'box--animate':'' }} match-height {{ isset($isEdit)?'box--edit':'' }}
        @if(isset($isCreate))
        {{ $meta['create_view_student_list_block']==1?'':'profile-container__box--list' }}
        @endif
        @if(isset($isIndex))
        {{ $meta['index_view_student_list_block']==1?'':'profile-container__box--list' }}
        @endif
                ">

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
    <a href="{!! URL::action('Www\StudentController@show',['slug'=>$student->slug]) !!}"
       title="Renvoie vers la fiche de l’élèves {{ $student->fullname }}" class="media">
        <img class="profile-picture media__img user-image"
             src="{!! $url !!}"
             alt="Image de l’élève {{ $student->fullname }}" width="50px" height="50px">
        <h2 class="media__body">
            <span class="profile-name">{!! $student->first_name !!}</span>
            <span class="profile-name">{!! $student->last_name !!}</span>
        </h2>
    </a>
    <div>
        @unless(isset($isEdit))
            {!!  Form::open(['action' => ['Www\StudentController@destroy', $student->id], 'method' => 'delete','class'=>'inline']) !!}
            <button class="link--alert"
                    data-toggle="tooltip" title="Supprimer l’élève : {!! $student->fullname !!}"
                    data-form="delete-class-form--{!! $student->slug !!}">
                <svg class="svg-basic svg--alert">
                    <use xlink:href="#shape-trash"></use>
                </svg>
                <span class="visuallyhidden">Supprimer le cours : {!! $student->fullname !!}</span>
            </button>
            {!! Form::close() !!}
        @endunless
        <a href="{!! URL::action('Www\StudentController@edit',['id'=>$student->id]) !!}" class="svg-container"
           data-toggle="tooltip" title="Modifier l’élève : {!! $student->fullname !!}">
            <svg class="svg-basic svg--blue">
                <use xlink:href="#shape-edit"></use>
            </svg>
            <span class="visuallyhidden">Modifier l’élève : {!! $student->fullname !!}</span>
        </a>
    </div>
    <dl class="
    @if(isset($isCreate))
    {{ $meta['create_view_student_list_block']==1?'':'visuallyhidden' }}
    @endif
    @if(isset($isIndex))
    {{ $meta['index_view_student_list_block']==1?'':'visuallyhidden' }}
    @endif
            ">
        @unless(isset($isClasse))
            @if($student->classes()->count()>0)
                <dt>Appartient à la classe :</dt>
                <dd>
                    @foreach($student->classes as $class)
                        {!! Html::linkAction('Www\ClassController@show',$class->name,['classe_slug'=>$class->slug]) !!}
                    @endforeach</dd>
            @else
                <p>L’élève n’appartient pas encore à une classe.</p>
            @endif
        @endunless
        @if($student->classes()->count()>0)
            <dt>Ses cours :</dt>
            <dd>
                @foreach($student->classes as $classe)
                    @foreach($classe->cours as $cour)
                        {!! Html::linkAction('Www\CoursController@show',$cour->name,['cour_slug'=>$cour->slug]) !!}
                    @endforeach
                @endforeach</dd>
        @else
            <p>L’élève ne suit pas encore de cours.</p>
        @endif
    </dl>
    @unless(isset($isEdit))
        <div class="form-hidde delete-class-form--{!! $student->slug !!}">
            {!!  Form::open(['action' => ['Www\StudentController@destroy', $student->id], 'method' => 'delete','class'=>'']) !!}
            {!! Form::hidden('redirect_back',1) !!}
            <a href="#" data-form="delete-class-form--{!! $student->slug !!}" class="hide-modal--top">
                <svg class="hide-modal--top__svg svg--alert">
                    <use xlink:href="#shape-close-modal"></use>
                </svg>
                <span class="visuallyhidden">@include('partials.panel.close-message')</span>
            </a>
            <p>Vous êtes sur le point de supprimer l'élève : {!! $student->fullname !!}</p>
            <div class="text--center btn-container">
                <button class=" btn btn--small btn--red-svg btn--alert"
                        title="Supprimer l'élève : {!! $student->fullname !!}">
                    <svg class="svg-basic svg--white">
                        <use xlink:href="#shape-trash"></use>
                    </svg>
                    <span>Supprimer l'élève {!! $student->fullname !!}</span>
                </button>
            </div>
            <a href="#" data-form="delete-class-form--{!! $student->slug !!}">@include('partials.panel.close-message')</a>
            {!! Form::close() !!}
        </div>
    @endunless
</article>