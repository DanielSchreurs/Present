<div class="form-group user_avatar-container">
    <label for="avatar">
        <span class="profile-avatar__placeholder {{ empty($student->avatar)?'':'avatar--success' }}">
            <img id="user-avatar"
                 class="cropie-image"
                 alt=""
                 src=""/>
        </span>
        <span class="profile-avatar__placeholder__message">Cliquez pour choisir une image.</span>
    </label>
    <p class="profile-avatar__placeholder__meta">Le format de l'image doit être .png ou .jpg ,et elle doit être d'au
        moins 100 pixels par 100 pixels.</p>
    {!! Form::input('file','avatar',null,['class'=>'visuallyhidden avatar-loader-input','id'=>'avatar']) !!}
    @include('errors.error_field',['field'=>'avatar','name'=>'photo de profil'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-student-first_name"
           class="floating-placeholder__label">Prénom @include('forms.partials.required')</label>
    {!! Form::input('text','first_name',old('first_name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Valérie','id'=>'create-student-first_name']) !!}
    @include('errors.error_field',['field'=>'first_name','name'=>'prénom'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-student-last_name" class="floating-placeholder__label">Nom de
        famille @include('forms.partials.required')</label>
    {!! Form::input('text','last_name',old('last_name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Dumont','id'=>'create-student-last_name']) !!}
    @include('errors.error_field',['field'=>'last_name','name'=>'nom de famille'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-student-email" class="floating-placeholder__label">L’adresse mail de
        l’élève @include('forms.partials.required')</label>
    {!! Form::input('email','email',old('email'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : velérie.dumont@domaine.com','id'=>'create-student-email']) !!}
    @include('forms.partials.base-info',['message'=>'L’adresse mail doit être unique parmis tous vos élèves.'])
    @include('errors.error_field',['field'=>'email','name'=>'l’adresse mail de l’élève'])
</div>
@unless(empty(Auth::user()->schools->toArray()))
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label for="" class="floating-placeholder__label">Le nom des écoles @include('forms.partials.required')</label>
        {!! Form::select('school_id',$schools,old('school_id'),['class'=>'mask',"data-type"=>"select"]) !!}
        @include('errors.error_field',['field'=>'school_id','name'=>'le nom des écoles'])
    </div>
@endunless
@unless(empty(Auth::user()->classes->toArray()))
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
        <label class="floating-placeholder__label">Le nom des classes @include('forms.partials.required')</label>
        {!! Form::select('classes_id[]',$classes,old('classes_id'),['class'=>'mask',"data-type"=>"select"]) !!}
        @include('errors.error_field',['field'=>'classes_id','name'=>'le nom des classes'])
        <a href="{{ URL::action('Www\ClassController@create') }}">Ou créez une classe</a>
    </div>
@endunless
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit('Créer l’élève',['class'=>'btn']) !!}
</div>
