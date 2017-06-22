<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    {!! Form::label('email','Votre adresse email',['class'=>'floating-placeholder__label floating-placeholder__label--white']) !!}
    {!! Form::input('email','email',old('email'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : votre.email@domaine.com','autofocus']) !!}
    @include('errors.error_field',['field'=>'email','name'=>'votre adresse email'])
</div>
<div class="form-group">
    {!! Form::submit('M’envoyer un lien',['class'=>'btn']) !!}
</div>