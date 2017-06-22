<div class="form-group user_avatar-container">
    <label for="avatar">
        <span class="profile-avatar__placeholder {{ empty($student->avatar)?'':'avatar--success' }}">
            <img id="user-avatar"
                 class="cropie-image"
                 alt=""
                 src="{{ empty($student->avatar)?'/':'/image-origine-student/'.$student->avatar }}"/>
        </span>
        <span class="profile-avatar__placeholder__message">Cliquez pour choisir une image.</span>
    </label>
    <p class="profile-avatar__placeholder__meta">Le format de l'image doit être .png ou .jpg ,et elle doit être d'au
        moins 100 pixels par 100 pixels.</p>
    {!! Form::input('file','avatar',null,['class'=>'visuallyhidden avatar-loader-input','id'=>'avatar']) !!}
    @include('errors.error_field',['field'=>'avatar','name'=>'photo de profil'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="edit-student-first_name-{!! $student->id !!}" class="floating-placeholder__label">Prénom @include('forms.partials.required')</label>
    {!! Form::input('text','first_name',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Valérie','id'=>'edit-student-first_name-'.$student->id]) !!}
    @include('errors.error_field',['field'=>'first_name','name'=>'prénom'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="edit-student-last_name-{!! $student->id !!}" class="floating-placeholder__label">Nom de famille @include('forms.partials.required')</label>
    {!! Form::input('text','last_name',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Dumont','id'=>'edit-student-last_name-'.$student->id]) !!}
    @include('errors.error_field',['field'=>'last_name','name'=>'nom de famille'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="edit-student-email-{!! $student->id !!}" class="floating-placeholder__label">Email de l’élève @include('forms.partials.required')</label>
    {!! Form::input('email','email',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : velérie.dumont@domaine.com','id'=>'edit-student-email-'.$student->id]) !!}
    @include('errors.error_field',['field'=>'email','name'=>'email de l’élève'])
</div>
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>
