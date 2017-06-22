<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    {!! Form::label('email','Votre adresse email',['class'=>'floating-placeholder__label floating-placeholder__label--white']) !!}
    {!! Form::input('email','email',old('email'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : votre.email@domaine.com','autofocus']) !!}
    @include('errors.error_field',['field'=>'email','name'=>'votre adresse email'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    {!! Form::label('password','Votre mot de passe',['class'=>'floating-placeholder__label floating-placeholder__label--white']) !!}
    {!! Form::input('password','password','',['class'=>'floating-placeholder__input--huge floating-placeholder__input']) !!}
    <a href="#" class="form-group__svg" title="Monter/cacher le mot de passe" data-toggle="tooltip" id="oLinkPassword">
        <svg class="svg-basic svg--blue">
            <use xlink:href="#shape-iris_close"></use>
        </svg>
    </a>
    @include('errors.error_field',['field'=>'password','name'=>'votre mot de passe'])
</div>
{!! Form::label('remember','Se souvenir de moi',['class'=>'']) !!}
{!! Form::checkbox('remember',old('remember'),['class'=>'']) !!}
<div class="form-group">
        {!! Form::submit('S’identifier',['class'=>'btn btn--large']) !!}
</div>

