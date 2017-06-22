@extends('layouts.teacher_layout')
@section('title', 'Valider votre liste d’élève')
@section('teacher_content')
    {!! Form::open(['action' => 'Www\StudentController@storeValidatedInport','method'=>'post','class'=>'','enctype'=>'multipart/form-data']) !!}
    <div class="header-action-box">
        @include('partials.nav.import_nav')
        {!! Form::submit('Importer ces élèves',['class'=>'btn']) !!}
    </div>
    <div class="student-list layout">
        <?php $i = 1; ?>
        @foreach($studentImport as $student)
            <div class="layout__item  u-4/12-desk u-6/12-lap u-12/12-palm">
                <div class="student-item student-item-succes box">
                    <div class="form-group user_avatar-container">
                        <label for="avatar-{{ $i}}">
                        <span class="profile-avatar__placeholder">
                            <img id="user-avatar"
                                 class="cropie-image"
                                 alt=""
                                 src=""/>
                        </span>
                            <span class="profile-avatar__placeholder__message">Cliquez pour choisir une image.</span>
                        </label>
                        <p class="profile-avatar__placeholder__meta">Le format de l'image doit être .png ou .jpg ,et
                            elle doit être d'au
                            moins 100 pixels par 100 pixels</p>
                        {!! Form::input('file','avatar-'.$i,old('avatar-'.$i),['class'=>'visuallyhidden avatar-loader-input','id'=>'avatar-'.$i]) !!}
                        @include('errors.error_field',['field'=>'avatar','name'=>'photo de profil'])
                    </div>
                    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
                        <label for="first_name-{{ $i}}" class="floating-placeholder__label">Le prénom de
                            l’élève @include('forms.partials.required')</label>
                        {!! Form::input('text','first_name-'.$i,null==old('first_name-'.$i)?$student['first_name']:old('first_name-'.$i),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Claude','id'=>'first_name-'.$i]) !!}
                        @include('errors.error_field',['field'=>'first_name-'.$i,'name'=>'le prénom de l’élève'])
                    </div>
                    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
                        <label for="last_name-{{ $i}}" class="floating-placeholder__label">Le nom
                            l’élève @include('forms.partials.required')</label>
                        {!! Form::input('text','last_name-'.$i,null==old('last_name-'.$i)?$student['last_name']:old('last_name-'.$i),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Claude','id'=>'last_name-'.$i]) !!}
                        @include('errors.error_field',['field'=>'last_name-'.$i,'name'=>'le nom l’élève'])
                    </div>
                    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
                        <label for="email-{{ $i}}" class="floating-placeholder__label">L’e-mail de
                            l’élève @include('forms.partials.required')</label>
                        {!! Form::input('text','email-'.$i,null==old('email-'.$i)?$student['email']:old('email-'.$i),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Claude','id'=>'email-'.$i]) !!}
                        @include('errors.error_field',['field'=>'email-'.$i,'name'=>'l’e-mail de l’élève'])
                    </div>
                    <?php $classe_id = \Session::get('classe_id');
                    $session_classe = isset($classe_id) ? $classe_id : '';
                    ?>
                    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
                        <label for="classe_id-{{$i}}" class="filter-result__item__label floating-placeholder__label">Sélectionner
                            une classe</label>
                        {!! Form::select('classe_id-'.$i,$allClasses,null==old('classe_id-'.$i)?$session_classe:old('classe_id-'.$i),['class'=>'mask',"data-type"=>"select",'id'=>'classe_id-'.$i]) !!}
                        @include('errors.error_field',['field'=>'classe_id-'.$i,'name'=>'sélectionner une classe'])
                    </div>
                    <input type="checkbox" class="visuallyhidden btn--delete-user-label" name="remove_user-{{$i}}"
                           id="remove_user-{{$i}}" value="1">
                    <label for="remove_user-{{$i}}" class="btn btn--small btn--alert btn--delete-user">Supprimmer
                        l’élève de l'importation</label>
                    @include('errors.error_field',['field'=>'remove_user-'.$i,'name'=>'Supprimmer l’élève de l’importation'])
                </div>
            </div>
            <?php $i++; ?>
        @endforeach
    </div>
    {!! Form::hidden('nbr',$i) !!}
    {!! Form::submit('Importer ces élèves',['class'=>'btn']) !!}
    {!! Form::close() !!}
@stop