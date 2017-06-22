{!! Form::hidden('email',$request[0]) !!}
{!! Form::hidden('password',bcrypt($request[1])) !!}
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--small-height">
    {!! Form::label('name','Votre nom complet',['class'=>'floating-placeholder__label floating-placeholder__label--white']) !!}
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Jane','autofocus']) !!}
    @include('errors.error_field',['field'=>'name','name'=>'votre nom complet'])
</div>
<div class="form-group floating-placeholder-float--small-height">
    <a href="{{ URL::previous() }}">Retour en arrière</a>
    {!! Form::submit($submit,['class'=>'btn btn--large']) !!}
</div>
